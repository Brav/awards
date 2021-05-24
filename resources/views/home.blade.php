@extends('layouts.simple')

@section('content')
    <div class="col-md-12">
        <ul>
            @foreach ($awards as $award)
                @php
                    $link = strtolower(str_replace(' ', '_', $award->name));
                @endphp
                <li>
                    <a href="{{ route('award-nominations.create', $link) }}">{{ $award->name }}</a>
                </li>
            @endforeach
            <li>
                <a href="{{ route('login') }}">View submitted entries</a>
            </li>
        </ul>
    </div>
@endsection
