@extends('transport::admin.layouts.app')
@section('title', 'Super Admin Firm Type')
@section('style')

@endsection
@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-6 text-start">
            <h5 class="py-2 mb-2">
                <span class="text-primary fw-light">Add Bank</span>
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Show Validation Errors -->
                    <form action="{{ route("admin.bank.store") }}" method="post">
                        <div class="row">
                            @csrf
                            <div class="col-md-6 mb-3">
                                <label for="bank_name" class="form-label">Bank Name</label>
                                <input type="text"
                                       class="form-control"
                                       id="bank_name"
                                       name="bank_name"
                                       value=""
                                       placeholder="Enter Bank Name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="account_number" class="form-label">Account Number</label>
                                <input type="text"
                                       class="form-control"
                                       id="account_number"
                                       name="account_number"
                                       value=""
                                       placeholder="Enter Account Number">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                <input type="text"
                                       class="form-control"
                                       id="account_holder_name"
                                       name="account_holder_name"
                                       value=""
                                       placeholder="Enter Account Holder Name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ifsc_code" class="form-label">Ifsc Code</label>
                                <input type="text"
                                       class="form-control"
                                       id="ifsc_code"
                                       name="ifsc_code"
                                       value=""
                                       placeholder="Enter Ifsc Code">
                            </div>
                            <div class="col-md-10 mb-3">
                                <label for="branch_address" class="form-label">Branch Address</label>
                                <input type="text"
                                       class="form-control"
                                       id="branch_address"
                                       name="branch_address"
                                       value=""
                                       placeholder="Enter Branch Address">
                            </div>
                            <div class="col-md-2 text-end">
                                <button type="submit" class="btn btn-primary mt-4">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>

</script>
@endsection
