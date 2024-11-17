<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\GoogleAuthnticate;
use App\Models\Token;

use Filament\Facades\Filament;
//Google

use Google\Service\Forms;
use Google\Service\Drive;

class GoogleApiAuthController extends Controller
{

    /**
     * Redirect to Google Oatuh screen to grant access
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */

    public function __construct()
    {
        $this->middleware(Filament::getCurrentPanel()->getAuthMiddleware());
    }
    public function redirectToAuthnitcateUrl(Request $request): \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
    {
        //   dd();
        return redirect(GoogleAuthnticate::makeAuthnticateUrl([
            Forms::FORMS_BODY,
            Drive::DRIVE,
            'email' // to grant user information such as email in order to have multiabel accounts
        ]));
    }


    /**
     * Redirect URI callback
     * This Callback will store tokens to database
     * Will redircet back to same page where authnticate happens
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function callback(Request $request)  
    {

        // first step validate if token present in database
        
        $tokenData = [];
        $tokenInDatabase = !is_null(Filament::auth()->user()->googleTokens()->where('active', 1)->first());
        $client = GoogleAuthnticate::createClient();

        if ($request->has('code')) {
            // which means we successfuly authnitcated and retrive a code to use to fetchaccesstoken
            // fetchTokens
            $tokenData['code'] = $request->code;
            $token =  $client->fetchAccessTokenWithAuthCode($request->code);
            // case token is bad grant
            if (isset($token['error']) && 'invalid_grant' === $token['error']) return redirect(route('googel.redirect'));
            // case contniue no erros perfom databaes storage
            $client->setAccessToken($token);
            $idToken = $client->verifyIdToken();
            if (is_array($idToken)) {
                // validated if verfid email
                $tokenData['account_email'] = $idToken['email'];
            }
            $tokenData = array_merge($token, $tokenData);
            $tokenData['active'] = true ;

            $_token = null;

            $tokenInDatabase
                ? $_token  = $this->updateToken($tokenData)
                : $_token  = $this->storeToken($tokenData);

            Filament::auth()->user()->googleTokens()->save($_token);

            return redirect()->intended();
        }



         return redirect() ;
    }

    public function refreshToken(Request $request)
    {

        $tokenData = [];
        $refresh_token = json_decode(file_get_contents(base_path('refresh_token.json')), true)['refresh_token'];

        // dd($refresh_token);
        $client = GoogleAuthnticate::createClient();

        $token = $client->fetchAccessTokenWithRefreshToken($refresh_token);

        $token['code'] = Token::first()->code;

        $tokenData = array_merge($token, $tokenData);

        $this->updateToken($tokenData);
        dump($client->getAccessToken()['access_token'] === Token::first()->access_token);
    }

    protected function updateToken(array $data): Token
    {

        $token =  Token::first();
        $token->update($data);

        return $token;
    }

    protected function storeToken(array $data): Token
    {

        $token = Token::create($data);
        return $token;
    }

    /**
     * Athunticate Google api and store tokens
     *
     * @param Request $request
     * @return void
     */
    public function authnticate(Request $request): \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
    {
        // this function only do one thing which is redirec to google auth url
        return redirect(GoogleAuthnticate::makeAuthnticateUrl([
            Forms::FORMS_BODY,
            Forms::DRIVE,
            'email'
        ]));
    }
    protected function validateToken(string $token)
    {
        // $client  = GoogleAuth
    }
    protected function valid_token(string $token)
    {
    }
}
