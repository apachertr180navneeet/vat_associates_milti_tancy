@extends('admin.layouts.app')
@section('title', 'Edit Branch')
@section('style')

@endsection
@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-6 text-start">
            <h5 class="py-2 mb-2">
                <span class="text-primary fw-light">Edit Branch</span>
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Show Validation Errors -->
                    <form action="{{ route("admin.branchs.store") }}" method="post">
                        <div class="row">
                            @csrf
                            <div class="col-md-6 mb-3">
                                <label for="branch_name" class="form-label">Branch Name</label>
                                <input type="text"
                                       class="form-control"
                                       id="branch_name"
                                       name="branch_name"
                                       value=""
                                       placeholder="Enter Branch Name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="branch_code" class="form-label">Branch Code</label>
                                <input type="text"
                                       class="form-control"
                                       id="branch_code"
                                       name="branch_code"
                                       value=""
                                       placeholder="Enter Branch Code">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gstn" class="form-label">GSTN</label>
                                <input type="text"
                                       class="form-control"
                                       id="gstn"
                                       name="gstn"
                                       value=""
                                       placeholder="Enter GSTN">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">Location</label>
                                <select id="location" name="location" class="form-select">
                                    <option>Default select</option>
                                    <option value="1">Jodhpur</option>
                                    <option value="2">Japur</option>
                                    <option value="3">Delhi</option>
                                  </select>
                            </div>
                            <div class="col-md-6 text-end">
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
