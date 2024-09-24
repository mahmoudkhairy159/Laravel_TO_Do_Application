   {{-- title --}}
   <div class="accordion mt-3" id="accordionExample">
    <div class="card accordion-item active">
        <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                data-bs-target="#accordion_title" aria-expanded="true" aria-controls="accordion_title">
                Title
            </button>
        </h2>
        @foreach (core()->getSupportedLocales() as $localeCode => $properties)
            <div id="accordion_title" class="accordion-collapse collapse show"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @php
                        $title = $item->translate($localeCode)->title;
                    @endphp
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="multicol-full-name"> Title
                            ({{ $properties['native'] }})
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input dir="{{ $localeCode == 'ar' ? 'rtl' : 'ltr' }}" type="text"
                                value="{{ $title }}" name="{{ $localeCode }}[title]"
                                id="multicol-full-name"
                                class="form-control @error($localeCode . '.title') is-invalid @enderror"
                                placeholder="Page Title" />
                            @error($localeCode . '.title')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </div>

</div>
{{-- title --}}

{{-- seo --}}
<div class="accordion mt-3" id="accordion-accordion">
    <div class="card accordion-item active">
        <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                data-bs-target="#accordion_seo" aria-expanded="true" aria-controls="accordion_seo">
                SEO
            </button>
        </h2>

        <div id="accordion_seo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                {{-- Keys --}}
                <div class="accordion mt-3" id="accordion-Keys">
                    <div class="card accordion-item active">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                data-bs-target="#accordion_seo_keys" aria-expanded="true"
                                aria-controls="accordion_seo_keys">
                                Search Keys
                            </button>
                        </h2>
                        @foreach (core()->getSupportedLocales() as $localeCode => $properties)
                            <div id="accordion_seo_keys" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @php
                                        $keys = $item->translate($localeCode)->keys;
                                    @endphp
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label" for="multicol-full-name">
                                            Keys In ({{ $properties['native'] }}) <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea dir="{{ $localeCode == 'ar' ? 'rtl' : 'ltr' }}" name="{{ $localeCode }}[keys]" id="multicol-full-name"
                                                class="form-control @error($localeCode . '.keys') is-invalid @enderror" placeholder="Page Keys" >{{ $keys }}</textarea>
                                            @error($localeCode . '.keys')
                                                <div class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
                {{-- Keys --}}
                {{-- Description --}}
                <div class="accordion mt-3" id="accordion-Description">
                    <div class="card accordion-item active">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                data-bs-target="#accordion_seo_description" aria-expanded="true"
                                aria-controls="accordion_seo_description">
                                Description
                            </button>
                        </h2>
                        @foreach (core()->getSupportedLocales() as $localeCode => $properties)
                            <div id="accordion_seo_description" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @php
                                        $description = $item->translate($localeCode)->description;
                                    @endphp
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label" for="multicol-full-name">
                                            Description In ({{ $properties['native'] }})
                                            <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea dir="{{ $localeCode == 'ar' ? 'rtl' : 'ltr' }}" name="{{ $localeCode }}[description]"
                                                id="multicol-full-name" class="form-control @error($localeCode . '.description') is-invalid @enderror"
                                                placeholder="Page Description">{{ $description }}</textarea>
                                            @error($localeCode . '.description')
                                                <div class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
                {{-- Description --}}
            </div>
        </div>


    </div>

</div>
{{-- seo --}}
