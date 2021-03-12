<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-custom elevation-4">
    <!-- Brand Logo -->
   <style>
     ul.nav-sidebar a{
       color: rgba(255,255,255,0.6) !important;
     }
     ul.nav-sidebar .active{
       background-color: #cc4646 !important;
       color: white !important;
     }

     ul.nav-treeview {
       padding-left: 1em !important;
     }

     ul.nav-treeview .active{
       background-color: #cc4646 !important;
       color: white !important;
     }

     .nav-child .nav-link > p{
       padding-left: 16px;
     }

     ul.nav-sidebar a:hover{
       background-color: #cc4646 !important;
       color: white !important;
     }
     
   </style>

    <nav class="navbar navbar-default">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">
            <span class="brand-logo"><img src="<?=base_url() ?>assets/img/icon.png"/></span>
            <span class="brand-title">Apakabar</span>
        </a>
    </div>
    </nav>
    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2 nav-collapse-hide-child">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php
          $menus = $this->db->query("SELECT * FROM menu WHERE parent = '0' AND status = '1' AND type = 'page'")->result();
          ?>
          <?php foreach($menus as $m) {

            
          $url = ($m->url != '') ? $m->url : '#' ;
          //$cekMenu = $this->db->get_where('user_role', ['user_di' => $this->session->userdata('id_user'), 'menu_id' => $m->id_menu])->row();
          ?>
            <?php if($this->session->userdata('tipe_user') == 'super-admin') { ?>
            <li class="nav-item">
              <a href="<?=site_url($url) ?>" class="nav-link">
                <i class="nav-icon <?=$m->icon ?>"></i>
                <p>
                  <?= $m->menu_name ?>
                </p>
              </a>

            </li>
              <?php } else { ?>
                <?php if($m->level != $this->session->userdata('tipe_user')){ ?>
                  <li class="nav-item">
                    <a href="<?=site_url($url) ?>" class="nav-link">
                      <i class="nav-icon <?=$m->icon ?>"></i>
                      <p>
                        <?= $m->menu_name ?>
                      </p>
                    </a>

                  </li>
                <?php } ?>
              <?php } ?>
            <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- script to change the selected active nav-link -->

<script>
$(function () {
    var url = window.location;
    // for single sidebar menu
    $('ul.nav-sidebar a').filter(function () {
        return this.href == url;
    }).addClass('active');

    // for sidebar menu and treeview
    $('ul.nav-treeview a').filter(function () {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview")
        .css({'display': 'block'})
        .addClass('menu-open').prev('a')
        .addClass('active');
});
</script>