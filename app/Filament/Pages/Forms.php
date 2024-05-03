<?php

namespace App\Filament\Pages;

use App\Classes\GoogleAuthnticate;
use App\Classes\GoogleFormsApi;
use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;

use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Columns\TextColumn;

use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Widgets\StatsOverview;
use Filament\Actions\Action;
use Filament\Tables\Actions\Action as TableAction;

use Filament\Tables\Table;
use App\Models\GoogleForm;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

use Google\Service\Forms as FormService;

use Google\Service\Forms\Question;
use Google\Service\Forms\QuestionItem;
use Google\Service\Forms\QuestionGroupItem;

class Forms extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.forms';

    public array $questionTypes = [
        'choiceQuestion',
        'shuffleQuestions',
        'timeQuestion',
        'dateQuestion',
        'textQuestion',
        'scaleQuestion'

    ];

    public array $googleForms = [];


    public  $formitems = [];
    public  $formResponses = [];
    protected GoogleFormsApi $service;

    public $modalContent;

    public function __construct()
    {
        $this->service = app(GoogleFormsApi::class);
    }
    public function mount(): void
    {

        $this->service = app(GoogleFormsApi::class);

    }
    public function table(Table $table): Table
    {
        // return $table->query();
        return $table->query(GoogleForm::query())
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('type'),
                TextColumn::make('google_mimeType'),
            ])->actions([
                TableAction::make('viwe_response')
                    ->label(__('response'))
                    ->action(function (GoogleForm $record) {


                        $formItems = $this->service->getForm($record->google_file_id)->getItems();
                        // dd($formItems);
                        // dd($this->service->getFormResponse($record->google_file_id));                        //  dd(json_decode(json_encode($formItems),true));
                        $this->formitems = json_encode($formItems);
                        $this->formResponses = json_encode($this->service->getFormResponse($record->google_file_id));
                        $this->dispatch('open-modal', id: 'responce');
                        // dd($formItems->toSimpleObject());
                    }),
            ]);
        //                 $service = app(GoogleFormsApi::class);

        //                 // make a request to fetch selected row0
        //                 // requst fomrs api service
        //                 $id = $record->google_file_id;
        //                 $questions = $record->questions;
        //                 //,$service->getFormResponse($id)
        //                 $form = $service->getForm($id);
        //                 // dd($service->getFormResponse($id)[0]->toSimpleObject() , $form->toSimpleObject()->items);
        //                 $reflectionClass = new \ReflectionClass('Google\Service\Forms\\Question');

        //                 $props = array_keys($reflectionClass->getProperties());


        //                 $itemsCollection = $form->toSimpleObject();

        //                 // $this->modalContent = $itemsCollection ;

        //                 $this->modalContent  = json_encode($itemsCollection);
        //                 $this->dispatch('open-modal' , id:"responce");

        //                 return ;
        //                 dd($itemsCollection);

        //                 $questionItems =  $itemsCollection->mapWithKeys(function ($value, $key) {

        //                     // check if gorup
        //                     if(!isset($value->questionItem) && isset($value->questionGroupItem)) {

        //                      }
        //                      #region Khall
        //                     // check if questoin item
        //                     if(isset($value->questionItem) && !isset($value->questionGroupItem)) {

        //                         $key = $value->question->questionId;
        //                     }

        //                     $swap = $value->questionItem->question;
        //                     unset($value->questionItem);
        //                     $value->question = $swap;
        //                     return [$key => $value];
        //                 })->toArray();

        //                 // $questionItemGroup = $itemsCollection->filter(function ($value, $key) {
        //                 //     return isset($value->questionGroupItem);
        //                 // })->toArray();

        //   #end region Khalil
        //                 // foreach ($questionItemGroup as $item) {
        //                 //     // add item to items question array
        //                 //     foreach ($item->questionGroupItem->questions as $question) {
        //                 //         $questionItems[$question->questionId] = [
        //                 //             'is_group' => true,
        //                 //             'itemId' => $item->itemId,
        //                 //             'title' => $item->title,
        //                 //             'question' => [
        //                 //                 'questionId' => $question->questionId,
        //                 //                 'question_title' => $question->rowQuestion->title,

        //                 //             ]
        //                 //         ];
        //                 //     }
        //                 // }
        //                 // map ansers to question
        //                 $responses = $service->getFormResponse($id);

        //                 foreach ($responses as $response) {
        //                     $answers = $response->toSimpleObject()->answers;

        //                     foreach ($answers as $key => $value) {
        //                         if (array_key_exists($key, $questionItems)) {
        //                             $questionItems[$key] = (array)$questionItems[$key];

        //                             $questionItems[$key]['answer'] = $value;

        //                             // $questionItems[$key] = collect($questionItems[$key]);
        //                         }
        //                     }
        //                 }





        //                 dd($questionItems, $questionItemGroup);



        //                 die;
        //                 //dd($questions);

        //                 //dd($service->getForm($id));

        //                 foreach ($service->getFormResponse($id) as $response) {
        //                     //    dump($questions[$response->anser])
        //                 }
        //                 // dd($this->formsApi->getForm($record->google_file_id));
        //             })
        //     ]);

    }


    protected function getHeaderActions(): array
    {
        return [
            Action::make(__('Fetch Forms'))
                ->action(function () {
                    $forms = app(GoogleFormsApi::class);


                    foreach ($forms->getForms() as $form) {


                        GoogleForm::updateOrCreate(
                            [
                                'google_file_id' => $form->getId(),
                            ],
                            [
                                'name' => $form->getName(),
                                'google_file_id' => $form->getId(),
                                'type' => 'form',
                                'google_mimeType' => $form->getMimeType(),
                                'web_view_link' => $form->getWebViewLink(),
                                'questions' => json_encode($forms->getFormItemsWithQuestions()[$form->getId()]),
                            ]
                        );
                    }

                    $this->resetTable();
                })
        ];
    }
}


// [
//  'item' =>
// ];
