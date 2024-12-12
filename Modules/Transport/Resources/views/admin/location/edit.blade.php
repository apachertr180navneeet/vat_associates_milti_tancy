@extends('admin.layouts.app')
@section('title', 'Location')
@section('style')

@endsection
@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-6 text-start">
            <h5 class="py-2 mb-2">
                <span class="text-primary fw-light">Edit Location</span>
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Show Validation Errors -->
                    <form action="{{ route("admin.location.store") }}" method="post">
                        <div class="row">
                            @csrf
                            <div class="col-md-10 mb-3">
                                <label for="location" class="form-label">Location Name</label>
                                <input type="text"
                                       class="form-control"
                                       id="location"
                                       name="location"
                                       value=""
                                       placeholder="Enter Location Name">
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
