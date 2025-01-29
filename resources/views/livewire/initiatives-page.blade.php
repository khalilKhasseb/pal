<x-slot name="header">
    <h2 class="capitalize">{{ $pageTitle }}</h2>
</x-slot>

@push('styles')
<style>
    .active{
        background-color:#75ba75;
        color: white;
    }
    </style>
    
@endpush
<div class="container mb-4">
    <div x-data="inititavis" class="row">
        <!-- Supporters side -->

        <div class="pt-3 col-12 col-md-2 col-lg-4">
            <h4 class="mb-1 text-dark">{{ __('Supporters') }}</h4>
            <hr />
            <ul>
                <template x-for="(sup,index) in supporters">
                    <li x-bind:class="index === activeIndex ? 'active' : ''"  style="cursor:pointer;transtion:background-color 0.5s , color 0.5s;" x-on:click="loadSupporter(sup , index)" x-text="sup.name.{{ app()->getLocale() }}"
                        class="p-2 my-1 text-black border" ></li>
                </template>
            </ul>
        </div>
        <!-- Supporters side -->

        <div class="pt-3 col-12 col-md-10 col-lg-8">
            <div class="d-flex justify-content-between align-items-center">
                @foreach ($initiatives as $initiative)
                    <h4 style="cursor:pointer"
                        @if ($loop->first) x-init="supporters = @JS($initiative->supporters) ; supporter =@JS($initiative->supporters[0]) " @endif
                        x-on:click="loadSupporters({{ $loop->index }})"
                        x-bind:class="`px-2 py-2 text-center text-white ms-1 d-block w-100   ${activeInitiativeIndex === {{ $loop->index }} ? 'bg-success' : 'bg-dark'}`"
                        >
                        {{ $initiative->title }}
                    </h4>
                @endforeach
            </div>


            <div class="p-2 ms-1 supporter-content" style="background-color: #eee">

                <template x-if="supporter !== null">
                    <div>
                        <div class="p-2 bg-white rounded d-flex justify-content-between align-items-start">

                            <div class="info">
                                <h3 class="mb-2 text-dark"
                                    x-text="supporter.name && supporter.name.{{ app()->getLocale() }}">

                                </h3>
                                <hr />
                                <dl class="row">
                                    <dt class="col-sm-3">{{ __('Location') }}</dt>
                                    <dd class="col-sm-9" x-text="supporter.location.{{ app()->getLocale() }}"> </dd>

                                    <dt class="col-sm-3">{{ __('Website') }}</dt>
                                    <dd class="col-sm-9"><a class="link-info"
                                            :href="supporter.webiste !== null && supporter.website"
                                            x-text="supporter.website ? '{{ __('Vist') }}' : '{{ __('Unaviablel') }}'">{{ __('Vist') }}</a>
                                    </dd>

                                    <dt class="col-sm-3">{{ __('Contact info') }}</dt>
                                    <dd class="col-sm-9" x-text="supporter.contact_info"> </dd>

                                    <dt class="col-sm-3">{{ __('Phone') }}</dt>
                                    <dd class="col-sm-9"
                                        x-text="supporter.phone !== null ? supporter.phone :'{{ __('Unaviablel') }}'">
                                    </dd>



                                </dl>

                                <dl>
                                    <dt class="col-sm-3">{{ __('Supported project styps') }}</dt>
                                    <dd class="col-sm-9"
                                        x-text="supporter.supported_project_types.map(item => item.name.{{ app()->getLocale() }}).join(', ')">
                                    </dd>

                                    <dt class="col-sm-3">{{ __('Supported projects') }}</dt>
                                    <dd class="col-sm-9"
                                        x-text="supporter.supported_projects.map(item => item.name.{{ app()->getLocale() }}).join(', ')">
                                    </dd>
                                </dl>

                            </div>
                            <div class="w-25 align-self-center">
                                <img :src="supporter.media[0].original_url" alt=""
                                    class="rounded d-block mw-100">

                            </div>
                        </div>
                        <p class="p-2 mt-2 bg-white rounded lead text-dark"
                            x-text="supporter.about.{{ app()->getLocale() }}">

                        </p>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        Alpine.data('inititavis', () => ({

            init() {
                this.inititaives = @JS($initiatives);

            },
            active: false,
            activeIndex: 0,
            activeInitiativeIndex: 0,
            inititaives: null,
            supporters: [],
            supporter: null,

            loadSupporter(sup , index) {
                this.supporter = sup;
                this.activeIndex = index
            },
            loadSupporters(index) {
                //   console.log(this.inititaives[index].supporters)
                this.supporters = this.inititaives[index].supporters
                // this.supporter = this.supporters[0]
                // this.loadSupporter(this.supporters[0])

                this.activeInitiativeIndex = index

            },



        }))
    </script>
@endscript
