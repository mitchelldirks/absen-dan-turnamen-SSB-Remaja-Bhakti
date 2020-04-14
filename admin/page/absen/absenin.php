<?php
$id_latihan=$_POST['id_latihan'];
$maxloop=$_POST['kuota'];
for ($a=1; $a <= $maxloop; $a++) { 
	$idm=$_POST['id_murid_'.$a];
	$abs=$_POST['absen_'.$a];
	$sql=mysqli_query($con,"INSERT INTO absen  VALUES (null,'$id_latihan','$idm','$abs')");
	if ($sql) {
	
	}else{
		echo "Error: ".$sql;
	}
}
	$validasi=mysqli_query($con,"UPDATE latihan SET status='Absen Selesai' where id_latihan=$id_latihan");
		if ($validasi) {
			echo "<script>alert('Absen berhasil disimpan');window.location.href='index.php?p=absen'</script>";
			//header('location: index.php?p=absen');
		}else{
		echo "Error: ".$validasi;
	}
?>