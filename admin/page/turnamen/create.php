<?php 
	if (isset($_POST['simpan'])) {
    $mulai=$_POST['mulai'];
    $selesai=$_POST['selesai'];
    $nama=$_POST['Nama'];
    $NIP=$_POST['NIP'];
		$sql = "INSERT into turnamen values(null,'$nama','$mulai','$selesai','$NIP','Set')";
		$query = mysqli_query($con, $sql);
		if ($query) {
			echo "<script>alert('Data berhasil ditambahkan!');window.location.href='index.php?p=turnamen'</script>";
		} else {
			echo "Error : " . mysqli_error($con);
		}
  }

 ?>
<div class="row">
    <!-- left column -->
    <div class="col-lg-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Jadwal turnamen</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label >Tanggal Mulai </label><span class="float-right" style="color: #aaa;">Hanya dapat mulai sejak hari ini</span>
              <input type="date" class="form-control input-lg" id="exampleInputEmail1" min="<?=date('Y-m-d')?>" value="<?=date('Y-m-d')?>" name="mulai" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tanggal Selesai</label>
              <input type="date" class="form-control input-lg" id="exampleInputEmail1" value="<?=date('Y-m-d')?>" min="<?=date('Y-m-d')?>" name="selesai" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Turnamen</label>
              <input type="text" class="form-control input-lg" id="exampleInputEmail1" placeholder="Masukan Nama Turnamen" name="Nama" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Pelatih</label>
              <?php if ($_SESSION["level"]=="Pelatih"){ ?>
                <input type="text" readonly name="NIP" class="form-control input-lg" value="<?=$_SESSION['id_user']?>">
              <?php }else{ ?>
              <select class="form-control custom-select input-lg" name="NIP">
                <option disabled selected>-- Pilih pelatih --</option>
                <?php $opt=mysqli_query($con,"SELECT * from pelatih");
                while ($row=mysqli_fetch_array($opt)){
                 ?>
                  <option value="<?php echo $row['NIP']; ?>" title="NIP: <?php echo $row['NIP'];?>"><?=$row['nama_pelatih']?></option>
                <?php } ?>
              </select>
              <?php } ?>
              
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