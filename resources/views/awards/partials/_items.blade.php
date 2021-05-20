@foreach ($items as $item)
    <tr id="item-{{ $item->id }}">
        <th>{{ $item->id }}</th>
        <th>{{ $item->name }}</th>
        <th class="text-capitalize">{{ $periods[$item->period_type] }}</th>
        <th>{{ $item->always_visible ? 'Yes' : 'No' }}</th>
        <th class="text-capitalize">{{ $item['options']['office_type'] }}</th>
        <th class="small">{!! $item->nominations !!}</th>
        <th>{{ $item->order }}</th>

        <th>
            <a href="{{ route('awards.edit', $item->id) }}"
                class="btn btn-primary btn-sm active"
                role="button" aria-pressed="true">Edit</a>

            <a data-toggle="modal"
                class="btn btn-danger btn-sm"
                role="smallModal"
                data-target="#smallModal"
                data-attr="{{ route('awards.delete', $item->id) }}" title="Delete Award">
                    <i class="fa fa-trash-o fa-lg"></i> Delete
                </a>
        </th>
    </tr>
@endforeach
