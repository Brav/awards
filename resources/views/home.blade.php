@extends('layouts.public')

@section('banner')
    <div class="position-relative overflow-hidden">
        <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true" data-arrows="true">
            <!-- slide -->
            <div>
                <div class="bg-image d-flex w-100" style="background-image: url( {{ asset('media/photos/VetPartners-Awards-Banner-1.jpg')}} ); height: 90vh; min-height: 500px">
                    <div class="d-flex align-items-center justify-content-center w-100 h-100" style="background: rgba(0, 0, 0, .4);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 offset-md-2 text-center">
                                    <h2 class="text-white display-4"><strong>Awards Nomination</strong></h2>
                                    <p class="text-white h3" style="opacity: .85;">Submit a nomination below by clicking in the award you wish to nominate for</p>
                                    <a href="#" class="btn btn-hero btn-hero-primary btn-hero-lg m-1 page-scroll">Find out more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end slide -->

            <!-- slide -->
            <div>
                <div class="bg-image d-flex w-100" style="background-image: url({{ asset('media/photos/VetPartners-Awards-Banner-2.jpg')}}); height: 90vh; min-height: 500px">
                    <div class="d-flex align-items-center justify-content-center w-100 h-100" style="background: rgba(0, 0, 0, .4);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 offset-md-2 text-center">
                                    <h2 class="text-white display-4"><strong>Awards Nomination</strong></h2>
                                    <p class="text-white h3" style="opacity: .85;">Submit a nomination below by clicking in the award you wish to nominate for</p>
                                    <a href="#" class="btn btn-hero btn-hero-primary btn-hero-lg m-1 page-scroll">Find out more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end slide -->

            <!-- slide -->
            <div>
                <div class="bg-image d-flex w-100" style="background-image: url({{ asset('media/photos/VetPartners-Awards-Banner-3.jpg')}}); height: 90vh; min-height: 500px">
                    <div class="d-flex align-items-center justify-content-center w-100 h-100" style="background: rgba(0, 0, 0, .4);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 offset-md-2 text-center">
                                    <h2 class="text-white display-4"><strong>Awards Nomination</strong></h2>
                                    <p class="text-white h3" style="opacity: .85;">Submit a nomination below by clicking in the award you wish to nominate for</p>
                                    <a href="#" class="btn btn-hero btn-hero-primary btn-hero-lg m-1 page-scroll">Find out more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end slide -->
        </div>

        <div class="ds-seperator">

            <a class="page-scroll fusion-one-page-text-link" href="#">
                <div class="lineholderfirst"></div>
            </a>

            <div class="lineholder">
                <svg version="1.1" class="firstdivider" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0.5px" y="0.5px" width="2560px" height="100px" viewBox="0 0 2560 100" style="enable-background:new 0 0 2560 100;" xml:space="preserve">
                    <path class="st0" id="linec1c" d="M1300.8,55.1 M1259.2,48 M1269.8,47.6l10,11.9l10.3-11.9C1290.2,47.7,1269.4,47.6,1269.8,47.6z M1280,34.2c-9.7,0-17.6,7.9-17.6,17.6s7.9,17.6,17.6,17.6s17.6-7.9,17.6-17.6S1289.7,34.2,1280,34.2z" shape-rendering="auto" transform="translate(0.5,0.5)"></path>
                    <path class="st0" id="linec1r" d="M2560,36c0,0-108.5-19-225-19c-282.8,0-413,74-666.5,74c-138.6,0-256.9-17.1-367.7-35.9" shape-rendering="auto" transform="translate(0.5,0.5)"></path>
                    <path class="st0" id="linec1l" d="M1259.2,48C1141.6,27.7,1030.9,7.8,911,7.8C706.2,7.8,484,96,229.5,96C107,96,0,80.5,0,80.5" shape-rendering="auto" transform="translate(0.5,0.5)"></path>
                </svg>

            </div>

        </div>

    </div>
