@extends('admin.layouts.layoutMaster')

@section('title', 'Crm')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/apex-charts/apex-charts.css') }}" />

@endsection


@section('vendor-script')
    <script src="{{ asset('assets/admin/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/admin/js/dashboards-crm.js') }}"></script>
@endsection

@section('content')
    <div class="row justify-content-start  ">

        <!-- Total Admins-->
        <div class="col-xl-3 col-md-4 col-6 mb-4 text-center ">
            <a href="{{ route('admin.admin-management.index') }}">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="badge p-2 bg-label-info mb-2 rounded"><i class="tf-icons ti ti-typography ti-md"></i>
                        </div>
                        <h5 class="card-title mb-1 pt-2">Total Admins</h5>
                        <p class="mb-2 mt-1">{{ number_format($statisticsCount['users_count']) }}</p>
                    </div>
            </a>
        </div>
    </div>
    <!-- Total Admins-->

    </div>







    

@endsection
