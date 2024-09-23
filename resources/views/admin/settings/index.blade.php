@extends('admin.layouts.layoutMaster')

@section('title', 'App Settings')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/quill/editor.css') }}" />
@endsection

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/quill/editor.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/admin/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/admin/js/form-layouts.js') }}"></script>
        <script src="{{ asset('assets/admin/js/forms-editors.js') }}"></script>
@endsection


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-1">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class=" d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <span class="menu-icon tf-icons ti ti-smart-home"></span>
                        </a>
                    </li>


                    <li class="breadcrumb-item active" aria-current="page">App Settings</li>

                </ol>
            </nav>
        </div>
    </div>


    <div class="card mb-4">
        <h5 class="card-header">Update App Settings</h5>
        <form class="card-body" action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- title --}}
            <div class="accordion mt-3" id="accordion-title">
                <div class="card accordion-item active">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                            data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                            App Title
                        </button>
                    </h2>
                    <div class="accordion-body">

                        @foreach (core()->getSupportedLocales() as $localeCode => $properties)
                            @php
                                $title = $settings->translate($localeCode) ? $settings->translate($localeCode)->title : '';
                            @endphp
                            <div id="accordionOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label" for="multicol-full-name">
                                            App Title In ({{ $properties['native'] }})<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input dir="{{ $localeCode == 'ar' ? 'rtl' : 'ltr' }}" type="text"
                                                value="{{ $title }}" name="{{ $localeCode }}[title]"
                                                id="multicol-full-name"
                                                class="form-control @error($localeCode . '.title') is-invalid @enderror" />
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

            </div>

            {{-- title --}}

            {{-- slogan --}}
            <div class="accordion mt-3" id="accordion-slogan">
                <div class="card accordion-item active">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                            data-bs-target="#accordionTwo" aria-expanded="true" aria-controls="accordionTwo">
                            App Slogan
                        </button>
                    </h2>
                    <div class="accordion-body">
                        @foreach (core()->getSupportedLocales() as $localeCode => $properties)
                            @php
                                $slogan = $settings->translate($localeCode) ? $settings->translate($localeCode)->slogan : '';
                            @endphp
                            <div id="accordionTwo" class="accordion-collapse collapse show"
                                data-bs-parent="#accordion-slogan">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label" for="multicol-full-name">
                                            App slogan In ({{ $properties['native'] }})<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea dir="{{ $localeCode == 'ar' ? 'rtl' : 'ltr' }}" name="{{ $localeCode }}[slogan]"
                                                class="form-control @error($localeCode . '.slogan') is-invalid @enderror" id="{{ $localeCode }}[slogan]"
                                                cols="30" rows="2">{!! $slogan !!}</textarea>

                                            @error($localeCode . '.slogan')
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

            </div>

            {{-- slogan --}}


            {{-- summary --}}
            <div class="accordion mt-3" id="accordion-summary">
                <div class="card accordion-item active">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                            data-bs-target="#accordionThree" aria-expanded="true" aria-controls="accordionThree">
                            App Summary
                        </button>
                    </h2>
                    <div class="accordion-body">


                        @foreach (core()->getSupportedLocales() as $localeCode => $properties)
                            @php
                                $summary = $settings->translate($localeCode) ? $settings->translate($localeCode)->summary : '';
                            @endphp
                            <div id="accordionThree" class="accordion-collapse collapse show"
                                data-bs-parent="#accordion-summary">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label" for="multicol-full-name">
                                            App summary In ({{ $properties['native'] }})<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea dir="{{ $localeCode == 'ar' ? 'rtl' : 'ltr' }}" name="{{ $localeCode }}[summary]"
                                                class="form-control @error($localeCode . '.summary') is-invalid @enderror" id="{{ $localeCode }}[summary]"
                                                cols="30" rows="4">{!! $summary !!}</textarea>

                                            @error($localeCode . '.summary')
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

            </div>

            {{-- summary --}}



            {{-- address --}}
            <div class="accordion mt-3" id="accordion-address">
                <div class="card accordion-item active">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                            data-bs-target="#accordion-222" aria-expanded="true" aria-controls="accordion-222">
                            Address
                        </button>
                    </h2>
                    <div class="accordion-body">
                        @foreach (core()->getSupportedLocales() as $localeCode => $properties)
                            @php
                                $address = $settings->translate($localeCode) ? $settings->translate($localeCode)->address : '';
                            @endphp
                            <div id="accordion-222" class="accordion-collapse collapse show"
                                data-bs-parent="#accordion-address">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label" for="multicol-full-name">
                                            Address In ({{ $properties['native'] }})</label>

                                        <div class="col-sm-9">
                                            <input dir="{{ $localeCode == 'ar' ? 'rtl' : 'ltr' }}"
                                                type="hidden" name="{{ $localeCode }}[address]"
                                                id="full_editor_1_value_{{ $localeCode }}"
                                                value="{{ $address }}"
                                                class="form-control @error($localeCode . '.address') is-invalid @enderror"
                                                placeholder="Page Section One Paragraph">
                                            <div style="height:auto" id="full_editor_1_{{ $localeCode }}"
                                                dir="{{ $localeCode == 'ar' ? 'rtl' : 'ltr' }}"
                                                class="form-control @error($localeCode . '.address') is-invalid @enderror">
                                                @php
                                                    echo $address;
                                                @endphp
                                            </div>

                                            @error($localeCode . '.address')
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

            </div>

            {{-- address --}}

            {{-- contacts --}}

            <div class="accordion mt-3" id="accordion-contacts">
                <div class="card accordion-item active">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                            data-bs-target="#accordion-55" aria-expanded="true" aria-controls="accordion-55">
                            Contacts
                        </button>
                    </h2>

                    <div id="accordion-55" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">


                            <div class="row">
                                {{-- emails --}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="emails">
                                            Emails</label>
                                        <div class="col-12">
                                            <input class="form-control @error('image') is-invalid @enderror"
                                                type="emails" name="emails"
                                                value="{{ implode(',', $settings->emails) }}">
                                            @error('image')
                                                <div class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                {{-- emails --}}

                                {{-- phone_numbers --}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="phone_numbers">
                                            Phones NUmbers</label>
                                        <div class="col-12">
                                            <input class="form-control @error('image') is-invalid @enderror"
                                                type="text" name="phone_numbers"
                                                value="{{ implode(',', $settings->phone_numbers) }}">
                                            @error('image')
                                                <div class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                {{-- phone_numbers --}}

                                {{-- map_latitude --}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="map_latitude">
                                            Map latitude </label>
                                        <div class="col-12">
                                            <input class="form-control @error('image') is-invalid @enderror"
                                                type="text" name="map_latitude"
                                                value="{{ $settings->map_latitude }}">
                                            @error('map_latitude')
                                                <div class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- map_latitude --}}


                                {{-- map_longitude --}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="map_longitude">
                                            Map longitude </label>
                                        <div class="col-12">
                                            <input class="form-control @error('image') is-invalid @enderror"
                                                type="text" name="map_longitude"
                                                value="{{ $settings->map_longitude }}">
                                            @error('map_longitude')
                                                <div class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                                {{-- map_longitude --}}

                            </div>


                        </div>

                    </div>
                </div>
                {{-- contacts --}}


                {{-- social_accounts --}}

                <div class="accordion mt-3" id="accordion-social_accounts">
                    <div class="card accordion-item active">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                data-bs-target="#accordion-7" aria-expanded="true" aria-controls="accordion-7">
                                Social Accounts
                            </button>
                        </h2>

                        <div id="accordion-7" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">


                                <div class="row">


                                    {{-- facebook_link --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="facebook_link">
                                                Facebook Link</label>
                                            <div class="col-12">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="text" name="facebook_link"
                                                    value="{{ $settings->facebook_link }}">
                                                @error('facebook_link')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    {{-- facebook_link --}}


                                    {{-- instagram_link --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="instagram_link">
                                                Instagram Link</label>
                                            <div class="col-12">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="text" name="instagram_link"
                                                    value="{{ $settings->instagram_link }}">
                                                @error('instagram_link')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    {{-- instagram_link --}}

                                    {{-- behance_link --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="behance_link">
                                                Behance Link</label>
                                            <div class="col-12">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="text" name="behance_link"
                                                    value="{{ $settings->behance_link }}">
                                                @error('behance_link')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    {{-- behance_link --}}

                                    {{-- tiktok_link --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="tiktok_link">
                                                TikTok Link</label>
                                            <div class="col-12">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="text" name="tiktok_link"
                                                    value="{{ $settings->tiktok_link }}">
                                                @error('tiktok_link')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    {{-- tiktok_link --}}

                                    {{-- twitter_link --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="twitter_link">
                                                Twitter Link</label>
                                            <div class="col-12">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="text" name="twitter_link"
                                                    value="{{ $settings->twitter_link }}">
                                                @error('twitter_link')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    {{-- twitter_link --}}

                                    {{-- linkedin_link --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="linkedin_link">
                                                Linkedin Link</label>
                                            <div class="col-12">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="text" name="linkedin_link"
                                                    value="{{ $settings->linkedin_link }}">
                                                @error('linkedin_link')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    {{-- linkedin_link --}}

                                    {{-- youtube_link --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="youtube_link">
                                                Youtube Link</label>
                                            <div class="col-12">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="text" name="youtube_link"
                                                    value="{{ $settings->youtube_link }}">
                                                @error('youtube_link')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    {{-- youtube_link --}}


                                    {{-- patreon_link --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="patreon_link">
                                                Patreon Link</label>
                                            <div class="col-12">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="text" name="patreon_link"
                                                    value="{{ $settings->patreon_link }}">
                                                @error('patreon_link')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    {{-- patreon_link --}}
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

                {{-- credentials --}}


                {{-- credentials --}}

                <div class="accordion mt-3" id="accordion-credentials">
                    <div class="card accordion-item active">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                data-bs-target="#accordion-10" aria-expanded="true" aria-controls="accordion-10">
                                Credentials
                            </button>
                        </h2>

                        <div id="accordion-10" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">


                                <div class="row">


                                    {{-- google_maps_api_key --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="google_maps_api_key">
                                                Google Maps API Key</label>
                                            <div class="col-12">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="text" name="google_maps_api_key"
                                                    value="{{ $settings->google_maps_api_key }}">
                                                @error('google_maps_api_key')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    {{-- google_maps_api_key --}}


                                    {{-- google_analytics_clint_id --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="google_analytics_clint_id">
                                                Google Analytics Clint Id</label>
                                            <div class="col-12">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="text" name="google_analytics_clint_id"
                                                    value="{{ $settings->google_analytics_clint_id }}">
                                                @error('google_analytics_clint_id')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    {{-- google_analytics_clint_id --}}


                                    {{-- google_recaptcha_api_key --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="google_recaptcha_api_key">
                                                Google Recaptcha API Key</label>
                                            <div class="col-12">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="text" name="google_recaptcha_api_key"
                                                    value="{{ $settings->google_recaptcha_api_key }}">
                                                @error('google_recaptcha_api_key')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    {{-- google_recaptcha_api_key --}}





                                </div>
                            </div>


                        </div>

                    </div>
                </div>

                {{-- credentials --}}

                {{-- maintenance_mode --}}

                <div class="accordion mt-3" id="accordion-maintenance_mode">
                    <div class="card accordion-item active">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                data-bs-target="#accordion-4" aria-expanded="true" aria-controls="accordion-4">
                                App Maintainance Mode
                            </button>
                        </h2>

                        <div id="accordion-4" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="maintenance_mode">
                                        Maintainance
                                        Mode</label>
                                    <div class="col-sm-9">
                                        <select required name="maintenance_mode" id="maintenance_mode"
                                            class="form-select @error('maintenance_mode') is-invalid @enderror">
                                            <option value="1"
                                                {{ $settings->maintenance_mode == '1' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0"
                                                {{ $settings->maintenance_mode == '0' ? 'selected' : '' }}>
                                                InActive
                                            </option>
                                        </select>
                                        @error('maintenance_mode')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

                {{-- maintenance_mode --}}

                {{-- Image --}}

                <div class="accordion mt-3" id="accordion-Image">
                    <div class="card accordion-item active">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                data-bs-target="#accordion-989" aria-expanded="true" aria-controls="accordion-989">
                                Logo
                            </button>
                        </h2>

                        <div id="accordion-989" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    {{-- logo --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="logo">
                                                App Logo</label>
                                            <div class="col-12">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="file" name="logo" value="{{ $settings->logo }}">
                                                @error('logo')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    {{-- logo --}}


                                    {{-- logo_light --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="logo_light">
                                                App Logo Light</label>
                                            <div class="col-12">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="file" name="logo_light"
                                                    value="{{ $settings->logo_light }}">
                                                @error('logo_light')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    {{-- logo_light --}}
                                </div>

                            </div>
                        </div>


                    </div>

                </div>
                {{-- Image --}}


                <div class="pt-4">
                    <div class="row justify-content-start">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary me-sm-2 me-1">Update</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
@endsection
