@extends('admin.layouts.app')
@section('title', 'Super Admin Firm Type')
@section('style')

@endsection
@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-6 text-start">
            <h5 class="py-2 mb-2">
                <span class="text-primary fw-light">Edit Firm Type</span>
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Show Validation Errors -->
                    <form action="{{ route("admin.firm.type.store") }}" method="post">
                        <div class="row">
                            @csrf
                            <div class="col-md-6">
                                <input type="hidden" name="fitmtypeid" value="{{ $firmType->id }}">
                                <label for="firmType" class="form-label">Firm Type</label>
                                <input type="text"
                                       class="form-control @error('firmType') is-invalid @enderror"
                                       id="firmType"
                                       name="firmType"
                                       value="{{ old('firmType', $firmType->name) }}"
                                       placeholder="Enter Firm Type">
                                <!-- Show specific error for this field -->
                                @error('firmType')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
