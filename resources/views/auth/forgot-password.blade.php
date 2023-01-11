@extends('layouts.simple')

@section('content')

<p class="text-uppercase text-center font-w700 font-size-sm text-muted">{{ __('Password Reset') }}</p>

<form method="POST" action="{{ route('password.mail') }}">
    @csrf

    <div class="form-group">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>


    <div class="form-group mb-0">
        <button type="submit" class="btn btn-hero-primary">
            {{ __('Email Password Reset Link') }}
        </button>
    </div>
</form>
@endsection
