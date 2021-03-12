<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <!-- Sidebar user (optional) -->
        <a data-toggle="dropdown" href="#" aria-expanded="true" class="nav-link d-block">
          <div class="user-panel d-flex">
            <div class="image">
              <img src="<?=base_url() ?>assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <?=$this->session->userdata('name'); ?>
            </div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
          <a href="<?=site_url('login/logout') ?>" class="dropdown-item">
            Logout
          </a>
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->