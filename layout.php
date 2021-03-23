<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="../img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">Heet Kalaria</div>
      </a>
      
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Components
      </div>
      <li class="nav-item">
        <a class="nav-link" href="../dashboard/index.php">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Dashboard</span>
        </a>
      </li>
      
      <!--<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepurchase" aria-expanded="true"
          aria-controls="collapseForm">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Customer</span>
        </a>
        <div id="collapsepurchase" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Customer</h6>
            <a class="collapse-item" href="../list/index.php">Customer List</a>
            <a class="collapse-item" href="../category/index.php">Customer Category</a>
          </div>
        </div>
      </li>-->
      <li class="nav-item">
        <a class="nav-link" href="../list/index.php">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Customer List</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../myemail/index.php">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>My Email</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../templates/index.php">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Email Templates</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="../img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">Heet Kalaria</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../changepassword/index.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../login/logout.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>