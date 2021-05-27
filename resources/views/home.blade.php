@extends('layouts.simple')

@section('content')
    <div class="col-md-12">
        <!-- Home Page start -->
        <h1>AWARDS NOMINATION</h1>
        <h4>Submit a nomination below by clicking in the award you wish to nominate for </h4>
    </div>
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
                <a href="{{ route('award-nominations.index') }}">View submitted entries</a>
            </li>

        </ul>
    </div>
@endsection
