@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status.type') }}" role="alert">
                            {{ session('status.message') }}
                        </div>
                    @endif
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                    <label for="award_id">Select Award</label>
                    <select class="form-control" name="award_id" id="awardCategory">
                        <option value="select">Select Category</option>
                        @foreach ($awards as $category)
                            <option
                            data-url={{ route('award-nominations.index', $category->id) }}

                            value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                @if ($items)

                    @include('award-nominations/partials/_table')

                    <div id="pagination">
                        @include('pagination', [
                            'paginator' => $items,
                            'layout'    => 'vendor.pagination.bootstrap-4',
                            'role'      => 'award-nominations',
                            'container' => 'award-nominations-container',
                        ])
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
