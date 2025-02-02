<!-- filepath: /Users/khalilkhasseb/Herd/dev.palgbc.org/resources/views/dashboard.blade.php -->
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
        selectedItem: null,
        library_items: [],
        content: [],
        tabContent: null,
        errors: [],
        loading: false,
        activeTab: null,
        trans: {
            preview: @js(__('Preview'))
        },
        async fetchByTagItemByTagSlug(slug) {
            this.loading = true;
            this.activeTab = slug;
            try {
                const response = await axios.get('{{ route('library.getBySlug') }}', { params: { slug } });
                if (response.status === 200) {
                    this.library_items = response.data;
                } else {
                    this.errors.push('Please contact Site admin for this error ' + response.status);
                }
            } catch (error) {
                console.error(error);
                this.errors.push('An error occurred while fetching the data.');
            } finally {
                this.loading = false;
            }
        },
        openModal(id) {
            this.selectedItem = this.library_items.find(item => item.id === id);

            console.log(this.selectedItem);
            this.modalIsOpen = true;
        },
        downloadFile(item) {
           console.log(item)
             const downloadLink = `/attachment/${item.media[0].id}`;
            window.location.href = downloadLink;
        },
        init() {
            if (this.$refs.firstTag) {
                this.fetchByTagItemByTagSlug(this.$refs.firstTag.dataset.slug);
            }
        }
    }" x-init="init" class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Welcome') . ' ' . auth()->user()->name }}
                </div>
            </div>

            <!-- Tabs for Library Categories -->
            <div class="grid gap-4 p-4 mt-4 bg-white rounded-lg shadow-md dark:bg-gray-800 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($libraryTags as $index => $cat)
                    <div x-on:click="fetchByTagItemByTagSlug('{{ $cat->slug }}')"
                        :class="{
                            'bg-green-700 text-white': activeTab === '{{ $cat->slug }}',
                            'bg-green-600 text-white': activeTab !== '{{ $cat->slug }}'
                        }"
                        class="p-4 font-sans font-bold text-center cursor-pointer rounded-lg dark:bg-green-500 hover:bg-green-700"
                        data-slug="{{ $cat->slug }}"
                        x-ref="{{ $index === 0 ? 'firstTag' : '' }}">
                        {{ $cat->name }}
                    </div>
                @endforeach
            </div>

            <!-- Loading Indicator -->
            <div x-show="loading" class="flex justify-center mt-4">
                <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12"></div>
            </div>

            <!-- Library Items -->
            <div class="grid gap-4 p-4 mt-4 bg-white rounded-lg shadow-md dark:bg-gray-800 md:grid-cols-2 lg:grid-cols-4">
                <template x-for="lib in library_items" :key="lib.id">
                    <div @click="openModal(lib.id)"
                        class="p-4 font-bold text-black bg-gray-100 border border-gray-300 rounded-lg cursor-pointer dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <div class="flex items-center">
                            <svg x-show="lib.type === 'FILE'" class="w-6 h-6 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <svg x-show="lib.type === 'url'" class="w-6 h-6 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 14.828a4 4 0 010-5.656m1.414 1.414a4 4 0 010 5.656M12 12h.01M9.172 9.172a4 4 0 010 5.656m-1.414-1.414a4 4 0 010-5.656M12 12h.01M12 12h.01"></path>
                            </svg>
                            <svg x-show="lib.type === 'IMAGE'" class="w-6 h-6 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 3v18M3 3l18 18"></path>
                            </svg>
                            <svg x-show="lib.type === 'VEIDEO'" class="w-6 h-6 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14m0 0l-4.553 2.276A1 1 0 019 15.382V8.618a1 1 0 011.447-.894L15 10z"></path>
                            </svg>
                            <p class="text-lg" x-text="lib.title.{{ $local }}"></p>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Modal -->
            <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="w-full max-w-3xl p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                    <div class="p-4">
                        <template x-if="selectedItem">
                            <div>
                                <div class="flex items-center justify-between">
                                    <h2 class="text-xl font-bold" x-text="selectedItem.title.{{ $local }}"></h2>
                                    <button @click="modalIsOpen = false"
                                        class="px-4 py-2 font-bold text-white bg-green-600 rounded-lg hover:bg-green-700">
                                        {{ __('Close') }}
                                    </button>
                                </div>
                                <p class="mt-2" x-text="selectedItem.description.{{ $local }}"></p>
                                <div class="mt-4 flex items-center space-x-4">
                                    <template x-if="selectedItem.type === 'FILE'">
                                        <button @click="downloadFile(selectedItem)"
                                            class="flex items-center px-4 py-2 font-bold text-white bg-green-600 rounded-lg hover:bg-green-700">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            {{ __('Download File') }}
                                        </button>
                                    </template>
                                    <template x-if="selectedItem.type === 'url'">
                                        <a :href="selectedItem.file_path" target="_blank"
                                            class="flex items-center px-4 py-2 font-bold text-white bg-green-600 rounded-lg hover:bg-green-700">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 14.828a4 4 0 010-5.656m1.414 1.414a4 4 0 010 5.656M12 12h.01M9.172 9.172a4 4 0 010 5.656m-1.414-1.414a4 4 0 010-5.656M12 12h.01M12 12h.01"></path>
                                            </svg>
                                            {{ __('Open URL') }}
                                        </a>
                                    </template>
                                    <template x-if="selectedItem.type === 'IMAGE'">
                                        <img :src="selectedItem.media[0].original_url" alt="Image"
                                            class="w-full h-auto mt-4 rounded-lg">
                                    </template>
                                    <template x-if="selectedItem.type === 'VIDEO'">
                                        <video controls class="w-full h-auto mt-4 rounded-lg">
                                            <source :src="selectedItem.media[0].original_url" type="video/mp4">
                                            {{ __('Your browser does not support the video tag.') }}
                                        </video>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('styles')
    <style>
        .loader {
            border-top-color: #3498db;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush