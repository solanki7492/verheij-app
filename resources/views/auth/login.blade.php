@extends('layouts.auth')

@section('pageTitle', __('web.login'))

@section('content')
    <div class="row h-100 align-items-center justify-contain-center">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row m-0">
                        <div class="col-xl-12 col-md-12">
                            <div class="sign-in-your py-4 px-2">
                                <div class="text-center w-100">
                                    <img src="{{ asset('logos/icon.png') }}" class="img-fluid" width="100">
                                </div>
                                <form method="POST" action="{{ route('login') }}" class="mt-5">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="mb-1" for="email"><strong>{{ __('web.email') }}</strong></label>
                                        <input type="email" name="email" id="email" placeholder="{{ __('web.email') }}" class="form-control">
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1" for="password"><strong>{{ __('web.password') }}</strong></label>
                                        <input type="password" name="password" id="password" placeholder="{{ __('web.password') }}" class="form-control">
                                    </div>
                                    <div class="row d-flex justify-content-between mt-4 mb-2">
                                        <div class="col-7 mb-3">
                                            <div class="form-check custom-checkbox ms-1">
                                                <input type="checkbox" name="remember" class="form-check-input" id="basic_checkbox_1">
                                                <label class="form-check-label" for="basic_checkbox_1">{{ __('web.rememberMe') }}</label>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-5">
                                            <a href="{{ route('password.request') }}" style="float: right;">{{ __('web.forgotPassword') }}?</a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block w-100">{{ __('web.login') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
