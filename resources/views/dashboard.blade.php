@php
    $local = app()->getLocale();
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ]['2xl'];

@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div x-data="{
        modalIsOpen: false,
        item: null,
        library_items: null,
        content: [],
        tabContent: null,
        errors: [],
        loading: false,
        trans:{
             preview : @js(__('Preview'))
        }
    }" class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Welcome') . ' ' . auth()->user()->name }}
                </div>
            </div>

            <div x-data="{
                async fetchByTagItemByTagSlug(slug) {

                        this.loading = true;
                        let response = await axios({
                            method: 'get',
                            url: '{{ route('library.getBySlug') }}',
                            params: {
                                slug: slug
                            }
                        });
                        // check for response status any status but 200 considered error;
                        if (response.status === 200) {
                            this.library_items = response.data;
                        } else {
                            this.errors.push('Pleser contact Site admin for this error ' + response.status);
                        }
                        this.loading = false;
                        console.log(response.data, response)
                    },
                    openModal(id) {
                        modalIsOpen = true
                        this.item = this.library_items.filter(item => item.id === id)[0];
                        console.log(item)
                    }
            }" class="mt-5 bg-white shadow-sm dark:bg-gray-900 dark:text-gray-100">

                {{-- Librara category each category when click wiil request its library and replace content with respobse content --}}
                <div
                    class="grid gap-2 p-2 my-2 bg-white rounded shadow-sm md:grid-cols-2 lg:grid-cols-4 dark:bg-gray-800">
                    @foreach ($libraryTags as $cat)
                        <div x-on:click="fetchByTagItemByTagSlug('{{ $cat->slug }}')"
                            class="p-2 font-sans font-bold text-center bg-green-600 cursor-pointer dark:bg-green-500 hover:bg-green-600">
                            {{ $cat->name }}</div>
                    @endforeach
                </div>

                <div
                    :class="`grid gap-2 p-4 bg-white rounded-lg sm:grid-cols-2 lg:grid-cols-4 dark:bg-gray-800 ${loading ? 'opacity-40' : ''}`">


                    <template x-if="errors.length === 0 && library_items !== null">

                        <template x-for="lib in library_items">
                            <div @click="openModal(lib.id)"
                                class="p-2 font-bold text-black bg-gray-200 rounded cursor-pointer dark:text-gray-300 dark:bg-gray-500 text-start">
                                <p class="text-lg" x-text="lib.title.{{ $local }}"> </p>
                            </div>
                        </template>

                    </template>
                </div>

            </div>
        </div>

        {{-- Moda;; --}}
        <div x-data>
            <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
                @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false"
                class="fixed inset-0 z-30 flex items-end justify-center p-4 pb-8 bg-black/20 backdrop-blur-md sm:items-center lg:p-8"
                role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                <!-- Modal Dialog -->
                <div x-show="modalIsOpen"
                    x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                    x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                    class="flex flex-col w-6/12 gap-4 overflow-hidden bg-white border rounded-xl border-slate-300 text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                    <!-- Dialog Header -->
                    <div
                        class="flex items-center justify-between p-4 border-b border-slate-300 bg-slate-100/60 dark:border-slate-700 dark:bg-slate-900/20">
                        <h3 x-text="item !==null?item.title.{{ $local }} : '' " id="defaultModalTitle"
                            class="font-semibold tracking-wide text-black dark:text-white">
                            Special Offer</h3>
                        <button @click="modalIsOpen = false" aria-label="close modal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!-- Dialog Body -->
                    <div class="px-4 py-2">
                        <template x-if="item !==null">
                            {{-- if has files or ur; --}}
                            <div>
                                <h4 x-text="item.title.{{ $local }}"></h4>
                                <div class="flex justify-between align-baseline">
                                    <template x-for="file in item.files">
                                        <div>
                                           <p class="font-sans text-lg font-bold text-white text-start" x-text="file.name"></p>
                                           <div class="flex items-center justify-start gap-2">
                                              <a class="px-2 py-1 text-white bg-blue-500 rounded " :href="file.original_url" x-text="'{{__('Preview')}}'" target="_blank"></a>
                                              <a class="px-2 py-1 text-white bg-green-600 rounded" :href="file.original_url" x-text="'{{__('Download')}}'" download></a>
                                           </div>
                                        </div>

                                    </template>

                                </div>
                            </div>
                        </template>
                    </div>
                    <!-- Dialog Footer -->
                    <div
                        class="flex flex-col-reverse justify-between gap-2 p-4 border-t border-slate-300 bg-slate-100/60 dark:border-slate-700 dark:bg-slate-900/20 sm:flex-row sm:items-center md:justify-end">
                        <a x-show="item !== null && item.file_path !== null" :href="item !== null && item.file_path" target="_blank"
                            class="px-4 py-2 text-sm font-medium tracking-wide text-center transition cursor-pointer whitespace-nowrap rounded-xl text-slate-700 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:text-slate-300 dark:focus-visible:outline-blue-600">{{ __('Download') }}</a>
                        <button @click="modalIsOpen = false" type="button"
                            class="px-4 py-2 text-sm font-medium tracking-wide text-center transition bg-blue-700 cursor-pointer whitespace-nowrap rounded-xl text-slate-100 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">{{ __('close') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
