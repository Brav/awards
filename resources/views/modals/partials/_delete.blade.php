{{-- !-- Delete Warning Modal -->  --}}
<form action="{{ $routeName }}" method="post" id=delete-form>
    <div class="modal-body">
        @method('DELETE')
        <input type="hidden" name="id" value="{{ $id }}">

        @if (isset($table))
            <input type="hidden" name="table" id="table" value="{{ $table }}">
        @endif

        <h5 class="text-center">Are you sure you want to delete {{ $itemName }} ?</h5>
    </div>

    <div class="modal-footer modal-action">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger modal-action-delete">Delete</button>
    </div>

    <div class="modal-footer dialog d-none">
        <span class="text-center text-danger">Be careful, you will delete this item</span>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger dialog-yes">Yes</button>
    </div>
</form>
