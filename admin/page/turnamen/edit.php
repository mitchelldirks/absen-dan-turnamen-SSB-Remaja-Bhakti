<?php 
  $id=$_GET['id'];
  $ed=mysqli_query($con,"SELECT * from turnamen where id_turnamen='$id'");
  $edit=mysqli_fetch_array($ed);
	if (isset($_POST['simpan'])) {
    $mulai=$_POST['mulai'];
    $selesai=$_POST['selesai'];
    $nama=$_POST['Nama'];
    $NIP=$_POST['NIP'];
		$sql = "UPDATE turnamen set nama_turnamen='$nama',mulai='$mulai',selesai='$selesai', pelatih='$NIP' where id_turnamen='$_GET[id]'";
		$query = mysqli_query($con, $sql);
		if ($query) {
			echo "<script>alert('Data berhasil diubah!');window.location.href='index.php?p=turnamen'</script>";
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
          <h3 class="box-title">Form Edit Turnamen</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label >Tanggal Mulai </label>
              <input type="date" class="form-control input-lg" id="exampleInputEmail1" value="<?=$edit['mulai']?>" name="mulai" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tanggal Selesai</label>
              <input type="date" class="form-control input-lg" id="exampleInputEmail1" value="<?=$edit['selesai']?>" name="selesai" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Turnamen</label>
              <input type="text" class="form-control input-lg" id="exampleInputEmail1" placeholder="Masukan Nama Turnamen" value="<?=$edit['nama_turnamen']?>" name="Nama" required>
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