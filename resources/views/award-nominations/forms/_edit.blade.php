<form action="{{ route('award-nominations.update', $item->id) }}" method="POST" style="padding-top: 150px; padding-bottom: 150px;">
    @csrf
    @method('PUT')
    <h1>{{ $award->name }}</h1>

    <input type="hidden" name="award_id" value="{{ $award->id}}">

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="member_logged">Team member logging the nomination:</label>
                <input type="text" class="form-control" name=member_logged id="member_logged"
                value="{{ old('member_logged', $item->member_logged) }}">

                @error('member_logged')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="member_logged_email">Team member email</label>
                <input type="text" class="form-control"
                name=member_logged_email
                id="member_logged_email"
                value="{{ old('member_logged_email') }}">

                @error('member_logged_email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>

    @if ($awardOffice === 'clinic')
        <div class="form-row align-items-center">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="clinic_id">Clinic Name</label>
                    <select class="form-control select2" name="clinic_id" id="clinic_id">
                        <option></option>
                        @foreach ($offices as $clinic)
                            <option value="{{ $clinic->id }}"

                                @foreach ($managers as $manager)
                                    @php
                                        $managerType = $managerTypes[$manager];
                                        $attribute   = $managersRelationMap[$managerType];
                                    @endphp
                                    data-{{ $managerType }}="{{
                                        $clinic->$attribute && !empty($clinic->$attribute) ?
                                        $clinic->$attribute->first()->user->name : '' }}"
                                @endforeach

                                @if (old('clinic_id') == $clinic->id)
                                    selected
                                @endif
                                >{{ $clinic->name }}</option>
                        @endforeach
                    </select>

                    @error('clinic_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            @foreach ($managers as $manager)
                <div class="col">
                    <div class="form-group">

                        <div class="form-group">
                            <label for="{{ $managerTypes[$manager] }}">{{ $managersLabel[$managerTypes[$manager]] }}</label>
                            <input type="text"
                            class="form-control" name="{{ $managerTypes[$manager] }}"
                            id="{{ $managerTypes[$manager] }}"
                            readonly>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    @endif

    @if ($awardOffice === 'department')
        <div class="form-row align-items-center">

            <div class="col-md-4">

                <div class="form-group">
                    <label for="department_id">Department Name</label>
                    <select class="form-control select2" name="department_id" id="department_id">
                        <option></option>
                        @foreach ($offices as $departmant)
                            <option value="{{ $departmant->id }}"

                                data-manager={{ $departmant->manager->name }}

                                @if (old('department_id') == $departmant->id)
                                    selected
                                @endif
                                >{{ $departmant->name }}</option>

                        @endforeach
                    </select>

                    @error('departmant_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
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
    @endif

    <div class="form-row align-items-center">

        <div class="col-md-4">
            <div class="form-group">
              <label for="nominee">Name of Nominee</label>
              <input type="text" name="nominee" id="nominee" class="form-control"
                value="{{ old('nominee') }}"
                placeholder="Name of Nominee">
                @error('nominee')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>

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

    @if (!empty($award['fields']))
        @foreach ($award['fields'] as $field)
            @php
                $fieldName = \str_replace(' ', '_', $field);
            @endphp
            <div class="form-row align-items-center">
                <div class="col-md-4">
                    <label for="fields_{{ $fieldName }}">{{ $field }}</label>
                </div>

                <div class="col">
                    <div class="form-group">
                      <textarea class="form-control"
                        name="fields[{{$fieldName  }}]"
                        id="fields_{{ $fieldName }}">{{ old('fields') ? old('fields')[$fieldName] : '' }}</textarea>

                        @error('fields.' . $fieldName)
                            <div class="alert alert-danger">Please write something</div>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <a class="btn btn-primary" href="{{ route('home') }}" role="button">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit Form</button>
</form>
