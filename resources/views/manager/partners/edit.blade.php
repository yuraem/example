@extends('manager.layouts.main')

@section('content')
<div class="content-wrapper" style="min-height: 313px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Редактирование пользователя</h1>
            </div>
        
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="col-md-6">
                <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Новый пользователь</h3>
                        </div>
                        <form action="{{ route('manager.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="card-body">
                                @include('manager.user.form', ['user' => $user])                    
                            </div>  
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>            
                </div>  
            </div>
        </div>  
    </section>      
</div>
@endsection
