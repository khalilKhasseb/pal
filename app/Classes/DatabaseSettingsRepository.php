<?php

namespace App\Classes;

use Spatie\LaravelSettings\SettingsRepositories\DatabaseSettingsRepository as DBR;

class DatabaseSettingsRepository extends DBR
{

    public function getPropertyPayload(string $group, string $name)
    {
        $setting = $this->getBuilder()
            ->where('group', $group)
            ->where('name', $name)
            ->first('payload')
            ->toArray();


        if (is_array($setting['payload'])) return $setting['payload'];

        // $setting['payload'] = str(json_encode($setting['payload'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))->value;

        return $this->decode($setting['payload'], true);
    }
    public function updatePropertiesPayload(string $group, array $properties): void
    {

        $propertiesInBatch = collect($properties)->map(function ($payload, $name) use ($group) {
            return [
                'group' => $group,
                'name' => $name,
                'payload' => is_array($payload) ? $this->encode($payload) : $payload,
            ];
        })->values()->toArray();

        $this->getBuilder()
            ->where('group', $group)
            ->upsert($propertiesInBatch, ['group', 'name'], ['payload']);
    }

    public function getPropertiesInGroup(string $group): array
    {

        return $this->getBuilder()
            ->where('group', $group)
            ->get(['name', 'payload'])
            ->mapWithKeys(function (object $object) {

                if (!is_array($object->payload)&&!is_null($this->decode($object->payload, true))) {
                    return [$object->name =>  $this->decode($object->payload, true)];
                }
                return [$object->name => $object->payload];
            })
            ->toArray();
    }
}
