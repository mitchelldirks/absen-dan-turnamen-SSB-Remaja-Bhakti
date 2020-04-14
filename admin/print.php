<?php 

    @session_start();
    include 'config/connection.php';
    // if ($_GET['p']=='murid') {
    //   $thead='<tr><th>Nama murid</th><th>Jenis Kelamin</th><th>TTL</th><th>Alamat</th></tr>';
    //   $sql="SELECT * from murid order by nama_murid";
    //   $row='<tr><td>'.$row['nama_murid'].'</td><td>'.$row['sex'].'</td><td>'.$row['pob'].', '.$row['dob'].'</td><td>'.$row['alamat'].'</td></tr>';

    // }
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
	<title><?=$_GET["p"]?></title>
    <link href="main.css" rel="stylesheet">
    <style type="text/css">
    	h3{
    		font-family: sans-serif;
    	}
    </style>
</head>
<body>
	<div class="col-lg-12" style="padding: 10px;border-bottom: 1px solid #333;">
			<div class="kop row" >
				<div class="col-xs-2">
					<img src="assets/images/logo.png" style="width: 200px;margin-bottom: -80px;">
				</div>
				<div class="col-xs-10" style="margin-left: 0;margin-top: 50px;">
					<h3 style="color: #111;"><b>SSB REMAJA BHAKTI</b></h3>
					<h6 style="margin-top: -10px;margin-left: 3px;">Lap. Citra Sima, Cipinang Lontar<br>
						Facebook: RemajaBhaktiFC<br>
						Telp. 081287214814<br>
					</h6>
				</div>
				
			</div>
	</div>
	<div class="col-xs-11" style="margin: 30px;">
		<div class="box-body">
			 <?php if ($_GET['p']=='murid'){ ?>
         <h3 style="padding: 10px;"><center>Daftar Murid SSB Remaja Bhakti</center></h3>
          <table id="example1" class="table table-bordered table-striped ">
            <thead>
            <tr>
              <th>Nama murid</th>
              <th>Jenis Kelamin</th>
              <th>TTL</th>
              <th>Alamat</th>
            </tr>
            </thead>
            <tbody>
              <?php 
                $sql = "SELECT * from murid order by nama_murid";
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($query)):

               ?>
               <tr>
                <td><?= $row['nama_murid'] ?></td>
                <td><?= $row['sex'] ?></td>
                <td><?= $row['pob'] ?>, <?= $row['dob'] ?></td>
                <td><?= $row['alamat'] ?></td>
               </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
      <?php }elseif ($_GET['p']=='turnamen'){
        $data=mysqli_fetch_array(mysqli_query($con,"SELECT * from turnamen where id_turnamen='".$_GET["kode"]."'"));
       ?>
         <h3 style="padding: 10px;"><center>Daftar Pemain untuk <?=$data['nama_turnamen']?></center></h3>
          <table id="example1" class="table table-bordered table-striped ">
            <thead>
            <tr>
              <th>Nama murid</th>
              <th>Jenis Kelamin</th>
              <th>TTL</th>
              <th>Alamat</th>
            </tr>
            </thead>
            <tbody>
              <?php 
                $sql = "SELECT * from peserta_turnamen where id_turnamen='".$data["id_turnamen"]."'";
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($query)):
                  $murid=mysqli_fetch_array(mysqli_query($con,"SELECT * from murid where id_murid='".$row["id_murid"]."'"));

               ?>
               <tr>
                <td><?= $murid['nama_murid'] ?></td>
                <td><?= $murid['sex'] ?></td>
                <td><?= $murid['pob'] ?>, <?= $murid['dob'] ?></td>
                <td><?= $murid['alamat'] ?></td>
               </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
      <?php }elseif($_GET['p']=='absen'){ ?>
          <h3 style="padding: 10px;"><center>Data absen SSB Remaja Bhakti<br><small><?php if (isset($_GET['bulan'])) {echo "Bulan ".bulan($_GET['bulan']). "  ".$_GET['tahun'];}else{echo "Data Keseluruhan";} ?></small></center></h3>
          <table id="example1" class="table table-bordered table-striped ">
            <thead>
            <tr>
              <th>Tanggal</th>
              <th>Materi</th>
              <th>Pelatih</th>
              <th>Pukul</th>
              <th>Nama murid</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>
              <?php 
          if (isset($_GET['bulan'])) { 
                $sql = "SELECT *,absen.status from absen join latihan on latihan.id_latihan=absen.id_latihan where latihan.tanggal like '".$_GET['tahun']."-".$_GET['bulan']."%' order by latihan.tanggal desc";
          }else{
             $sql = "SELECT *,absen.status from absen join latihan on latihan.id_latihan=absen.id_latihan order by latihan.tanggal desc";
          }
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($query)):
                  $murid=mysqli_fetch_array(mysqli_query($con,"SELECT * from murid where id_murid='".$row['id_murid']."'"));
                  $pelatih=mysqli_fetch_array(mysqli_query($con,"SELECT * from pelatih where NIP='".$row['pelatih']."'"));
               ?>
               <tr>
                <td><?= $row['tanggal'] ?></td>
                <td><?= $row['nama_latihan'] ?></td>
                <td><?= $pelatih['nama_pelatih'] ?></td>
                <td><?= $row['jam'] ?></td>
                <td><?= $murid['nama_murid'] ?></td>
                <td><?= $row['status'] ?></td>
               </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
          <?php }else{

          
       } ?>
         
        </div>
	</div>
  <script type="text/javascript">window.print()</script>
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
