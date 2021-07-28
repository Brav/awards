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

                <div class="col-md-3 d-inline-block">
                    <div class="form-group">
                    <label for="award_id">Select Award</label>
                    <select class="form-control" name="award_id" id="awardCategory">
                        <option value="select">Select Category</option>
                        @foreach ($awards as $category)
                            <option
                            data-url={{ route('award-nominations.index', $category->id) }}
                            @if ($award && $award->id == $category->id)
                                selected
                            @endif
                            value="{{ $category->id }}">{{ $category->name . '(' . $category->submitted_nominations_count . ')' }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="col-md-3 d-inline-block">
                    <div class="form-group">
                    <label for="winner_status">Select Status</label>
                    <select class="form-control" name="winner_status" id="winnerStatus">
                        <option value="all">All</option>
                        <option value="winners">Winners</option>
                        <option value="non-winner">Non-Winner</option>
                    </select>
                    </div>
                </div>

                <div class="col-md-3 d-inline-block">
                    <div class="form-group">
                    <label for="select_year">Select Year</label>
                    <select class="form-control" name="select_year" id="selectYear">
                        <option value="all">All</option>
                        @for ($i = $startingYear; $i <= $currentYear; $i++)
                            <option valeu={{ $i }}>{{ $i }}</option>
                        @endfor
                    </select>
                    </div>
                </div>

                <div class="table-responsive" id="award-nominations-table" style="height: 100vh">
                    @include('award-nominations/partials/_table')
                </div>

                <div id="pagination">
                    @if ($items)

                        @include('pagination', [
                            'paginator' => $items,
                            'layout'    => 'vendor.pagination.bootstrap-4',
                            'role'      => 'award-nominations',
                            'container' => 'award-nominations-container',
                        ])

                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
