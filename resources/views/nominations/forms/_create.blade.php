<form
    action="{{ route('nominations.store') }}"
    method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    <input type="hidden" name="table" id=table value="nominations">
    <input type="hidden" name="action" id=action value="create">

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="name">Nomination Name</label>
                <input type="text" class="form-control" name=name id="name" value="{{ old('name') }}">

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col">
            <div class="form-group">

                <div class="form-group">
                  <label for="nomination_category_id">Nomination Category</label>
                  <select class="form-control" name="nomination_category_id" id="nomination_category_id">
                      @foreach ($categories as $category)
                        <option
                        @if (old('nomination_category_id') == $category->id)
                            selected
                        @endif
                        value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                  </select>
                </div>

                @error('nomination_category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
