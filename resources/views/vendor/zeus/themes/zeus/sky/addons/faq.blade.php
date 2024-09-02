<x-slot name="header">
    <h1>{{ __('FAQs') }}</h1>
</x-slot>

<x-slot name="breadcrumbs">
    <li class="flex items-center">
        {{ __('FAQs') }}
    </li>
</x-slot>


<div class="container">
    <div x-data="{
        // show_1: false,
        //show_2: false,
        show: {},
        showcb(loopkey) {
            Object.keys(this.show).map(key => {
                if (key === loopkey) {
                    this.show[key] = true;
                } else {

                    this.show[key] = false;
                }
            })
        }
    }" class="row">

        <div class="py-2 parent-category-header">
            @if (!$cats->isEmpty())
                @foreach ($cats as $cat)
                    @php
                        $loopFirst = $loop->first;
                        $firstParent = null;
                    @endphp
                    @if (is_null($cat->parent_id) and !$cat->children->isEmpty())
                        <button class="p-2 ms-2 fs-1 border-success btn"
                         wire:click="loadParentItems({{$cat->id}})"
                         x-on:click="showcb('show_{{ $loop->index }}')"
                            x-init=" show.show_{{ $loop->index }} = false;
                             show = { ...show };
                             console.log(show)">{{ $cat->name }}</button>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="content-area">
            <div class="child-category-header">
                @foreach ($cats as $cat)
                    @if (is_null($cat->parent_id) and !$cat->children->isEmpty())
                        <template x-if="show.show_{{ $loop->index }}" wire:key="cat-parent{{ $cat->id }}">
                            <div class="mb-5">
                                @foreach ($cat->children as $child)
                                    <button class="p-2 ms-2 btn btn-success fs-6"
                                     wire:key="cat-child-{{ $child->id }}"
                                        x-on:click="$wire.loadFaqsForCategoryBySlug('{{ $child->slug }}')">{{ $child->name }}</button>
                                @endforeach
                            </div>
                        </template>
                    @endif
                @endforeach
            </div>
            <div class="faq-container">
                <div class="col-12">
                    @if (!is_null($faqs) and !$faqs->isEmpty())
                        <div class="mb-5 accordion" id="accordion-faqs}">
                            @foreach ($faqs as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $loop->index }}-{{ $faq->id }}"
                                            aria-expanded="true" aria-controls="collapse-{{ $loop->index }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $loop->index }}-{{ $faq->id }}"
                                        class="accordion-collapse collapse {{ $loop->first ? '' : '' }}"
                                        aria-labelledby="heading-{{ $loop->index }}"
                                        data-bs-parent="#accordion-{{ $loop->index }}-{{ $faq->index }}">
                                        <div class="accordion-body">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @elseif(!is_null($faqs) and $faqs->isEmpty())
                        <h3 class="text-primary">There is no Faqs</h3>
                    @endif

                </div>
            </div>
        </div>
</div>
</div>
