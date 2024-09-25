@extends('user.layouts.layoutMaster')

@section('title', 'Task List - Page')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/typeahead-js/typeahead.css') }}" />
@endsection

<!-- Page -->
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/admin/vendor/css/pages/page-profile.css')}}" />
@endsection


@section('vendor-script')
<script src="{{ asset('assets/admin/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/bloodhound/bloodhound.js') }}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/admin/js/pages-profile.js')}}"></script>
<script src="{{ asset('assets/admin/js/forms-selects.js') }}"></script>
<script src="{{ asset('assets/admin/js/forms-typeahead.js') }}"></script>
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
        <div class="card">
            <div class="card-header">
                <h5>All Tasks</h5>
                <div class="d-flex align-items-center justify-content-end">
                    <a href="{{ route('user.tasks.create') }}" class="btn btn-primary waves-effect waves-light mx-1">Create
                        Task <i class="ti ti-plus me-0 ti-xs"></i></a>
                    <button class="btn btn-secondary waves-effect waves-light mx-1" data-bs-toggle="modal"
                        data-bs-target="#createCategoryModal">Create New Category</button>
                </div>

                <form action="">
                    <div class="row mt-5">
                        <div class="row my-2">
                            <label class="col-sm-2 col-form-label " for="Categories">Categories</label>
                            @if ($categories->count() > 0)
                                <div class="col-sm-3">
                                    <select id="selectpickerMultiple" name="categoryIds[]" class="selectpicker "
                                        data-style="btn-default" multiple data-icon-base="ti"
                                        data-tick-icon="ti-check text-white">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request('categoryIds') && in_array($category->id, request('categoryIds')) ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            @endif
                        </div>
                        <div class="row my-2 justify-content-start">

                            <div class="col-md-9 d-flex">
                                <input type="text" value="{{ request('search') }}" name="search" id="serach"
                                    class="form-control " placeholder="Enter Search Value (title, description)" />
                            </div>
                            <div class="col-md-2 d-flex">

                                <button type="submit" class="btn btn-primary me-sm-2 me-1">Submit</button>
                                <a
                                    href="{{ route('user.tasks.index', ['clear_filters' => 1]) }}"class="btn btn-primary me-sm-2 me-1">Clear
                                </a>

                            </div>
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
                                <th>Change Status</th>
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
                                        @if ($item->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($item->status == 'in_progress')
                                            <span class="badge bg-warning">In Progress</span>
                                        @else
                                            <span class="badge bg-danger">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Button to Open Modal -->
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $item->id }}">
                                            Change Status
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="updateStatusModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateStatusModalLabel">Update Task
                                                            Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('user.tasks.updateStatus', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-select" id="status" name="status"
                                                                    required>
                                                                    <option value="pending"
                                                                        {{ $item->status == 'pending' ? 'selected' : '' }}>
                                                                        Pending</option>
                                                                    <option value="in_progress"
                                                                        {{ $item->status == 'in_progress' ? 'selected' : '' }}>
                                                                        In Progress</option>
                                                                    <option value="completed"
                                                                        {{ $item->status == 'completed' ? 'selected' : '' }}>
                                                                        Completed</option>
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="btn-group text-start">
                                        <div class="row justify-content-start align-content-center ">
                                            <div class="col-3">
                                                <a href="{{ route('user.tasks.show', $item->id) }}" class="btn"><i
                                                        class="ti ti-eye ti-sm me-1"></i></a>
                                            </div>
                                            <div class="col-3">
                                                <a href="{{ route('user.tasks.edit', $item->id) }}" class="btn"><i
                                                        class="ti ti-edit ti-sm me-1"></i></a>
                                            </div>
                                            <div class="col-3">
                                                <form action="{{ route('user.tasks.destroy', $item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn"><i
                                                            class="ti ti-trash ti-sm "></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div
                        class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
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
        <!-- Create Category Modal -->
        <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('user.categories.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createCategoryModalLabel">Create New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="categoryName" name="name"
                                    placeholder="Enter category name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
