<?php if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE from turnamen where id_turnamen='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil dihapus!');window.location.href='index.php?p=turnamen'</script>";
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

                    <h3 class="box-title">Jadwal turnamen</h3>
                </div>
                <div class="col-lg-6">
                    <span class="pull-right"><a class="btn btn-small btn-success" href="?p=turnamen&act=create" data-toggle="tooltip" data-placement="bottom" title="Tambah">+ Jadwal</a></span>
                </div>
            </div>
          
        </div>
 <table class="table table-condensed table-bordered table-hover" id="example1">
                    <thead>
						<th>  Tanggal</th>
                        <th>  Nama Turnamen</th>
						<th>  Pelatih</th>
                        <th>  Peserta</th>
                        <th></th>
                    </thead>
                      <tbody>
                        <?php 
                        if ($_SESSION["level"]=="Pelatih") {
                        $turnamen=mysqli_query($con,"SELECT * from turnamen where pelatih='".$_SESSION["id_user"]."' order by mulai desc");
                        }else{
                        $turnamen=mysqli_query($con,"SELECT * from turnamen order by mulai desc");
                        }
                        while ($row=mysqli_fetch_array($turnamen)) {
                            $gu=mysqli_query($con,"SELECT * from pelatih where NIP='$row[pelatih]'");
                            $pelatih=mysqli_fetch_array($gu);
                            $users=mysqli_num_rows(mysqli_query($con,"SELECT * from turnamen where id_turnamen='$row[id_turnamen]'"));
                            $id=$row['id_turnamen'];
                            if ($row['status']!='ready') {
                                $badge='danger';
                                $link='input';
                                $users=0;
                            }else{
                                $badge='success';
                                 $link='view';
                            }
                         ?>
                        <tr>
                        <td> <?php if ($row['mulai']==$row['selesai']) {
                            echo date_format(date_create($row['mulai']),'d ').bulan(date_format(date_create($row['mulai']),'m')).date_format(date_create($row['mulai']),' Y ');
                        }else{
                            echo date_format(date_create($row['mulai']),'d ').bulan(date_format(date_create($row['mulai']),'m')).date_format(date_create($row['mulai']),' Y ');?> s/d <?php echo date_format(date_create($row['selesai']),'d ').bulan(date_format(date_create($row['selesai']),'m')).date_format(date_create($row['selesai']),' Y ');
                        } ?></td>
                        <td> <?php echo $row['nama_turnamen'];?></td>
                        <td> <?php echo $pelatih['nama_pelatih'];?></td>
                        <td> <?php echo mysqli_num_rows(mysqli_query($con,"SELECT * from peserta_turnamen where id_turnamen='$id'"));?> nama</td>
                        <?php
                            if ($_SESSION["level"]=="Pelatih") {
                                if ($link=='view') { ?>
                                    <td>
                                        <a class="btn btn-primary" href='print.php?p=turnamen&kode=<?=$id?>'><i class="fa fa-file"></i></a><br>
                                    </td>
                             <?php }else{ ?>
                            <td>
                                <a class="btn btn-primary" href='?p=turnamen&act=<?=$link?>&kode=<?=$id?>'><i class="fa fa-user"></i></a><br>
                            </td>
                        <?php }}else{?>
                            <td>
                                <a class="btn btn-small btn-info" href="?p=turnamen&act=edit&id=<?php echo $id;?>" data-toggle="tooltip" data-placement="bottom" title="Edit"> Edit</a>
                                <a class="text-info text-center"></a>
                                <a href="?p=turnamen&delete&id=<?php echo $id;?>" data-toggle="tooltip" data-placement="bottom"
                                    title="Hapus">Hapus</a>   
                            </td>
                        <?php } ?>
                        
                        </tr>
                    <?php } ?>
                    </tbody>
</table>
</div>
</div>