<a class="btn btn-primary"
    href="{{ route('award-nominations.export', $award->id) }}"
    role="button"
    data-name="{{ \strtolower(Str::slug($award->name, '_')) }}"
    id="export">Export</a>
<table class="table table-bordered table-striped table-vcenter" id=award-nominations>

    <tbody id=award-nominations-container>
        @include('award-nominations/partials/_items')
    </tbody>
</table>

