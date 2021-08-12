<form action="{{ route('winners.store') }}" method="POST" id="winners-store">
    @csrf
    <div class="form-group">
        <input type="hidden" name="clinic_id" id="clinic_id">
        <input type="hidden" name="award_nomination_id" id="award_nomination_id">
        <input type="hidden" name="award_id" id="award_id">
    </div>

    <div class="form-group">
        <label for="name">Nomenee Name</label>
        <input type="text" class="form-control" name=name id="name" value="">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="name">Clinic/Department Name</label>
        <input type="text" class="form-control" name=clinic id="clinic" value="">

        @error('clinic')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="name">Award</label>
        <input type="text" class="form-control" name=award id="award" value="">

        @error('award')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="name">Order</label>
        <input type="number" class="form-control" name=order id="order" value="1">

        @error('order')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
      <label for="">Reason for Nomination</label>
      <textarea class="form-control" name="reason" id="reason" rows="5"></textarea>
    </div>


    <button type="submit" class="btn btn-primary">Show on winners page</button>
</form>
