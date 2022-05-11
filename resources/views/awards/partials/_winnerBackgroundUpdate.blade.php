<div class="col-md-12 my-3" id="winner-images-container">
    <h3 class="d-block">Winner Background</h3>
    <div class="row">
        @foreach ($winnerImages as $image)
            @php
                $data = pathinfo($image);
            @endphp
            <div class="col-lg-4 col-xl-2 background-image winner-cagetory
                    @if ($defaultWinner === $data['basename'])
                        border border-danger
                    @endif" id="winner-{{ $data['filename'] }}">

                <button class="btn btn-primary btn-sm background-use winner
                    @if ($defaultWinner === $data['basename'])
                        d-none
                    @endif"
                    data-type="winner"
                    data-file="{{ $data['basename'] }}"
                    data-url="{{ route('backgrounds.update') }}">Use as Background</button>

                @if ($defaultWinner === $data['basename'])
                    <span>Used as winner background</span>
                @endif

                <div class="d-block bg-image w-100 pb-100 ds-image-item mt-2" style="background-image: url({{ Storage::url($image) }})"></div>
            </div>
        @endforeach
    </div>
</div>
