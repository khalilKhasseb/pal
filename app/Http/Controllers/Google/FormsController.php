<?php

namespace App\Http\Controllers\Google;

use App\Classes\GoogleAuthnticate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoogleForm;
use Google\Client;
use Google\Service\Drive as Google_Service_Drive;
use Google\Service\Forms as Google_Service_Forms;
use App\Models\Token;
class FormsController extends Controller
{
    protected Client $client;
    public function __construct()
    {
        // if($%)
        // $this->client = GoogleAuthnticate::make([
        //     Google_Service_Drive::DRIVE_FILE,
        //     Google_Service_Forms::FORMS_BODY
        // ]);
    }

    public function fetchForms()
    {
        // $service = new Google_Service_Drive($this->client);
        // $files = $service->files->listFiles([
        //     'q' => "mimeType='application/vnd.google-apps.form' and trashed=false"
        // ]);
        // dd($files->getFiles()[0]->getWebContentLink());
        // if($files->getFiles()) {}
    }

    public function storeForm(array $formData): GoogleForm
    {

        $form = GoogleForm::create($formData);
        return $form;
    }
}
