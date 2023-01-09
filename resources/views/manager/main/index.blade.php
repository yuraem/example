@extends('manager.layouts.main')

@section('content')

<div class="content-wrapper" style="min-height: 313px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Менеджер</h1>
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
       
      <input name="sale_revenue_balance"  id="sale_revenue_balance" type="hidden" value="{{ $sale_revenue_balance ?? '' }}" class="@error('sale_revenue_balance') is-invalid @enderror form-control">

        <div class="row">
            <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
            <div class="inner">
            <h3 >{{ $user->balance}}</h3>
            <p>Баланс</p>
            </div>
            <div class="icon">
            <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="{{ route('manager.payout.showBalance', Auth::user()->id ) }}" class="small-box-footer">
            Обновить баланс <i class="fas fa-arrow-circle-right"></i>
            </a>
            </div>
            </div>

        </div>


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection

@section('page-js-script')   
    <script type="text/javascript">

        $(document).ready(function() {

          let $sale_revenue = $('#sale_revenue_balance').val();

          localStorage.setItem('manager_balance', $sale_revenue);
     
        });

    </script>
@endsection