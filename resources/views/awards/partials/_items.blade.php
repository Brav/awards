@foreach ($items as $item)
    <tr id="item-{{ $item->id }}">
        <td class=col>{{ $item->id }}</td>
        <td class=col>
            <a href="{{ route('award-nominations.create', $item->slug) }}" target=_blank rel=noopener rel=nofollow>
                {{ $item->name }}
            </a>
            @if ($item->deleted_at)
                <span class="text-danger">DELETED</span>
            @endif
        </td>
        <th class="text-capitalize">{{ $periods[$item->period_type] }}</th>
        <td class=col>{{ $item->always_visible ? 'Yes' : 'No' }}</td>
        <th class="text-capitalize">{{ $item['options']['office_type'] ?? '/' }}</th>
        <th class="small">{!! $item->nominations !!}</th>
        <td class=col>{{ $item->order }}</td>
        <td class=col>{{ $item->submitted_nominations_count }}</td>
        <td class=col>{{ $item->starting_at ?
            $item->starting_at->timezone('Australia/Sydney')
            ->format('d/m/Y') : '/' }}</td>
        <td class=col>{{ $item->ending_at ?
            $item->starting_at->timezone('Australia/Sydney')
            ->format('d/m/Y') : '/'}}</td>
        <td class=col>

            <a id="check_nomination"
            class="btn btn-primary"
            href="{{ route('award-nominations.index', $item->id) }}"
            role="button">Check Nomination</a>

            <a href="{{ route('awards.edit', $item->id) }}"
                class="btn btn-primary btn-sm active"
                role="button" aria-pressed="true">Edit</a>
            @if (!$item->deleted_at)
                <a data-toggle="modal"
                    class="btn btn-danger btn-sm"
                    role="smallModal"
                    data-target="#smallModal"
                    data-attr="{{ route('awards.delete', $item->id) }}" title="Delete Award">
                        <i class="fa fa-trash-o fa-lg"></i> Delete
                </a>
            @endif

        </td>
    </tr>
@endforeach
