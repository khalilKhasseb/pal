<?php

namespace App\TiptapBlocks;

use FilamentTiptapEditor\TiptapBlock;
use Filament\Forms\Components as comp;
class PdfView extends TiptapBlock
{
    public string $preview = 'tiptap-blocks.previews.pdf-view';

    public string $rendered = 'tiptap-blocks.rendered.pdf-view';

    public function getFormSchema(): array
    {
        return [
            comp\FileUpload::make('pdf_file')
            ->acceptedFileTypes(['application/pdf'])
            ->disk('public')
        ];
    }
}