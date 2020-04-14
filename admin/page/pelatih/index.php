<?php 
  if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE from pelatih where NIP='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil dihapus!');window.location.href='index.php?p=pelatih'</script>";
    } else {
      echo mysqli_error($con);
    }
  }

 ?>

<div class="row">
    <div class="col-lg-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Pelatih<span class="pull-right"><a href="?p=pelatih&act=create" class="btn btn-success"><i class="fa fa-user"></i> Tambah Data Pelatih</a></span></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>NIP</th>
              <th>Nama pelatih</th>
              <th>Foto</th>
              <th>Jenis Kelamin</th>
              <th>Mengajar</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            	<?php 
            		$sql = "select * from pelatih";
            		$query = mysqli_query($con, $sql);
            		while ($row = mysqli_fetch_assoc($query)):

            	 ?>
            	 <tr>
            	 	<td><?= $row['NIP'] ?></td>
            	 	<td><?= $row['nama_pelatih'] ?></td>
                <td><img height="100px" title="<?= $row['nama_pelatih'] ?>" src="assets/img/anggota/<?= $row['foto'] ?>"></td>
                <td><?= $row['JK'] ?></td>
                <td><?= mysqli_num_rows(mysqli_query($con,"SELECT * from latihan where pelatih='$row[NIP]'"))+mysqli_num_rows(mysqli_query($con,"SELECT * from turnamen where pelatih='$row[NIP]'")) ?> Jadwal</td>
                <td>
                  <a href="index.php?p=pelatih&act=edit&id=<?= $row['NIP'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  <a href="index.php?p=pelatih&delete&id=<?= $row['NIP'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="fa fa-trash"></i></a>
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

