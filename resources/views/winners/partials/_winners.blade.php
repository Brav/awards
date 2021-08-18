<div class="row">

    <div class="col-md-12">
        <div class="js-slider text-center" data-autoplay="true" data-dots="true" data-arrows="true" data-slides-to-show="3">

            <!-- Awarad Winner -->
            @foreach ($awardWinners as $winner)
                <div class="py-3">
                    <a class="ds-image-container"
                        href="#"
                        data-toggle="modal"
                        data-target="#award-modal"
                        data-reason="{{ $winner->reason }}">
                        <div class="d-block bg-image w-100 pb-100 ds-image-item bg-primary"
                            style='background-image: url("{{ $award->winnerBackgroundLink }}")'
                            ></div>
                        <div class="ds-image-overlay bg-black-50">
                            <div class="ds-image-overlay-content align-items-end text-center px-3">
                                <h3 class="h3 text-white my-5">
                                    <span>{{ $winner->nomination->created_at
                                            ->timezone('Australia/Sydney')
                                            ->format('F Y') }}</span>
                                    <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0">{!! $winner->getAwardName(true) !!}</span>
                                    <span class="mt-2 py-0 d-block text-primary2">{{ $winner->name }}</span>
                                    <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0">{{ $winner->clinicName }}</span>
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
            @endforeach

            <!-- END Awarad Winner -->

        </div>
    </div>

</div>
