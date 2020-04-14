<?php 
  error_reporting(0);
   
	if (isset($_POST['simpan'])) {
    
		$sql = "INSERT into pelatih values ('".$_POST[NIP]."','".$_POST[pelatih]."', '".$_POST[JK]."', '".$_FILES['photo']['name']."','na')";
		$query = mysqli_query($con, $sql);
		if ($query) {
      if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
            move_uploaded_file($_FILES['photo']['tmp_name'], "assets/img/anggota/".$a);
        }
        $query="INSERT INTO user values (null,'".$_POST[pelatih]."', '".$_POST[NIP]."','".$_POST[NIP]."','Pelatih')";
        echo $query;
      mysqli_query($con,$query);
		//echo "<script>alert('Data berhasil ditambahkan!');window.location.href='index.php?p=pelatih'</script>";
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
          <h3 class="box-title">Form Pelatih</h3>
          
        </div>
        <?php if($_GET['s']=="dm"){ echo "<div class='dm'>Password berbeda, coba lagi</div>";}else{echo"";}?>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post"  enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">NIP</label>
              <input type="text" class="form-control input-lg" id="exampleInputEmail1" placeholder="Masukan NIP" name="NIP" <?php if (isset($_GET['nip'])) { echo "value='".$_GET['nip']."'";}else{echo "";} ?> required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nama pelatih</label>
              <input type="text" class="form-control input-lg" id="exampleInputEmail1" placeholder="Masukan Nama pelatih" name="pelatih" <?php if (isset($_GET['nama'])) { echo "value='".$_GET['nama']."'";}else{echo "";} ?> required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Kelamin</label>
              <select class="form-control custom-select input-lg" name="JK">
                <option disabled selected>-- Masukan Gender --</option>
                <option value="Pria" <?php if($_GET[JK]=="Pria"){echo"selected";}else{echo "";} ?>>Pria</option>
                <option value="Wanita" <?php if($_GET[JK]=="Wanita"){echo"selected";}else{echo "";} ?>>Wanita</option>
              </select>
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
  <script>
  var check = function() {
  if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
  }
}
  </script>

