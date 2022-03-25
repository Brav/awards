<div class="form-row align-items-center">

    <div class="col-md-6">

        <div class="form-group">
            <label for="department_id">Support Office Name</label>
            <select class="form-control select2" name="department_id" id="department_id">
                <option></option>
                @foreach ($offices as $departmant)
                    <option value="{{ $departmant->id }}"

                        data-manager={{ $departmant->manager->name }}

                        @if (old('department_id', $departmantID) == $departmant->id)
                            selected
                        @endif
                        >{{ $departmant->name }}</option>

                @endforeach
            </select>

            @error('department_id')
                <div class="alert alert-danger">Please select support office</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">

            <div class="form-group">
                <label for="departmant_manager">Department Manager</label>
                <input type="text"
                class="form-control" name="departmant_manager"
                id="departmant_manager"
                readonly>
            </div>

        </div>
    </div>

</div>
