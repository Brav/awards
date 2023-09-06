<?php
    $startYear = date('Y');
    $endYear = date('Y') - 99;
?>

<div class="col">

    <div class="form-group">
        <label for="graduated_year">Graduated Year</label>
        <select class="form-control select2" name="graduated_year" id="graduated_year">
            @for($startYear; $startYear >= $endYear; $startYear--)
                <option value="{{ $startYear }}">{{ $startYear }}</option>
            @endfor
        </select>

        @error('graduated_year')
        <div class="alert alert-danger">Please select support office</div>
        @enderror
    </div>
</div>
