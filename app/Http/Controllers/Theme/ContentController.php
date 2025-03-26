<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\Token;
use App\Models\SystemUser;
use Illuminate\Support\Collection;
use Google\Client;
use Google\Service\Forms;
use Google\Service\Drive;
use Google\Service\Forms\Form;
use  Google\Service\Forms\Info;
use App\Classes\GoogleAuthnticate;
use Illuminate\Support\Facades\Session;

class ContentController extends Controller
{

    public function like_post(int $id, Request $request)
    {

        // check for ip
         $post = Post::withoutGlobalScopes()
         ->find($id);
        if ($post->checkIfHasLikeForThisIp($request->getClientIp())) {

            $this->dislike_post($post, $request);

            return response()->json([
                'likes' => $post->likes === 0 || $post->likes === -1 ? 0 : $post->likes,
                'liked' => $post->checkIfHasLikeForThisIp($request->getClientIp()),
                'message' => 'Post ' . $post->id . " Has a dislike",
            ]);
        }
        // check if post has likes

        if (!$post->has_likes()) {
            // create a like instance and store it

            $post->likes()->create([
                'ip' => $request->getClientIp()
            ]);
        }



        $post->increment('likes');

        $post->update();

        return response()->json([
            'message' => 'Post ' . $post->id . " Has a like",
            'likes' => $post->likes,
            'liked' => $post->checkIfHasLikeForThisIp($request->getClientIp()),

        ]);
    }


    public function dislike_post(Post $post, Request $request)
    {

        // get like for a given ip for this post

        $like  = $post->get_like_ip($request->getClientIp());


        $like->delete();

        if ($post->likes !== 0) {
            $post->decrement('likes');
            $post->update();
        }



        return response()->json([
            'message' => 'Dislike',
            'likes' => $post->likes
        ]);
    }


    public function author_posts(int $id)
    {

        $user  =  SystemUser::find($id);

        return view('theme.pages.author_posts', ['posts' => $user->posts, 'author' => $user]);
    }


    public function connect()
    {

        dd(Session::get('access_token'));
        return redirect(GoogleAuthnticate::makeAuthnticateUrl([
            Forms::DRIVE,
            Forms::FORMS_BODY
        ]));
    }

    public function set_token(Request $request)
    {

        $client  = GoogleAuthnticate::makeClient();
        if ($request->has('code')) {

            $accessToken = $client->fetchAccessTokenWithAuthCode($request->code);
            if (!isset($accessToken['error'])) {
                $tokenData = array_merge(['code' => $request->code], $accessToken);
                \DB::table('tokens')
                    ->insert($tokenData);
            }
        }
    }


    public function fetch_forms()
    {
        // $r =  \DB::table('tokens')->where('id', '2')->get();
        // dd($r[0]->access_token);
        // $t = (array) $r;
        // dd($t);



        $client = GoogleAuthnticate::makeClient([
            Drive::DRIVE_READONLY
        ]);

        $service = new Forms($client);
        $driveService = new Drive($client);
        // dd($service->forms->get('1e-VMViperLCDdID9zzEqUOuQynV1lyFjFSiFd3mqYL8'));
        $response = $driveService->files->listFiles(['q' => "mimeType='application/vnd.google-apps.form' and trashed=false"]);
        dd($response->files[0]->getName());
        // dd($driveService->files->listFiles(['q' => "mimeType='application/vnd.google-apps.form'"]));
    }

    public function create_form()
    {

        $client = GoogleAuthnticate::makeClient();
        // check if theres is access token in databse
        $client->addScope([
            Forms::DRIVE,
            Forms::FORMS_BODY
        ]);

        $client->setAccessToken(Token::first()->token);

        // requset service
        $service = new Forms($client);

        $form = $this->makeForm(['title' => 'Laravel form filament', 'description' => 'Deescriopto']);

        $service->forms->create($form);
    }

    protected function makeForm(array $formData): Form
    {
        $formInfo = new Info;

        $formInfo->setDocumentTitle('test');
        $formInfo->setTitle('test title');
        // $formInfo->setDescription($formData['description']);

        $form = new Form;
        $form->setInfo($formInfo);
        return $form;
    }
}
