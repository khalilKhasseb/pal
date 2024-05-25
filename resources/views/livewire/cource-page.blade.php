<x-slot name="header">
    <h2 class="capitalize">{{ $pageTitle }}</h2>
</x-slot>


<div class="container mb-4">

    <div x-data="courcess_data" class="row">
        <!-- Supporters side -->
        @unless ($courcess->isEmpty())
            <div class="pt-3 col-12 col-md-2 col-lg-4">
                <h4 class="mb-1 text-dark">{{ __('Courcess') }}</h4>
                <hr />
                <ul>
                    <template x-for="(_cource , index) in courcess">
                        <li x-init="if (index === 0) { cource = _cource }" x-on:click="loadCource(_cource)"
                            x-text="_cource.title.{{ app()->getLocale() }}" class="p-2 my-1 text-black border"
                            style="cursor:pointer"></li>
                    </template>
                </ul>
            </div>
            <!-- Supporters side -->

            <div class="pt-3 col-12 col-md-10 col-lg-8">


                <div class="p-2 ms-1 cource-content" style="background-color: #eee">

                    <template x-if="cource !== null">
                        <div>
                            <div class="d-flex justify-content-between">
                                <dl class="d-fex justify-content-between">
                                    <dt class="ms-2">{{ __('Start date') }}</dt>
                                    <dd class="ms-2" x-text="cource.start_date"></dd>

                                    <dt class="ms-2">{{ __('Fees') }}</dt>
                                    <dd class="ms-2" x-text="cource.fees"></dd>
                                </dl>

                                <dl class="me-4">

                                    <dt>{{ __('End date') }}</dt>
                                    <dd x-text="cource.end_date"></dd>


                                    <dt>{{ __('Scolership') }}</dt>
                                    <dd :class="`badge ${cource.scholership ? 'bg-success' : 'bg-danger'}`"
                                        x-text="cource.scholership !==0 ? 'Yes' : 'No'"></dd>
                                </dl>

                                <div class="p-2 bg-white rounded-top w-25 d-flex align-items-center"
                                    style="margin-right:auto">
                                    <img :src="cource.image" alt="" class="rounded d-block mw-100">

                                </div>
                            </div>

                            <div class="p-2 mb-2 bg-white rounded">


                                <h4 x-text="cource.title.{{ app()->getLocale() }}">
                                </h4>
                                <div x-html="cource.content.{{ app()->getLocale() }}">

                                </div>


                            </div>

                            <div class="p-2 bg-white rounded">

                                <h4>
                                    {{ __('Objectives') }}
                                </h4>
                                <div x-html="cource.objective.{{ app()->getLocale() }}">

                                </div>


                            </div>

                            <div class="p-2 bg-white rounded">
                                <dl>
                                    <dt>{{ __('Trainer') }}</dt>
                                    <dd x-text="cource.trainer.{{ app()->getLocale() }}"></dd>

                                    <dt>{{ __('Target audince') }}</dt>
                                    <dd x-text="cource.target_audince.{{ app()->getLocale() }}"></dd>

                                    <dt>{{ __('Partners') }}</dt>
                                    <dd x-text="cource.partners.{{ app()->getLocale() }}"></dd>


                                    <dt>{{ __('Trainer') }}</dt>
                                    <dd x-text="cource.trainer.{{ app()->getLocale() }}"></dd>
                                </dl>
                            </div>

                            <div class="mt-2 actions">
                                <a :href="cource.form_register" target="_blank"
                                    :class="`btn btn-primary ${!cource.form_register ? 'disabled':''} `" tabindex="-1"
                                    role="button"
                                    :aria-disabled="!cource.form_register ? true : false">{{ __('Sign up') }}</a>
                                <a :href="cource.scholership_link" target="_blank"
                                    :class="`btn btn-primary ${!cource.scholership ? 'disabled' : ''}`" tabindex="-1"
                                    role="button"
                                    :aria-disabled="!cource.scholership ? true : false">{{ __('Apply Grant') }}</a>

                            </div>
                        </div>
                    </template>
                </div>
            </div>
        @else
            @include($skyTheme . '.partial.empty')
        @endunless
    </div>
</div>

@script
    <script>
        Alpine.data('courcess_data', () => ({
            init() {
                this.courcess = @JS($courcess);
            },
            courcess: null,
            // supporters: [],
            cource: null,
            status: null,
            trans: {
                open: @JS(__('Open')),
                closed: @JS(__('Closed'))
            },
            loadCources(index) {
                //   console.log(this.inititaives[index].supporters)
                //this.supporters = this.inititaives[index].supporters
                //this.supporter = this.supporters[0]
            },
            loadCource($cource) {
                this.cource = $cource;
                let start_date = new Date(this.cource.start_date).getTime();
                let now = new Date().getTime()
                if (start_date > now) {
                    this.status = this.trans.open
                } else if (start_date < now) {
                    this.status = this.trans.closed
                }
                console.log(this.cource)
            },
            test() {}

        }))
    </script>
@endscript
