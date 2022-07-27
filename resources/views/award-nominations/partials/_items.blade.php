@foreach ($items as $item)
    <tr id="item-{{ $item->id }}">
        @if ($actions)
            <th scope="col" style="min-width: 115px">

                <button
                    data-id={{ $item->id }}
                    data-url="{{ route('award-nominations.winner', $item->id) }}"
                        class="btn btn-{{ $item->winner ? 'danger' : 'primary' }} btn-sm change-winner-status">
                    {{ $item->winner ? 'Remove Winner Status' : 'Make Winner'}}
                </button>

                <button
                    data-id={{ $item->id }}
                    data-clinic="{{ optional($item->clinic)->name ?? $item->department->name }}"
                    data-clinicid="{{ optional($item->clinic)->id ?? $item->department->id }}"
                    data-name="{{ $item->nominee }}"
                    data-award="{{ trim(strip_tags(
                        str_replace(['<br>', '<br />', '<br/>', '</p>'], ' ', $item->award->name)
                        )) }}"
                    data-awardid="{{ $item->award->id }}"
                    type="button"
                    class="btn btn-primary btn-sm winner-show @if($item->winnerShown)
                        d-none
                        @endif
                        @if (!$item->winner)
                            d-none
                        @endif
                    ">Show on home page</button>

                    <a
                    data-id={{ $item->id }}
                    data-url="{{ route('winners.edit', $item->id) }}"
                    type="button"
                    data-target="#bigModal"
                    role="bigModal"
                    data-attr="{{ route('winners.edit', $item->id) }}"
                    class="btn btn-primary btn-sm winner-update @if(!$item->winnerShown)
                        d-none
                        @endif">Update</a>

                    <button
                    data-id={{ $item->id }}
                    data-url="{{ route('winners.destroy', $item->id) }}"
                    type="button"
                    class="btn btn-success btn-sm winner-remove @if(!$item->winnerShown)
                        d-none
                        @endif">Remove from home page</button>

            </th>
        @endif
        <th>{{ $item->created_at
            ->timezone('Australia/Sydney')
            ->format('d/m/Y g:i A') }}</th>
        <th>{{ $item->member_logged }}</th>
        <th style="max-width: 125px; word-break: break-all">{{ $item->member_logged_email }}</th>

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

        @if ($award->options['office_type'] === 'values')
            <th>{{ $supportOfficeValues[$item->support_office_value] }}</th>

            <th>{{ $item->support_office_description }}</th>
        @endif

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

                @if ($actions)
                    {!! $item->fields[str_replace(' ', '_', $field)] !!}
                @else
                    {{ $item->fields[str_replace(' ', '_', $field)]  }}
                @endif


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
