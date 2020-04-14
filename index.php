<?php 
    @session_start();
   //error_reporting(0);
    include 'admin/config/connection.php';
  
    if (isset($_SESSION['username'])) {}else{header('Location: login.php');}
    if ($_SESSION['id_user'] == null) {
      echo "<script>alert('Harap login terlebih dahulu');window.location.href=' login.php'</script>";
    }
    if (isset($_GET['logout'])) {
      mysqli_query($con,"UPDATE user set last_activity = null where id_user='".$_SESSION["id_user"]."'");
      session_destroy();
      header('Location: login.php');
    }elseif (isset($_POST['simpan'])) {
    $nama=$_POST['nama'];
    $JK=$_POST['JK'];
    $pob=$_POST['pob'];
    $dob=$_POST['dob'];
    $alamat=$_POST['alamat'];
    $sql = "UPDATE murid set nama_murid='$nama',sex='$JK',dob='$dob',pob='$pob',alamat='$alamat' where id_murid='$_SESSION[id_user]'";
    $query = mysqli_query($con, $sql);
    if ($query) {

      $_SESSION['name']   = $nama;
      $_SESSION['edit-alert'] = 0; 
    } else {
      echo "Error : " . mysqli_error($con);
    }
  }elseif (isset($_POST['foto'])) {
    //if(($_POST['photo'])!=null) {
      
      $a=$_FILES['photo']['name'];

        if (strlen($a)>0) {
            if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
              move_uploaded_file($_FILES['photo']['tmp_name'], "./admin/assets/img/anggota/".$a);
              //$img=",img='".$_POST['photo']."'";
              $img=",img='".$a."'";
            }
          //}
    }else{
      $img="";
    }
    $query="UPDATE murid SET foto = '".$a."' where id_murid='".$_SESSION['id_user']."'";
    $sql=mysqli_query($con,$query);
    if ($sql) {
      $_SESSION['edit-alert'] = 0;
    }else{
      // echo "<script>alert('Pengubahan data gagal!');window.location.href='index.php?p=anggota'</script>";
      echo $query;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" href="admin/assets/images/logo.png">
  <link rel="icon" type="image/png" href="admin/assets/images/logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Remaja Bhakti | Home
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="./assets/font/google.css" />
  <!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" /> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="./assets/css/material-kit.css?v=2.0.7" rel="stylesheet" />  
  <link href="admin/main.css" rel="stylesheet">
  <style type="text/css">
    .input-buat-myBear{
      background: white;
    }

    .file-drop-area {
      position: relative;
      display: flex;
      align-items: center;
      width: 450px;
      max-width: 100%;
      padding: 25px;
      border: 1px dashed #999;
      border-radius: 3px;
      transition: 0.2s;
      &.is-active {
        background-color: rgba(255, 255, 255, 0.05);
      }
    }

    .fake-btn {
      flex-shrink: 0;
      background-color: rgba(255, 255, 255, 0.04);
      border: 1px solid #999;
      border-radius: 3px;
      padding: 8px 15px;
      margin-right: 10px;
      font-size: 12px;
      text-transform: uppercase;
    }
    .file-msg {
      font-size: small;
      font-weight: 300;
      line-height: 1.4;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .file-input {
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 100%;
      cursor: pointer;
      opacity: 0;
      &:focus {
        outline: none;
      }
    }
    .submit{
      width: 450px;
      max-width: 100%;
      padding: 25px;
      border: 1px dashed #999;
      border-radius: 3px;
      transition: 0.2s;
    }  
    .submit:hover{
        background:#aaa;
        transition: 0.4s;
      }

    .excel{
      background: green;
      color: black;
    }
    /*.excel-title,th{
      background: rgb(33, 115, 70);
      color: #fff;
    }*/
    .cells,tr{
      grid-template-columns: 40px repeat(11, calc((100% - 50px) / 11));
      grid-template-rows: repeat(21, 25px);
      grid-gap: 1px;
      background: white;
      grid-auto-flow: dense;
      max-width: 100%;
      overflow: hidden;
      &__spacer {
        background: $gray-dark;
        position: relative;
        &:after {
          content: "";
          position: absolute;
          right: 4px;
          bottom: 4px;
          height: 80%;
          width: 100%;
          background: linear-gradient(
            135deg,
            transparent 30px,
            #bbb 30px,
            #bbb 55px,
            transparent 55px
          );
        }
      }
      /*input, button {
        border: none;
        background: #fff;
        padding: 0 6px;
        font-family: 'Noto Sans', sans-serif;
      }*/
    }
    .cells,tr:hover{
      background: #999;
    }
    .num{
      text-align: right;
    }
  </style>
</head>

<body class="index-page sidebar-collapse">

  <div class="page-header header-filter clear-filter blue-filter" data-parallax="true" style="background-image: url('./assets/img/bg2.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="brand">
            <h1>Remaja Bhakti</h1>
            <h3>Jadwal Latihan dan Turnamen</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="main main-raised">
    <div class="section section-white">
      <?php if ($_SESSION["num"] == 0 ){ ?>

      <div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="material-icons">check</i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="material-icons">clear</i></span>
          </button>
          <b>Selamat Datang, </b> <?php echo $_SESSION["name"]; $_SESSION["num"]++; ?>
        </div>
      </div>
      <?php }elseif ($_SESSION["edit-alert"] == 0 ){ ?>

      <div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="material-icons">check</i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="material-icons">clear</i></span>
          </button>
          <b>Data Berhasil diubah </b> <?php $_SESSION["edit-alert"]++; ?>
        </div>
      </div>
      <?php } ?>
      <div class="container">
        <!--                 nav pills -->
        <div id="navigation-pills">
          <div class="title">
            <h3>Menu untuk <?=$_SESSION["name"]?></h3>
            <!-- <span class="pull-right">
                <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal">
                  <i class="material-icons">library_books</i>
                  Classic
                </button>
              </span> -->
          </div>
          <!-- <div class="title">
            <h3><small>With Icons</small></h3>
          </div> -->
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <ul class="nav nav-pills nav-pills-icons" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" href="#dashboard-1" role="tab" data-toggle="tab">
                    <i class="material-icons">dashboard</i>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#profile" role="tab" data-toggle="tab">
                    <i class="material-icons">person</i>
                    Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#schedule-1" role="tab" data-toggle="tab">
                    <i class="material-icons">calendar_today</i>
                    Kalender
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#tasks-1" role="tab" data-toggle="tab">
                    <i class="material-icons">list</i>
                    Tasks
                  </a>
                </li>
                <li class="nav-item img-raised" style="background: #D52A46;color: white; border-radius: 5px;">
                  <a class="nav-link" href="?logout" style="color: white">
                    <i class="material-icons">exit_to_app</i>
                    Logout
                  </a>
                </li>
              </ul>
              <div class="tab-content tab-space">
                <div class="tab-pane fadein active " id="dashboard-1">
                  <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Hadir Latihan</div>
                                            <div class="widget-subheading"><i class="fa fa-users"></i></div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * from absen where id_murid='".$_SESSION["id_user"]."'"));?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="card mb-3 widget-content bg-arielle-smile">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Partisipasi Turnamen</div>
                                            <div class="widget-subheading"><i class="fa fa-user-secret"></i></div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * from peserta_turnamen where id_murid='".$_SESSION["id_user"]."'"));?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 info">
                            <div class="icon icon-primary">
                              <i class="material-icons">calendar_today</i>
                            </div>
                            <div class="description">
                              <h4 class="info-title">Jadwal Latihan Berikutnya</h4>
                              <?php $calendar=mysqli_query($con,"SELECT * from latihan where tanggal >= '".date('Y-m-d')."' order by tanggal limit 1");
                              if (mysqli_num_rows($calendar) > 0) { $latihan=mysqli_fetch_array($calendar); 
                                $pelatih=mysqli_fetch_array(mysqli_query($con,"SELECT * from pelatih where NIP = '".$latihan['pelatih']."'")); ?>
                                  <table border="0">
                                    <tr>
                                      <td><h5>Materi</h5></td><td>:</td><td><h5 style="color: black;"><?=$latihan['materi']?></h5></td>
                                    </tr>
                                    <tr>
                                      <td><h5>Waktu</h5></td><td>:</td><td><h5 style="color: black;"><?php echo date_format(date_create($latihan['jam']),'H:i');?> - <?php echo date_format(date_create($latihan['tanggal']),'d ').bulan(date_format(date_create($latihan['tanggal']),'m')).date_format(date_create($latihan['tanggal']),' Y ');?></h5></td>
                                    </tr>
                                    <tr>
                                      <td><h5>Pelatih</h5></td><td>:</td><td><h5 style="color: black;"><?=$pelatih['nama_pelatih']?></h5></td>
                                    </tr>
                                  </table>
                               <?php }else{ ?>
                                  <span class="badge badge-pill badge-success">&nbsp;</span>
                               <?php } ?>
                              <a href="#schedule-1" role="tab" data-toggle="tab">Lihat Kalender...</a>
                            </div>
                          </div>
                          <div class="col-md-6 info">
                            <div class="icon icon-warning">
                              <i class="material-icons">emoji_events</i>
                            </div>
                            <div class="description">
                              <h4 class="info-title">Jadwal Turnamen Berikutnya</h4>
                              <?php $turnamen=mysqli_query($con,"SELECT * from turnamen where mulai >= '".date('Y-m-d')."' order by mulai limit 1");
                              if (mysqli_num_rows($turnamen) > 0) { $kompetisi=mysqli_fetch_array($turnamen); 
                                $pelatih=mysqli_fetch_array(mysqli_query($con,"SELECT * from pelatih where NIP = '".$kompetisi['pelatih']."'")); ?>
                                  <table border="0">
                                    <tr>
                                      <td><h5>Tanggal </h5></td><td>:</td><td><h5 style="color: black;"><?php echo date_format(date_create($kompetisi['mulai']),'d ').bulan(date_format(date_create($kompetisi['mulai']),'m')).date_format(date_create($kompetisi['mulai']),' Y ');?> - <?php echo date_format(date_create($kompetisi['selesai']),'d ').bulan(date_format(date_create($kompetisi['selesai']),'m')).date_format(date_create($kompetisi['selesai']),' Y ');?></h5></td>
                                    </tr>
                                    <tr>
                                      <td><h5>Pelatih</h5></td><td>:</td><td><h5 style="color: black;"><?=$pelatih['nama_pelatih']?></h5></td>
                                    </tr>
                                  </table>
                               <?php }else{ ?>
                                  <span class="badge badge-pill badge-success">&nbsp;</span>
                               <?php } ?>
                              <a href="#schedule-1" role="tab" data-toggle="tab">Lihat Kalender...</a>
                            </div>
                          </div>
                        </div>


                </div>
                <div class="tab-pane fade" id="schedule-1">
                    <h3>Jadwal Kegiatan SSB Remaja Bhakti</h3>
                      <div class="main-card mb-3">
                          <div class="card-body">
                              <!-- <div id="calendar-bg-events"></div> -->
                              <div id="calendar-bg"></div>
                          </div>
                      </div>
                </div>
                <div class="tab-pane fade" id="tasks-1">
                  <div class="row">
                          <div class="col-md-6 info">
                            <div class="icon icon-primary">
                              <i class="material-icons">calendar_today</i>
                            </div>
                            <div class="description">
                              <h4 class="info-title">Kehadiran Latihan</h4>
                              <?php 
                              // $calendar=mysqli_query($con,"SELECT * from latihan join absen on latihan.id_latihan=absen.id_latihan where absen.id_murid= '".$_SESSION['id_user']."' order by latihan.tanggal desc");

                              $calendar=mysqli_query($con,"SELECT * from latihan order by latihan.tanggal desc");
                              while($latihan=mysqli_fetch_array($calendar)){ 
                              $absen=mysqli_query($con,"SELECT * from absen where id_latihan='".$latihan['id_latihan']."' and id_murid='".$_SESSION['id_user']."'");
                              $abs=mysqli_fetch_array($absen);
                              if (mysqli_num_rows($absen) > 0) { 
                                $pelatih=mysqli_fetch_array(mysqli_query($con,"SELECT * from pelatih where NIP = '".$latihan['pelatih']."'")); ?>
                                <br>
                                  <span class="badge badge-pill badge-success">&nbsp;</span>
                                  <a tabindex="0" style="color: #111" role="button" data-toggle="popover" data-trigger="focus" title="Hadir" ><span><?php echo date_format(date_create($latihan['jam']),'H:i');?> - <?php echo date_format(date_create($latihan['tanggal']),'d ').bulan(date_format(date_create($latihan['tanggal']),'m')).date_format(date_create($latihan['tanggal']),' Y ');?></span></a>
                                  <br>
                               <?php }else{ ?>
                                <br>
                                  <span class="badge badge-pill badge-danger">&nbsp;</span>
                                  <a tabindex="0" style="color: #999" role="button" data-toggle="popover" data-trigger="focus" title="Tidak Hadir"><span><?php echo date_format(date_create($latihan['jam']),'H:i');?> - <?php echo date_format(date_create($latihan['tanggal']),'d ').bulan(date_format(date_create($latihan['tanggal']),'m')).date_format(date_create($latihan['tanggal']),' Y ');?></span></a>
                                  <br>
                               <?php }} ?>
                            </div>
                          </div>
                          <div class="col-md-6 info">
                            <div class="icon icon-warning">
                              <i class="material-icons">emoji_events</i>
                            </div>
                            <div class="description">
                              <h4 class="info-title">Partisipasi Turnamen</h4>
                              <?php $turnamen=mysqli_query($con,"SELECT * from turnamen order by mulai desc");
                              while($kompetisi=mysqli_fetch_array($turnamen)){ 
                              $kontingen=mysqli_query($con,"SELECT * from peserta_turnamen where id_turnamen='".$kompetisi['id_turnamen']."' and id_murid='".$_SESSION['id_user']."'");
                              if (mysqli_num_rows($kontingen) > 0) { 

                                 ?>
                                 <br>
                                  <a tabindex="0" class="mt-3" style="color: #333;margin: 10px;" role="button" data-toggle="popover" data-trigger="focus" title="Kontingen">
                                  <span class="badge badge-pill badge-success">&nbsp;</span>
                                  <?=$kompetisi['nama_turnamen']?> (
                                  <?php echo date_format(date_create($kompetisi['mulai']),'d ').bulan(date_format(date_create($kompetisi['mulai']),'m')).date_format(date_create($kompetisi['mulai']),' Y ');?> - <?php echo date_format(date_create($kompetisi['selesai']),'d ').bulan(date_format(date_create($kompetisi['selesai']),'m')).date_format(date_create($kompetisi['selesai']),' Y ');?> )
                                  </a><br>
                               <?php }else{ ?>
                                <br>
                                  <a tabindex="0" class="mt-3" style="color: #999;margin: 10px;" role="button" data-toggle="popover" data-trigger="focus" title="Tidak Berpartisipasi">
                                  <span class="badge badge-pill badge-danger">&nbsp;</span>
                                  <?=$kompetisi['nama_turnamen']?> (
                                  <?php echo date_format(date_create($kompetisi['mulai']),'d ').bulan(date_format(date_create($kompetisi['mulai']),'m')).date_format(date_create($kompetisi['mulai']),' Y ');?> - <?php echo date_format(date_create($kompetisi['selesai']),'d ').bulan(date_format(date_create($kompetisi['selesai']),'m')).date_format(date_create($kompetisi['selesai']),' Y ');?> )
                                  </a><br>
                               <?php }} ?>
                            </div>
                          </div>
                        </div>
                </div>

                <div class="tab-pane fade" id="profile">
                  <?php 
                  $ed=mysqli_query($con,"SELECT * from murid where id_murid='".$_SESSION["id_user"]."'");
                  $edit=mysqli_fetch_array($ed);
                   ?>

                        <span class="pull-right">
                          <button class="btn btn-block btn-warning" data-toggle="modal" data-target="#myModal">
                            <i class="material-icons">edit</i>
                            Ubah Profil
                          </button>
                        </span>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="ml-auto">
                        <center>
                        <h4><?=$edit['nama_murid']?></h4>
                        <a class="" data-toggle="modal" data-target="#foto">
                          <img height="300px" width="300px" style="border-radius: 5px;" src="./admin/assets/img/anggota/<?=$edit['foto']?>" alt="Thumbnail Image" class="img-raised  img-fluid">
                        </a>
                            <!-- <a tabindex="0" class="btn btn-lg btn-danger" role="button" data-toggle="popover" data-trigger="focus" title="Dismissible popover" data-content="And here's some amazing content. It's very engaging. Right?">Dismissible popover</a> -->
                        </center>
                      </div>
                    </div>
                    <div class="col-lg-5">
                      <br>
                      <div class="form-group">
                        <label>Tempat, Tanggal Lahir</label>
                        <input type="text" readonly class="input-buat-myBear form-control" value="<?= $edit['pob'] ?>,  <?php echo date_format(date_create($edit['dob']),'d ').bulan(date_format(date_create($edit['dob']),'m')).date_format(date_create($edit['dob']),' Y ');?>">
                      </div>
                      <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" readonly class="input-buat-myBear form-control" value="<?=$edit['sex']?>">
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" readonly class="input-buat-myBear form-control" value="<?=$edit['alamat']?>">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="tab-pane" id="tasks-1">
                  Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas.
                  <br><br>Dynamically innovate resource-leveling customer service for state of the art customer service.
                </div> -->
              </div>
            </div>
          </div>
        </div>
        <!--                 end nav pills -->
      </div>
    </div>


  </div>


  <!-- Classic Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Ubah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="material-icons">clear</i>
          </button>
        </div>

      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
              <label for="exampleInputEmail1">Nama murid</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="<?=$edit['nama_murid']?>" placeholder="Masukan Nama murid" name="nama" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Kelamin</label>
              <select class="form-control custom-select" name="JK">
                <option disabled selected>-- Masukan Gender --</option>
                <option value="Laki-Laki" <?php if ($edit['sex']=='Laki-Laki') {echo "selected"; }else{}?>>Laki-Laki</option>
                <option value="Perempuan" <?php if ($edit['sex']=='Perempuan') {echo "selected"; }else{}?>>Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tempat Lahir</label>
               <input type="text" class="form-control" id="exampleInputEmail1" value="<?=$edit['pob']?>" placeholder="Masukan Tempat Lahir" name="pob" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tanggal Lahir</label>
               <input type="date" class="form-control" id="exampleInputEmail1" value="<?=$edit['dob']?>" placeholder="Masukan Tanggal Lahir" name="dob" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Alamat</label>
               <textarea class="form-control" name="alamat"  required><?=$edit['alamat']?></textarea>
            </div>
            <!-- <div class="form-group">
              <div class="row">
                <div class="col-md-10">
                  <label for="exampleInputEmail1">Pas Foto <span style="color: red">* ukuran file maximum 1MB</span><small class="text-danger"> *)</small></label>
                  <input type="file" accept="image/*" name="photo" class="form-control inputFileVisible">
                  <small class="text-danger">*) Kosongkan jika tidak ingin diubah</small>
                </div>
                <div class="col-md-2">
                  <label for="exampleInputEmail1">Sebelumnya</label>
                  <img width="100%" alt="<?=$edit['foto']?>" title="<?=$edit['foto']?>" src="./admin/assets/img/anggota/<?=$edit['foto']?>">
                </div>
              </div>
            </div> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  <!--  End Modal -->
