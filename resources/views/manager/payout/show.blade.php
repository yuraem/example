@extends('manager.layouts.main')

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

      <div class="card">
        <div class="card-body">
        
            <form action="{{ route('manager.payout.showStat', $user->id)}}" method="post" >                               
                @csrf          
                <input name="user_id"  id="user_id" type="hidden" value="{{ old('user_id', $user->id) }}" class="@error('user_id') is-invalid @enderror form-control">
              
                @php 
                  $moment = Carbon\Carbon::now()->format('d-m-Y');    
                  
                @endphp
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">                      
                        <div class="input-group">                        
                        <button type="button" class="btn btn-default float-right" id="daterange-btn">
                          <i class="far fa-calendar-alt"></i> Выбор диапазона дат
                          <i class="fas fa-caret-down"></i>
                        </button>
                      </div>
                    </div>
                    <input type="hidden" name="period" class="form-control float-right" id="reservationtime" value="{{ $date_from ?? $moment }}/{{  $date_to  ?? $moment }}">
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">                      
                        <span class="daterange_text form-control ">{{ $date_from ?? $moment }} / {{  $date_to  ?? $moment}}</span>
                    </div>
                  </div>

                  <div class="col-md-3">                   
                    <button type="submit"  class="btn btn-primary" >
                      <span class="submit-spinner submit-spinner_hide"></span>
                      Показать статистику                   
                    </button>                 
                  </div>
                </div>      
            </form>


          <form action="{{ route('manager.payout.store') }}" method="POST" enctype="application/json" >
            @csrf  @method('POST') 
                  @include('manager.payout.form', ['user' => $user, 'payouts' => $payouts])                    
                  <!-- <button type="submit" class="btn btn-primary">Сохранить</button> -->
          </form>   
        </div>
      </div>
       
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
                           
            </div>
            <!-- </div> -->
          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover table-bordered text-nowrap">
              <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя/E-mail</th>             
                    <th>Период</th>
                    <th>Сумма</th>
                    <th>Выплачено</th>
                    <th>Дата выплаты</th>    
                </tr>
              </thead>
              <thead>
                <tr>
                    @php 
                      $a = 0;
                      $b = 0;
                    @endphp
                  @foreach($payouts as $payout)
                    @php 
                      $a += $payout->amount;
                      $b += $payout->balance;
                    @endphp                    
                    @endforeach
                    
                    <th>Итого</th>
                    <th></th>                    
                    <th></th>
                    <th>{{ $b }}</th>
                    <th>{{ $a }}</th>
                
                    <th></th>
                </tr>
              </thead>
              <tbody>                               
                  @foreach($payouts as $payout)
                      <tr data-widget="expandable-table" aria-expanded="false">
                          <td>{{ $payout->id }}</td>
                          <td>{{ $user->name }} / {{ $user->email }}</td>
                          <td>{{ $payout->period }}</td>                                        
                          <td>{{ $payout->balance }}</td>                                        
                          <td>{{ $payout->amount }}</td>                                        
                          <td>{{ $payout->created_at }}</td>   
                      </tr>
                      <tr class="expandable-body d-none">
                      <td colspan="6">             
                          <p style="display: none;">
                            Кошелёк: {{ $user->payid }} <br>
                            Валюта: {{ $payout->valute }} <br>
                            Система: {{ $payout->payment_system }} <br>                   
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

<script type="text/javascript">

$('select').on('change', function(){ 
    $('#sub').val($(this).val()) 
});

 //Date range picker with time picker
 $('#daterange-btn').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
      format: 'DD-MM-YYYY'
    }
  })

  // //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      // ranges   : {
      //   'Сегодня'       : [moment(), moment()],
      //   'Вчера'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      //   'Последние 7 дней' : [moment().subtract(6, 'days'), moment()],
      //   'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
      //   'Этот месяц'  : [moment().startOf('month'), moment().endOf('month')],
      //   'Предыдущий месяц'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      // },
      startDate: moment().subtract(29, 'days'),
      // startDate: moment().subtract(1, 'weeks').startOf('isoWeek'),
      endDate  : moment()
      // endDate  : moment().subtract(1, 'weeks').endOf('isoWeek')
    },
    function (start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      $('input[name="period"]').html(start.format('DD-MM-YYYY') + ' / ' + end.format('DD-MM-YYYY'));
      $('input[name="period"]').val(start.format('DD-MM-YYYY') + '/' + end.format('DD-MM-YYYY'));
      $('.daterange_text').html(start.format('DD-MM-YYYY') + ' / ' + end.format('DD-MM-YYYY'));
      $('#reportrange span').html(start.format('DD-MM-YYYY') + ' / ' + end.format('DD-MM-YYYY'))
    }
  )

  
    // $('input[name="date_from"]').daterangepicker({
    //     autoclose: true,
    //     singleDatePicker: true,
    //     showDropdowns: true,
    //     language: 'ru',
    //     orientation: 'bottom',
    //      locale: {
    //           format: 'DD-MM-YYYY'
    //         },
    //     // startDate: new Date(),
    //     // endDate: '+1y',
    //     // maxViewMode: 'years',
    //     // startView: 'days',
    //     // viewMode: "years",
    // });

    // $('input[name="date_to"]').daterangepicker({
    //     autoclose: true,
    //     singleDatePicker: true,
    //     showDropdowns: true,
    //     language: 'ru',
    //     orientation: 'bottom',
    //     locale: {
    //       format: 'DD-MM-YYYY'
    //     },
    //     // startDate: new Date(),
    //     // endDate: '+1y',
    //     // maxViewMode: 'years',
    //     // startView: 'days',
    // });

  
   

    var btns = document.getElementsByClassName('btn-primary');
    var par = document.getElementsByClassName('submit-spinner');
    btns[0].onclick = function() {
      btns[0].classList.add("disabled");
      par[0].classList.remove("submit-spinner_hide");
    }
   
</script>
@endsection