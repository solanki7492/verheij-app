@extends('layouts.auth')

@section('pageTitle', __('web.resetPassword'))

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
                                <form method="POST" action="{{ route('password.update') }}" class="mt-5">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="mb-3">
                                        <label class="mb-1" for="email"><strong>{{ __('web.email') }}</strong></label>
                                        <input type="email" name="email" id="email" placeholder="{{ __('web.email') }}" class="form-control" value="{{ $email ?? old('email') }}">
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1" for="password"><strong>{{ __('web.password') }}</strong></label>
                                        <input type="password" name="password" id="password" placeholder="{{ __('web.password') }}" class="form-control" value="{{ old('password') }}">
                                        @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1" for="password_confirmation"><strong>{{ __('web.confirmPassword') }}</strong></label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ __('web.confirmPassword') }}" class="form-control" value="{{ old('password_confirmation') }}">
                                        @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <button type="submit" class="btn btn-primary btn-block w-100">{{ __('web.resetPassword') }}</button>
                                        </div>
                                        <div class="col-4">
                                            <a href="{{ route('login') }}" class="btn btn-default btn-block w-100">{{ __('web.back') }}</a>
                                        </div>
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
