<form
    action="{{ route('departments.store') }}"
    method="POST"
    role="formAjax"
    id=formAjax>
    @csrf
    <input type="hidden" name="table" id=table value="departments">
    <input type="hidden" name="action" id=action value="create">

    <div class="form-row align-items-center">

        <div class="col">
            <div class="form-group">
                <label for="name">Department Name</label>
                <input type="text" class="form-control" name=name id="name" value="{{ old('name') }}">

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
                            @if (in_array($user->id, old("manager_id") ?? []))
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

    <button type="submit" class="btn btn-primary">Create</button>
</form>
