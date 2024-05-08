<?php

namespace App\Classes;

use Google\Client;
use Google\Service\Drive\DriveFile;

class GoogleFormsApi
{

    // first operation : Construct a client connection to google forms api

    protected string $formsMimeType = 'application/vnd.google-apps.form';
    protected string $trashed = "false";
    public function __construct(
        protected Client $client
    ) {
    }

    /**
     * Undocumented function
     *
     * @return array DriveFile[] $file
     */
    public function getForms()
    {
       
        $service = new \Google\Service\Drive($this->client);

        $files =  $service->files->listFiles([
            'q' => "mimeType='$this->formsMimeType' and trashed=$this->trashed",
            'fields' => 'files(id, name, webViewLink,webContentLink, mimeType ,capabilities/canDownload)'
        ]);

        return $files->getFiles();
    }

    public function getForm(string $id)
    {

        $service = new \Google\Service\Forms($this->client);

        $form  = $service->forms->get($id);

        return $form;
    }

    public function getFormResponse(string $id)
    {

        $this->client->addScope('https://www.googleapis.com/auth/forms.responses.readonly');
        $responseService = new \Google\Service\Forms($this->client);

        $response = $responseService->forms_responses->listFormsResponses($id);

        return $response->getResponses();
    }

    public function getFormItemsWithQuestions()
    {

        $forms = $this->getForms();
        $itemsArr = [];
          // get each from as form item

        foreach ($forms as $formItem) {
            // get form items
            $items = $this->getForm($formItem->getId())->getItems();

            $itemsArr[$formItem->getId()] = [];
            // get item content
            foreach ($items as $item) {
                // build item array
                $itemsArr[$formItem->getId()][$item->getQuestionItem()?->getQuestion()->getQuestionId()] =  [

                    'id' => $item->getItemId(),
                    'title' => $item->getTitle(),
                    'question' => [
                        'id' => $item->getQuestionItem()?->getQuestion()->getQuestionId()
                    ]

                ];
            }
        }
        return $itemsArr;
    }
    public function getClient(): Client
    {
        if ($this->client === null || !isset($this->client)) {
            $this->client = GoogleAuthnticate::makeClient();
        }

        return $this->client;
    }
}
