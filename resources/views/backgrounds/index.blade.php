@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <h2>Upload Images</h2>
        <p class="text-danger">You can upload only <strong>jpg, jpeg and png</strong> images up to 2mb in size</p>
        <div>
            <form id="multi-file-upload-ajax" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" name="files[]" id="files" placeholder="Choose files" multiple >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <i class="fas fa-sync fa-spin d-none" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container mt-2">
        <div class="row">
        @if ($images)
            <div class="col-md-12">
                <div class="row" id="images-container">
                @foreach ($images as $image)
                    @php
                        $data = pathinfo($image);
                    @endphp
                    <div class="col-lg-4 col-xl-2 mb-2 border-bottom border-danger" id="{{ $data['filename'] }}">

                        <a class="btn btn-danger btn-sm background-delete"
                        data-file="{{ $image }}"
                        data-url="{{ route('backgrounds.delete') }}">Delete Image</a>

                        <button class="btn btn-primary btn-sm background-set
                            @if ($background && ($background->default === $data['basename']))
                            d-none
                            @endif"
                            data-file="{{ $image }}"
                            data-url="{{ route('backgrounds.update') }}">Set as Default</button>

                        <div class="d-block bg-image w-100 pb-100 ds-image-item my-2" style="background-image: url({{ Storage::url($image) }})"></div>
                    </div>
                @endforeach
                </div>
            </div>
        @endif
        </div>
    </div>
@endsection
@section('js_after')

<script type="text/javascript">
    $(document).ready(function (e) {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#multi-file-upload-ajax').submit(function(e) {

            e.preventDefault();

            const validImageTypes = ['image/jpeg', 'image/png'];

            let formData   = new FormData(this);
            let totalFiles = $('#files')[0].files.length;

            let $this = $(this)

            let files = $('#files')[0];

            for (let i = 0; i < totalFiles; i++)
            {
                let filesize = Math.round((files.files[i].size / 1024));

                if (validImageTypes.includes(files.files[i].type) && filesize < 2049)
                {
                    formData.append('files' + i, files.files[i]);
                }
            }

            formData.append('totalFiles', totalFiles);

            $('.fa-spin').removeClass('d-none')
            $('body').addClass('avoid-clicks')

            $.ajax({
                type:'POST',
                url: "{{ route('backgrounds.store') }}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: (data) => {
                    this.reset();

                    if (data.images.length)
                    {
                        data.images.forEach(element => {

                            let image = `/storage/backgrounds/${element}.png`
                            let html  =
                            `
                            <div class="col-lg-4 col-xl-2 mb-2 border-bottom border-danger" id="${element}">

                                <a class="btn btn-danger btn-sm background-delete"
                                data-file="public/backgrounds/${element}.png"
                                data-url="{{ route('backgrounds.delete') }}">Delete Image</a>

                                <button class="btn btn-primary btn-sm background-set"
                                    data-file="${element}.png"
                                    data-url="{{ route('backgrounds.update') }}">Set as Default</button>

                                <div class="d-block bg-image w-100 pb-100 ds-image-item my-2" style="background-image: url(${image})"></div>
                             </div>
                            `
                            $('#images-container').prepend(html)
                        });
                    }

                },
                error: function(data)
                {
                    alert('Something went wrong. Please try again or try another image')
                }
            }).always(function()
            {
                $('.fa-spin').addClass('d-none')
                $('body').removeClass('avoid-clicks')
                $this.trigger('reset');
            });
        });
    });
</script>

@endsection
