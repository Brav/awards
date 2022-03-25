<div class="form-group">
    <label for="support_office_value">Support Office Value</label>
    <select class="form-control select2 col-md-12" name="support_office_value" id="support_office_value">
            <option></option>
            @foreach ($supportOfficeValues as $key => $value)
                <option value="{{ $key }}"
                    @if (old('support_office_value', $supportOfficeValue) == $key)
                        selected
                    @endif
                    >{{ $value }}</option>
            @endforeach
        </select>
    @error('support_office_value')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
