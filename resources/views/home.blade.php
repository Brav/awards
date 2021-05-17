@extends('layouts.simple')

@section('content')

    @if (!Auth::check())
        <a name="login"
            id="login"
            class="btn btn-hero-secondary btn-block" href="{{ route('login') }}"
            role="button">View Submitted Entries</a>
    @endif

@endsection
