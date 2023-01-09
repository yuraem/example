@csrf

<div class="form-group">
    <label for="company_kt">ID кампании Keytaro</label>
    <input name="company_kt"  id="company_kt" type="text" value="{{ old('company_kt', $company->company_kt) }}" class="@error('company_kt') is-invalid @enderror form-control">
    <input name="company_kt_old"  id="company_kt_old" type="hidden" value="{{ old('company_kt_old', $company->company_kt) }}" class="@error('company_kt_old') is-invalid @enderror form-control">

    @error('company_kt')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="user_id">ID User</label>
    <input name="user_id"  id="user_id" type="text" value="{{ old('user_id', $company->user_id) }}" class="@error('user_id') is-invalid @enderror form-control">

    @error('user_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="geo">Страна, ГЕО</label>
    <input name="geo"  id="geo" type="text" value="{{ old('geo', $company->geo) }}" class="@error('geo') is-invalid @enderror form-control">

    @error('geo')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<!-- <div class="form-group">
    <label for="options">Опции</label>
    <input name="options"  id="options" type="text" value="{{ old('options', $company->options) }}" class="@error('options') is-invalid @enderror form-control">

    @error('options')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div> -->

<!-- <div class="form-group">
    <label for="short_script">URL скрипта 1 в index</label>
    <input name="short_script"  id="short_script" type="text" value="{{ old('short_script', $company->short_script) }}" class="@error('short_script') is-invalid @enderror form-control">

    @error('short_script')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div> -->

<div class="form-group">
    <label for="short_url">Название кампании</label>
    <input name="short_url"  id="short_url" type="text" value="{{ old('short_url', $company->short_url) }}" class="@error('short_url') is-invalid @enderror form-control">

    @error('short_url')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>


<div class="form-group">
    <label for="short_url_2">URL внутри скрипта в index</label>
    <input name="short_url_2"  id="short_url_2" type="text" value="{{ old('short_url_2', $company->short_url_2) }}" class="@error('short_url_2') is-invalid @enderror form-control">

    @error('short_url_2')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="short_script_2">URL скрипта 2 в footer</label>
    <input name="short_script_2"  id="short_script_2" type="text" value="{{ old('short_script_2', $company->short_script_2) }}" class="@error('short_script_2') is-invalid @enderror form-control">

    @error('short_script_2')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>





