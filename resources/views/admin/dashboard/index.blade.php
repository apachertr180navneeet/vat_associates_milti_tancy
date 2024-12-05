@extends('admin.layouts.app')
@section('title', 'Super Admin Dashboard')
@section('style')
@endsection
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- New Visitors & Activity -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body row g-4">
                        <div class="col-md-12 ps-md-4">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <h5 class="mb-0">Firms</h5>
                            </div>
                            <div class="d-flex justify-content-between" style="position: relative;">
                                <div class="mt-auto">
                                    <h4 class="mb-2">Active :- 10|Inactive :- 5 </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body row g-4">
                        <div class="col-md-12 ps-md-4">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <h5 class="mb-0">Firms Type</h5>
                            </div>
                            <div class="d-flex justify-content-between" style="position: relative;">
                                <div class="mt-auto">
                                    <h4 class="mb-2">10</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body row g-4">
                        <div class="col-md-12 ps-md-4">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <h5 class="mb-0">Firm A/C Users</h5>
                            </div>
                            <div class="d-flex justify-content-between" style="position: relative;">
                                <div class="mt-auto">
                                    <h4 class="mb-2">Active :- 10|Inactive :- 5 </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body row g-4">
                        <div class="col-md-12 ps-md-4">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <h5 class="mb-0">Office Employee</h5>
                            </div>
                            <div class="d-flex justify-content-between" style="position: relative;">
                                <div class="mt-auto">
                                    <h4 class="mb-2">Active :- 10|Inactive :- 5 </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body row g-4">
                        <div class="col-md-12 ps-md-4">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <h5 class="mb-0">Customer Managment</h5>
                            </div>
                            <div class="d-flex justify-content-between" style="position: relative;">
                                <div class="mt-auto">
                                    <h4 class="mb-2">Active :- 10|Inactive :- 5 </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- / Content -->
@endsection
@section('script')
@endsection
