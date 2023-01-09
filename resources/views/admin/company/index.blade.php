@extends('admin.layouts.main')

@section('content')

  <div class="content-wrapper" style="min-height: 313px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Кампании</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Главная</a></li>
              <li class="breadcrumb-item active">Кампании</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      @if (session('success'))
          <div class="box-body">
              <div class="alert alert-info">
                  {{ session('success') }}
              </div>
          </div>
      @endif
       
        <div class="pull-right p-2">
            {{ $companys->appends(request()->except('page'))->links() }}   
        </div>
      
      <div class="card">
        <div class="card-header">
          <!-- <h3 class="card-title">Responsive Hover Table</h3> -->
            <!-- <div class="pull-left"> -->
                  <a href="{{ route('admin.company.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Создать кампанию</a>
            <!-- </div> -->
            <!-- <div class="pull-right"> -->
            <div class="card-tools">  
                  <form action="{{ route('admin.company.index') }}" method="get">
                      <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                          <input type="hidden" name="filter" value="{{ Request::input('filter') }}">
                          <input type="text" name="q" value="{{ Request::input('q')}}" class="form-control pull-right" placeholder="Поиск">
                          <div class="input-group-append">
                              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                          </div>
                      </div>
                  </form>             
            </div>
            <!-- </div> -->
          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                    <th>№</th>
                    <th>ID Keytaro</th>
                    <th>ID User</th>
                    <th>Данные</th>                                 
                    <th>Страна</th>   
                    
                </tr>
              </thead>
              <tbody>                               
                  @foreach($companys as $company)
                      <tr>
                          <td>{{ $company->id }}</td>
                          <td>{{ $company->company_kt }}</td>
                          <td>{{ $company->user_id }}</td>                          
                          <td>
                            @foreach($users as $user)
                              @if ($user->id == $company->user_id)
                               <b>{{ $company->short_url }}</b> |  {{ $user->name }} |  {{ $user->email }}     
                              @endif                                
                            @endforeach
                            <div>В index - <code>
                                  <em class="block-highlight">  
                                      &lt;script src="{{ getenv('APP_URL') }}/analitiks/{{ $company->company_kt }}/index.js"&gt;&lt;/script&gt;                                            
                                  </em>
                                  
                              </code> </div>
                              <div>В спасибо - <code>
                                  <em class="block-highlight">  
                                      &lt;script src="{{ getenv('APP_URL') }}/analitiks/{{ $company->company_kt }}/thanks.js"&gt;&lt;/script&gt;                                            
                                  </em>
                              </code> </div>
                          </td>
                          <td>{{ $company->geo }}</td>                                  
                          <td>
                              <a href="{{ route('admin.company.edit', $company->id)}}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                              <button
                                  type="button"
                                  class="btn btn-danger btn-xs"
                                  data-toggle="modal"
                                  data-id="{{ $company->id }}"
                                  data-login="{{ $company->company_kt }}"
                                  data-target="#deleteModal">
                                  <i class="fa fa-trash"></i>
                              </button>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
            </table>
          </div>


        <div class="card-footer clearfix p-2">
          <div class="pull-right">
           {{ $companys->appends(request()->except('page'))->links() }}   
          </div>
        </div>
        
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->   
    
  </div>

            <div class="modal fade" id="deleteModal"
                 tabindex="-1" role="dialog"
                 aria-labelledby="favoritesModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"
                                    data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                >Вы хотите удалить пользователя?</h4>
                        </div>
                        <div class="modal-body">
                            <p>
                                Вы хотите удалить пользователя <span  id="fav-title"></span>?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('admin.company.destroy', 8)}}" method="post" id="deleteform">
                                @method('DELETE')
                                @csrf
                                <div class="modal-footer no-border">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Нет</button>
                                    <button type="submit" class="btn btn-primary">Да</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('page-js-script')
    <style>
        .pagination{margin: 0;}
    </style>
    <script type="text/javascript">

        $(function () {
            $('#deleteModal').on("show.bs.modal", function (e) {
                $("#deleteform").attr('action', '/admin/company/' + $(e.relatedTarget).data('id'));
                $("#fav-title").html($(e.relatedTarget).data('company_kt'));
            });
        });
    </script>
@endsection