<!-- Classic Modal -->
  <div class="modal fade" id="foto" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Preview Foto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="material-icons">clear</i>
          </button>
        </div>

        <div class="modal-body">
          <center><img height="400px" width="400px" style="border-radius: 5px;" src="./admin/assets/img/anggota/<?=$edit['foto']?>" alt="Thumbnail Image" class="img-raised m-auto img-fluid"></center>
          <br>
        </div>
        <hr>
        <div class="modal-footer">
          <form role="form" method="post"  enctype="multipart/form-data">
              <div class="">
                <h6>Form Ubah Foto <small class="text-danger">*) Abaikan jika tidak ingin diubah</small></h6>
                  <div class="row">
                    <div class="col-md-10">
                      <label for="exampleInputEmail1">Pas Foto <span style="color: red">* ukuran file maximum 1MB</span><small class="text-danger"> *)</small></label>
                      <!-- <input type="file" accept="image/*" name="photo" class="form-control-file"> -->
                      <div class="file-drop-area">
                          <span class="fake-btn">Pilih file</span>
                          <span class="file-msg">atau seret kesini</span>
                          <input class="file-input" type="file" name="photo" accept="images/*" multiple required>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="pull-right">
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="foto">Simpan</button>
                </div>
          </form>
        </div>
      
      </div>
    </div>
  </div>
  <!--  End Modal -->

  <footer class="footer" data-background-color="black">
    <div class="container">
      <!-- <div class="float-left">asd</div> -->
      <div class="copyright float-right">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>, made with <i class="material-icons">favorite</i> by
        <a href="https://github.com/pottsed">Pottsed</a> for a lover.
      </div>
    </div>
  </footer>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="./assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
  <script type="text/javascript">
    $('.popover-dismiss').popover({
      trigger: 'focus'
    })
  </script>
  <?php include './assets/js/main.php'; ?>
  <script>
    $(document).ready(function() {
      //init DateTimePickers
      materialKit.initFormExtendedDatetimepickers();

      // Sliders Init
      materialKit.initSliders();
    });


    function scrollToDownload() {
      if ($('.section-download').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-download').offset().top
        }, 1000);
      }
    }


    var $fileInput = $('.file-input');
    var $droparea = $('.file-drop-area');

    // highlight drag area
    $fileInput.on('dragenter focus click', function() {
      $droparea.addClass('is-active');
    });

    // back to normal state
    $fileInput.on('dragleave blur drop', function() {
      $droparea.removeClass('is-active');
    });

    // change inner text
    $fileInput.on('change', function() {
      var filesCount = $(this)[0].files.length;
      var $textContainer = $(this).prev();

      if (filesCount === 1) {
        // if single file is selected, show file name
        var fileName = $(this).val().split('\\').pop();
        $textContainer.text(fileName);
      } else {
        // otherwise show number of files
        $textContainer.text(filesCount + ' files selected');
      }
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
