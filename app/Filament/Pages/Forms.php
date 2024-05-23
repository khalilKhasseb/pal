<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Actions\Action as InofListAction;
use Filament\Infolists\Components\Actions;



use Filament\Actions\Action;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

use Google\Service\Forms as FormService;
use Google\Service\Forms\Question;
use Google\Service\Forms\QuestionItem;
use Google\Service\Forms\QuestionGroupItem;
use Google\AccessToken\Revoke;
use Google\AccessToken\Verify;
use Google\Service\Drive;
use Google\Service\Forms as Google_Service_Forms;

use App\Models\GoogleForm;
use App\Models\Token;
use App\Filament\Widgets\StatsOverview;
use App\Classes\GoogleAuthnticate;
use App\Classes\GoogleFormsApi;

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
        if (Filament::auth()->user()->hasGoogleTokens()) {
            // dd(filament()->auth()->user());
            $this->service = new GoogleFormsApi(GoogleAuthnticate::makeClient([
                Drive::DRIVE_READONLY,
                Google_Service_Forms::FORMS_BODY_READONLY,
                Google_Service_Forms::FORMS_RESPONSES_READONLY
            ]));
        }
    }
    public function mount(): void
    {
        // $this->service = app(GoogleFormsApi::class);
    }

    public static function getNavigationLabel() : string {
        return __('Forms');
    }
    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable {
        return __('Forms');
    }
    public static function getNavigationBadge(): ?string
    {
        return GoogleForm::count();
    }

    public function table(Table $table): Table
    {

        return $table->query(GoogleForm::query())
            ->columns([
                TextColumn::make('name')
                ->label(__('Name')),
                TextColumn::make('type')
                ->label(__("Type")),
                TextColumn::make('responder_uri'),
            ])->actions([
                TableAction::make('viwe_response')
                    ->label(__('response'))
                    ->label(__('Responses'))
                    ->action(function (GoogleForm $record) {

                        $formItems = $this->service->getForm($record->google_file_id)->getItems();
                        $this->formitems = json_encode($formItems);
                        $this->formResponses = json_encode($this->service->getFormResponse($record->google_file_id));
                        $this->dispatch('open-modal', id: 'responce');
                    })->disabled(!Filament::auth()->user()->hasGoogleTokens()),
            ]);
    }


    protected function getHeaderActions(): array
    {
        return [
            Action::make(__('Fetch Forms'))
                ->action(function () {
                    $forms = $this->service;
             

                    foreach ($forms->getForms() as $form) {
                        $responderUri = $forms->getForm($form->getId())->getResponderUri();
                       

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
                                'responder_uri' => $responderUri ,
                                'questions' => json_encode($forms->getFormItemsWithQuestions()[$form->getId()]),
                            ]
                        );
                    }

                    // $this->resetTable();
                })->disabled(!Filament::auth()->user()->hasGoogleTokens()),
            Action::make('refresh')
            ->label(__("Refresh"))
                ->action(function () {
                    $this->resetPage();
                }),

            Action::make('revoke')
                ->label(__('Revoke'))
                ->action(function () {
                    $revoke = new Revoke;
                    $token  = Token::first();
                    $tokenarr = $token->toArray();
                    unset($tokenarr['created_at']);

                    if ($revoke->revokeToken($tokenarr)) {
                        $token->delete();
                        foreach (GoogleForm::all() as $formModel) {
                            $formModel->delete();
                        }
                    }


                    $this->resetTable();
                })->disabled(!Filament::auth()->user()->hasGoogleTokens())

        ];
    }

    public function authnticateInfoList(Infolist $infolist): InfoList
    {

        return $infolist->make()
            ->state([
                'hint' => __('To use google forms in this application Authnticate a google acount'),
                'account' => Filament::auth()->user()->tokens
            ])
            ->schema([
                Section::make()
                    ->schema([
                        TextEntry::make('hint')
                            ->label(__('Athnticate Google acount')),
                        Actions::make([
                            InofListAction::make('authnticate')
                                ->label(__('Authnticate'))
                                ->url(fn () => route('google.redirect'))
                        ])
                    ])->visible(function () {
                        return !Filament::auth()->user()->hasGoogleTokens();
                    })

            ]);
    }

    public static function canAccess(): bool
    {
        return Filament::getCurrentPanel()->getId() === 'admin';
    }
}
