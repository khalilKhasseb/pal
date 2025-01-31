<x-slot name="header">
    <h1>{{ __('FAQs') }}</h1>
</x-slot>

<x-slot name="breadcrumbs">
    <li class="flex items-center">
        {{ __('FAQs') }}
    </li>
</x-slot>


<div class="container">
    <!-- filepath: /Users/khalilkhasseb/Herd/dev.palgbc.org/resources/views/vendor/zeus/themes/zeus/sky/addons/faq.blade.php -->
    <!-- filepath: /Users/khalilkhasseb/Herd/dev.palgbc.org/resources/views/vendor/zeus/themes/zeus/sky/addons/faq.blade.php -->
    <!-- filepath: /Users/khalilkhasseb/Herd/dev.palgbc.org/resources/views/vendor/zeus/themes/zeus/sky/addons/faq.blade.php -->
    <div x-data="faqComponent()" class="container my-5">
        <div class="text-center mb-4">
            <h2 class="display-4">{{ __('Frequently Asked Questions') }}</h2>
            <p class="lead">{{ __('Find answers to the most common questions below.') }}</p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="list-group" id="parent-category-list">
                    @if (!$cats->isEmpty())
                        @foreach ($cats as $cat)
                            @if (is_null($cat->parent_id) && !$cat->children->isEmpty())
                                <a href="#" class="list-group-item list-group-item-action"
                                    :class="{ 'active': show['show_{{ $loop->index }}'] }"
                                    x-on:click.prevent="toggleCategory('show_{{ $loop->index }}')"
                                    x-init="initializeCategory({{ $loop->index }}, '{{ $cat->children->first()->slug }}')">
                                    {{ $cat->name }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-8">
                <div class="accordion" id="child-category-accordion">
                    @foreach ($cats as $cat)
                        @if (is_null($cat->parent_id) && !$cat->children->isEmpty())
                            <div x-show="show['show_{{ $loop->index }}']" x-transition>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">{{ $cat->name }}</h5>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($cat->children as $child)
                                            <button
                                                style="{{ app()->getLocale() === 'ar' ? 'text-align: right' : '' }}"
                                                class="btn btn-outline-primary btn-block mb-2"
                                                wire:click="loadFaqsForCategoryBySlug('{{ $child->slug }}')">
                                                {{ $child->name }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="mt-4">
                    @if (!empty($faqs))
                        <div class="accordion" id="faq-accordion">
                            @foreach ($faqs as $index => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-{{ $index }}">
                                        <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $index }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse-{{ $index }}">
                                            {{ $faq['question'] }}
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $index }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 53,1 Top
                                        aria-labelledby="heading-{{ $index }}" data-bs-parent="#faq-accordion">
                                        <div class="accordion-body">
                                            {{ $faq['answer'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function faqComponent() {
            return {
                show: {},
                initializeCategory(index, slug) {
                    if (index === 0) {
                        this.show['show_' + index] = true;
                        $wire.loadFaqsForCategoryBySlug(slug);
                    } else {
                        this.show['show_' + index] = false;
                    }
                },
                toggleCategory(key) {
                    Object.keys(this.show).forEach(k => {
                        if (k !== key) this.show[k] = false;
                    });
                    // Toggle the clicked category
                    this.show[key] = !this.show[key];
                }
            }
        }
    </script>

    <style>
        .list-group-item.active {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .btn-outline-primary {
            width: 100%;
            text-align: left;
        }

        .card {
            margin-bottom: 1rem;
        }

        .card-header {
            background-color: #f8f9fa;
        }
    </style>
</div>
