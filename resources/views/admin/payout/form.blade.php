
<input name="user_id"  id="user_id" type="hidden" value="{{ old('user_id', $user->id) }}" class="@error('user_id') is-invalid @enderror form-control">
<input name="status"  id="status" type="hidden" value="{{ old('status', 1) }}" class="@error('status') is-invalid @enderror form-control">
<input type="hidden" name="period" class="form-control float-right" id="reservationtime" value="{{ $date_from ?? $moment }}/{{  $date_to  ?? $moment }}">


@php 
    if ($statistik && $statistik['summary']['sale_revenue']){
    $amount = $statistik['summary']['sale_revenue'] * 80*100 / 10000;
    $income = $statistik['summary']['sale_revenue'] * 20*100 / 10000;
    }
@endphp

<div class="row">
<div class="col-md-6">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="balance">Баланс</label>
            <input name="balance"  id="balance" disabled type="integer" value="{{ $statistik['summary']['sale_revenue'] ?? '' }}" class="@error('balance') is-invalid @enderror form-control">
            <input name="balance"  id="balance" type="hidden" value="{{ $statistik['summary']['sale_revenue'] ?? '' }}" class="@error('balance') is-invalid @enderror form-control">

            @error('balance')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">  
            <label for="amount">Выплатить</label>
            <input name="amount"  id="amount" disabled type="integer" value="{{ $amount ?? '' }}" class="@error('amount') is-invalid @enderror form-control">
            <input name="amount"  id="amount" type="hidden" value="{{ $amount ?? '' }}" class="">

            @error('amount')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">  
            <label for="income">Доход</label>
            <input name="income"  id="income" disabled type="integer" value="{{ $income ?? '' }}" class="@error('amount') is-invalid @enderror form-control">
            <input name="income"  id="income" type="hidden" value="{{ $income ?? '' }}" class="">

            @error('income')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="percent">Процент</label>
            <input name="percent"  id="percent" disabled type="integer" value="{{ old('percent', 20) }}" class="@error('percent') is-invalid @enderror form-control">
            <input name="percent"  id="percent" type="hidden" value="{{ old('percent', 20) }}" class="@error('percent') is-invalid @enderror form-control">

            @error('percent')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="valute">Валюта</label>
            <input name="valute"  id="valute" type="text" value="{{ old('valute', 'USD') }}" class="@error('valute') is-invalid @enderror form-control">

            @error('valute')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="payment_system">Платежная система</label>
            <select name="payment_system"  id="payment_system" class="@error('payment_system') is-invalid @enderror form-control">
                @foreach(App\Models\User::PAY_SYSTEMS as $k => $v)
                <option value="{{$k}}" @if($k == old('payment_system', $user->paysystem)) selected @endif >{{ $v }}</option>
                @endforeach
            </select>
            @error('payment_system')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="walletwallet">Кошелёк</label>
            <input name="wallet"  id="wallet" type="text" value="{{ old('wallet', $user->payid) }}" class="@error('wallet') is-invalid @enderror form-control">

            @error('wallet')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    
</div>
</div>

<div class="col-md-6">
<!-- <div class="row">
<div class="col-md-3"> -->
        <div class="form-group">
            <label for="description">Комментарий</label>
            <textarea id="description"  name="description"  rows="1" class="@error('description') is-invalid @enderror form-control">
                {{ old('description') }}
            </textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    <!-- </div>
    </div> -->
</div>
</div>
