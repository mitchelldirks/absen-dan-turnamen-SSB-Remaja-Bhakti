<?php 
$id=$_GET['id'];
  $ed=mysqli_query($con,"SELECT * from murid where id_murid='$id'");
  $edit=mysqli_fetch_array($ed);

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
   $nama=$_POST['nama'];
    $JK=$_POST['JK'];
    $pob=$_POST['pob'];
    $dob=$_POST['dob'];
    $alamat=$_POST['alamat'];
    $sql = "UPDATE murid set nama_murid='$nama',sex='$JK',dob='$dob',pob='$pob',alamat='$alamat' ".$img." where id_murid='$_GET[id]'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil diubah!');window.location.href='index.php?p=murid'</script>";
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
          <h3 class="box-title">Form murid</h3>
          
        </div>
        <!-- form start -->
        <form role="form" method="post"  enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama murid</label>
              <input type="text" class="form-control input-lg" id="exampleInputEmail1" value="<?=$edit['nama_murid']?>" placeholder="Masukan Nama murid" name="nama" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Kelamin</label>
              <select class="form-control custom-select input-lg" name="JK">
                <option disabled selected>-- Masukan Gender --</option>
                <option value="Laki-Laki" <?php if ($edit['sex']=='Laki-Laki') {echo "selected"; }else{}?>>Laki-Laki</option>
                <option value="Perempuan" <?php if ($edit['sex']=='Perempuan') {echo "selected"; }else{}?>>Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tempat Lahir</label>
               <input type="text" class="form-control input-lg" id="exampleInputEmail1" value="<?=$edit['pob']?>" placeholder="Masukan Tempat Lahir" name="pob" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tanggal Lahir</label>
               <input type="date" class="form-control input-lg" id="exampleInputEmail1" value="<?=$edit['dob']?>" placeholder="Masukan Tanggal Lahir" name="dob" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Alamat</label>
               <textarea class="form-control input-lg" name="alamat"  required><?=$edit['alamat']?></textarea>
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
                  <img width="100%" alt="<?=$edit['foto']?>" title="<?=$edit['foto']?>" src="assets/img/anggota/<?=$edit['foto']?>">
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
      <!-- /.box -->


    </div>
    <!--/.col (left) -->
    

  </div>



  <!-- /.row -->

