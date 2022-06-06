<div class="alert alert-danger fade show" role="alert" hidden>
    <div class="alert-message"></div>
</div>

<form>
    <input type="hidden" name="id">
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">
            Nama<span class="tx-danger">*</span>
        </label>
        <div class="col-sm-8">
            <input type="text" class="form-control selector-start_date" name="startDate" {{ $readOnly ?? '' }}>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">
            Jadwal Reminder<span class="tx-danger">*</span>
        </label>
        <div class="col-sm-6">
            <input type="text" class="form-control selector-days_of_recurring" name="daysOfRecurring" {{ $readOnly ?? '' }}>   
        </div>
        <div class="col-sm-2 col-form-label">
            <p>days</p>
        </div>
    </div>
</form>