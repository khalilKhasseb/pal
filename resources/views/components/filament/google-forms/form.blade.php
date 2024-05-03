@use(Illuminate\Support\Str)
@props(['formid', 'items' => [], 'answers' => []])
{{-- @dd($answers , $items) --}}
<div id="{{ $formid }}" class="form" x-data="{
    getFormData(e = null) {
        e.preventDefault();
        const formData = new FormData($refs.form);
        for (const pair of formData.entries()) {
            console.log(pair[0], pair[1]);
          }
       // console.log(formData.entries(), $refs.form)
    },
}">

    <form action="" method="post" class="form-elemnt" x-ref="form" >
        {{-- If item is single --}}

        <button x-on:click="getFormData">Transfer data</button>
        @foreach ($items as $item)
            <div id={{ $item['itemId'] }} class="form-item rounded border border-sm border-gray-300 shadow p-4 mb-2">
                <h3 class="item-title font-bold text-lg text-gray-500 mb-5">
                    {{ !is_null($item['title']) ? $item['title'] : __('No title') }}</h3>

                @isset($item['questionItem'])
                    @php
                        $questionId = $item['questionItem']['question']['questionId'];
                        $required = $item['questionItem']['question']['required'];

                        unset($item['questionItem']['question']['questionId']);
                        unset($item['questionItem']['question']['required']);
                        $answer = array_key_exists($questionId, $answers)
                            ? $answers[$questionId]['textAnswers']['answers']
                            : [];
                        $props = $item['questionItem']['question'][array_key_first($item['questionItem']['question'])];
                        $componentName = Str::of(array_key_first($item['questionItem']['question']))->kebab();
                    @endphp
                    <x-dynamic-component :component="'filament.google-forms.questions.' . $componentName" :props="$props" :answer="$answer" :questionid="$questionId"
                        class="mt-4" />
                @endisset

                @isset($item['questionGroupItem'])
                    @php
                        // create array named for cloumnd
                        $columns = array_map(function ($col) {
                            return $col;
                        }, $item['questionGroupItem']['grid']['columns']['options']);
                    @endphp
                    <div class="table w-full p-[15px] bg-fuchsia-100 rounded">
                        <div class="table-header-group">
                            <div class="table-row text-center">
                                <div class="table-cell p-4"></div>
                                {{-- Questions --}}
                                @foreach ($item['questionGroupItem']['grid']['columns']['options'] as $option)
                                    <div data-col="col-{{ $loop->index }}" data-col-value={{ $option['value'] }}
                                        class="table-cell p-4 text-center">{{ $option['value'] }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="table-row-group">

                            {{-- @dd($item['questionGroupItem']) --}}
                            @foreach ($item['questionGroupItem']['questions'] as $question)
                                @php
                                    $answer = array_key_exists($question['questionId'], $answers)
                                        ? $answers[$question['questionId']]
                                        : null;
                                    $answer = is_null($answer) ? null : $answer['textAnswers']['answers'][0]['value'];
                                @endphp
                                <div class="table-row">
                                    <div class="table-cell p-4 ltr:text-left rtl:text-right">
                                        {{ $question['rowQuestion']['title'] }}</div>
                                    {{-- @dump(isset($answers[$question['questionId']])) --}}
                                    @foreach ($item['questionGroupItem']['grid']['columns']['options'] as $option)
                                        <div class="table-cell p-4 text-center">
                                            <input name="{{ $loop->index }}-row"
                                                {{ $answer === $option['value'] ? 'checked' : '' }}
                                                type="{{ $item['questionGroupItem']['grid']['columns']['type'] }}"
                                                value="{{ $option['value'] }}">
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endisset
            </div>
        @endforeach
    </form>
</div>
