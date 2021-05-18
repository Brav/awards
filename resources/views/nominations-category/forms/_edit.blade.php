<form
    action="{{ route('nominations-category.update', $category->id) }}"
    method="POST"
    role="formAjax"
    id=formAjax>
    @method('PUT')
    @csrf
    <input type="hidden" name="table" id=table value="nomination-categories">
    <input type="hidden" name="action" id=action value="edit">
    <input type="hidden" name="_id" id=_id value="{{ $category->id }}">

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="name">Nomination Name</label>
                <input type="text" class="form-control" name=name id="name"
                    value="{{ old('name', $category->name) }}">

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
