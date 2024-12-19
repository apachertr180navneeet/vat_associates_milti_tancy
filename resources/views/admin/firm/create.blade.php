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
                                <select class="form-select @error('location') is-invalid @enderror" id="location" name="location">
                                    <option value="" selected>Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->city_name }}" {{ $location->city_name == old('location') ? 'selected' : '' }}>{{ $location->city_name }}</option>
                                    @endforeach
                                </select>
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
                                <select class="form-select @error('state') is-invalid @enderror" id="state" name="state">
                                    <option value="" selected>Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->state_id }}" {{ $state->state_id == old('state') ? 'selected' : '' }} data-id="{{$state->state_id}}">{{ $state->state_name }}</option>
                                    @endforeach
                                </select>
                                <!-- Show specific error for this field -->
                                @error('state')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">City</label>
                                <select class="form-select @error('city') is-invalid @enderror" id="city" name="city">
                                    <option value="" selected>Select City</option>
                                </select>
                                @error('city')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>            
                            <div class="col-md-4 mb-3">
                                <label for="zipcode" class="form-label">Pincode</label>
                                <select class="form-select @error('zipcode') is-invalid @enderror" id="zipcode" name="zipcode">
                                    <option value="" selected>Select Pincode</option>
                                </select>
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
    $(document).ready(function () {
        var oldCity = "{{ old('city') }}"; 
        var oldZipcode = "{{ old('zipcode') }}";

        // When the state dropdown changes
        $('#state').on('change', function () {
            let stateId = $('#state').find(':selected').attr('data-id');
            fetchCities(stateId, $('#city'), oldCity);
        });

        // When the city dropdown changes
        $('#city').on('change', function () {
            let cityId = $('#city').find(':selected').attr('data-id');
            fetchPincodes(cityId, $('#zipcode'), oldZipcode);
        });

        // Fetch cities and preselect old value if available
        function fetchCities(stateId, cityElement, oldCity) {
            if (stateId) {
                $.ajax({
                    url: '{{ route("ajax.getCities", "") }}/' + stateId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        cityElement.empty().append('<option selected>Select City</option>');
                        $.each(data, function (key, value) {
                            let selected = (value.id == oldCity) ? 'selected' : '';
                            cityElement.append('<option value="' + value.id + '" data-id="' + value.id + '" ' + selected + '>' + value.city_name + '</option>');
                        });

                        // Trigger change to load pincodes if oldCity exists
                        if (oldCity) {
                            cityElement.trigger('change');
                        }
                    }
                });
            }
        }

        // Fetch pincodes and preselect old value if available
        function fetchPincodes(cityId, zipcodeElement, oldZipcode) {
            if (cityId) {
                $.ajax({
                    url: '{{ route("ajax.getPincodes", "") }}/' + cityId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        zipcodeElement.empty().append('<option selected>Select Pincode</option>');
                        $.each(data, function (key, value) {
                            let selected = (value.id == oldZipcode) ? 'selected' : '';
                            zipcodeElement.append('<option value="' + value.id + '" ' + selected + '>' + value.pincode + '</option>');
                        });
                    }
                });
            }
        }

        // On page load, populate cities and pincodes if old values exist
        if (oldCity) {
            let stateId = $('#state').find(':selected').attr('data-id');
            fetchCities(stateId, $('#city'), oldCity);
        }
        if (oldZipcode) {
            let cityId = $('#city').find(':selected').attr('data-id');
            fetchPincodes(cityId, $('#zipcode'), oldZipcode);
        }
    });
</script>
@endsection
