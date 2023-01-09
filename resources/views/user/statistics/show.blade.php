@extends('user.layouts.main')

@section('content')

  <div class="content-wrapper" style="min-height: 313px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h3 class="m-0">Статистика: <b>{{  $company->short_url  ?? ''}}</b></h3>
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
           <form action="{{ route('user.statistics.showStat', $company->id)}}" method="post" id="user">                               
                @csrf          
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
                    <input type="hidden" name="daterange" class="form-control float-right" id="reservationtime" value="{{ $date_from ?? $moment}}/{{  $date_to  ?? $moment}}">
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">                      
                        <span class="daterange_text">{{ $date_from ?? $moment}} / {{  $date_to  ?? $moment}}</span>
                    </div>
                  </div>
                </div>
                <!-- <div class="row"> -->
                  <!-- <div class="col-md-3">
                    <lable>Дата начала:</lable>
                    <input type="text" name="date_from" class="form-control float-right" id="date_from" value="{{ $date_from ?? ''}}">
                  </div>
                  <div class="col-md-3">
                    <lable>Дата окончания:</lable>
                    <input type="text" name="date_to" class="form-control float-right" id="date_to" value="{{  $date_to  ?? ''}}">
                  </div> -->
                  <!-- <div class="col-md-3">
                      <div class="form-group" >  
                      <lable>Sub:</lable>                      
                          <select class="form-control" id="selectboxid1">                          
                                @foreach($sub as $k => $sub_id)
                                  @if($k == old('$subid', $subid)) 
                                    <option value="">{{  $sub_id  ?? '---'}}</option>  
                                  @endif 
                                @endforeach 
                                <option value="">---</option>
                              @foreach($sub as $k => $subid)
                                <option value="{{ $k }} ">{{ $subid }} </option>   
                              @endforeach                                                   
                            <input type='hidden' name="sub" id='sub' value=""/>                          
                          </select>                        
                      </div>
                  </div> -->

                                
                <!-- </div> -->

                <div class="row">
                  <div class="col-md-2">
                    <lable>utm_source:</lable>
                    <!-- <input type="hidden" name="sub" class="" value="sub_id_1"> -->
                    <input type="text" name="utm_source" class="form-control float-right" id="utm_source" value="{{  $utm_source  ?? ''}}">
                  </div>
                  <div class="col-md-2">
                    <lable>utm_campaign:</lable>
                    <!-- <input type="hidden" name="sub" class="" value="sub_id_1"> -->
                    <input type="text" name="utm_campaign" class="form-control float-right" id="utm_campaign" value="{{  $utm_campaign  ?? ''}}">
                  </div>
                  <div class="col-md-2">
                    <lable>utm_content:</lable>
                    <!-- <input type="hidden" name="sub" class="" value="sub_id_1"> -->
                    <input type="text" name="utm_content" class="form-control float-right" id="utm_content" value="{{  $utm_content  ?? ''}}">
                  </div>
                  <div class="col-md-2">
                    <lable>utm_term:</lable>
                    <!-- <input type="hidden" name="sub" class="" value="sub_id_1"> -->
                    <input type="text" name="utm_term" class="form-control float-right" id="utm_term" value="{{  $utm_term  ?? ''}}">
                  </div>
                  <div class="col-md-2">
                    <lable>utm_medium:</lable>
                    <!-- <input type="hidden" name="sub" class="" value="sub_id_1"> -->
                    <input type="text" name="utm_medium" class="form-control float-right" id="utm_medium" value="{{  $utm_medium  ?? ''}}">
                  </div>

                </div>

                <div class="row">
                  
                  <div class="col-md-2">
                    <lable>sub2:</lable>
                    <!-- <input type="hidden" name="sub" class="" value="sub_id_1"> -->
                    <input type="text" name="sub2" class="form-control float-right" id="sub2" value="{{  $sub2  ?? ''}}">
                  </div>
                  <div class="col-md-2">
                    <lable>sub3:</lable>
                    <!-- <input type="hidden" name="sub" class="" value="sub_id_1"> -->
                    <input type="text" name="sub3" class="form-control float-right" id="sub3" value="{{  $sub3  ?? ''}}">
                  </div>
                  <div class="col-md-2">
                    <lable>sub4:</lable>
                    <!-- <input type="hidden" name="sub" class="" value="sub_id_1"> -->
                    <input type="text" name="sub4" class="form-control float-right" id="sub4" value="{{  $sub4  ?? ''}}">
                  </div>
                  <div class="col-md-2">
                    <lable>sub5:</lable>
                    <!-- <input type="hidden" name="sub" class="" value="sub_id_1"> -->
                    <input type="text" name="sub5" class="form-control float-right" id="sub5" value="{{  $sub5  ?? ''}}">
                  </div>

                </div>
                     
                <div class="row mt-3">
                  <div class="col-md-3">
                    <!-- <div>Фильтр</div>  -->
                    <button type="submit"  class="btn btn-primary" >
                      <span class="submit-spinner submit-spinner_hide"></span>
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
                    <th>Sub/Utm</th> 
                    <th>Доход, $</th>   
                    <th></th>
                </tr>
              </thead>
              <tbody>  
                @if($statistik ?? '') 
                  @foreach( $statistik['rows'] as $k => $stat )                       
                    <tr>     
                        <td> {{ date('d-m-Y', strtotime($stat['day'])) }}</td>
                        <td> {{ $stat['clicks'] }} </td> 
                        <td> {{ $stat['campaign_unique_clicks'] }} </td> 
                        <td> {{ $stat['conversions'] }} </td> 
                        <td> {{ $stat['rejected'] }} </td> 
                        <td> {{ $stat['sales'] }} </td> 
                        <td> {{ $stat['approve'] }} </td> 
                        <td> {{ $stat['cr'] }} </td> 
                        @if( isset($stat['sub_id_1']))
                          <td> {{ $stat['sub_id_1'] }} </td>
                        @elseif (isset($stat['sub_id_2']) )
                          <td> {{ $stat['sub_id_2'] }} </td>
                        @elseif (isset($stat['sub_id_3']) )
                          <td> {{ $stat['sub_id_3'] }} </td>
                        @elseif (isset($stat['sub_id_4']) )
                          <td> {{ $stat['sub_id_4'] }} </td>
                        @elseif (isset($stat['sub_id_5']) )
                          <td> {{ $stat['sub_id_5'] }} </td>
                        @elseif (isset($stat['sub_id_6']) )
                          <td> {{ $stat['sub_id_6'] }} </td>
                        @elseif (isset($stat['sub_id_7']) )
                          <td> {{ $stat['sub_id_7'] }} </td>
                        @elseif (isset($stat['sub_id_8']) )
                          <td> {{ $stat['sub_id_8'] }} </td>
                        @elseif (isset($stat['sub_id_9']) )
                          <td> {{ $stat['sub_id_9'] }} </td>
                        @elseif (isset($stat['sub_id_10']) )
                          <td> {{ $stat['sub_id_10'] }} </td>
                        @else
                          <td></td>
                        @endif
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
                    <td></td>
                    <td>{{ $statistik['summary']['sale_revenue']  }} $</td>
                </tr>
               
                @endif
              </tbody>
            </table>
          </div>

        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->   
    
  </div>
            
