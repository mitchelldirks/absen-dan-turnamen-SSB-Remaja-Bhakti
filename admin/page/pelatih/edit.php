<?php 
  
  $id = $_GET['id'];
  $sql = "SELECT * from pelatih where NIP='$id'";
  $query = mysqli_query($con, $sql);
  $data = mysqli_fetch_array($query);


	if (isset($_POST['simpan'])) {

    $a=$_FILES['photo']['name'];
    if (strlen($a)>0) {
            if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
              move_uploaded_file($_FILES['photo']['tmp_name'], "assets/img/anggota/".$a);
              //$img=",img='".$_POST['photo']."'";
              $img=",foto='".$a."'";
            }
          //}
    }else{
      $img="";
    }
		$sql = "UPDATE pelatih set  NIP='".$_POST['NIP']."', nama_pelatih='".$_POST['pelatih']."', JK='".$_POST['JK']."' $img  where NIP='$id'";
		$query = mysqli_query($con, $sql);
		if ($query) {
			echo "<script>alert('Data berhasil diubah!');window.location.href='index.php?p=pelatih'</script>";
		} else {
			echo "Error : " . mysqli_error($con);
		}
	}

 ?>

<div class="row">
    <!-- left column -->
    <div class="col-lg-12">
      <!-- general form elements -->
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Pelatih</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post"  enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">NIP</label>
              <input type="text" class="form-control input-lg" id="exampleInputEmail1" placeholder="Masukan NIP" name="NIP" value="<?php echo $data['NIP']; ?>" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nama pelatih</label>
              <input type="text" class="form-control input-lg" id="exampleInputEmail1" placeholder="Masukan Nama pelatih" name="pelatih" value="<?php echo $data['nama_pelatih']; ?>"required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Kelamin</label>
              <select class="form-control custom-select input-lg" name="JK">
                <option disabled selected>-- Masukan Gender --</option>
                <option value="Pria" <?php if($data['JK']=="Pria"){echo"selected";}else{echo "";} ?>>Pria</option>
                <option value="Wanita" <?php if($data['JK']=="Wanita"){echo"selected";}else{echo "";} ?>>Wanita</option>
              </select>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-10">
                  <label for="exampleInputEmail1">Pas Foto <span style="color: red">* ukuran file maximum 1MB</span><small class="text-danger"> *)</small></label>
                  <input type="file" accept="image/*" name="photo" class="form-control input-lg">
                  <small class="text-danger">*) Kosongkan jika tidak ingin diubah</small>
                </div>
                <div class="col-md-2">
                  <label for="exampleInputEmail1">Sebelumnya</label>
                  <img width="100%" alt="<?=$data['foto']?>" title="<?=$data['foto']?>" src="assets/img/anggota/<?=$data['foto']?>">
                </div>
              </div>
              
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
          </div>
        </form>
      </div>
    
  </div>
  <!-- /.row -->