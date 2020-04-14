<?php 
  if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE from murid where id_murid='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil dihapus!');window.location.href='index.php?p=murid'</script>";
    } else {
      echo mysqli_error($con);
    }
  }

 ?>

<div class="row">
    <div class="col-lg-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data murid <span class="float-right"><a href="?p=murid&act=create" class="btn btn-success"><i class="fa fa-user"></i> Tambah Data murid</a></span></h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nama murid</th>
              <th>Foto</th>
              <th>Jenis Kelamin</th>
              <th>TTL</th>
              <th>Alamat</th>
              <th>Aksi</th>
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
                <td><img height="100px" title="<?= $row['nama_murid'] ?>" src="assets/img/anggota/<?= $row['foto'] ?>"></td>
                <td><?= $row['sex'] ?></td>
                <td><?= $row['pob'] ?>,  <?php echo date_format(date_create($row['dob']),'d ').bulan(date_format(date_create($row['dob']),'m')).date_format(date_create($row['dob']),' Y ');?></td>
                <td><?= $row['alamat'] ?></td>
                
                <td>
                  <a href="index.php?p=murid&act=edit&id=<?= $row['id_murid'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  <a href="index.php?p=murid&delete&id=<?= $row['id_murid'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="fa fa-trash"></i></a>
                </td>
            	 </tr>
            	<?php endwhile; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

