<a class="btn btn-primary" href="{{ route('award-nominations.export', $award->id) }}" role="button">Export</a>
<table class="table table-bordered table-striped table-vcenter" id=award-nominations>
    <thead>
        <tr>
            <th class="small">Date/time submitted</th>
            <th class="small">Nomination submitted by</th>
            <th class="small">Submitting team member email</th>

            @if ($award->options['office_type'] === 'clinic')
                <th class="small">Clinic of Nominee</th>
                @foreach ($managers as $manager)
                    <th class="small">{{ $managersLabel[$managerTypes[$manager]] }}</th>
                @endforeach
            @else
                <th class="small">Department Name</th>
            @endif

            <th class="small">Name of Nominee</th>

            @foreach ($nominationCategories as $category)
                <th class="small">{{ $category->name }}</th>
            @endforeach

            @foreach ($award->fields as $field)
                <th class="small">{{ $field }}</th>
            @endforeach

            @if ($actions)
                <th class="small">Actions</th>
            @endif

        </tr>
    </thead>
    <tbody id=award-nominations-container>
        @include('award-nominations/partials/_items')
    </tbody>
</table>

