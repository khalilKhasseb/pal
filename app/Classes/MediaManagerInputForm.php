<?php 
namespace App\Classes;
use Filament\Forms;
class MediaManagerInputForm {

   public static function schema() : array {
        return [
            Forms\Components\TextInput::make('title')
                ->required()
                ->default('Untitled Media'),
            Forms\Components\TextInput::make('description')
                ->required()
                ->default('No decription added')
        ];
   } 
}