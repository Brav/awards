<form
    action="{{ route('departments.update', $item->id) }}"
    method="POST"
    role="formAjax"
    id=formAjax>
    @method('PUT')
    @csrf
    <input type="hidden" name="table" id=table value="departments">
    <input type="hidden" name="action" id=action value="edit">
    <input type="hidden" name="_id" id=_id value="{{ $item->id }}">

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="name">Department Name</label>
                <input type="text" class="form-control" name=name id="name" value="{{ old('name', $item->name) }}">

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col">

            <div class="form-group">
                <label for="manager_id">Manager</label>
                    <select class="form-control select2"
                        style="width: 100%"
                        name="manager_id"
                        id="manager_id">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                @if ($user->id == old("manager_id", $item->manager_id))
                                    selected
                                @endif>{{ $user->name }}</option>
                        @endforeach
                    </select>

                    @error('manager_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
            </div>

        </div>

    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
