@extends('layouts.public')
@section('css_after')
<style type="text/css">
    #page-header {display: none !important;}
</style>
@endsection 
@section('content')

    <section class="pb-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-left">
                    <a class="font-w600 text-white tracking-wide" href="/">
                        <span class="">
                            <img src="{{ asset('media/logos/VetPartners_Primary_Stacked_Logo_FullColor_RGB.svg')}}" alt="" class="img-fluid mb-5" style="width:250px;">
                        </span>
                    </a>
                    <br>
                    <br>
                    <h1 class="text-left h1 mb-3">We Received Your Nomination<br />
                        <strong class="text-primary2">Thank You!</strong>
                    </h1>
                    <br>
                    <p class="mb-5">Your nomination has been added to the list of candidates. We really appreciate you recognising the good work of a colleague and letting us know! If your nominee is selected, he/she will be contacted directly.</p>

                    <a class="btn btn-hero btn-hero-primary btn-hero-lg waves-effect waves-light" href="{{ route('home') }}" role="button">New Nomination</a>
                </div>
            </div>

            
        </div>
    </section>
    
@endsection
