<x-filament-panels::page>


    {{ $this->table }}

    <x-filament::modal id="responce" width="5xl" slide-over>
        <x-slot name="heading">
            Heading
        </x-slot>

        {{-- Modal contanet --}}
        <div class="form container max-auto grid grid-cols-1 gap-10 px-[24px]">
            @php
                $items = !empty($this->formitems) && isset($this->formitems) ? json_decode($this->formitems, true) : [];
                $formResponses =
                    !empty($this->formResponses) && isset($this->formResponses)
                        ? json_decode($this->formResponses, true)
                        : [];

            @endphp

            @foreach ($formResponses as $response)
                <div x-data="{
                    open:false,
                }" x-init="console.log('hello')">
                    <div class="flex justify-between items-center border border-gray-400 mb-2 pl-2 shadow rounded ">
                        <h4>{{$response['respondentEmail']}}</h4>
                        <button x-on:click="open = !open" class="bg-green-600 p-3 text-center text-white">View</button>
                    </div>
                    <div x-show="open" x-transition >
                        <x-filament.google-forms.form :formid="'213asdz21'" :items="$items" :answers="$response['answers']" />
                    </div>
                </div>
            @endforeach

        </div>
        <x-slot name="footer">
            Footer
        </x-slot>
    </x-filament::modal>

</x-filament-panels::page>
