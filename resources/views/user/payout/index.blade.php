@extends('user.layouts.main')

@section('content')

  <div class="content-wrapper" style="min-height: 313px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Выплаты</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Главная</a></li>
              <li class="breadcrumb-item active">Выплаты</li>
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
         <!-- $users->appends(request()->except('page'))->links() }}    -->
      </div>
      
      <div class="card">
        <div class="card-header">
          <!-- <h3 class="card-title">Responsive Hover Table</h3> -->
            <!-- <div class="pull-left"> -->
                
            <!-- </div> -->
            <!-- <div class="pull-right"> -->
            <div class="card-tools">  
                  <form action="{{ route('user.payout.index') }}" method="get">
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

          <div class="card-body table-responsive p-0" style="">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя/E-mail</th>                    
                    <th>Период</th>
                    <th>Сумма</th>
                    <th>Выплачено</th>
                    <th>Заработано</th>
                    <th></th>
                    <th>Дата выплаты</th>  
                </tr>
              </thead>
              <thead>
                <tr>
                    @php 
                      $a = 0;
                      $b = 0;
                      $p = 0;
                    @endphp
                  @foreach($payouts as $payout)
                    @php 
                      $a += $payout->amount;
                      $b += $payout->balance;
                      $p += $payout->income;
                    @endphp                    
                    @endforeach
                    
                    <th>Итого</th>
                    <th></th>                    
                    <th></th>
                    <th>{{ $b }}</th>
                    <th>{{ $a }}</th>
                    <th>{{ $p }}</th>
                    <th></th>
                    <th></th>
                </tr>
              </thead>
              <tbody>                               
                  @foreach($payouts as $payout)
                      <tr data-widget="expandable-table" aria-expanded="false">
                          <td>{{ $payout->user_id }}</td>
                          <td>{{ $payout->user->name }} / {{ $payout->user->email }}</td>                          
                          <td>{{ $payout->period }}</td>                                        
                          <td>{{ $payout->balance }}</td>                                        
                          <td>{{ $payout->amount }}</td>                                        
                          <td>{{ $payout->income }}</td>                                        
                          <td>
                              <button
                                  type="button"
                                  class="btn btn-danger btn-xs"
                                  data-toggle="modal"
                                  data-id="{{ $payout->id }}"
                                  data-login="{{ $payout->period  }}"
                                  data-target="#deleteModal">
                                  <i class="fa fa-trash"></i>
                              </button>
                          </td>
                          <td>{{ $payout->created_at }}</td>
                      </tr>
                      <tr class="expandable-body d-none">
                      <td colspan="5">             
                          <!-- <td class="p-1"> Валюта: {{ $payout->valute }}</td>  
                          <td> Система: {{ $payout->payment_system }}</td>                          
                          <td> Комментарий: {{ $payout->description }}</td>                           -->
                          <p style="display: none;">
                            Кошелёк: {{ $payout->user->payid }} <br>
                            Валюта: {{ $payout->valute }} <br>
                            Система: {{ $payout->payment_system }}    <br>                   
                            Комментарий: {{ $payout->description }}<br>
                          </p>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
              <tfoot>
                <tr>
                    <th></th>
                    <th></th>                    
                    <th>Итого</th>
                    <th>{{ $b }}</th>
                    <th>{{ $a }}</th>
                    <th>{{ $p }}</th>
                    <th></th>
                    <th></th>
                </tr>
              </tfoot>
            </table>
          </div>

        <div class="card-footer clearfix p-2">
          <div class="pull-right">
          {{ $payouts->appends(request()->except('page'))->links() }}   
          </div>
        </div>
        
        </div>

      </div><!--/.container-fluid--> 
    </section>
    <!-- /.content -->   
    
  </div>

  <div class="modal fade" id="deleteModal"
                 tabindex="-1" role="dialog"
                 aria-labelledby="favoritesModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Вы хотите удалить выплату?</h4>
                            <button type="button" class="close"
                                    data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>                            
                        </div>
                        <div class="modal-body">
                            <p>
                                Вы хотите удалить выплату от <span  id="fav-title"></span>?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <form  method="post" id="deleteform">
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
                $("#deleteform").attr('action', '/user/payout/' + $(e.relatedTarget).data('id'));
                $("#fav-title").html($(e.relatedTarget).data('login'));
            });
        });
    </script>
@endsection