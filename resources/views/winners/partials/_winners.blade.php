<div class="row">

    <div class="col-md-12">
        <div class="js-slider text-center" data-autoplay="true" data-dots="false" data-arrows="false" data-slides-to-show="4">

            <!-- Awarad Winner -->
            @foreach ($awardWinners as $winner)
                <div class="p-3">
                    <a class="ds-image-container"
                        href="#"
                        data-toggle="modal"
                        data-target="#award-modal"
                        data-reason="{{ $winner->reason }}">
                        <div class="d-block bg-image w-100 pb-150 ds-image-item bg-primary-turquoise"
                            @if ($award->winnerBackgroundLink)
                                style='background-image: url("{{ $award->winnerBackgroundLink }}")'
                            @endif

                            ></div>
                        <div class="ds-image-overlay @if ($award->winnerBackgroundLink)
                            bg-black-50
                        @endif">
                        <!-- <div class="ds-image-overlay bg-black-50">  AKO IMA SLIKA -->
                            <div class="ds-image-overlay-content align-items-end text-center px-3">
                                <h3 class="h3 text-white my-5">
                                    <img src="{{ asset('media/images/VP_Awards_Icon_GEM.png') }}" alt="" class="d-block mx-auto mb-4" style="max-width: 100px">
                                    <span class="mb-4 py-0 d-block text-primary2 small">{{ $winner->nomination->created_at
                                            ->timezone('Australia/Sydney')
                                            ->format('F Y') }}</span>
                                    <span class="font-w700 d-block pt-2 h4 text-white my-5 py-0">{!! $winner->getAwardName(true) !!}</span>
                                    <span class="mt-4 py-0 d-block text-primary2 small">{{ $winner->name }}</span>
                                    <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0 small">{{ $winner->clinicName }}</span>
                                </h3>
                            </div>
                        </div>
                        <div class="ds-image-overlay2  bg-primary-turquoise">
                            <div class="ds-image-overlay-content text-center px-5">
                                <p class="text-white mb-0 my-5">
                                    View Reason for Nomination
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            <!-- END Awarad Winner -->

        </div>
    </div>

</div>
