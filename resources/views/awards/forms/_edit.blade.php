<form
    action="{{ route('awards.update', $award->id) }}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="hidden" id="background-award"
        name="background-award"
        value="{{ $defaultAward ?? null }}">

    <input type="hidden" id="background-winner"
        name="background-winner"
        value="{{ $defaultWinner ?? null }}">

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="name">Award Name</label>
                <textarea class="form-control" name="name" id="name">{{
                    old('name', $award->name)
                }}</textarea>

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
              value="{{ old('order', $award->order) }}"
              placeholder="Order on home screen" >

                @error('order')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="col">
            <div class="form-group">
                <label class="d-block">Award Category</label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="office-type-department"
                    name="office_type"
                    value=department
                    @if (old('office_type', $award['options']['office_type']) === 'department')
                        checked
                    @endif>
                    <label class="custom-control-label" for="office-type-department">Support Office</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio"
                        class="custom-control-input"
                        id="office-type-clinic"
                        value=clinic
                        name="office_type"
                        @if (old('office_type', $award['options']['office_type']) === 'clinic')
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
                        @if ($key == old('period_type', $award->period_type))
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
                type="checkbox" value="true"
                id="always_visible"
                name="always_visible"
                @if (old('always_visible', $award->always_visible))
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
                    @if (in_array($key, old('clinic_managers_shown', $award['options']['clinic_managers_shown'] ?? []) ?? []))
                        checked
                    @endif>
                    <label class="custom-control-label" for="{{ $value }}">{{
                    $managersLabels[$value] }}</label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-row align-items-center">
        <div class="col">
        <div class="form-group">
            <label for="description">Award Description</label>
            <textarea class="form-control" name="description" id="description">{{
                old('description', $award->description)
            }}</textarea>

            @error('description')
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
                        value="{{ old('starting_at',
                            $award->starting_at ?
                            $award->starting_at->timezone('Australia/Sydney')->format('d/m/Y') : null) }}"/>
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
                        value="{{ old('ending_at',
                            $award->ending_at ?
                            $award->ending_at->timezone('Australia/Sydney')->format('d/m/Y') : null) }}"/>
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
        id="add_field">Add Text Field</button>
        <div id="fields" class=col-md-12>
            <div class="col-md-3 d-none" id="number_of_fields">
                <div class="form-group">
                  <label for="">Minimum of fields to user need to fill</label>
                  <input type="number"
                    name="number_of_fields_to_fill"
                    id="number_of_fields_to_fill"
                    class="form-control"
                    value="{{ old('number_of_fields_to_fill', $award['options']['fields_minimum'] ?? 1) }}"
                    min=1
                    @if (!old('number_of_fields_to_fill') || old('number_of_fields_to_fill', $award['options']['fields_minimum'] ?? 1) == 1)
                        readonly
                    @endif
                    >
                </div>
            </div>
            @if (old('additional_field', $award['fields']))
                @php
                    $i = 1;
                @endphp
                @foreach (old('additional_field', $award['fields']) as $field)
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

    <div class="form-row align-items-center mb-3">
        <div class="col-md-4">
            <div class="form-group">
              <label for="">User roles which can access the award for view/export</label>
              <select class="form-control form-control-sm select2" name="roles[]"
                id="roles" multiple>

                @foreach ($roles as $role)
                    <option value="{{ $role->id }}"
                        @if (in_array($role->id, old('roles', $award->roles) ?? []))
                            selected
                        @endif>{{ $role->name }}</option>
                @endforeach
              </select>

            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
              <label for="roles_can_access_for_nomination">User roles which can nominate this award</label>
              <select
                class="form-control form-control-sm select2"
                name="roles_can_access_for_nomination[]"
                id="roles_can_access_for_nomination" multiple>

                <option value="all"
                    @if (!$award->roles_can_access_for_nomination ||
                        in_array('all',
                            old('roles_can_access_for_nomination') ?? [])
                    )
                        selected
                    @endif
                    >All</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}"
                        @if (in_array($role->id,
                            old('roles_can_access_for_nomination', $award->roles_can_access_for_nomination) ?? []))
                            selected
                        @endif
                        >{{ $role->name }}</option>
                @endforeach
              </select>

            </div>
        </div>
    </div>

    @if ($images)
        <div class="col-md-12" id="award-images-container">
            <h3 class="d-block">Award Background</h3>
            <div class="row">
                @foreach ($awardImages as $image)
                    @php
                        $data = pathinfo($image);
                    @endphp
                    <div class="col-lg-4 col-xl-2 background-image award
                            @if ($defaultAward === $data['basename'])
                                border border-danger
                            @endif" id="award-{{ $data['filename'] }}">

                        <button class="btn btn-primary btn-sm background-use award
                            @if ($defaultAward === $data['basename'])
                                d-none
                            @endif"
                            data-type="award"
                            data-file="{{ $data['basename'] }}"
                            data-url="{{ route('backgrounds.update') }}">Use as Background</button>

                        @if ($defaultAward === $data['basename'])
                            <span>Used as award background</span>
                        @endif

                        <div class="d-block bg-image w-100 pb-100 ds-image-item mt-2" style="background-image: url({{ Storage::url($image) }})"></div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-12 my-3" id="winner-images-container">
            <h3 class="d-block">Winner Background</h3>
            <div class="row">
                @foreach ($winnerImages as $image)
                    @php
                        $data = pathinfo($image);
                    @endphp
                    <div class="col-lg-4 col-xl-2 background-image winner
                            @if ($defaultWinner === $data['basename'])
                                border border-danger
                            @endif" id="winner-{{ $data['filename'] }}">

                        <button class="btn btn-primary btn-sm background-use winner
                            @if ($defaultWinner === $data['basename'])
                                d-none
                            @endif"
                            data-type="winner"
                            data-file="{{ $data['basename'] }}"
                            data-url="{{ route('backgrounds.update') }}">Use as Background</button>

                        @if ($defaultWinner === $data['basename'])
                            <span>Used as winner background</span>
                        @endif

                        <div class="d-block bg-image w-100 pb-100 ds-image-item mt-2" style="background-image: url({{ Storage::url($image) }})"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<script src="{{ asset('js/tinymce.js') }}"></script>
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

    tinymce.init({
        selector: '#description',
        menubar : false,
        toolbar: "undo redo | paragraph bold italic"
    });
    tinymce.init({
        selector: '#name',
        menubar : false,
        toolbar: "undo redo | paragraph bold italic"
    });
</script>
