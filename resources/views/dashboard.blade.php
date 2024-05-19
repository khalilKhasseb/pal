<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome") . " " .auth()->user()->name}}
                </div>
            </div>

            <div x-data="{
                content: [],
                tabContent: null,
                trans:{
                   'download': '{{__("Downlaod")}}',
                   'preview': '{{__("Preview")}}'
                },
                fetchContent(slug) {
                    console.log(this.content[slug])
                    this.tabContent = this.content[slug]
                },
                addFiles(slug, files) {
                    this.content[slug] = files
                }
            }" class="bg-white dark:bg-gray-900 dark:text-gray-100 mt-5  shadow-sm">

                {{-- Librara category each category when click wiil request its library and replace content with respobse content --}}

                <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-4 bg-white dark:bg-gray-800 p-4 rounded-lg">
                    @if (!empty($libraries) && !is_null($libraries))


                        @foreach ($libraries as $library)
                            <div x-init="addFiles('{{ $library->slug }}', @js($library->getFiles()))" x-on:click="fetchContent('{{ $library->slug }}')"
                                class="bg-gray-200 text-black dark:text-gray-300 dark:bg-gray-500 rounded text-start font-bold p-2 cursor-pointer">
                                <p class="text-lg"> {{ $library->title }} </p>
                                @if (!is_null($library->description))
                                    <p class="dark:text-gray-200 font-light text-sm"> {{ $library->description }} </p>
                                @endif
                            </div>
                        @endforeach

                    @endif


                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 my-4 dark:bg-gray-800 rounded p-4 shadown-sm" id="content-library" x-ref="content">
                    <template x-for="file in tabContent">
                        <div x-show="tabContent!==null" class="border border-solid dark:border-gray-400 rounded p-2">
                            <h1 class="mb-2" x-text="file.name"> </h1>
                            <a x-bind:class="`bg-green-600 text-white font-bold text-xs px-2 py-1 rounded-lg ${tabContent === null ? 'hidden' : ''}` " target="_blank" x-bind:href="file.original_url" x-text=" trans['download']" download> </a>
                            <a  x-bind:class="`bg-blue-600 text-white font-bold text-xs px-2 py-1 rounded-lg ${tabContent === null ? 'hidden' : ''}`" target="_blank" x-bind:href="file.original_url" x-text="trans['preview']"> </a>
                        </div>
                    </template>
                </div>
            </div>
        </div>


    </div>
</x-app-layout>
