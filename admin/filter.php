<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
		<h3>Filter <?=$_GET['print']?></h3>
		<form action="print.php" method="GET">
			<div class="form-group">
				<label>Perihal</label>
				<input type="text" name="p" class="form-control" readonly value="<?=$_GET['print']?>">
			</div>
			<?php if ($_GET['print']=='absen'){ ?>
			<div class="form-group">
				<label>Tahun</label>
				<select name="tahun" class="form-control">
					<?php
						// $master=mysqli_query($con,'SELECT * FROM latihan group by tanggal');
						for ($i=date('Y'); $i > 1983; $i--) { 
							$output=mysqli_query($con,"SELECT * from latihan where tanggal like '".$i."%'");
							if (mysqli_num_rows($output)>0) {
								echo "<option>".$i."</option>";
							}
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label>Bulan</label>
				<select name="bulan" class="form-control">
					<?php
						for ($i=1; $i <= 12; $i++) {
								if (date('m')==$i) {
								echo "<option value='".$i."' selected>".bulan($i)."</option>";
								}else{
								echo "<option value='".$i."'>".bulan($i)."</option>";
								}
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Tampilkan filter</button>
				<a style="margin-top: 8px" class="pull-right" href="print.php?p=<?=$_GET['print']?>" onclick="return confirm('Abaikan filter dan telusuri semua data?')">Tampilkan Semua</a>
			</div>



			<?php } ?>
			
		</form>
	</div>
	<div class="col-lg-3"></div>

</div>