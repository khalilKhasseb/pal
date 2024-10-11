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
        // validate relation 
        if (!$record->isRelation('panels'))
            return;

        // check if has panels 
        if (!$this->hasPanels($record))
            $record = $this->assingPanel($record);

        // asing tags to panels 

        $record->panels->each(function ($panel) use ($record) {
            $panel->tags()->syncWithoutDetaching($record->tags);
        });
    }

    private function hasPanels(Model $record): bool
    {
        return $record->isRelation('panels') && !$record->panels->isEmpty();
    }

    protected function asingPanels(Model $record): Model
    {
        $panel = \App\Models\Panel::findByName(filament()->getCurrentPanel()->getId())->id;
        $record->panels->attach($panel->id);
        return $record;
    }
}