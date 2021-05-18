<tr id="item-{{ $nomination->id }}">
    <th>{{ $nomination->id }}</th>
    <th class="title">{{ $nomination->name }}</th>
    <th class="title nomination-category-{{ $nomination->category->id }}">{{ $nomination->category->name }}</th>
    <th>
        <a href="{{ route('nominations.edit', $nomination->id) }}"
            class="btn btn-primary btn-sm active"
            role="bigModal"
            data-toggle="modal"
            data-target="#bigModal"
            data-table="nominations"
            data-attr="{{ route('nominations.edit', $nomination->id) }}"
            aria-pressed="true">Edit</a>

        <a data-toggle="modal"
            class="btn btn-danger btn-sm"
            role="smallModal"
            data-target="#smallModal"
            data-attr="{{ route('nominations.delete', $nomination->id) }}"
            title="Delete Category">
                <i class="fa fa-trash-o  fa-lg"></i> Delete
            </a>
    </th>
</tr>
