@extends('admin.layouts.login_layout')
@section('title', 'Super Admin Reset Password')
@section('content')
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">
        <!-- Forgot Password -->
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <a href="index.html" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                        </span>
                        <span class="app-brand-text demo text-body fw-bold">Vat Associates</span>
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">Reset Password 🔒</h4>
                <p class="mb-4">Please Enter New Password</p>
                <form method="POST" action="{{ route('admin.reset.password.post') }}" class="mb-3">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$email}}">
                    @if ($errors->has('email'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                    <div class="form-group">
                        <label for="email" class="form-label">Password</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                        @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button type="submit" class="btn btn-primary d-grid w-100">{{ __('Reset Password') }}</button>
                    </div>
                </form>
                <div class="text-center">
                    <a href="{{route('admin.login')}}" class="d-flex align-items-center justify-content-center">
                        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                        Back to login
                    </a>
                </div>
            </div>
        </div>
        <!-- /Forgot Password -->
    </div>
</div> 

@endsection