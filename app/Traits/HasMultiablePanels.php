<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;
use App\Models\Panel;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

trait HasMultiablePanels
{

    protected function handleRecordCreation(array $data): Model
    {
        $record = app(static::getModel());

        $translatableAttributes = static::getResource()::getTranslatableAttributes();

        $record->fill(Arr::except($data, $translatableAttributes));

        foreach (Arr::only($data, $translatableAttributes) as $key => $value) {
            $record->setTranslation($key, $this->activeLocale, $value);
        }

        $originalData = $this->data;

        foreach ($this->otherLocaleData as $locale => $localeData) {
            $this->data = [
                ...$this->data,
                ...$localeData,
            ];

            try {
                $this->form->validate();
            } catch (ValidationException $exception) {
                continue;
            }

            $localeData = $this->mutateFormDataBeforeCreate($localeData);

            foreach (Arr::only($localeData, $translatableAttributes) as $key => $value) {
                $record->setTranslation($key, $locale, $value);
            }
        }

        $this->data = $originalData;

        $record->save();

        $record = $this->attachPanel($record);

        return $record;
    }

    private static function  attachPanel(Model $record): Model
    {

        $panel = Panel::findByName(Filament::getCurrentPanel()->getId());

        // try to load method from record name

        $recordName = str(class_basename($record))->lcfirst()->plural()->value();

        if (method_exists($panel, $recordName)) {

            $panel->$recordName()->attach($record->id);
        }
        // eles return $record without attaching record to panel which means there is no method exists on the panel
        // go to add method ;
        // $panel->posts()->attach($record->id);

        return $record;
    }
}
