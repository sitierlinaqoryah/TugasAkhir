<!-- Header -->
<header class="top-head container-fluid navbar-fixed-top" style="background-color: #1ca8dd;">
  <!-- logo -->
  <div class="logo hidden-xs">
    <a href="{BASE_URL}pages/content/home" class="logo-expanded"> <span class="nav-text">SPK-SMART</span></a>
    
  </div>
  <!-- end logo -->
  <button type="button" class="navbar-toggle pull-left">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-toggle ion-navicon-round"></span>
  </button>
  
  <!-- <div class="logo">
    <img src="img/logo.png" alt="" height="45px" width="190px">
    <b style="color:white; font-size: 25px; margin-left: 230px; letter-spacing: .05em;">SPK</b>
  </div> -->


  <!-- Right navbar -->
  <ul class="list-inline navbar-right top-menu top-right-menu">
    <!-- Notification -->
    <!-- <li class="dropdown">
      <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="fa fa-bell-o"></i> <span class="badge badge-sm up bg-pink count">5</span> </a>
      <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5002">
        <li class="noti-header">
          <p>
            Notifications
          </p>
        </li>
        <li>
          <a href="#"> <span class="pull-left"><i class="fa fa-user-plus fa-2x text-info"></i></span> <span>New user add
            <br>
            <small class="text-muted">2 minutes ago</small></span> </a>
        </li>
        <li>
          <a href="#"> <span class="pull-left"><i class="fa fa-diamond fa-2x text-primary"></i></span> <span>Use file add
            <br>
            <small class="text-muted">4 minutes ago</small></span> </a>
        </li>
        <li>
          <a href="#"> <span class="pull-left"><i class="fa fa-bell-o fa-2x text-danger"></i></span> <span>Send project demo files to client
            <br>
            <small class="text-muted">2 hour ago</small></span> </a>
        </li>
        <li>
          <a href="#"> <span class="pull-left"><i class="fa fa-cloud-upload fa-2x text-success"></i></span> <span>Download project
            <br>
            <small class="text-muted">3 hour ago</small></span> </a>
        </li>
        <li>
          <a href="#"> <span class="pull-left"><i class="fa fa-cloud-download fa-2x text-warning"></i></span> <span>Upload projects
            <br>
            <small class="text-muted">5 hour ago</small></span> </a>
        </li>
    
        <li>
          <p class="text-center">
            <a href="#">All notifications</a>
          </p>
        </li>
      </ul>
    </li> -->
    <!-- End Notification -->

    <?php
      $bln = date('m');
      $thn = date('Y');
      $notif = select2("notif","*","WHERE bln='$bln' AND thn='$thn'");

      if($notif!=NULL && ($this->session->userdata('ei_level')=='Admin' || $this->session->userdata('ei_level')=='Kepala Bagian')){
        echo '
        <li class="dropdown">
          <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="fa fa-bell-o"></i> <span class="badge badge-sm up bg-pink count">1</span> </a>
          <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5002">
            <li class="noti-header">
              <p>
                Notifications
              </p>
            </li>
            <li>
              <a href="'.base_url().'pages/content/penilaian/data?thn='.$thn.'"> <span class="pull-left"><i class="fa fa-edit fa-2x text-info"></i></span> <span>'.$notif['ket'].'
                <br>
                <small class="text-muted">Penilaian ('.$thn.')</small></span> </a>
            </li>
            <li>
              <p class="text-center">
                <a href="#"></a>
              </p>
            </li>
          </ul>
        </li>';
      }
      
    ?>

    <!-- User Menu Dropdown -->
    <li class="dropdown text-center">
      {MENU_DD}
      <ul class="dropdown-menu extended pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
        <!-- <li>
          <a href="?pages=profile-edit"><i class="fa fa-briefcase"></i>Profile</a>
        </li> -->
        <li>
          <a href="{BASE_URL}pages/logout"><i class="fa fa-sign-out"></i> Logout</a>
        </li>
      </ul>
    </li>
    <!-- End User Menu Dropdown -->
  </ul>
  <!-- End Right Navbar -->

</header>
<!-- End Header -->