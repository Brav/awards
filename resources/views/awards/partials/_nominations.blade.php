<div class="form-row align-items-center" id="nominations">
    <div class="col">
        <div class="form-group">
            <label for="nomination">Nomination category to select</label>
            <select class="form-control select2"
                multiple
                name="nominations[]" id="nomination">
                @foreach ($nominations as $nomination)
                    <option
                        @if (in_array($nomination->id, old('nominations') ?? []))
                            selected
                        @endif
                        value="{{ $nomination->id }}">{{ $nomination->name }}</option>
                @endforeach
            </select>

            @error('nominations')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="number_of_nomination_to_select">Minimum number of nomination to select</label>
            <input type="number" name="number_of_nomination_to_select" id="number_of_nomination_to_select" class="form-control" value={{ old('number_of_nomination_to_select', 1) }}
            min=1
            @if (old('number_of_nomination_to_select') == 1)
                readonly
            @endif>
            <small id="helpId" class="text-muted">Minimum number of nomination categories user needs to select</small>

            @error('number_of_nomination_to_select')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="nomination_category_text">Nomination Category Text</label>
            <input type="text" name="nomination_category_text" id="nomination_category_text" class="form-control" value="{{ old('nomination_category_text', 'Reason for nomination') }}">

            @error('nomination_category_text')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
