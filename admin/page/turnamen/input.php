<?php
$bln=date('n');
$bul=date('m');
$taun=date('Y');
	if (isset($_GET['simpan'])) {
		$id_murid=$_GET['id'];
		mysqli_query($con,"INSERT INTO peserta_turnamen values (null,'".$_GET['kode']."','".$_GET['id']."','Pemain')");
	}elseif (isset($_GET['delete'])) {
		mysqli_query($con,"DELETE from peserta_turnamen where id_peserta_turnamen='".$_GET['id']."'");
	}elseif (isset($_GET['lock'])) {
		$lock=mysqli_query($con,"UPDATE turnamen set status='ready' where id_turnamen='".$_GET['kode']."'");
		if ($lock) {
			echo "<script>alert('Daftar Pemain telah tersimpan, Semoga bermanfaat and vice versa!');window.location.href='?p=turnamen'</script>";
		}
	}
    if (isset($_GET['kode'])) {
        $q=mysqli_query($con,"SELECT * FROM turnamen JOIN pelatih ON turnamen.pelatih=pelatih.NIP where id_turnamen='".$_GET['kode']."'");
        if(mysqli_num_rows($q) > 0){ $i=1;
               while($jadwal = mysqli_fetch_array($q)){
                $id_turnamen=$jadwal['id_turnamen'];
                $mulai=$jadwal['mulai'];
                $napel=$jadwal['nama_turnamen'];
                $selesai=$jadwal['selesai'];
                $pelatih=$jadwal['nama_pelatih'];
                $status=$jadwal['status'];
                if ($status!='Absen Selesai') {
                                $badge='danger';
                            }else{
                                $badge='success';
                                header("location: ?p=absen&act=view&kode=".$_GET['kode']);
                            }
               }
           }
    }else{
    $Besok=' ';	
}
?>

	<style>
        .inputin{
            border-top: none;
            border-right: none;
            border-left: none;
            border-bottom: lightblue solid 2px;
        }
        .none{
            border-top: none;
            border-right: none;
            border-left: none;
            border-bottom: lightblue solid 2px;
            background: transparent;
        }
        .hover:hover{
            border-left: blue solid 4px;
            background-color: #eee;
        }

  #myInput {
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 100%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 6px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
}
#myUL {
  /* Remove default list styling */
  list-style-type: none;
  padding: 0;
  margin: 0;
}
#myUL li a {
  border: 1px solid #ddd; /* Add a border to all links */
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6; /* Grey background color */
  padding: 12px; /* Add some padding */
  text-decoration: none; /* Remove default text underline */
  font-size: 18px; /* Increase the font-size */
  color: black; /* Add a black text color */
  display: block; /* Make it into a block element to fill the whole list */
  width: 100%;
}
#myUL li a:hover:not(.header) {

            border-left: blue solid 4px;
            background-color: #eee;
}
</style>



     <div class="col-lg-12">
      <div class="box box-primary" style="padding: 10px;">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-lg-12">

                    <h3 class="box-title">Absensi <?=$napel?></h3>
                </div>
            </div>
          
        </div>
<div class="card" id="Jadwal" style="padding: 20px;">
    <div class="col-lg-12">
    <div class="row">
        <div class="col-lg-6">
                    <div class="form-group row">
                         <label class="col-lg-3">Kode</label>
                         <input type="text" class="inputin col-lg-8" value="<?php echo $id_turnamen;?>" readonly>
                    </div>
                    <div class="form-group row">
                         <label class="col-lg-3">Tanggal</label>
                         <input type="text" class="inputin col-lg-8" value="<?php if($mulai==$selesai){
                         	echo $mulai;
                         }else{
                         	 echo $mulai; ?> s/d <?php echo $selesai; 
                         } ?>"  readonly>
                    </div>
        </div>
        <div class="col-lg-6">
                    <div class="form-group row">
                         <label class="col-lg-3">Pelatih</label>
                         <input type="text" class="inputin col-lg-8" value="<?php echo $pelatih; ?>"  readonly>
                    </div>
                    <div class="form-group row">
                         <label class="col-lg-3">Status</label>
                         <input type="text" class="inputin col-lg-8" value="<?php echo $status; ?>" readonly>
                    </div>
        </div>
    </div>
    </div>
</div>
<br><br><br><br><hr>
<div class="card" id="Daftar_Murid" style="padding: 30px">
    <form action="?p=absen&act=proses&kode=<?php echo $_GET['kode'];?>" method="POST">
        <input type="text" name="id_turnamen" value="<?php echo $_GET['kode'];?>" hidden>
    <h3 style="padding: 10px; ">Daftar Peserta <span class="pull-right">
        <a href="?p=turnamen&act=input&lock&kode=<?=$id_turnamen?>" class="btn btn-success" onclick="return confirm('Pastikan pemain siap! Tidak bisa diubah setelah tersimpan. Simpan daftar?')"><i class="fa fa-save"></i> Simpan</a>
    </span></h3>
    <hr>

<?php 
    $murid=mysqli_query($con,"SELECT * FROM peserta_turnamen join murid on peserta_turnamen.id_murid=murid.id_murid ORDER BY nama_murid");
    $i=0;
                if(mysqli_num_rows($murid) > 0){ 
               while($r = mysqli_fetch_array($murid)){ $i++;
 ?>
    <div class="row hover" style="padding: 10px;">
        <div class="col-lg-10">
            <label class="col-lg-2"><?=$i?></label>
            <label class="col-lg-3"><img height="35px" src="assets/img/anggota/<?php echo $r['foto']; ?>"></label>
            <label class="col-lg-6"><?php echo $r['nama_murid']; ?></label>
            
        </div>
        <div class="col-lg-2">
        	<a class="btn btn-danger" href="?p=turnamen&act=input&kode=<?php echo $id_turnamen; ?>&delete&id=<?php echo $r['id_peserta_turnamen']; ?>"><i class="fa fa-trash"></i></a>
        </div>
    </div>

<?php 
}} ?>
<hr>
										<div class="card-body">
                                            <div class="collapse" id="collapseExample123">
                                            	<label>Daftar Murid</label>
										          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

										          <ul id="myUL">
										            <?php 
										            $dosen=mysqli_query($con,"SELECT * from murid where id_murid NOT IN (SELECT id_murid from peserta_turnamen where id_turnamen='".$id_turnamen."') order by nama_murid");
										            while ($list=mysqli_fetch_array($dosen)) { ?>
										              	<li>
											              	<a href="?p=turnamen&act=input&kode=3&simpan&id=<?php echo $list['id_murid'];?>"><?php echo $list['nama_murid']; ?> 
											             		<span class="pull-right"><img height="35px" src="assets/img/anggota/<?php echo $list['foto']; ?>"></span>
											          		</a>
										          		</li>
										            <?php } ?>
										          </ul> 
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" data-toggle="collapse" href="#collapseExample123" class="btn btn-primary">Tambah Peserta</button>
                                        </div>
</form>
</div>
</div>
<script>
function myFunction() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  ul = document.getElementById("myUL");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>

</body>
</html>