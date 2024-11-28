<?php
namespace App\Traits;
use Illuminate\Database\Eloquent\Model;

trait EditResourceHasPanels
{
    protected function afterSave(): void
    {
        $record = $this->getRecord();

        $this->validateRecordPanel($record);

    }
    protected function validateRecordPanel(?Model $record)
    {
        // validate relation. Its a must to throw an error if not exists and inform to add it to the form modal. 
        if (!$record->isRelation('panels'))
            return;

        // check if has panels 
        if (!$this->hasPanels($record))
            $record = $this->asingPanels($record);

        // asing tags to panels after validating if a record has even tags or not
        if ($record->isRelation('tags') && !$record->tags->isEmpty()) {
            
            $record->panels->each(function ($panel) use ($record) {
                $panel->tags()->syncWithoutDetaching($record->tags);
            });
        }


    }

    private function hasPanels(Model $record): bool
    {
        return $record->isRelation('panels') && !$record->panels->isEmpty();
    }

    protected function asingPanels(Model $record): Model
    {
        $panel = \App\Models\Panel::findByName(filament()->getCurrentPanel()->getId())->id;
        $record->panels()->attach($panel);
        return $record;
    }


    // protected function mutateFormDataBeforeSave(array $data): array
    // {
    //     dd($data);
    //     return $data;
    // }


}