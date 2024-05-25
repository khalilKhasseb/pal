<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Welcome') . ' ' . auth()->user()->name }}
                </div>
            </div>

            <div x-data="{
                content: [],
                tabContent: null,
                trans: {
                    'download': '{{ __('Downlaod') }}',
                    'preview': '{{ __('Preview') }}'
                },
                fetchContent(slug) {
                    console.log(this.content[slug])
                    this.tabContent = this.content[slug]
                },
                addFiles(slug, files) {
                    this.content[slug] = files
                }
            }" class="mt-5 bg-white shadow-sm dark:bg-gray-900 dark:text-gray-100">

                {{-- Librara category each category when click wiil request its library and replace content with respobse content --}}

                <div class="grid gap-2 p-4 bg-white rounded-lg sm:grid-cols-2 lg:grid-cols-4 dark:bg-gray-800">
                    @unless (empty($libraries) && is_null($libraries))


                        @foreach ($libraries as $library)
                            <div x-init="addFiles('{{ $library->slug }}', @js($library->getFiles()))" x-on:click="fetchContent('{{ $library->slug }}')"
                                class="p-2 font-bold text-black bg-gray-200 rounded cursor-pointer dark:text-gray-300 dark:bg-gray-500 text-start">
                                <p class="text-lg"> {{ $library->title }} </p>
                                @if (!is_null($library->description))
                                    <p class="text-sm font-light dark:text-gray-200"> {{ $library->description }} </p>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="w-full p-2 text-center border rounded shadow dark:bg-gray-80">
                            {{ __('There is no libraries yet.') }}</div>
                    @endunless


                </div>
                <div class="grid gap-5 p-4 my-4 rounded sm:grid-cols-2 lg:grid-cols-4 dark:bg-gray-800 shadown-sm"
                    id="content-library" x-ref="content">
                    <template x-for="file in tabContent">
                        <div x-show="tabContent!==null" class="p-2 border border-solid rounded dark:border-gray-400">
                            <h1 class="mb-2" x-text="file.name"> </h1>
                            <a x-bind:class="`bg-green-600 text-white font-bold text-xs px-2 py-1 rounded-lg ${tabContent === null ? 'hidden' : ''}`"
                                target="_blank" x-bind:href="file.original_url" x-text=" trans['download']" download>
                            </a>
                            <a x-bind:class="`bg-blue-600 text-white font-bold text-xs px-2 py-1 rounded-lg ${tabContent === null ? 'hidden' : ''}`"
                                target="_blank" x-bind:href="file.original_url" x-text="trans['preview']"> </a>
                        </div>
                    </template>
                </div>
            </div>
        </div>


    </div>
</x-app-layout>
