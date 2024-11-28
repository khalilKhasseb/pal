<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;
use App\Models\Panel;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use App\Models\Blog\Tag;

trait HasMultiablePanels
{

    /**
     * Handles creating a record in the database.
     *
     * @param array $data The form data.
     *
     * @return Model The created record.
     */
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
        if (!filled($originalData['panels'])) {
            $panel = Panel::findByName(Filament::getCurrentPanel()->getId());
            $record = $this->attachPanel($record, $panel);
            // dd($record->panels);

            return $record;

        }

        return $record;
    }

        /**
         * Attach panel to the record.
         *
         * @param  Model  $record
         * @param  mixed  $panel
         * @return Model
         */
    private static function attachPanel(Model $record, $panel): Model
    {
        // try to load method from record name
        $recordName = str(class_basename($record))->lcfirst()->plural()->value();
        if (method_exists($panel, $recordName)) {
            $panel->$recordName()->attach($record->id);
        }

        return $record;
    }



    /**
     * Sync record tags to panel tags.
     *
     * @param  Model|null  $record
     * @param  mixed  $panel
     * @return void
     */
    protected function asingRecordTagsInputToPanel(?Model $record, $panel): void
    {

        if (!$record->tags->isEmpty()) {

            $record->tags->each(function ($tag) use ($panel) {

                $panel->tags()->syncWithoutDetaching($tag->id);

            });
        }

    }

    /**
     * After create record.
     *
     * If the record is instance of MorphToMany tags, we sync tags to panel tags.
     *
     * @return void
     */
    protected function afterCreate(): void
    {

        if ($this->getRecord()->isRelation('tags')) {

            $panel = Panel::findByName(Filament::getCurrentPanel()->getId());

            $this->asingRecordTagsInputToPanel($this->getRecord(), $panel);
        }
    }
}
