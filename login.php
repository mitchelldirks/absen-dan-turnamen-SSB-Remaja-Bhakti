<?php 

  @session_start();
  include 'admin/config/connection.php';
 // error_reporting(0);
  if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * from user where username='$user' and password='$pass'";
    $query = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($query);
    $row = mysqli_num_rows($query);

    if ($row > 0) {
      //$_SESSION['logged'] = 1;
      $_SESSION['id_user']  = $data['id_user'];
      $_SESSION['name']     = $data['nama'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['level']    = $data['level'];
      //$_SESSION['img']    = $data['foto'];
      
      if ($_SESSION['level']=='admin') {
        echo "<script>alert('Login berhasil!');window.location.href='admin/index.php'</script>";  
      }elseif ($_SESSION['level']=='Pelatih') {
        $pelatih=mysqli_fetch_array(mysqli_query($con,"SELECT * from pelatih where NIP='$user'"));

        $_SESSION['id_user']= $pelatih['NIP'];
        $_SESSION['name']   = $pelatih['nama_pelatih'];
        $_SESSION['img']    = $pelatih['foto'];
        echo "<script>alert('Login berhasil!');window.location.href='admin/index.php'</script>";  
      }else{
        $murid=mysqli_fetch_array(mysqli_query($con,"SELECT * from murid where id_murid='$user'"));

        $_SESSION['id_user']= $murid['id_murid'];
        $_SESSION['name']   = $murid['nama_murid'];
        $_SESSION['img']    = $murid['foto'];
        $_SESSION["num"]    = 0;
      	echo "<script>alert('Login berhasil!');window.location.href='index.php'</script>";  
      }

    }else{
      	echo "<script>alert('Username atau Password salah!')</script>";  
    }
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="admin/assets/css/login.css">
</head>
<body>

	<div class="bawaan">
		<div class="imgBX">
			<img src="admin/assets/images/logo.png">
		</div>
		<div class="detil">
			<div class="tulisan">
				<form method="POST">
				<h2>Remaja Bhakti <br><span>Login untuk melanjutkan</span></h2>
				<div class="form">
					<div class="inputbox">
						<!-- <label>Username</label> -->
						<input type="text" name="username" placeholder="Username" class="input-full" required <?php if (isset($_POST['username'])){ echo "value='".$_POST['username']."'";} ?>>
					</div>
					<div class="inputbox">
						<!-- <label>Password</label> -->
						<input type="password" name="password" placeholder="Password" class="input-full" required >
					</div>
				</div>
				<button title="Sini Sama Oom" type="submit" name="submit" style="width: 100%">Login</button>

				<h3 class="bottom">&copy; <?=date("Y")?></h3>
				</form>
			</div>
		</div>
	</div>
</body>
</html>