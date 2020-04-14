<?php 
  if (isset($_POST['simpan'])) {
    $a=$_FILES['photo']['name'];
    $nama=$_POST['nama'];
    $JK=$_POST['JK'];
    $pob=$_POST['pob'];
    $dob=$_POST['dob'];
    $alamat=$_POST['alamat'];
    $id_m=date('Ym');
    $cek=mysqli_query($con,"SELECT * from murid where id_murid like '".$id_m."%' order by id_murid asc");
    if (mysqli_num_rows($cek)>0) {
      while ($idcek=mysqli_fetch_array($cek)) {
        $id_v = $idcek["id_murid"];
      }
      $id_v++;
    }else{
      $id_v=$id_m."01";
    }
    $pass=date_format(date_create($dob),'dmY');
		$sql = "INSERT into murid values ('$id_v','$nama','$JK', '$dob','$pob','$alamat','$a')";
		$query = mysqli_query($con, $sql);
		if ($query) {
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
      mysqli_query($con,"INSERT INTO user values (null,'$id_v','$id_v','$pass','Murid')");
			echo "<script>alert('Data berhasil ditambahkan!');window.location.href='index.php?p=murid'</script>";
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
          <h3 class="box-title">Form murid</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post"   enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama murid</label>
              <input type="text" class="form-control input-lg" id="exampleInputEmail1" placeholder="Masukan Nama murid" name="nama" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Kelamin</label>
              <select class="form-control custom-select input-lg" name="JK">
                <option disabled selected>-- Masukan Gender --</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tempat Lahir</label>
               <input type="text" class="form-control input-lg" id="exampleInputEmail1" placeholder="Masukan Tempat Lahir" name="pob" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tanggal Lahir</label>
               <input type="date" class="form-control input-lg" id="exampleInputEmail1" placeholder="Masukan Tanggal Lahir" name="dob" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Alamat</label>
               <textarea class="form-control input-lg" name="alamat" required></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Pas Foto <span style="color: red">* ukuran file maximum 1MB</span></label>
              <input required type="file" accept="image/*" name="photo" class="form-control input-lg">
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

