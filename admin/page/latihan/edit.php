<?php 
  $id=$_GET['id'];
  $ed=mysqli_query($con,"SELECT * from latihan where id_latihan='$id'");
  $edit=mysqli_fetch_array($ed);
	if (isset($_POST['simpan'])) {
    $tgl=$_POST['Tgl'];
    $nama=$_POST['Nama'];
    $waktu=$_POST['Waktu'];
    $Materi=$_POST['Materi'];
    $NIP=$_POST['NIP'];
		$sql = "UPDATE latihan set nama_latihan='$nama',tanggal='$tgl',jam='$waktu',materi='$Materi',pelatih='$NIP' where id_latihan='$_GET[id]'";
		$query = mysqli_query($con, $sql);
		if ($query) {
			echo "<script>alert('Data berhasil diubah!');window.location.href='index.php?p=latihan'</script>";
		} else {
			echo "Error : " . mysqli_error($con);
		}
  }

 ?>
 <style>
 .dm{
    margin:5px;
    padding: 10px;
     background: #E65E4C;
      color: white;
      border-left: #ED2B12 solid 5px;
      font-weight:35px;
   } 
   </style>

<div class="row">
    <!-- left column -->
    <div class="col-lg-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Edit Latihan</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Tanggal</label>
              <input type="date" class="form-control input-lg" id="exampleInputEmail1" value="<?=$edit['tanggal']?>"  name="Tgl" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Waktu Mulai</label>
              <input type="time" class="form-control input-lg" id="exampleInputEmail1" value="<?=$edit['jam']?>" name="Waktu" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Konsep Latihan</label>
              <input type="text" class="form-control input-lg" id="exampleInputEmail1" value="<?=$edit['nama_latihan']?>" placeholder="Masukan Konsep" name="Nama" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Materi</label>
              <textarea class="form-control input-lg" id="exampleInputEmail1" name="Materi"><?=$edit['materi']?></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">pelatih</label>
              <select class="form-control custom-select input-lg" name="NIP">
                <option disabled selected>-- Pilih pelatih --</option>
                <?php $opt=mysqli_query($con,"SELECT * from pelatih");
                while ($row=mysqli_fetch_array($opt)){
                 ?>
                  <option value="<?php echo $row['NIP']; ?>" title="NIP: <?php echo $row['NIP'];?>" <?php
                  if ($edit['pelatih']==$row['NIP']) {echo "selected";}else{} ?>><?=$row['nama_pelatih']?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            </div>
          </div>
          <!-- /.box-body -->
        </form>
      </div>
      <!-- /.box -->


    </div>
    <!--/.col (left) -->
</div>



  <!-- /.row -->