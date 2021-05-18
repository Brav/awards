<tr id="item-{{ $item->id }}">
    <th>{{ $item->id }}</th>
    <th class="title">{{ $item->name }}</th>
    <th class="title">{{ $item->manager->name }}</th>
    <th>
        <a href="{{ route('departments.edit', $item->id) }}"
            class="btn btn-primary btn-sm active"
            role="bigModal"
            data-toggle="modal"
            data-target="#bigModal"
            data-table="departments"
            data-attr="{{ route('departments.edit', $item->id) }}"
            aria-pressed="true">Edit</a>

        <a data-toggle="modal"
            class="btn btn-danger btn-sm"
            role="smallModal"
            data-target="#smallModal"
            data-attr="{{ route('departments.delete', $item->id) }}"
            title="Delete Category">
                <i class="fa fa-trash-o  fa-lg"></i> Delete
            </a>
    </th>
</tr>
