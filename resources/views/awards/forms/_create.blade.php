<form
    action="{{ route('awards.store') }}"
    method="POST">
    @csrf

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="name">Award Name</label>
                <input type="text" class="form-control" name=name id="name" value="{{ old('name') }}">

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col">

            <div class="form-group">
              <label for="order">Order on screen</label>
              <input type="number" name="order"
              id="order" class="form-control"
              min=1
              value="{{ old('order') }}"
              placeholder="Order on home screen" >

                @error('order')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col">
            <div class="form-group">
                <label class="d-block">Office Type</label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="office-type-department"
                    name="office_type"
                    value=department
                    @if (old('office_type') === 'department' || !old('office_type'))
                        checked
                    @endif>
                    <label class="custom-control-label" for="office-type-department">Department</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio"
                        class="custom-control-input"
                        id="office-type-clinic"
                        value=clinic
                        name="office_type"
                        @if (old('office_type') === 'clinic')
                            checked
                        @endif>
                    <label class="custom-control-label" for="office-type-clinic">Clinic</label>
                </div>
            </div>
        </div>

        <div class="col">

            <div class="form-group">
                <label for="period_type">Award Type</label>
                <select class="form-control" name="period_type" id="period_type">
                    @foreach ($periods as $key => $value)
                        <option value="{{ $key }}"
                        @if ($key == old('period_type'))
                            selected
                        @endif
                        >{{ ucwords($value) }}</option>
                    @endforeach
                </select>

                @error('period_type')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col">
            <div class="form-check">
                <input class="form-check-input"
                    type="checkbox"
                    value="true"
                    id="always_visible"
                    name="always_visible"
                    @if (old('always_visible'))
                        checked
                    @endif>
                <label class="form-check-label" for="always_visible">Always Visible</label>

                @error('always_visible')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>

    <div class="form-row align-items-center d-none" id="clinic-managers">
        <div class="form-group">
            <label class="d-block">Show Managers</label>
            @foreach ($clinicManagers as $key => $value)
                <div class="custom-control custom-switch custom-control-inline">
                    <input
                    type="checkbox" class="custom-control-input"
                    value="{{ $key }}"
                    id="{{ $value }}"
                    name="clinic_managers_shown[]"
                    @if (in_array($key, old('clinic_managers_shown') ?? []))
                        checked
                    @endif>
                    <label class="custom-control-label" for="{{ $value }}">{{
                    ucwords(str_replace('_', ' ', $value)) }}</label>
                </div>
            @endforeach
        </div>
    </div>

     <div class="form-row align-items-center">
         <div class="col">
            <div class="form-group">
                <label for="description">Award Description</label>
                <textarea class="form-control" name="description" id="description">{{
                    old('description')
                }}</textarea>

                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
         </div>
     </div>

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

    <div class="form-row">

        <div class="col-md-4">
            <div class="form-group">
                <label for="starting_at">Date Starting</label>
                <div class="input-group date starting_at" data-target-input="nearest">

                    <input type="text"
                        class="form-control datetimepicker-input datetimepicker"
                        data-target=".starting_at"
                        name="starting_at"
                        id="starting_at"
                        value="{{ old('starting_at') }}"/>
                    <div class="input-group-append"
                        data-target=".starting_at"
                        data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                @error('starting_at')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="ending_at">Date Ending</label>
                <div class="input-group date ending_at" id="start_dt_2" data-target-input="nearest" >
                    <input type="text"
                        class="form-control datetimepicker-input datetimepicker"
                        data-target="#start_dt_2"
                        name="ending_at"
                        id="ending_at"
                        value="{{ old('ending_at') }}"/>
                    <div class="input-group-append"
                        data-target="#start_dt_2"
                        data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>

            </div>

                @error('ending_at')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>

    <div class="form-row align-items-center mb-3">

        <button type="button"
        class="btn btn-primary"
        id="add_field"
        >Add Text Field</button>

        <div id="fields" class=col-md-12>
            <div class="col d-none" id="number_of_fields">
                <div class="form-group">
                  <label for="">Minimum of fields to user need to fill</label>
                  <input type="number"
                    name="number_of_fields_to_fill"
                    id="number_of_fields_to_fill"
                    class="form-control"
                    value="{{ old('number_of_fields_to_fill', 1) }}"
                    min=1
                    @if (!old('number_of_fields_to_fill') || old('number_of_fields_to_fill') == 1)
                        readonly
                    @endif
                    >
                </div>
            </div>
            @if (old('additional_field'))
                @php
                    $i = 1;
                @endphp
                @foreach (old('additional_field') as $field)
                    <div class="col additional_field"
                        id="field-{{ $i }}">
                        <div class="form-group">
                            <label for="additional_field_{{ $i }}">Addition Field Name</label>
                            <input type="text" name="additional_field[]"
                            id="additional_field_{{ $i }}"
                            class="form-control"
                            value="{{ $field }}"
                            >
                        </div>
                        <i class="fas fa-trash fa-sm remove_field"
                        data-field="field-{{ $i }}">Remove</i>
                    </div>
                    @php
                        $i++
                    @endphp
                @endforeach
            @endif
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {

        let startingAt = $("#starting_at").val();
        let endingAt   = $("#ending_at").val();

        $(function () {

            $("#starting_at").flatpickr({
                dateFormat: "d/m/Y",
            });


            $("#ending_at").flatpickr({
                dateFormat: "d/m/Y",
            });

        });

    })
</script>