@endsection

@section('page-js-script')

<style>
  @keyframes spinner-border {
    100% {
      transform: rotate(360deg);
    }
  }

  .submit-spinner {
    display: inline-block;
    width: 1rem;
    height: 1rem;
    vertical-align: -0.125em;
    border: 0.2em solid currentColor;
    border-right-color: transparent;
    border-radius: 50%;
    -webkit-animation: .75s linear infinite spinner-border;
    animation: .75s linear infinite spinner-border;
  }

  .submit-spinner_hide {
    display: none;
  }
</style>

    <style>
        .pagination{margin: 0;}
    </style>
 


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
         
          //Date range as a button
          $('#daterange-btn').daterangepicker(
            {
              ranges   : {
                'Сегодня'       : [moment(), moment()],
                'Вчера'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Последние 7 дней' : [moment().subtract(6, 'days'), moment()],
                'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
                'Этот месяц'  : [moment().startOf('month'), moment().endOf('month')],
                'Предыдущий месяц'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate  : moment()
            },
            function (start, end) {
              // $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
              $('input[name="daterange"]').html(start.format('DD-MM-YYYY') + ' / ' + end.format('DD-MM-YYYY'));
              $('input[name="daterange"]').val(start.format('DD-MM-YYYY') + '/' + end.format('DD-MM-YYYY'));
              $('.daterange_text').html(start.format('DD-MM-YYYY') + ' / ' + end.format('DD-MM-YYYY'));
              $('#reportrange span').html(start.format('DD-MM-YYYY') + ' / ' + end.format('DD-MM-YYYY'))
            }
          )

          // $('#daterange-btn').on('change', function(){ 
          //   console.log($(this).val());
          //   $('.daterange_text').html($(this).val()) 
          // });

          // $('input[name="date_from"]').daterangepicker({
          //       autoclose: true,
          //       singleDatePicker: true,
          //       showDropdowns: true,
          //       language: 'ru',
          //       orientation: 'bottom',
          //        locale: {
          //             format: 'DD-MM-YYYY'
          //           },
          //       // startDate: new Date(),
          //       // endDate: '+1y',
          //       // maxViewMode: 'years',
          //       // startView: 'days',
          //       // viewMode: "years",
          //   });

          //   $('input[name="date_to"]').daterangepicker({
          //       autoclose: true,
          //       singleDatePicker: true,
          //       showDropdowns: true,
          //       language: 'ru',
          //       orientation: 'bottom',
          //       locale: {
          //         format: 'DD-MM-YYYY'
          //       },
          //       // startDate: new Date(),
          //       // endDate: '+1y',
          //       // maxViewMode: 'years',
          //       // startView: 'days',
          //   });
          

          var btns = document.getElementsByClassName('btn-primary');
          var par = document.getElementsByClassName('submit-spinner');
          btns[0].onclick = function() {
            btns[0].classList.add("disabled");
            par[0].classList.remove("submit-spinner_hide");
          }
           
    </script>
@endsection