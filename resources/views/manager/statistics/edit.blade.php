@extends('user.layouts.main')

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
            <div class="col-md-6">
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

                <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Редактировать Кампанию</h3>
                        </div>
                        <form action="{{ route('user.company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="card-body">
                                @include('user.company.form', ['company' => $company])                    
                            </div>  
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>            
                </div>  
            </div>

            <div class="col-md-6">
                <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Информация о кампании</h3>
                        </div>                        
                        <div class="card-body">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Название</th>
                                        <th>Параметры</th>                                        
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                        <td>ID Кампании</td>  
                                        <td>{{ $company->id }}</td>                                            
                                    </tr>
                                    <tr>    
                                        <td>ID Keytaro</td>  
                                        <td>{{ $company->company_kt }}</td>
                                    </tr>
                                    <tr>
                                        <td>ID User </td>  
                                        <td>{{ $company->user_id }}</td>
                                    </tr>  
                                    <tr>
                                        <td>Имя</td>  
                                        <td>
                                            @foreach($users as $user)
                                            @if ($user->id == $company->user_id)
                                            {{ $user->name }} <br>                              
                                            {{ $user->email }}                               
                                            @endif                                
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr> 
                                        <td>Страна</td>  
                                        <td>{{ $company->geo }}</td>         
                                    </tr>
                                    

                                    
                                </tbody>
                            </table>                 
                        </div>  
                        <div class="card-footer">
                            <table class="table table-hover text-nowrap">
                                <tbody> 
                                <tr><code>
                                    <em class="block-highlight">  
                                        &lt;script&gt; src="{{ $company->short_script }}"&gt;&lt;/script&gt;                                            
                                    </em>
                                </code>  
                                </tr>
                                <tr><code>
                                    <em class="block-highlight">  
                                        &lt;script&gt; src="{{ $company->short_script_2 }}"&gt;&lt;/script&gt;                                            
                                    </em>
                                </code>  
                                </tr>
                            </tbody>
                            </table> 
                        </div>                               
                </div> 
            </div> 
        </div>  
    </section>      
</div>
@endsection