@endsection
@section('content')

    <section id="Available-Nominatons">
        <div class="container py-4">
        
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center">
                    <h2 class="text-center h1 mb-3">Available Nominations</h2>
                    <p class="mb-5">Award nominations are designed for everyone to nominate their colleagues for recognition due to exemplary work, effort or other achievement. We appreciate you taking the time to help recognise the great work being done across VetPartners</p>
                </div>
            </div>

            <div class="container pb-4">

                <div class="row">
                    @foreach ($awards as $award)
                        <div class="col-lg-4 mb-4">

                            <a class="ds-image-container fx-item-zoom-in fx-overlay-zoom-in" href="{{ route('award-nominations.create', $award->slug) }}">
                                <div class="d-block bg-image w-100 pb-lg-100 pb-150 ds-image-item ds-award-bg"></div>
                                <div class="ds-image-overlay bg-black-50 align-items-end pb-3">
                                    <div class="ds-image-overlay-content text-left px-3">
                                        <h3 class="h3 text-white mb-3">{{ $award->name }}</h3>
                                    </div>
                                </div>
                                <div class="ds-image-overlay2 bg-white-50">
                                    <div class="ds-image-overlay-content text-center px-3">
                                        <!-- <span class="h4 text-primary mb-2 text-uppercase px-5 py-3">Read More</span> -->
                                    </div>
                                </div>
                            </a>

                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </section>

    <section class="bg-image mb-5" style="background: url({{ asset('media/photos/VetPartners-Awards-4.jpg')}})">
        <div class="section-wrapper bg-black-50 py-5">

            <div class="container-xl pb-4 py-5">

                <div class="row pr-lg-5 h-100 align-items-center">
                  <div class="col-md-5 mb-4">

                    <div>                                 
                        <h2 class="mb-4 text-primary2">View submitted entries</h2>
                        <div class="d-block" style="height: 2px; width: 200px; background:#fff"></div>
                        <br>
                        <p class="text-white mb-3">Please login here to view the nominations for your relevant awards. If you need a login or cant see your award nominations please contact <a href="mailto:helpdesk@vet.partners">helpdesk@vet.partners</a></p>
                        <br>
                        <a href="{{ route('award-nominations.index') }}" class="btn btn-hero btn-hero-primary btn-hero-lg waves-effect waves-light">View submitted entries</a>
                    </div>                         

                  </div>
                </div>

            </div>
        </div>                  
    </section>

  <!--   <section>
        <div class="section-wrapper py-5">
            <div class="container-xl pb-4 py-5">
                <div class="row no-gutters">
                    <div class="col-lg-8">
                        <div class="d-block h-100 bg-image" style="background: url({{ asset('media/photos/VetPartners-Awards-4.jpg')}});"></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-inner py-4 px-5" style="background: #d8efee">                            
                        
                            <h2 class="text-primary pt-4">Why I Joined<br /> VetPartners</h2>
                            
                            <div class="d-block" style="height: 2px; width: 200px; background:#a5cf4c"></div>
                            <br>
                            <br>


                            <p>“The greatest advantage for us in transitioning to VetPartners is we’ve got more time to be vets, it’s business as usual without any of the noise”</p>

                            <br>
                            <br>

                            <p class="mb-0"><strong>DR HOLLY GOLDRING & DR ASHLEY YOUNG</strong></p>
                            <p><strong>BETTER PET VETS, MACKAY</strong></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section> -->

@endsection

@section('js_after')
<script type="text/javascript">
$(document).ready(function() {
     var images = ['VetPartners-Awards-1.jpg', 'VetPartners-Awards-2.jpg', 'VetPartners-Awards-3.jpg', 'VetPartners-Awards-4.jpg', 'VetPartners-Awards-5.jpg', 'VetPartners-Awards-6.jpg', 'VetPartners-Awards-7.jpg', 'VetPartners-Awards-8.jpg', 'VetPartners-Awards-9.jpg', 'VetPartners-Awards-10.jpg', 'VetPartners-Awards-11.jpg', 'VetPartners-Awards-12.jpg', 'VetPartners-Awards-13.jpg', 'VetPartners-Awards-14.jpg', 'VetPartners-Awards-15.jpg'];
     $('.ds-award-bg').each(function() {
        $(this).css({'background-image': 'url(media/photos/' + images[Math.floor(Math.random() * images.length)] + ')'});
     })
})
</script>
@endsection