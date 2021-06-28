@foreach ($items as $item)
    <tr id="item-{{ $item->id }}">
        @if ($actions)
            <th>
                <button
                    data-id={{ $item->id }}
                    data-url="{{ route('award-nominations.winner', $item->id) }}"
                        class="btn btn-{{ $item->winner ? 'danger' : 'primary' }} change-winner-status">
                    {{ $item->winner ? 'Remove Winner Status' : 'Make Winner'}}
                </button>
            </th>
        @endif
        <th>{{ $item->created_at
            ->timezone('Australia/Sydney')
            ->format('d/m/Y g:i A') }}</th>
        <th>{{ $item->member_logged }}</th>
        <th>{{ $item->member_logged_email }}</th>

        @if ($award->options['office_type'] === 'clinic')
            <th>{{ optional($item->clinic)->name ?? '/' }}</th>
            @foreach ($managers as $manager)
                @php
                    $managerType = $managerTypes[$manager];
                    $attribute   = $managersRelationMap[$managerType];
                @endphp
                <th>
                    {{
                        $item->clinic->$attribute && !empty($item->clinic->$attribute) ?
                        $item->clinic->$attribute->first()->user->name : '/' }}
                </th>
            @endforeach
        @else
            <th>{{ $item->department->manager->name }}</th>
        @endif

        <th>{{ $item->nominee }}</th>

        @foreach ($nominationCategories as $category)
            <th>
                @if (in_array($category->id, array_column($item->options, 'category')))
                    {{ $category->nomination($item->options) }}
                @endif
            </th>
        @endforeach

        @foreach ($award->fields as $field)
            <th>
                @if (isset($item->fields[str_replace(' ', '_', $field)]))
                {{ $item->fields[str_replace(' ', '_', $field)] }}
                @endif
            </th>
        @endforeach

        @if ($actions)
            <th>
                <a data-toggle="modal"
                    class="btn btn-danger btn-sm"
                    role="smallModal"
                    data-target="#smallModal"
                    data-attr="{{ route('award-nominations.delete', $item->id) }}" title="Delete Nomination">
                        <i class="fa fa-trash-o fa-lg"></i> Delete
                </a>
            </th>
        @endif

    </tr>
@endforeach
