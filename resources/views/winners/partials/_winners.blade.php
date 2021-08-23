<div class="row">

    <div class="col-md-12 ds-slider">
        <div class="js-slider text-center" data-autoplay="true" data-dots="false" data-arrows="true" data-slides-to-show="4">

            <!-- Awarad Winner -->
            @foreach ($awardWinners as $winner)
                <div class="p-3">
                    <a class="ds-image-container"
                        href="#"
                        data-toggle="modal"
                        data-target="#award-modal"
                        data-reason="{{ $winner->reason }}">
                        <div class="d-block bg-image w-100 pb-150 ds-image-item bg-primary-turquoise"
                            @if ($winner->nomination->award->winnerBackgroundLink)
                                style='background-image: url("{{ $winner->nomination->award->winnerBackgroundLink }}")'
                            @endif

                            ></div>
                        <div class="ds-image-overlay align-items-start @if ($winner->nomination->award->winnerBackgroundLink)
                            bg-black-50
                        @endif">
                        <!-- <div class="ds-image-overlay bg-black-50">  AKO IMA SLIKA -->
                            <div class="ds-image-overlay-content align-items-start text-center px-3">
                                <h3 class="h3 text-white my-3">
                                    <img src="{{ asset('media/images/VP_Awards_Icon_GEM.png') }}" alt="" class="d-block mx-auto mb-4" style="max-width: 100px">
                                    <span class="mb-4 py-0 d-block text-primary2 small">{{ $winner->nomination->created_at
                                            ->timezone('Australia/Sydney')
                                            ->format('F Y') }}</span>
                                    <span class="font-w700 d-block pt-2 h4 text-white my-5 py-0">{!! $winner->clinicName !!}</span>
                                    <span class="mt-4 py-0 d-block text-primary2 small">{{ $winner->name }}</span>
                                    <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0 small">{!! $winner->getAwardName(true) !!}</span>
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

            <div class="p-3">
                    <a class="ds-image-container"
                        href="#"
                        data-toggle="modal"
                        data-target="#award-modal"
                        data-reason="asd">
                        <div class="d-block bg-image w-100 pb-150 ds-image-item bg-primary-turquoise"
                           
                            ></div>
                        <div class="ds-image-overlay ">
                        <!-- <div class="ds-image-overlay bg-black-50">  AKO IMA SLIKA -->
                            <div class="ds-image-overlay-content align-items-start text-center px-3">
                                <h3 class="h3 text-white my-3">
                                    <img src="{{ asset('media/images/VP_Awards_Icon_GEM.png') }}" alt="" class="d-block mx-auto mb-4" style="max-width: 100px">
                                    <span class="mb-4 py-0 d-block text-primary2 small">date</span>
                                    <span class="font-w700 d-block pt-2 h4 text-white my-5 py-0">Gem neki kurac nesto</span>
                                    <span class="mt-4 py-0 d-block text-primary2 small">name</span>
                                    <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0 small">winner</span>
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

                <div class="p-3">
                    <a class="ds-image-container"
                        href="#"
                        data-toggle="modal"
                        data-target="#award-modal"
                        data-reason="asd">
                        <div class="d-block bg-image w-100 pb-150 ds-image-item bg-primary-turquoise"
                           
                            ></div>
                        <div class="ds-image-overlay ">
                        <!-- <div class="ds-image-overlay bg-black-50">  AKO IMA SLIKA -->
                            <div class="ds-image-overlay-content align-items-start text-center px-3">
                                <h3 class="h3 text-white my-3">
                                    <img src="{{ asset('media/images/VP_Awards_Icon_GEM.png') }}" alt="" class="d-block mx-auto mb-4" style="max-width: 100px">
                                    <span class="mb-4 py-0 d-block text-primary2 small">date</span>
                                    <span class="font-w700 d-block pt-2 h4 text-white my-5 py-0">Gem neki kurac nesto</span>
                                    <span class="mt-4 py-0 d-block text-primary2 small">name</span>
                                    <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0 small">winner</span>
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

                <div class="p-3">
                    <a class="ds-image-container"
                        href="#"
                        data-toggle="modal"
                        data-target="#award-modal"
                        data-reason="asd">
                        <div class="d-block bg-image w-100 pb-150 ds-image-item bg-primary-turquoise"
                           
                            ></div>
                        <div class="ds-image-overlay ">
                        <!-- <div class="ds-image-overlay bg-black-50">  AKO IMA SLIKA -->
                            <div class="ds-image-overlay-content align-items-start text-center px-3">
                                <h3 class="h3 text-white my-3">
                                    <img src="{{ asset('media/images/VP_Awards_Icon_GEM.png') }}" alt="" class="d-block mx-auto mb-4" style="max-width: 100px">
                                    <span class="mb-4 py-0 d-block text-primary2 small">date</span>
                                    <span class="font-w700 d-block pt-2 h4 text-white my-5 py-0">Gem neki kurac nesto</span>
                                    <span class="mt-4 py-0 d-block text-primary2 small">name</span>
                                    <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0 small">winner</span>
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

                <div class="p-3">
                    <a class="ds-image-container"
                        href="#"
                        data-toggle="modal"
                        data-target="#award-modal"
                        data-reason="asd">
                        <div class="d-block bg-image w-100 pb-150 ds-image-item bg-primary-turquoise"
                           
                            ></div>
                        <div class="ds-image-overlay ">
                        <!-- <div class="ds-image-overlay bg-black-50">  AKO IMA SLIKA -->
                            <div class="ds-image-overlay-content align-items-start text-center px-3">
                                <h3 class="h3 text-white my-3">
                                    <img src="{{ asset('media/images/VP_Awards_Icon_GEM.png') }}" alt="" class="d-block mx-auto mb-4" style="max-width: 100px">
                                    <span class="mb-4 py-0 d-block text-primary2 small">date</span>
                                    <span class="font-w700 d-block pt-2 h4 text-white my-5 py-0">Gem neki kurac nesto</span>
                                    <span class="mt-4 py-0 d-block text-primary2 small">name</span>
                                    <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0 small">winner</span>
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

                <div class="p-3">
                    <a class="ds-image-container"
                        href="#"
                        data-toggle="modal"
                        data-target="#award-modal"
                        data-reason="asd">
                        <div class="d-block bg-image w-100 pb-150 ds-image-item bg-primary-turquoise"
                           
                            ></div>
                        <div class="ds-image-overlay ">
                        <!-- <div class="ds-image-overlay bg-black-50">  AKO IMA SLIKA -->
                            <div class="ds-image-overlay-content align-items-start text-center px-3">
                                <h3 class="h3 text-white my-3">
                                    <img src="{{ asset('media/images/VP_Awards_Icon_GEM.png') }}" alt="" class="d-block mx-auto mb-4" style="max-width: 100px">
                                    <span class="mb-4 py-0 d-block text-primary2 small">date</span>
                                    <span class="font-w700 d-block pt-2 h4 text-white my-5 py-0">Gem neki kurac nesto</span>
                                    <span class="mt-4 py-0 d-block text-primary2 small">name</span>
                                    <span class="font-w400 d-block pt-2 h4 text-white my-0 py-0 small">winner</span>
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

              

            <!-- END Awarad Winner -->

        </div>
    </div>

</div>
