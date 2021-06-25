<form action="{{ route('award-nominations.store') }}" method="POST" style="padding-top: 150px; padding-bottom: 150px;">
    @csrf
    <h1>{{ $award->name }}</h1>

    <input type="hidden" name="award_id" value="{{ $award->id}}">

    @if (isset( $award->options['nominations']['minimum'] ))
        <input type="hidden" name="_minimum" value="{{ $award->options['nominations']['minimum']}}">
    @endif

    @if (isset( $award->options['fields_minimum'] ))
        <input type="hidden" name="_fields_minimum" value="{{ $award->options['fields_minimum']}}">
    @endif

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="member_logged">Nomination submitted by</label>
                <input type="text" class="form-control" name=member_logged id="member_logged" value="{{ old('member_logged') }}">

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
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Place for managers --}}

        </div>
    @endif

    @if ($awardOffice === 'department')
        <div class="form-row align-items-center">

            <div class="col-md-4">

                <div class="form-group">
                    <label for="department_id">Support Office Name</label>
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

                    @error('department_id')
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

    {{-- @if ($nominationCategories)
        @include('award-nominations/partials/_nominations')
    @endif --}}

    @if (!empty($award['fields']))

        @if (count($award['fields']) > 1)
            <div class="form-row align-items-center mb-3">
                <div class="col-md-2">
                    <label>Nomination</label>
                </div>

                <div class="col">
                    <label>Nomination based on {{ $award->options['fields_minimum'] }} or more of the following  categories</label>
                    @error('fields')
                        <div class="alert alert-danger">You need to write at least {{ $award->options['fields_minimum'] }} or more of the following  categories</div>
                    @enderror
                </div>

            </div>
        @endif
        @foreach ($award['fields'] as $field)
            @php
                $fieldName = \str_replace(' ', '_', $field);
            @endphp
            <div class="form-row align-items-center">
                <div class="col-md-2">
                    <label for="fields_{{ $fieldName }}">{{ $field }}</label>
                </div>

                <div class="col">
                    <div class="form-group">
                      <textarea class="form-control"
                        placeholder="Please write your answer here. {{ $field }}"
                        name="fields[{{$fieldName  }}]"
                        id="fields_{{ $fieldName }}">{{ old('fields') ? old('fields')[$fieldName] : '' }}</textarea>

                        @error('fields.' . $fieldName)
                            <div class="alert alert-danger">Please write more than 25 words in this field</div>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <a class="btn btn-primary" href="{{ route('home') }}" role="button">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit Form</button>
</form>
