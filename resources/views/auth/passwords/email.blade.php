@extends('layouts.auth')

@section('pageTitle', __('web.forgotPassword'))

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
                                @if (session('status'))
                                    <div class="alert alert-success mt-2" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('password.email') }}" class="mt-2">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="mb-1" for="email"><strong>{{ __('web.email') }}</strong></label>
                                        <input type="email" name="email" id="email" placeholder="{{ __('web.email') }}" class="form-control" value="{{ old('email') }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-7">
                                            <button type="submit" class="btn btn-primary btn-block w-100">{{ __('web.sendResetLink') }}</button>
                                        </div>
                                        <div class="col-5">
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
