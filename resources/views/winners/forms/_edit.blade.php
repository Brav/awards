<form action="{{ route('winners.update', $winner->id) }}" method="POST"
    id="winners-store"
    role="formAjax">
    @csrf
    @method('PUT')

    <input type="hidden" name="clinic_id" id="clinic_id" value="{{ $winner->clinic_id }}">
    <input type="hidden" name="award_nomination_id" id="award_nomination_id" value="{{ $winner->award_nomination_id }}">
    <input type="hidden" name="award_id" id="award_id" value="{{ $winner->nomination->award->id }}">

    <div class="form-group">
        <label for="name">Nomenee Name</label>
        <input type="text" class="form-control" name=name id="name" value="{{ $winner->name }}">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="name">Clinic Name</label>
        <input type="text" class="form-control" name=clinic id="clinic"
            value="{{ $winner->clinicName }}">

        @error('clinic')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="name">Award</label>
        <input type="text" class="form-control" name=award id="award"
            value="{{ $winner->getAwardName() }}"
        >

        @error('award')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="name">Order</label>
        <input type="number" class="form-control" name=order id="order" value="{{ $winner->order }}">

        @error('order')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
      <label for="">Reason for Nomination</label>
      <textarea class="form-control" name="reason" id="reason" rows="5">{{ $winner->reason }}</textarea>
    </div>


    <button type="submit" class="btn btn-primary">Update</button>
</form>
