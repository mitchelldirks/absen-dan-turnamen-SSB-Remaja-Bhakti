<?php
$bln=date('n');
$bul=date('m');
$taun=date('Y');

    if (isset($_GET['kode'])) {
        $q=mysqli_query($con,"SELECT * FROM latihan JOIN pelatih ON latihan.pelatih=pelatih.NIP where id_latihan='".$_GET['kode']."'");
        if(mysqli_num_rows($q) > 0){ $i=1;
               while($jadwal = mysqli_fetch_array($q)){
                $id_latihan=$jadwal['id_latihan'];
                $Besok=$jadwal['tanggal'];
                $napel=$jadwal['nama_latihan'];
                $waktu=$jadwal['jam'];
                $pelatih=$jadwal['nama_pelatih'];
                $materi=$jadwal['materi'];
                $status=$jadwal['status'];
                if ($status!='Absen Selesai') {
                                $badge='danger';
                            }else{
                                $badge='success';
                                header("location: ?p=absen&act=view&kode=".$_GET['kode']);
                            }
               }
           }
    }else{
    $Besok=' '; 
}
?>

    <style>
        .inputin{
            border-top: none;
            border-right: none;
            border-left: none;
            border-bottom: lightblue solid 2px;
        }
        .none{
            border-top: none;
            border-right: none;
            border-left: none;
            border-bottom: lightblue solid 2px;
            background: transparent;
        }
        .hover:hover{
            border-left: blue solid 4px;
            background-color: #eee;
        }
    </style>


     <div class="col-lg-12">
      <div class="box box-primary" style="padding: 10px;">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="box-title">Absensi <?=$napel?></h3>
                </div>
            </div>
          
        </div>
<div class="card" id="Jadwal" style="padding: 20px;">
    <div class="col-lg-12">
    <div class="row">
        <div class="col-lg-6">
                    <div class="form-group row">
                         <label class="col-lg-3">Kode</label>
                         <input type="text" class="inputin col-lg-8" value="<?php echo $id_latihan;?>" readonly>
                    </div>
                    <div class="form-group row">
                         <label class="col-lg-3">Tanggal</label>
                         <input type="text" class="inputin col-lg-8" value="<?php echo $Besok; ?>" readonly>
                    </div>
                    <div class="form-group row">
                         <label class="col-lg-3">Waktu</label>
                         <input type="text" class="inputin col-lg-8" value="<?php echo $waktu; ?>"   readonly>
                    </div>
        </div>
        <div class="col-lg-6">
                    <div class="form-group row">
                         <label class="col-lg-3">pelatih</label>
                         <input type="text" class="inputin col-lg-8" value="<?php echo $pelatih; ?>"  readonly>
                    </div>
                    <div class="form-group row">
                         <label class="col-lg-3">Pelajaran</label>
                         <input type="text" class="inputin col-lg-8" value="<?php echo $napel; ?>" readonly>
                    </div>
                    <div class="form-group row">
                         <label class="col-lg-3">Materi</label>
                         <input type="text" class="inputin col-lg-8" value="<?php echo $materi; ?>" readonly>
                    </div>
                    
        </div>
    </div>
    </div>
</div>
<br><br><br><br><hr>
<div class="card" id="Daftar_Murid" style="padding: 30px">
    <h3 style="padding: 10px; ">Daftar Murid</h3>
    <hr>

<?php 
    $murid=mysqli_query($con,"SELECT * FROM murid ORDER BY nama_murid");
                if(mysqli_num_rows($murid) > 0){ $i=1;
               while($r = mysqli_fetch_array($murid)){
 ?>
    <div class="row hover" style="padding: 10px;">
        <div class="col-lg-9 ">
            <label class="col-lg-3"><?=$i?></label>
            <label class="col-lg-6"><?php echo $r['nama_murid']; ?></label>
            <input type="text" name="id_murid_<?php echo $i; ?>" value="<?php echo $r['id_murid']; ?>" hidden>
            
        </div>
        <div class="col-lg-3">
            <?php $abs=mysqli_fetch_array(mysqli_query($con,"SELECT * from absen where id_latihan='$_GET[kode]' and  id_murid='$r[id_murid]'"));
            echo "<h4>$abs[status]</h4>";
            ?>
        </div>
    </div>

<?php $i++;
}} ?>
<input type="text" name="kuota" value="<?php $i--;echo $i; ?>" hidden>
</form>
</div>
        
</div>
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>