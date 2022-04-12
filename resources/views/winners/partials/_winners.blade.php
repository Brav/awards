<div class="row">

    <div class="col-md-12 ds-slider">
        <div class="js-slider text-center" data-autoplay="false" data-dots="false" data-arrows="true" data-slides-to-show="4">

            <!-- Awarad Winner -->
            @foreach ($awardWinners as $winner)
                <div class="p-3 winner">
                    <div class="ds-image-container bg-primary-sky h-100"
                        {{-- data-toggle="modal"
                        data-target="#award-modal"
                        data-reason="{{ $winner->reason }}" --}}
                        >

                        <div class="col-md-12">
                            <h4 class="winner-person mb-0">
                                {{ $winner->name }}
                            </h4>

                            <span class="winner-date text-primary2">
                                {{ $winner->created_at->format('M y') }}
                            </span>
                        </div>

                        <div class="winner-inner-container">

                            <div class="winner-inner-container-main">

                                <div class="col-md-12 winner-logo">
                                    <img src="{{ $award->awardLogo }}" alt="Logo" class="winner-logo">
                                </div>

                                <div class="col-md-12 winner-award">
                                    {{ $winner->getAwardName() }}
                                </div>

                            </div>

                            <div class="winner-inner-container-hover invisible">
                                {{ $winner->reason }}
                            </div>

                        </div>

                        <div class="winner-footer">
                            <div class="col-md-12 winner-clinic my-3 text-primary2 font-weight-light">
                                    {{ $winner->clinicName }}
                            </div>

                            <img src="{{ $award->awardLogo }}"
                                alt="Logo" class="winner-footer-logo invisible">
                        </div>

                    </div>
                </div>
            @endforeach

            <!-- END Awarad Winner -->

        </div>
    </div>

</div>
