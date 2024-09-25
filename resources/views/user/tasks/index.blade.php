@extends('user.layouts.layoutMaster')

@section('title', 'Task List - Page')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/admin/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-1">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.dashboard') }}">
                            <span class="menu-icon tf-icons ti ti-smart-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Task Management</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>All Tasks</h5>
            <div class="d-flex align-items-center justify-content-end">
                <a href="{{ route('user.tasks.create') }}" class="btn btn-primary waves-effect waves-light mx-1">Create Task <i class="ti ti-plus me-0 ti-xs"></i></a>
            </div>

            <form action="">
                <div class="row my-3">
                    <div class="col-md-6 d-flex">
                        <input type="text" value="{{ request('search') }}" name="search" id="search" class="form-control" placeholder="Search Tasks" />
                        <button type="submit" class="btn btn-primary me-sm-2 me-1">Search</button>
                    </div>
                </div>
            </form>
        </div>

        @if ($items->count() > 0)
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->due_date }}</td>
                                <td>{{ $item->priority }}</td>
                                <td>
                                    @if ($item->status)
                                        <span class="btn btn-icon-only btn-success text-white" title="Completed" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    @else
                                        <span class="btn btn-icon-only btn-danger text-white" title="Pending" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="fa-solid fa-x"></i>
                                        </span>
                                    @endif
                                </td>
                                <td class="btn-group text-center">
                                    <div class="row justify-content-center align-content-center m-2">
                                        <div class="col-5">
                                            <a href="{{ route('user.tasks.edit', $item->id) }}" class="btn"><i class="ti ti-edit ti-sm"></i></a>
                                        </div>
                                        <div class="col-5">
                                            <form action="{{ route('user.tasks.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn"><i class="ti ti-trash ti-sm"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                    {!! $items->appends(request()->query())->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        @else
            <div class="container-xxl container-p-y text-center">
                <div class="misc-wrapper">
                    <h2 class="mb-1 mx-2">No Tasks Found!</h2>
                </div>
            </div>
        @endif
    </div>
@endsection
