<?php if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE from latihan where id_latihan='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil dihapus!');window.location.href='index.php?p=latihan'</script>";
    } else {
      echo mysqli_error($con);
    }
} ?>
     <div class="col-lg-12">
      <!-- general form elements -->
      <div class="box box-primary" style="padding: 10px;">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-lg-6">

                    <h3 class="box-title">Jadwal Latihan</h3>
                </div>
                <div class="col-lg-6">
                    <span class="pull-right"><a class="btn btn-small btn-success" href="?p=latihan&act=create" data-toggle="tooltip" data-placement="bottom" title="Tambah">+ Jadwal</a></span>
                </div>
            </div>
          
        </div>
 <table class="table table-condensed table-bordered table-hover" id="example1">
                    <thead>
						<th>  Tanggal</th>
                        <th>  Konsep</th>
                        <th>  Jam</th>
						<th>  Materi</th>
						<th>  Pelatih</th>
                        <th></th>
                    </thead>
                      <tbody>
                        <?php 
                        $latihan=mysqli_query($con,"SELECT * from latihan");
                        while ($row=mysqli_fetch_array($latihan)) {
                            $gu=mysqli_query($con,"SELECT * from pelatih where NIP='$row[pelatih]'");
                           $pelatih=mysqli_fetch_array($gu);
                           $id=$row['id_latihan'];
                         ?>
                        <tr>
                        <td> <?php echo date_format(date_create($row['tanggal']),'d ').bulan(date_format(date_create($row['tanggal']),'m')).date_format(date_create($row['tanggal']),' Y ');?></td>
                        <td> <?php echo $row['nama_latihan'];?></td>
                        <td> <?php echo date_format(date_create($row['jam']),'H:i');?></td>
                        <td> <?php echo $row['materi'];?></td>
                        <td> <?php echo $pelatih['nama_pelatih'];?></td>
                        <td>
                                <a class="btn btn-small btn-info" href="?p=latihan&act=edit&id=<?php echo $id;?>" data-toggle="tooltip" data-placement="bottom" title="Edit"> Edit</a>
                                <a class="text-info text-center"></a>
                                <a href="?p=latihan&delete&id=<?php echo $id;?>" data-toggle="tooltip" data-placement="bottom"
                                    title="Hapus">Hapus</a>   
                        </td>
                        </tr>
                    <?php } ?>
                    </tbody>
</table>
</div>
</div>