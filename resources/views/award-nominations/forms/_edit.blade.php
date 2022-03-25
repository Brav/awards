<form action="{{ route('award-nominations.update', $item->id) }}" method="POST" style="padding-top: 150px; padding-bottom: 150px;">
    @csrf
    @method('PUT')
    <h1>{{ $award->name }}</h1>

    <input type="hidden" name="award_id" value="{{ $award->id}}">

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="member_logged">Nomination submitted by</label>
                <input type="text" class="form-control" name=member_logged id="member_logged"
                value="{{ old('member_logged', $item->member_logged) }}">

                @error('member_logged')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="member_logged_email">Submitting team member email</label>
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
                    <label for="clinic_id">Clinic of Nominee</label>
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
                        <div class="alert alert-danger">Please select clinic</div>
                    @enderror
                </div>
            </div>

        </div>
    @endif

    @if (in_array($awardOffice, ['department', 'values']))
        @include('award-nominations/forms/fields/_supportOfficeName', [
            'departmantID' => $award->department_id,
        ])
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

        @if ($awardOffice === 'values')
            <div class="col-md-6">
                @include('award-nominations/forms/fields/_supportOfficeValues',
                [
                    'supportOfficeValue' => $award->support_office_value,
                ])
            </div>
        @endif

    </div>

    @if ($awardOffice === 'values')
        <div class="form-row align-items-center form-group row">
            @include('award-nominations/forms/fields/_supportOfficeDescription',
            [
                '_supportOfficeDescription' =>  $award->support_office_description,
            ])
        </div>
    @endif

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
                        placeholder="Please write your answer here."
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
