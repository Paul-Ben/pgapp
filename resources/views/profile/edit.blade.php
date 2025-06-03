{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>{{ __('Profile Information') }}</h5>
                                    <p class="mt-1 text-muted">
                                        {{ __("Update your account's profile information and email address.") }}
                                    </p>
                                </div>

                                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                    @csrf
                                </form>

                                <form method="post" action="{{ route('profile.update') }}" class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    @method('patch')

                                    @if (session('status') === 'profile-updated')
                                        <div class="alert alert-success">
                                            {{ __('Saved.') }}
                                        </div>
                                    @endif

                                    @if (session('status') === 'verification-link-sent')
                                        <div class="alert alert-success">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">{{ __('Name') }}</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" id="name" name="name" type="text" 
                                                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                                @error('name')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">{{ __('Email') }}</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" id="email" name="email" type="email" 
                                                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                                                @error('email')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                                
                                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                                    <div class="mt-2">
                                                        <p class="text-muted">
                                                            {{ __('Your email address is unverified.') }}
                                                            <button form="send-verification" class="btn btn-link p-0">
                                                                {{ __('Click here to re-send the verification email.') }}
                                                            </button>
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="button login button-1 text-center">
                                            <button class="btn btn-primary" type="submit">
                                                <span>{{ __('Save') }}</span>
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>{{ __('Update Password') }}</h5>
                            <p class="mt-1 text-muted">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}
                            </p>
                        </div>

                        <form method="post" action="{{ route('password.update') }}" class="theme-form theme-form-2 mega-form">
                            @csrf
                            @method('put')

                            @if (session('status') === 'password-updated')
                                <div class="alert alert-success">
                                    {{ __('Saved.') }}
                                </div>
                            @endif

                            <div class="row">
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-4">{{ __('Current Password') }}</label>
                                    <div class="col-sm-4 mb-4">
                                        <input class="form-control" id="current_password" name="current_password" type="password" required autocomplete="current-password">
                                        @error('current_password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-4">{{ __('New Password') }}</label>
                                    <div class="col-sm-4 mb-4">
                                        <input class="form-control" id="password" name="password" type="password" required autocomplete="new-password">
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-4">{{ __('Confirm Password') }}</label>
                                    <div class="col-sm-4 mb-4">
                                        <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="button login button-1 text-center">
                                    <button class="btn btn-primary" type="submit">
                                        <span>{{ __('Save') }}</span>
                                        <i class="fa fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection