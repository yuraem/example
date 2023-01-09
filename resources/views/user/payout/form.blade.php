
<input name="user_id"  id="user_id" type="hidden" value="{{ old('user_id', $user->id) }}" class="@error('user_id') is-invalid @enderror form-control">
<input name="status"  id="status" type="hidden" value="{{ old('status', 1) }}" class="@error('status') is-invalid @enderror form-control">
<input type="hidden" name="period" class="form-control float-right" id="reservationtime" value="{{ $date_from ?? $moment }}/{{  $date_to  ?? $moment }}">


@php 
    if ($statistik && $statistik['summary']['sale_revenue']){
    $amount = $statistik['summary']['sale_revenue'] * 80*100 /10000;    
    }
@endphp

<div class="row">
<div class="col-md-6">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="balance">Баланс</label>
            <input name="balance"  disabled type="integer" value="{{ $statistik['summary']['sale_revenue'] ?? '' }}" class="@error('balance') is-invalid @enderror form-control">
            <input name="balance"  type="hidden" value="{{ $statistik['summary']['sale_revenue'] ?? '' }}" class="@error('balance') is-invalid @enderror form-control">

            @error('balance')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">  
            <label for="amount">На вывод</label>
            <input name="amount"  id="amount" disabled type="integer" value="{{ $amount ?? '' }}" class="@error('amount') is-invalid @enderror form-control">
            <input name="amount"  id="amount" type="hidden" value="{{ $amount ?? '' }}" class="">

            @error('amount')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    
</div>
</div>

<div class="col-md-6">

</div>
</div>
