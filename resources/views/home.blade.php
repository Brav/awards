@extends('layouts.public')

@section('banner')
    <div style="margin-top: 140px">
     <div class="py-3 d-flex
        align-items-center
        justify-content-center
        w-100 h-100" style="background: #258f90;">
         <div class="container">
             <img class="col" src="{{ asset('media/backgrounds/slide.jpg')}}" style="object-fit: cover;">
        </div>
    </div>
@endsection
@section('content')

    <section id="Winners" class="bg-light pt-4">
        <div class="container pt-4">

            <div class="row">
                <div class="col-12 ">
                    <h3 class="mb-3 text-center">Congratulations to this months Clinic GEM Award winners!</h3>
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
                    <div class="col-xs-6 col-md">
                        <button type="button" class="btn btn-hero-primary btn-block active"
                        role="award-filter"
                        data-award="all">All<br />Awards</button>
                    </div>
                    <div class="col-xs-6 col-md">
                        <button type="button" class="btn btn-hero-primary btn-block"
                        role="award-filter"
                        data-award="clinics">Clinic & Ancillary <br>
                        Businesses Awards
                    </button>
                    </div>
                    <div class="col-xs-6 col-md">
                        <button type="button" class="btn btn-hero-primary btn-block"
                        role="award-filter"
                        data-award="deparments">Support<br />Office Awards</button>
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
                            Click below to view the Posters
                        </p>

                        <div class="d-inline-flex justify-content-center align-items-center">
                            <div class="mx-3">
                                <div class="infographic-container text-center">
                                    <img src="{{ asset('media/images/VP_Clinic_Awards Poster_2025.jpg')}}">
                                </div>

                                <a class="btn btn-hero btn-hero-green my-2"
                                href="{{ url('/media/images/VP_Clinic_Awards Poster_2025.pdf')}}" target=_blank rel=noopener rel=nofollow>
                                Business Ancillary Awards
                                </a>
                            </div>
                            <div>

                                <div class="infographic-container text-center">
                                    <img src="{{ asset('media/images/Support-Office-Awards-Poster-2024.jpg')}}">
                                </div>

                                <a class="btn btn-hero btn-hero-green my-2`"
                                href="{{ url('/media/images/Support-Office-Awards-Poster-2024.pdf')}}"
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

    <section>
        <div class="section-wrapper">
            <div class="container-xxl pb-4 ">
                <div class="row no-gutters">
                    <div class="col-lg-8">
                        <div class="col-inner py-4 px-5" style="background: #d8efee">

                            <h2 class="text-primary m-0">View Nomination Entries</h2>

                            <h4 class="text-primary2 pt-4">Regional Managers and Human Resources only
                            </h4>


                            <p>Regional Managers and Human Resources can
                            <a href="{{ route('login') }}" class="font-w700"><u>login here</u></a>
                            to view all nominations. If you need a login or are having issues seeing the nominations please contact <a href="mailto:helpdesk@vet.partners" class="font-w700">helpdesk@vet.partners</a></p>
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
