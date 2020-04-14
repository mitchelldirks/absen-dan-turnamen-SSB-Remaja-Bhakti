<?php 
    @session_start();
  //error_reporting(0);
    include 'config/connection.php';
  
    if (isset($_SESSION['username'])) {}else{header('Location:../login.php');}
    if ($_SESSION['id_user'] == null) {
    echo "<script>alert('Harap login terlebih dahulu');window.location.href='../login.php'</script>";
    }
    if (isset($_GET['logout'])) {
    mysqli_query($con,"UPDATE user set last_activity = null where id_user='".$_SESSION["id_user"]."'");
    session_destroy();
    header('Location: ../login.php');
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $_SESSION['name']; ?> | Admin Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">

    <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="main.css" rel="stylesheet">

</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <!-- <div class="logo-src"><h5 style="border-bottom: 1px solid blue;color: #666;"><b>REMAJA BHAKTI</b></h5></div> -->
                <div class=""><h5 style="border-bottom: 1px solid blue;color: #3F6AD8;"><b>REMAJA BHAKTI</b></h5></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <!-- <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav"> -->
                        <!-- <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span> -->
                        <img src="assets/images/logo.png" style="width: 50px">
                    <!-- </button> -->
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    
            <div class="app-header__content">
                <div class="app-header-left">
                    <!-- <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div> -->
                    <!-- <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-database"> </i>
                                Statistics
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Projects
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>
                    </ul>   -->      
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <?php if (isset($_SESSION['img'])) { ?>
                                            <img width="42px" class="rounded-circle" alt="<?=$_SESSION['img']?>" src="assets/img/anggota/<?=$_SESSION['img']?>">
                                            <?php }else{ ?>
                                              <i class="metismenu-icon pe-7s-user" style="font-size: 24px;"></i>
                                            <?php } ?>
                                            <!-- <?=$_SESSION['name']?> -->
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <!-- <button type="button" tabindex="0" class="dropdown-item">User Account</button> -->
                                            <!-- <button type="button" tabindex="0" class="dropdown-item">Settings</button> -->
                                            <h6 tabindex="-1" class="dropdown-header">Actions</h6>
                                            <a class="dropdown-item" href="?p=change" tabindex="0">Change Password </a>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <!-- <button type="button" tabindex="0" class="dropdown-item">Dividers</button> -->
                                            <a class="dropdown-item" href="?logout" tabindex="0" style="color: red;"><i class="fa fa-circle-o text-red"></i> Logout </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?=$_SESSION['name']?>
                                    </div>
                                    <div class="widget-subheading">
                                        <?=$_SESSION['level']?>
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>        
        <?php include 'settings.html'; ?>
        <div class="app-main">
        <?php include 'sidebar.php'; ?> 
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="col-lg-12" style="background: white;padding: 30px;border-radius: 20px;">

                        <?php 

          $page = @$_GET['p'];
          $action = @$_GET['act'];

          switch ($page) {
            case 'user':
              if ($action == "create") {
                include 'page/user/create.php';
              } else if ($action == "edit") {
                include 'page/user/edit.php';
              } else {
                include 'page/user/index.php';
              }
              break;

            case 'pelatih':
              if ($action == "create") {
                include 'page/pelatih/create.php';
              }else if ($action == "edit") {
                include 'page/pelatih/edit.php';
              }else if ($action == "upload") {
                include 'page/pelatih/upload.php';
              } else {
                include 'page/pelatih/index.php';
              }
              break;

            case 'murid':
              if ($action == "create") {
                include 'page/murid/create.php';
              }else if ($action == "edit") {
                include 'page/murid/edit.php';
              }else if ($action == "upload") {
                include 'page/murid/upload.php';
              } else {
                include 'page/murid/index.php';
              }
              break;
            case 'filter':
              include 'filter.php';
              break;

            case 'absen':
              if ($action == "create") {
                include 'page/absen/create.php';
              }else if ($action == "input") {
                include 'page/absen/absensi.php';
              }else if ($action == "proses") {
                include 'page/absen/absenin.php';
              }else if ($action == "view") {
                include 'page/absen/absence_preview.php';
              }else{
                include 'page/absen/index.php';
              }
              break;

              case 'latihan':
              if ($action == "create") {
                include 'page/latihan/create.php';
              }else if ($action == "edit") {
                include 'page/latihan/edit.php';
              }else{
                include 'page/latihan/index.php';
              }
              break;

              case 'agenda':
                include 'agenda.php';
              
              break;

              case 'turnamen':
              if ($action == "create") {
                include 'page/turnamen/create.php';
              }else if ($action == "edit") {
                include 'page/turnamen/edit.php';
              }else if ($action == "input") {
                include 'page/turnamen/input.php';
              }else{
                include 'page/turnamen/index.php';
              }
              break;

              case 'change':
                include 'changepass.php';
              break;

              default:
                include 'page/dashboard.php';
              break;
            
          }

         ?>

                        
                        
                       
                        
                            </div>
                        </div>
                    <?php  include 'footer.php'; ?>   
                </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>

<!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- <script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script> -->

<script type="text/javascript" src="./assets/scripts/main.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
  <?php
function bulan($bln)
{
  if($bln == 1){
      $bulan1="Januari";
    }elseif($bln == 2){
      $bulan1="Februari";
    }elseif($bln == 3){
      $bulan1="Maret";
    }elseif($bln == 4){
      $bulan1="April";
    }elseif($bln == 5){
      $bulan1="Mei";
    }elseif($bln == 6){
      $bulan1="Juni";
    }elseif($bln == 7){
      $bulan1="Juli";
    }elseif($bln == 8){
      $bulan1="Agustus";
    }elseif($bln == 9){
      $bulan1="September";
    }elseif($bln == 10){
      $bulan1="Oktober";
    }elseif($bln == 11){
      $bulan1="November";
    }elseif($bln == 12){
      $bulan1="Desember";
  }
  return $bulan1;
}
?>
</body>
</html>
