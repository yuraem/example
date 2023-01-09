@extends('user.layouts.main')

@section('content')

  <div class="content-wrapper" style="min-height: 313px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Пользователи</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Главная</a></li>
              <li class="breadcrumb-item active">Новости</li>
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
       
      <div class="card">
        <div class="card-header">
          <!-- <h3 class="card-title">Responsive Hover Table</h3> -->
            <!-- <div class="pull-left"> -->
                  <a href="{{ route('user.user.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Новый пользователь</a>
            <!-- </div> -->
            <!-- <div class="pull-right"> -->
            <div class="card-tools">  
                  <form action="{{ route('user.user.index') }}" method="get">
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
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Кошелёк</th>
                    <th>Роль</th>   
                    <th>E-mail</th>                                    
                    <th></th>
                </tr>
              </thead>
              <tbody>                               
                  @foreach($users as $user)
                      <tr>
                          <td>{{ $user->id }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->payid }}</td>
                          <td>
                              <span class="label label-info">
                                добавить роль                                            
                              </span>                                          
                          </td>
                          <td>{{ $user->email }}</a></td>                                        
                          <td>
                              <a href="{{ route('user.user.edit', $user->id)}}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                              <button
                                  type="button"
                                  class="btn btn-danger btn-xs"
                                  data-toggle="modal"
                                  data-id="{{ $user->id }}"
                                  data-login="{{ $user->login }}"
                                  data-target="#deleteModal">
                                  <i class="fa fa-trash"></i>
                              </button>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
            </table>
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
                            <form action="{{ route('user.user.destroy', 8)}}" method="post" id="deleteform">
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
                $("#deleteform").attr('action', '/user/user/' + $(e.relatedTarget).data('id'));
                $("#fav-title").html($(e.relatedTarget).data('login'));
            });
        });
    </script>
@endsection