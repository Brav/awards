@extends('layouts.simple')

@section('content')
    <h1>We Received Your Nomination – Thank You!</h1>
    <p> Your nomination has been added to the list of candidates. We really appreciate you recognising the good work of a college and letting us know! If your nominee is selected, he/she will be contacted directly.</p>
    <a class="btn btn-primary" href="{{ route('home') }}" role="button">New Nomination</a>
@endsection
