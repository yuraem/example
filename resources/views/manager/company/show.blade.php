@extends('manager.layouts.main')

@section('content')

  <div class="content-wrapper" style="min-height: 313px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Статистика Кампании</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Главная</a></li>
              <li class="breadcrumb-item active">Статистика Кампании</li>
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
           <form action="{{ route('manager.company.showStat', $company->id)}}" method="post" >                               
                @csrf          
                
                <!-- <div class="form-group">
                  
                    <div class="input-group">
                    
                    <button type="button" class="btn btn-default float-right" id="daterange-btn">
                      <i class="far fa-calendar-alt"></i> Выбор диапазона дат
                      <i class="fas fa-caret-down"></i>
                    </button>
                  </div>
                </div> -->
                <!-- <input type="text" name="daterange" class="form-control float-right" id="reservationtime"> -->
                
                <div class="row">
                  <div class="col-md-4">
                    <lable>Дата начала:</lable>
                    <input type="text" name="date_from" class="form-control float-right" id="date_from">
                  </div>
                  <div class="col-md-4">
                    <lable>Дата окончания:</lable>
                    <input type="text" name="date_to" class="form-control float-right" id="date_to">
                  </div>
                  <div class="col-md-4">
                    <div>После нажатия, подождите 5 - 10 секунд! </div> 
                    <button type="submit" class="btn btn-primary" >
                    <i class="fas fa fa-sync-alt "></i>
                      Показать статистику                   
                    </button>                 
                  </div>                
                </div>
                     
               
                          
            </form>
          </div>

        

       

          <div class="card-body table-responsive p-0" >
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                    <th>№</th>
                    <th>Клики</th>                    
                    <th>Уникальные клики</th>                                 
                    <th>Конверсия</th>   
                    <th>Отклонённые</th>   
                    <th>Продажи</th>   
                    <th>% Аппрув</th>   
                    <th>CR</th>   
                    <th>Доход, $</th>   
                    <th></th>
                </tr>
              </thead>
              <tbody>  
                @if($statistik ?? '') 
                  @foreach( $statistik['rows'] as $k => $stat )                       
                      <tr>     
                        <td> {{ $stat['datetime'] }}</td>
                        <td> {{ $stat['clicks'] }} </td> 
                        <td> {{ $stat['campaign_unique_clicks'] }} </td> 
                        <td> {{ $stat['conversions'] }} </td> 
                        <td> {{ $stat['rejected'] }} </td> 
                        <td> {{ $stat['sales'] }} </td> 
                        <td> {{ $stat['approve'] }} </td> 
                        <td> {{ $stat['cr'] }} </td> 
                        <td> {{ $stat['sale_revenue'] }} $</td> 
                      </tr>
                  @endforeach
                <tr>  
                    <td><b>Итого</b></td>
                    <td>{{ $statistik['summary']['clicks']  }}</td>
                    <td>{{ $statistik['summary']['campaign_unique_clicks']  }}</td>
                    <td>{{ $statistik['summary']['conversions']  }}</td>
                    <td>{{ $statistik['summary']['rejected']  }}</td>
                    <td>{{ $statistik['summary']['sales']  }}</td>
                    <td>{{ $statistik['summary']['approve']  }}</td>
                    <td>{{ $statistik['summary']['cr']  }}</td>
                    <td>{{ $statistik['summary']['sale_revenue']  }} $</td>
                </tr>
                <!-- "rows" => array:1 [▼
                    0 => array:7 [▼
                    "clicks" => 6
                    "campaign_unique_clicks" => 4
                    "conversions" => 5
                    "revenue" => 0
                    "rejected" => 0
                    "sales" => 0
                    "cr" => 83.333333
                    ]
                ]
                "summary" => array:7 [▼
                    "clicks" => 6
                    "campaign_unique_clicks" => 4
                    "conversions" => 5
                    "revenue" => 0
                    "rejected" => 0
                    "sales" => 0
                    "cr" => 83.333333
                ]
                "total" => 1
                "meta" => array:3 [▼
                    "body" => 2
                    "summary" => 2
                    "count" => 2
                ]

                 -->
                @endif
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
                            <form action="{{ route('manager.company.destroy', 8)}}" method="post" id="deleteform">
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
                $("#deleteform").attr('action', '/manager/company/' + $(e.relatedTarget).data('id'));
                $("#fav-title").html($(e.relatedTarget).data('company_kt'));
            });
        });

        $('#reservation').daterangepicker()
          //Date range picker with time picker
          $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
              format: 'YYYY-MM-DD'
            }
          })
          $('#from1').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
                      
            locale: {
              startDate: 'YYYY-MM-DD',  
            }
          })
          $('#to1').daterangepicker({
            timePicker: false,
            timePickerIncrement: 30,
            endDate: 'YYYY-MM-DD',
            // locale: {
            //   format: 'YYYY-MM-DD'
            // }
          })
          //Date range as a button
          $('#daterange-btn').daterangepicker(
            {
              ranges   : {
                'Сегодня'       : [moment(), moment()],
                'Вчера'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Последние 7 дней' : [moment().subtract(6, 'days'), moment()],
                'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
                'Этот месяц'  : [moment().startOf('month'), moment().endOf('month')],
                'Последний месяц'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate  : moment()
            },
            function (start, end) {
              // $('input[name="daterange"]').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
              $('input[name="date_from"]').html(start.format('MMMM D, YYYY'));
              $('input[name="date_to"]').html(end.format('MMMM D, YYYY'));
              // $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
          )

          // $('input[name="daterange"]').daterangepicker();

          $('input[name="date_from"]').daterangepicker({
                autoclose: true,
                singleDatePicker: true,
                showDropdowns: true,
                language: 'ru',
                // orientation: 'bottom',
                // format: 'yyyy-mm-dd',
                // startDate: new Date(),
                // endDate: '+1y',
                // maxViewMode: 'years',
                // startView: 'days',
            })
            $('input[name="date_to"]').daterangepicker({
                autoclose: true,
                singleDatePicker: true,
                showDropdowns: true,
                language: 'ru',
                // orientation: 'bottom',
                // format: 'yyyy-mm-dd',
                // startDate: new Date(),
                // endDate: '+1y',
                // maxViewMode: 'years',
                // startView: 'days',
            })
    </script>
@endsection