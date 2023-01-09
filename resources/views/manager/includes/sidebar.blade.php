
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('manager.index')}}" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Focs Showcase</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if (Auth::user()->avatar)
            <img src="{{asset('storage/app/uploads/users/avatars/'.Auth::user()->avatar) }}" class="img-circle elevation-2 user-image" alt="User Image">
          @else
              <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2 user-image" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="{{ route('manager.index')}}" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
          <li class="nav-item">
            <a href="{{ route('manager.profil.index')}}" class="nav-link">
            <i class="nav-icon fas fa-user-plus"></i>
              <p>
                Профиль               
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('manager.company.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Коды бэкфикса               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('manager.statistics.index')}}" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Статистика               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('manager.partners.index')}}" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Партнёры               
              </p>
            </a>
          </li>

          <li class="nav-item">
          <a href="{{ route('manager.payout.showBalance', Auth::user()->id ) }}" class="nav-link">
            <i class="nav-icon  fa fa-person"></i>
              <span class="sale_revenue1">{{ Auth::user()->balance }}</span>$
              </a>
          </li>
         

        </ul>
      </nav>
  


    </div>
    <!-- /.sidebar -->
  </aside>