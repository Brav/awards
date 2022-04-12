<div class="row">
    @foreach ($awards as $award)
        <div class="col-lg-4 mb-4 {{ $award['options']['office_type'] }} award">
            <a class="ds-image-container fx-item-zoom-in fx-overlay-zoom-in overflow-visible"
                href="{{ route('award-nominations.create', $award->slug) }}"
                >
                <div class="d-block bg-image w-100 pb-150 ds-image-item"
                    style='background-image: url("{{ $award->awardBackgroundLink }}")'></div>
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
