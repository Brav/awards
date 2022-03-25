<a class="btn btn-primary"
    href="{{ route('award-nominations.export', $award->id) }}"
    role="button"
    data-name="{{ \strtolower(Str::slug($award->name, '_')) }}"
    id="export">Export</a>
<table class="table table-bordered table-striped table-vcenter" id=award-nominations>
    <thead class="thead-dark">
        <tr>
            @if ($actions)
                <th scope="col" class="small sticky-top">Actions</th>
            @endif
            <th scope="col" class="small sticky-top">Date/time submitted</th>
            <th scope="col" class="small sticky-top">Nomination submitted by</th>
            <th scope="col" class="small sticky-top" style="max-width: 125px;">Submitting team member email</th>

            @if ($award->options['office_type'] === 'clinic')
                <th scope="col" class="small sticky-top">Clinic of Nominee</th>
                @foreach ($managers as $manager)
                    <th scope="col" class="small sticky-top">{{ $managersLabel[$managerTypes[$manager]] }}</th>
                @endforeach
            @else
                <th scope="col" class="small sticky-top">Department Name</th>
            @endif

            <th scope="col" class="small sticky-top">Name of Nominee</th>

            @if ($award->options['office_type'] === 'values')
                <th scope="col" class="small sticky-top">Support Office Value</th>

                <th scope="col" class="small sticky-top">Value Description</th>
            @endif

            @foreach ($nominationCategories as $category)
                <th scope="col" class="small sticky-top">{{ $category->name }}</th>
            @endforeach

            @foreach ($award->fields as $field)
                <th scope="col" class="small sticky-top" style="min-width: 250px">{{ $field }}</th>
            @endforeach

            @if ($actions)
                <th scope="col" class="small sticky-top">Actions</th>
            @endif

        </tr>
    </thead>
    <tbody id=award-nominations-container>
        @include('award-nominations/partials/_items')
    </tbody>
</table>

