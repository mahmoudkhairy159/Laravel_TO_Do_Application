@extends('admin.layouts.layoutMaster')

@section('title', "Create New Admin")

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/admin/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/admin/vendor/libs/select2/select2.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/admin/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/admin/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/admin/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/admin/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/admin/vendor/libs/select2/select2.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/admin/js/form-layouts.js')}}"></script>
<script src="{{asset('assets/admin/js/forms-pickers.js')}}"></script>
<script src="{{asset('assets/admin/vendor/libs/flatpickr/flatpickr.js')}}"></script>
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
                <li class="breadcrumb-item ">
                    <a href="{{ route('admin.admin-management.index') }}">Admin Mangement</a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">Create Admin</li>

            </ol>
        </nav>
    </div>
</div>
<div class="card mb-4">
    <h5 class="card-header">Create Admin</h5>
    <form class="card-body" action="{{ route('admin.admin-management.store')}}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="multicol-full-name">Full Name <span
                    class="text-danger">*</span></label>
            <div class="col-sm-9">
                <input type="text" value="{{old('name')}}" name="name" id="multicol-full-name"
                    class="form-control @error('name') is-invalid @enderror" placeholder="Enter Full Name" />
                @error('name')
                <div class="text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="multicol-email">Email <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <div class="input-group input-group-merge">
                    <input value="{{old('email')}}" type="text" name="email" id="multicol-email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="" aria-label="john.doe"
                        aria-describedby="multicol-email2">
                    <span class="input-group-text" id="multicol-email2">@example.com</span>
                </div>
                @error('email')
                <div class="text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="multicol-phone">Phone No</label>
            <div class="col-sm-9">
                <input value="{{old('phone')}}"  type="tel" name="phone" id="multicol-phone"
                    class="form-control phone-mask @error('phone') is-invalid @enderror" placeholder="658 799 8941"
                    aria-label="658 799 8941" />
                @error('phone')
                <div class="text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="job_title">Job Title</label>
            <div class="col-sm-9">
                <input value="{{old('job_title')}}" type="text" name="job_title" id="job_title"
                    class="form-control @error('job_title') is-invalid @enderror" placeholder="Software Engineer" />
                @error('job_title')
                <div class="text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
        </div>


        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="admin_image">Admin Image</label>
            <div class="col-sm-9">
                <input class="form-control @error('admin_image') is-invalid @enderror" type="file" name="image"
                    id="formFile">
                @error('image')
                <div class="text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
        </div>




        <div class="row mb-3 form-password-toggle">
            <label class="col-sm-3 col-form-label " for="alignment-password">Password <span
                    class="text-danger">*</span></label>
            <div class="col-sm-9">
                <div class="input-group input-group-merge">
                    <input type="password" name="password" id="alignment-password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="············"
                        aria-describedby="alignment-password2">
                    <span class="input-group-text cursor-pointer" id="alignment-password2"><i
                            class="ti ti-eye-off"></i></span>
                </div>
                @error('password')
                <div class="text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3 form-password-toggle">
            <label class="col-sm-3 col-form-label " for="password_confirmation">Password Confirmation <span
                    class="text-danger">*</span></label>
            <div class="col-sm-9">
                <div class="input-group input-group-merge">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="············" aria-describedby="alignment-password2">
                    <span class="input-group-text cursor-pointer" id="alignment-password2"><i
                            class="ti ti-eye-off"></i></span>
                </div>
                @error('password_confirmation')
                <div class="text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
        </div>


        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="status">Status <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <select required name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="{{ App\Models\User::STATUS_ACTIVE }}" {{ old('status')==App\Models\User::STATUS_ACTIVE ?'selected':''}}>Active</option>
                    <option value="{{ App\Models\User::STATUS_INACTIVE }}" {{ old('status')==App\Models\User::STATUS_INACTIVE  ?'selected':''}}>InActive</option>
                </select>
                @error('status')
                <div class="text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="blocked">Blocked <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <input {{old('blocked') ? "checked" :""}} type="checkbox" name="blocked" id="blocked"
                    class="form-check-input @error('blocked') is-invalid @enderror" />
                @error('blocked')
                <div class="text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
        </div>



        <div class="pt-4">
            <div class="row justify-content-start">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary me-sm-2 me-1">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
