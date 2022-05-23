@php
    $currentYear = \Carbon\Carbon::now()->format('Y');

    $yearRange = array_reverse(range($currentYear - 10,$currentYear));

@endphp

<div class="form-group">
    <label for="month_{{ $id }}">Month</label>
    <select class="form-control" name="month_{{$id}}" id="month_{{$id}}">>
        @foreach(range(1,12) as $month)

            <option value="{{$month}}"
                @if($month == $date->format('n'))
                    selected
                @endif
            >
                {{date("M", strtotime('2016-'.$month))}}
            </option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <label for="year_{{ $id }}">Year</label>
    <select class="form-control"  id="year_{{ $id }}" name="year_{{ $id }}">

        @foreach($yearRange as $year)

            <option value="{{$year}}"
                    @if($year == $date->format('Y'))
                        selected
                 @endif
            >
                {{ $year }}
            </option>
        @endforeach

    </select>
</div>
