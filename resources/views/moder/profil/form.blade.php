@csrf

<div class="form-group">
    <label for="name">Имя</label>
    <input name="name"  id="name" type="text" value="{{ old('name', $user->name) }}" class="@error('name') is-invalid @enderror form-control">

    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="email">E-mail</label>
    <input name="email"  id="email" type="text" value="{{ old('email', $user->email) }}" class="@error('email') is-invalid @enderror form-control">

    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="password">Пароль</label>
    <input name="password"  id="password" type="password" value="{{ old('password') }}" class="@error('password') is-invalid @enderror form-control">

    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="paysystem">Платежная система</label>
    <select name="paysystem"  id="paysystem" class="@error('paysystem') is-invalid @enderror form-control">
        @foreach(App\Models\User::PAY_SYSTEMS as $k => $v)
        <option value="{{$k}}" @if($k == old('paysystem',$user->paysystem)) selected @endif >{{ $v }}</option>
        @endforeach
    </select>
    @error('paysystem')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="payid">№ счета</label>
    <input name="payid"  id="payid" type="text" value="{{ old('payid', $user->payid) }}" class="@error('payid') is-invalid @enderror form-control">

    @error('payid')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>


<div class="form-group">
    <label for="exampleInputFile">Аватар</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" name="avatar" class="custom-file-input" id="exampleInputFile">
            <label class="custom-file-label" for="exampleInputFile">Добавить изображение</label>
        </div>
        @error('avatar')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <!-- <div class="input-group-append">
            <span class="input-group-text">Выбрать</span>
        </div> -->
    </div>
    @if ($user->avatar ?? false)
        <div class="user-form-avatar">                            
            <img src="{{ asset('storage/app/uploads/users/avatars/'.$user->avatar) }}" alt="avatar">
        </div>
    @endif
</div>




