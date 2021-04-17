<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="{{ route("admin.dashboard") }}">
          <!-- <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> -->
          <h2>LOGO</h2>
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            @can('dashboard_access')
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard') || request()->is('admin/dashboard/*') ? 'active' : '' }}" href="{{ route("admin.dashboard") }}">
                  <i class="ni ni-tv-2 "></i>
                  <span class="nav-link-text">Dashboard</span>
                </a>
              </li>
            @endcan
            @can('inventories_access')
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/inventories') || request()->is('admin/inventories/*') ? 'active' : '' }}" href="{{ route("admin.inventories.index") }}">
                  <i class="ni ni-bullet-list-67"></i>
                  <span class="nav-link-text">Inventories</span>
                </a>
              </li>
            @endcan
            @can('ordering_access')
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/ordering') || request()->is('admin/ordering/*') ? 'active' : '' }}" href="{{ route("admin.getproducts") }}">
                  <i class="ni ni-cart"></i>
                  <span class="nav-link-text">Ordering</span>
                </a>
              </li>
            @endcan
          </ul>

            @can('sales_report_access')  
              <hr class="my-3">
                <h6 class="navbar-heading p-0 text-muted">
                  <span class="docs-normal">Sales Report</span>
                </h6>
                <ul class="navbar-nav mb-md-3">
                @can('report_access')
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/sales') || request()->is('admin/sales/*') ? 'active' : '' }}" href="{{ route("admin.sales.index") }}">
                    <i class="fas fa-file-invoice-dollar"></i>
                      <span class="nav-link-text">Report</span>
                    </a>
                  </li>
                @endcan
                @can('graph_access')
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/graph') || request()->is('admin/graph/*') ? 'active' : '' }}" href="{{ route("admin.graph") }}">
                    <i class="ni ni-chart-bar-32"></i>
                      <span class="nav-link-text">Graph</span>
                    </a>
                  </li>
                @endcan
                </ul>
            @endcan
            @can('user_management_access')
            <hr class="my-3">
              <h6 class="navbar-heading p-0 text-muted">
                <span class="docs-normal">User Management</span>
              </h6>
                <ul class="navbar-nav mb-md-3">
                @can('permission_access')
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}" href="{{ route("admin.permissions") }}">
                    <i class="text-success ni ni-ui-04"></i>
                      <span class="nav-link-text">Permission</span>
                    </a>
                  </li>
                @endcan
                @can('role_access')
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}" href="{{ route("admin.roles.index") }}">
                    <i class="text-success ni ni-badge"></i>
                      <span class="nav-link-text">Roles</span>
                    </a>
                  </li>
                @endcan
                @can('user_access')
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}" href="{{ route("admin.users.index") }}">
                    <i class="text-success ni ni-circle-08"></i>
                      <span class="nav-link-text">Users</span>
                    </a>
                  </li>
                @endcan
                </ul>
              @endcan

        </div>

      </div>
    </div>
  </nav>