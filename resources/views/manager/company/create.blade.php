@extends('manager.layouts.main')
@section('content')
<div class="content-wrapper" style="min-height: 313px;">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Добавление кампании</h1>
        </div>
       
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            @if ($errors->any())
            <section class="content">
                <div class="row">
                <div class="col-md-12">
                    <div class="box-header alert alert-danger">
                        <strong>Whoops!</strong> Были некоторые проблемы с вашим вводом.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>  
                </div>  
            </section>
            @endif
        
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Новая кампания</h3>
                </div>
                <form action="{{route('manager.company.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        @include('manager.company.form', ['company' => $company])                    
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

