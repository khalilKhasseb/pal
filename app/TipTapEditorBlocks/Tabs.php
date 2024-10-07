<?php 
namespace App\TipTapEditorBlocks;

use FilamentTiptapEditor\TiptapBlock ;
use Filament\Forms\Components as c;
class Tabs  extends TiptapBlock {
    //Block settigns 

    public string $preview = 'tiptap.blocks.previews.tabs';
    public string $rendered = 'tiptap.blocks.rendered.tabs';

    public string $width = 'xl';

    public bool $slideOver = true;

    public ?string $icon = 'heroicon-o-film';

    public function getFormSchema(): array
    {
        return [
            c\TextInput::make('name'),
            c\TextInput::make('color'),
            c\Select::make('side')
                ->options([
                    'Hero' => 'Hero',
                    'Villain' => 'Villain',
                ])
                ->default('Hero')
        ];
    }
}