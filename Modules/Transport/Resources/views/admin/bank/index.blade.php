@extends('transport::admin.layouts.app')
@section('title', 'Transport Admin Location')
@section('style')

@endsection
@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-6">
            <h5 class="py-2 mb-2">
                <span class="text-primary fw-light">Bank</span>
            </h5>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.bank.create') }}" class="btn btn-primary">
                Add Bank
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered" id="firmTable">
                            <thead>
                                <tr>
                                    <th>Bank Name</th>
                                    <th>Account Number</th>
                                    <th>Account Holder Name</th>
                                    <th>Ifsc Code</th>
                                    <th>Branch Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>SBI</th>
                                    <th>7412589630</th>
                                    <th>Test</th>
                                    <th>SBI000333</th>
                                    <th>Jodhpur</th>
                                    <th><span class="badge bg-label-success me-1">Active</span></th>
                                    <th>
                                        <button type="button" class="btn btn-sm btn-danger me-1 mb-2">Deactivate</button>
                                        <br>
                                        <button type="button" class="btn btn-sm btn-danger me-1 mb-2">Delete</button>
                                        <br>
                                        <a href="" class="btn btn-sm btn-warning mb-2">Edit</a>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
