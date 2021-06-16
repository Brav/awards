@foreach ($managers as $manager)
    <div class="col">
        <div class="form-group">

            <div class="form-group">
                <label for="{{ $managerTypes[$manager] }}">{{ $managersLabel[$managerTypes[$manager]] }}</label>
                <input type="text"
                class="form-control" name="{{ $managerTypes[$manager] }}"
                id="{{ $managerTypes[$manager] }}"
                readonly>
            </div>

        </div>
    </div>
@endforeach
