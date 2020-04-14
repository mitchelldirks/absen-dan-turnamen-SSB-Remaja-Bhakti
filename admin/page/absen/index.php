     <div class="col-lg-12">
      <!-- general form elements -->
      <div class="box box-primary" style="padding: 10px;">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-lg-6">

                    <h3 class="box-title">Daftar Mata Pelajaran</h3>
                </div>
                <div class="col-lg-6">
                    <span class="pull-right"><a class="btn btn-small btn-success" href="?p=latihan&act=create" data-toggle="tooltip" data-placement="bottom" title="Tambah">+ Jadwal</a></span>
                </div>
            </div>
          
        </div>
 <table class="table table-condensed table-bordered table-hover" id="example1">
                    <thead>

                        <th>  Nama Pelajaran</th>
                        <th>  Tanggal</th>
                        <th>  Jam</th>
                        <th>  Materi</th>
                        <th>  Pelatih</th>
                        <th>  Absensi</th>
                        <th></th>
                    </thead>
                      <tbody>
                        <?php 
                        if ($_SESSION["level"]=="Pelatih") {
                          $latihan=mysqli_query($con,"SELECT * from latihan where pelatih='".$_SESSION["id_user"]."' order by tanggal desc");
                        }else{
                          $latihan=mysqli_query($con,"SELECT * from latihan order by tanggal desc");
                        }
                        while ($row=mysqli_fetch_array($latihan)) {
                            $gu=mysqli_query($con,"SELECT * from pelatih where NIP='$row[pelatih]'");
                           $pelatih=mysqli_fetch_array($gu);
                           $id=$row['id_latihan'];
                           $status1=$row['status'];
                           if ($status1!='Absen Selesai') {
                                $badge='danger';
                                $link='input';
                                $users=0;
                            }else{
                                $badge='success';
                                 $link='view';
                                 $users=mysqli_num_rows(mysqli_query($con,"SELECT * from absen where status = 'Hadir' and id_latihan='$row[id_latihan]'"));
                            }
                         ?>
                        <tr>

                        <td> <?php echo $row['nama_latihan'];?></td>
                        <td> <?php echo date_format(date_create($row['tanggal']),'d ').bulan(date_format(date_create($row['tanggal']),'m')).date_format(date_create($row['tanggal']),' Y ');?></td>
                        <td> <?php echo $row['jam'];?></td>
                        <td> <?php echo $row['materi'];?></td>
                        <td> <?php echo $pelatih['nama_pelatih'];?></td>
                        <td> <?php echo "<div class='text-center'><span class='badge btn-$badge'>$status1</span></div>"; ?></td>
                        <td align="center"><a class="btn btn-primary" href='?p=absen&act=<?=$link?>&kode=<?=$id?>'><i class="fa fa-user"></i></a><br>
                        <span class="text-center"><i class="fa fa-user"></i> <?=$users?></span>
                        </td>
                        </tr>
                    <?php } ?>
                    </tbody>
</table>
</div></div>