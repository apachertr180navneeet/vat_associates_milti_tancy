@extends('admin.layouts.app')
@section('title', 'Super Admin Firm Type')
@section('style')

@endsection
@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-6 text-start">
            <h5 class="py-2 mb-2">
                <span class="text-primary fw-light">Add Firm</span>
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Show Validation Errors -->
                    <form action="{{ route("admin.firm.store") }}" method="post">
                        <div class="row">
                            @csrf
                            <div class="col-md-4 mb-3">
                                <label for="firm_name" class="form-label">Firm Name</label>
                                <input type="text"
                                       class="form-control @error('firm_name') is-invalid @enderror"
                                       id="firm_name"
                                       name="firm_name"
                                       value="{{ old('firm_name') }}"
                                       placeholder="Enter Firm Name">
                                <!-- Show specific error for this field -->
                                @error('firm_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="phone" class="form-label">Mobile</label>
                                <input type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="Enter Mobile">
                                <!-- Show specific error for this field -->
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text"
                                       class="form-control @error('location') is-invalid @enderror"
                                       id="location"
                                       name="location"
                                       value="{{ old('location') }}"
                                       placeholder="Enter Location">
                                <!-- Show specific error for this field -->
                                @error('location')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text"
                                       class="form-control @error('address') is-invalid @enderror"
                                       id="address"
                                       name="address"
                                       value="{{ old('address') }}"
                                       placeholder="Enter Address">
                                <!-- Show specific error for this field -->
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="Enter Firm Type">
                                <!-- Show specific error for this field -->
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state" class="form-label">State</label>
                                <input type="text"
                                       class="form-control @error('state') is-invalid @enderror"
                                       id="state"
                                       name="state"
                                       value="{{ old('state') }}"
                                       placeholder="Enter State">
                                <!-- Show specific error for this field -->
                                @error('state')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text"
                                       class="form-control @error('city') is-invalid @enderror"
                                       id="city"
                                       name="city"
                                       value="{{ old('city') }}"
                                       placeholder="Enter City">
                                <!-- Show specific error for this field -->
                                @error('city')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="zipcode" class="form-label">Pincode</label>
                                <input type="text"
                                       class="form-control @error('zipcode') is-invalid @enderror"
                                       id="zipcode"
                                       name="zipcode"
                                       value="{{ old('zipcode') }}"
                                       placeholder="Enter Firm Type">
                                <!-- Show specific error for this field -->
                                @error('zipcode')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="firm_type" class="form-label">Firm Type</label>
                                <select class="form-select @error('firm_type') is-invalid @enderror" id="firm_type" name="firm_type">
                                    <option value="" selected>Select Firm Type</option>
                                    @foreach ($firmTypes as $firmType)
                                        <option value="{{ $firmType->id }}" {{ $firmType->id == old('firm_type') ? 'selected' : '' }}>{{ $firmType->name }}</option>
                                    @endforeach
                                </select>
                                <!-- Show specific error for this field -->
                                @error('firm_type')
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
