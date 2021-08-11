@extends('layouts.public')

@section('banner')
    <div class="position-relative overflow-hidden">
        <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true" data-arrows="true">
            <!-- slide -->
            <div>
                <div class="bg-image d-flex w-100" style="background-image: url( {{ asset('media/images/Clayfield5.jpg')}} ); height: 90vh; min-height: 500px; background-position: top center !important;">
                    <div class="d-flex align-items-center justify-content-center w-100 h-100" style="background: rgba(0, 0, 0, .4);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 pt-5 mt-5">

                                    <h2 class="text-white display-4 pt-5 mt-5"><strong>VetPartners Excellence Awards</strong></h2>
                                    <p class="text-white h3" style="opacity: .85;">Submit a nomination below by clicking on the award you wish to nominate for</p>
                                    <a href="#" class="btn btn-hero btn-hero-primary btn-hero-lg m-1 d-scroll">Find out more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end slide -->

            <!-- slide -->
            <div>
                <div class="bg-image d-flex w-100" style="background-image: url({{ asset('media/images/MontroseAndNewNorfolk.jpg')}}); height: 90vh; min-height: 500px; background-position: top center !important;">
                    <div class="d-flex align-items-center justify-content-center w-100 h-100" style="background: rgba(0, 0, 0, .4);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 pt-5 mt-5">

                                    <h2 class="text-white display-4 pt-5 mt-5"><strong>VetPartners Excellence Awards</strong></h2>
                                    <p class="text-white h3" style="opacity: .85;">Submit a nomination below by clicking on the award you wish to nominate for</p>
                                    <a href="#" class="btn btn-hero btn-hero-primary btn-hero-lg m-1 d-scroll">Find out more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end slide -->

            <!-- slide -->
            <div>
                <div class="bg-image d-flex w-100" style="background-image: url({{ asset('media/images/QuakersHill.jpg')}}); height: 90vh; min-height: 500px; background-position: top center !important;">
                    <div class="d-flex align-items-center justify-content-center w-100 h-100" style="background: rgba(0, 0, 0, .4);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 pt-5 mt-5">

                                    <h2 class="text-white display-4 pt-5 mt-5"><strong>VetPartners Excellence Awards</strong></h2>
                                    <p class="text-white h3" style="opacity: .85;">Submit a nomination below by clicking on the award you wish to nominate for</p>
                                    <a href="#" class="btn btn-hero btn-hero-primary btn-hero-lg m-1 d-scroll">Find out more</a>
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

    <section id="Available-Nominations">
        <div class="container py-4">

            <div class="row">
                <div class="col-12 mb-4">
                    <h2 class="h1 mb-3">Nominate a Superstar</h2>
                    <p>The VetPartners Excellence Award Program is an opportunity to recognise the exceptional performance and commitment, hard work and dedication of team members at VetPartners.</p>

                    <p>Everyone at VetPartners can contribute to the program and we encourage team members to nominate their colleagues that go above and beyond.</p>

                    <p>Find all active awards below. Nominations for annual awards, Dr Stephen Coles award and additional support office values awards will be available later in the year. <a href="#" class="d-scroll">Find out more here</a></p>

                </div>
            </div>

            <div class="container pb-4">

                <div class="row mb-5">
                    <div class="col-xs-6 col-md-3">
                        <button type="button" class="btn btn-hero-primary btn-block"
                        role="award-filter"
                        data-award="all">All<br />Awards</button>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <button type="button" class="btn btn-hero-primary btn-block"
                        role="award-filter"
                        data-award="clinics">Clinic & Ancillary <br>
                        Businesses Awards
                    </button>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <button type="button" class="btn btn-hero-primary btn-block"
                        role="award-filter"
                        data-award="deparments">Support<br />Office Awards</button>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a class="btn btn-hero-primary btn-block" href="{{ route('award-nominations.index') }}"
                    role="button">View Nomination Entries</a>
                    </div>
                </div>

                <div class="row">
                    @foreach ($awards as $award)
                        <div class="col-lg-4 mb-4 {{ $award['options']['office_type'] }} award">
                            <a class="ds-image-container fx-item-zoom-in fx-overlay-zoom-in overflow-visible"
                                href="{{ route('award-nominations.create', $award->slug) }}"
                                >
                                <div class="d-block bg-image w-100 pb-150 ds-image-item"
                                    style='background-image: url("{{ $award->backgroundLink }}")'></div>
                                <div class="ds-image-overlay">
                                    <div class="ds-image-overlay-content align-items-end text-center px-3">

                                        <!-- <i class="fas fa-award d-block text-center fa-3x mb-3"></i> -->
                                        <h3 class="h3 text-primary my-5">{!! $award->name !!} <span class="font-w400 d-block pt-2">{{ $award->period }}</span></h3>
                                    </div>
                                </div>
                                <div class="ds-image-overlay2">
                                    <div class="ds-image-overlay-content text-center px-5">
                                        <p class="text-primary mb-0 my-5">
                                            {!! $award->description !!}
                                        </p>
                                    </div>
                                </div>
                            </a>

                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </section>

    <section id="Winners" class="bg-light pt-4">
        <div class="container py-4">

            <div class="row">
                <div class="col-12 ">
                    <h2 class="h1 mb-3">Some of Our Superstars</h2>
                    <p>Meet some of the VetPartners superstars that make this such an amazing place. And if you know someone that deserves recognition we’d encourage you to nominate them and tell everyone how they go above and beyond.</p>

                </div>
            </div>
           
            <div class="row">

                    <div class="col-md-12">
                        <div class="js-slider text-center" data-autoplay="true" data-dots="true" data-arrows="true" data-slides-to-show="3">

                            <!-- Awarad Winner -->
                            <div class="py-3">
                                <a class="ds-image-container"
                                    href="#" data-toggle="modal" data-target="#award-modal">
                                    <div class="d-block bg-image w-100 pb-100 ds-image-item bg-primary"
                                        style='background-image: url("{{ asset('media/photos/VetPartners-Awards-4.jpg')}}")'></div>
                                    <div class="ds-image-overlay bg-black-50">
                                        <div class="ds-image-overlay-content align-items-end text-center px-3">
                                            <h3 class="h3 text-white my-5">
                                                <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0">Award</span>
                                                <span class="mt-2 py-0 d-block text-primary2">Full Name</span>
                                                <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0">Award</span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="ds-image-overlay2  bg-primary">
                                        <div class="ds-image-overlay-content text-center px-5">
                                            <p class="text-white mb-0 my-5">
                                               View Reason for Nomination
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- END Awarad Winner -->

                            <!-- Awarad Winner -->
                            <div class="py-3">
                                <a class="ds-image-container"
                                    href="#" data-toggle="modal" data-target="#award-modal">
                                    <div class="d-block bg-image w-100 pb-100 ds-image-item bg-primary"
                                        style='background-image: url("{{ asset('media/photos/VetPartners-Awards-4.jpg')}}")'></div>
                                    <div class="ds-image-overlay bg-black-50">
                                        <div class="ds-image-overlay-content align-items-end text-center px-3">
                                            <h3 class="h3 text-white my-5">
                                                <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0">Award</span>
                                                <span class="mt-2 py-0 d-block text-primary2">Full Name</span>
                                                <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0">Award</span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="ds-image-overlay2  bg-primary">
                                        <div class="ds-image-overlay-content text-center px-5">
                                            <p class="text-white mb-0 my-5">
                                               View Reason for Nomination
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- END Awarad Winner -->

                            <!-- Awarad Winner -->
                            <div class="py-3">
                                <a class="ds-image-container"
                                    href="#" data-toggle="modal" data-target="#award-modal">
                                    <div class="d-block bg-image w-100 pb-100 ds-image-item bg-primary"
                                        style='background-image: url("{{ asset('media/photos/VetPartners-Awards-4.jpg')}}")'></div>
                                    <div class="ds-image-overlay bg-black-50">
                                        <div class="ds-image-overlay-content align-items-end text-center px-3">
                                            <h3 class="h3 text-white my-5">
                                                <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0">Award</span>
                                                <span class="mt-2 py-0 d-block text-primary2">Full Name</span>
                                                <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0">Award</span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="ds-image-overlay2  bg-primary">
                                        <div class="ds-image-overlay-content text-center px-5">
                                            <p class="text-white mb-0 my-5">
                                               View Reason for Nomination
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- END Awarad Winner -->

                            <!-- Awarad Winner -->
                            <div class="py-3">
                                <a class="ds-image-container"
                                    href="#" data-toggle="modal" data-target="#award-modal">
                                    <div class="d-block bg-image w-100 pb-100 ds-image-item bg-primary"
                                        style='background-image: url("{{ asset('media/photos/VetPartners-Awards-4.jpg')}}")'></div>
                                    <div class="ds-image-overlay bg-black-50">
                                        <div class="ds-image-overlay-content align-items-end text-center px-3">
                                            <h3 class="h3 text-white my-5">
                                                <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0">Award</span>
                                                <span class="mt-2 py-0 d-block text-primary2">Full Name</span>
                                                <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0">Award</span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="ds-image-overlay2  bg-primary">
                                        <div class="ds-image-overlay-content text-center px-5">
                                            <p class="text-white mb-0 my-5">
                                               View Reason for Nomination
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- END Awarad Winner -->

                            <!-- Awarad Winner -->
                            <div class="py-3">
                                <a class="ds-image-container"
                                    href="#" data-toggle="modal" data-target="#award-modal">
                                    <div class="d-block bg-image w-100 pb-100 ds-image-item bg-primary"
                                        style='background-image: url("{{ asset('media/photos/VetPartners-Awards-4.jpg')}}")'></div>
                                    <div class="ds-image-overlay bg-black-50">
                                        <div class="ds-image-overlay-content align-items-end text-center px-3">
                                            <h3 class="h3 text-white my-5">
                                                <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0">Award</span>
                                                <span class="mt-2 py-0 d-block text-primary2">Full Name</span>
                                                <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0">Award</span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="ds-image-overlay2  bg-primary">
                                        <div class="ds-image-overlay-content text-center px-5">
                                            <p class="text-white mb-0 my-5">
                                               View Reason for Nomination
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- END Awarad Winner -->

                        </div>
                    </div>

            </div>

            <!-- Award Winner Modal -->
            <div class="modal" id="award-modal" tabindex="-1" role="dialog" aria-labelledby="award-modal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Reason for Nomination</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center justify-content-center h-100 bg-primary py-3">
                                            <i class="si fa-8x si-trophy text-primary2"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content block-content-full text-right bg-light">
                                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Award Winner Modal -->

        </div>
    </section>

    <section id="Award-Information" class="bg-image" style="background: url({{ asset('media/photos/VetPartners-Awards-4.jpg')}});">
        <div class="section-wrapper bg-black-50 py-5">

            <div class="container-xl pb-4 py-5">

                <div class="row pr-lg-5 h-100 align-items-center">
                  <div class="col-md-5 mb-4">

                    <div>
                        <h2 class="mb-4 text-primary2">Award Information</h2>
                        <div class="d-block" style="height: 2px; width: 200px; background:#fff"></div>
                        <br>
                        <p class="text-white mb-3">
                            Find out more information about the many different Clinic and Support Office awards!</a></p>
                        <br>
                        <!-- <a href="{{ asset('media/downloads/VP_Awards_Clinics_Infograph.png')}}" download class="btn btn-hero btn-hero-primary btn-hero-lg waves-effect waves-light mb-3">CLINIC AWARDS INFORMATION</a> -->
                        <!-- <a href="{{ asset('media/downloads/VP_Awards_Support_Office_Infograph.png')}}" download class="btn btn-hero btn-hero-light btn-hero-lg waves-effect waves-light">SUPPORT OFFICE AWARDS INFORMATION</a> -->

                        <a href="https://vet.partners/wp-content/uploads/2021/07/VP_Awards_Clinics_Infograph-scaled.jpg" download class="btn btn-hero btn-hero-primary btn-hero-lg waves-effect waves-light mb-3" target="
                        _blank">CLINIC AWARDS INFORMATION</a>
                        <a href="https://vet.partners/wp-content/uploads/2021/07/VP_Awards_Support_Office_Infograph.jpg" download class="btn btn-hero btn-hero-light btn-hero-lg waves-effect waves-light" target="
                        _blank">SUPPORT OFFICE AWARDS INFORMATION</a>
                    </div>

                  </div>
                </div>

            </div>
        </div>
    </section>

    <section>
        <div class="section-wrapper py-5">
            <div class="container-xl pb-4 py-5">
                <div class="row no-gutters">
                    <div class="col-lg-8">
                        <div class="d-block h-100 bg-image" style="background: url({{ asset('media/photos/VetPartners-Awards-5.jpg')}});"></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-inner py-4 px-5" style="background: #d8efee">

                            <h2 class="text-primary pt-4">View Nomination <br /> Entries</h2>

                            <div class="d-block" style="height: 2px; width: 200px; background:#a5cf4c"></div>
                            <br>
                            <br>


                            <p>Regional Managers and Human Resources can login here to view submitted nominations for your team. If you need a login or are having issues seeing the nominations please contact <a href="mailto:helpdesk@vet.partners" class="font-w700">helpdesk@vet.partners</a></p>

                            <br>
                            <br>

                            <p class="mb-0"><strong><a href="{{ route('award-nominations.index') }}" class="">View Nomination Entries</a></strong></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection

@section('js_after')
<script type="text/javascript">
    $(document).ready(function() {
        $('button[data-award="clinics"]').click()
    })
</script>
@endsection
