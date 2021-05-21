@if ($nominationCategories->count() === 1)
    <div class="form-row align-items-center">
        <div class="col-md-4">
            <label for="nominations">{{ $award['options']['nominations']['text'] }}</label>
        </div>
        <div class="col-md-4">
            <div class="form-group">

                <select name="nominations[]" id="nominations" class=form-control>
                    @foreach ($nominationCategories->first()->nominations as $item)
                        <option value="{{ $nominationCategories->first()->id . '|'. $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>

            </div>
            @error('nomination')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

    </div>
@else
    <div class="form-row align-items-center">

        <div class="col-md-4">
            <label for="nominations">{{ $award['options']['nominations']['text'] }}</label>
        </div>
        <div class="col-md-4">
            <label for="nominations">Nomination based on {{$award['options']['nominations']['minimum'] }} or more of the following  categories </label>
        </div>

    </div>

    @foreach ($nominationCategories as $nomination)
        <div class="form-row align-items-center">
            <div class="col-md-4">
                <label for="nominations">{{ $nomination->name }}</label>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <select name="nominations[]" id="nominations" class=form-control>
                        @foreach ($nomination->nominations as $item)
                            <option value="{{ $nomination->id . '|'. $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    @endforeach

@endif
