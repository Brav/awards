@foreach ($items as $item)
    <tr id="item-{{ $item->id }}">
        <th>{{ $item->id }}</th>
        <th>{{ $item->member_logged }}</th>
        <th>{{ $item->member_logged_email }}</th>

        @if ($award->options['office_type'] === 'clinic')
            <th>{{ $item->clinic->name }}</th>
            @foreach ($managers as $manager)
                @php
                    $managerType = $managerTypes[$manager];
                    $attribute   = $managersRelationMap[$managerType];
                @endphp
                <th>
                    {{
                        $item->clinic->$attribute && !empty($item->clinic->$attribute) ?
                        $item->clinic->$attribute->first()->user->name : '' }}
                </th>
            @endforeach
        @else
            <th>{{ $item->department->manager->name }}</th>
        @endif

        <th>{{ $item->nominee }}</th>

        @foreach ($nominationCategories as $category)
            @if ($category->id == $item->options['category'])
                <th>Test</th>
            @endif
        @endforeach

        <th>
            <a href="{{ route('award-nominations.edit', $item->id) }}"
                class="btn btn-primary btn-sm active"
                role="button" aria-pressed="true">Edit</a>

            <a data-toggle="modal"
                class="btn btn-danger btn-sm"
                role="smallModal"
                data-target="#smallModal"
                data-attr="{{ route('award-nominations.delete', $item->id) }}" title="Delete Nomination">
                    <i class="fa fa-trash-o fa-lg"></i> Delete
            </a>
        </th>
    </tr>
@endforeach
