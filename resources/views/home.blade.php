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
                                    <a href="#main-container" class="btn btn-hero btn-hero-primary btn-hero-lg m-1 d-scroll">Find out more</a>
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
                                    <a href="#main-container" class="btn btn-hero btn-hero-primary btn-hero-lg m-1 d-scroll">Find out more</a>
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
                                    <a href="#main-container" class="btn btn-hero btn-hero-primary btn-hero-lg m-1 d-scroll">Find out more</a>
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
                    <h2 class="h1 mb-3"
                    id="recognising-our-people">Recognising Our People</h2>
                    <p>The VetPartners Excellence Award Program is an opportunity to recognise the exceptional performance and commitment, hard work and dedication of team members at VetPartners. Launched in 2021, the awards provides us with an opportunity to celebrate our hard working team and provide opportunities for our people to excel their careers and receive the recognition they deserve for their outstanding contribution to the business.</p>

                    <p>While the Annual Awards Ceremony is the jewel in the crown, we’re thrilled to have opportunities to recognise our stars throughout the year, with our monthly GEM clinic awards and Values awards for our Support Office team.</p>

                    <p>
                        Everyone at VetPartners can contribute to the program and we encourage you to nominate your colleagues that go above and beyond today and throughout the year. Your nominations ensure that your colleagues have the opportunity to be recognised and in the running for some amazing prizes.
                    </p>

                    <p>
                        For full details on the awards, prizes and how to nominate scroll down and use the handy infographics for the Clinic Awards and Support Office </u><a href="#Award-Infographics"><u>here</u></a>.
                    </p>

                </div>
            </div>

            <div class="container pb-4">

                <h2>Award Categories and Nominations</h2>

                <div class="row mb-5">
                    <div class="col-xs-6 col-md-3">
                        <button type="button" class="btn btn-hero-primary btn-block active"
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
                    role="award-filter">View Nomination Entries</a>
                    </div>
                </div>

                <div class="row">
                    @foreach ($awards as $award)

                    <div class="col-md-4 col-xs-6 mb-4 {{ $award['options']['office_type'] }} award">
                        <a href="{{ $award->awardLink['link'] }}">
                        <div class="col-md-12 award-inner p-0">
                            <h5 class="h5 text-primary award-title align-middle">{!! $award->name !!}</h5>
                            <div class="award-body">
                                <div class="award-background"
                                    style='background-image: url("{{ $award->awardBackgroundLink }}")'
                                ></div>
                                <div class="award-description py-0 px-1 d-none">
                                    {!! $award->description !!}
                                </div>
                            </div>

                            <div class="award-footer container d-flex py-2">
                                <img src="{{ $award->awardLogo }}" alt="Logo" class="award-logo">
                                <div class="col">
                                <div class="award-footer-info">
                                    > Awarded {{ $award->period }}
                                </div>

                                @foreach ($award->awardFooterInfo as $item)
                                    <div class="award-footer-info">
                                    > {{ $item }}
                                </div>
                                @endforeach

                                <div class="award-footer-info-link">
                                    <strong>
                                    > @if ($award->awardLink['isLink'])
                                        <a href="{{ $award->awardLink['link'] }}">
                                            {{ $award->awardLink['linkText']  }}
                                        </a>
                                    @else
                                        <span>{{ $award->awardLink['linkText'] }}</span>
                                    @endif
                                    </strong>
                                </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <section id="Award-Infographics" class="mb-3">
        <div class="section-wrapper py-0">

            <div class="container-xxl p-0 m-0">

                <div class="row">
                    <div class="col-md-6 px-6 py-4 left">

                        <h2 class="h2">
                            Find out more about the VetPartners Excellence Awards
                        </h2>

                        <p class="bottom">
                            Click below to view the infographics
                        </p>

                        <div class="d-inline-flex justify-content-center align-items-center">
                            <div class="mx-3">
                                <div class="infographic-container text-center">
                                    <img src="{{ asset('media/images/clinic-infographic-small.jpg')}}">
                                </div>

                                <a class="btn btn-hero btn-hero-green my-2"
                                href="{{ url('/media/images/clinic-infographic.png')}}" target=_blank rel=noopener rel=nofollow>
                                Business Ancillary Awards
                                </a>
                            </div>
                            <div>

                                <div class="infographic-container text-center">
                                    <img src="{{ asset('media/images/so-infographic-small.jpg')}}">
                                </div>

                                <a class="btn btn-hero btn-hero-green"
                                href="{{ url('/media/images/so-infographic.png')}}"
                                target=_blank rel=noopener rel=nofollow>
                                    Support Office Awards
                                </a>

                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 p-0 m-0 bg-image" style="background: url({{ asset('media/photos/award-infographics.png')}});"></div>
                </div>

            </div>
        </div>
    </section>

    <section id="Winners" class="bg-light pt-4">
        <div class="container pt-4">

            <div class="row">
                <div class="col-12 ">
                    <h3 class="mb-3 text-center">Congratulations to our award winners!</h3>
                </div>
            </div>
        </div>

        <div class="container-xl pb-4">

            @if ($awardWinners)
                @include('winners/partials/_winners')
            @endif

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
                                    <div class="col-md-12">
                                        <p id=modal-text></p>
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

    <section>
        <div class="section-wrapper">
            <div class="container-xxl pb-4 ">
                <div class="row no-gutters">
                    <div class="col-lg-8">
                        <div class="col-inner py-4 px-5" style="background: #d8efee">

                            <h2 class="text-primary m-0">View Nomination Entries</h2>

                            <h4 class="text-primary2 pt-4">
                                Regional Managers and Human Resources only
                            </h4>


                            <p>Regional Managers and Human Resources can
                            <a href="{{ route('login') }}" class="font-w700"><u>login here</u></a>
                            to view submitted nominations for your team. If you need a login or are having issues seeing the nominations please contact <a href="mailto:helpdesk@vet.partners" class="font-w700">helpdesk@vet.partners</a></p>
                        </div>

                    </div>

                    <div class="col-lg-4">
                        <div class="d-block h-100 bg-image" style="background: url({{ asset('media/photos/VetPartners-Awards-5.jpg')}});"></div>
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

    $('#award-modal').on('shown.bs.modal', function (event) {

        let target = event.relatedTarget
        let reason = target.dataset.reason

        $(this).find('#modal-text').html(reason)

    })
</script>
@endsection
