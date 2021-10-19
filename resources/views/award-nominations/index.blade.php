@extends('layouts.app')

@section('content')
    <div class="px-8">
        <div class="justify-content-center">
            <div class="">

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
                            value="{{ $category->id }}">{{ strip_tags($category->name) . '(' . $category->submitted_nominations_count . ')' }}</option>
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

                <div class="col-md-2 d-inline-block">
                    <div class="form-group">
                        <label for="select_month">Select Month</label>
                        <select name="select_month" class="form-control" id="selectMonth">
                            <option value="all">All</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                </div>


                <div class="table-responsive" id="award-nominations-table" style="height: 100vh">
                    @if ($items)
                        @include('award-nominations/partials/_table')
                    @endif
                </div>

                <div id="pagination">
                    @if ($items)

                        @include('pagination', [
                            'paginator' => $items,
                            'layout'    => 'vendor.pagination.bootstrap-4',
                            'role'      => 'award-nominations',
                            'container' => 'award-nominations-table',
                        ])

                    @endif
                </div>

            </div>
        </div>
    </div>

    <template id="winners-create">
        @include('winners/forms/_create')
    </template>

@endsection
