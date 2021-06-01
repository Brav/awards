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
                <div class="col-md-8 offset-md-2 text-center">
                    <a class="font-w600 text-white tracking-wide" href="/">
                        <span class="">
                            <img src="{{ asset('media/logos/VetPartners_Primary_Stacked_Logo_FullColor_RGB.svg')}}" alt="" class="img-fluid mb-5" style="width:250px;">
                        </span>
                    </a>
                    <br>
                    <br>
                    <h1 class="text-center h1 display-2 mb-3"><strong>404</strong> - 
                        <strong class="text-primary2">Error</strong>
                    </h1>
                    <br>
                    <p class="mb-2"><strong>Oops.. You just found an error page..</strong></p>
                    <p>We are sorry but the page you are looking for was not found..</p>

                    <a class="btn btn-hero btn-hero-primary btn-hero-lg waves-effect waves-light" href="{{ route('home') }}" role="button">Go Back</a>
                </div>
            </div>

            
        </div>
    </section>
    
@endsection
