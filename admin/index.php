<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Ecommerce</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body class="container p-4">
    <h2 class="mb-3">Login E-Commerce</h2>
    <hr>
    <form method="post" action="#">
        <div class="form-group mb-3">
            <label for="user">Username</label>
            <input type="text" class="form-control" id="user" name="user">
        </div>
        <div class="form-group mb-3">
            <label for="pass">Password</label>
            <input type="password" class="form-control" id="pass" name="pass">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
<?php
    include('../config/koneksi.php');

    if (isset($_POST['user'])) {

        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $sql = "SELECT password FROM admin WHERE username='$user'";
        $pesan = "";
        $login = false;
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_array($query);
            if ($data['password'] == md5($pass)) {
                $pesan = "Login berhasil.";
                $login = true;
            } else {
                $pesan = "Password salah.";
            }
        } else {
            $pesan = "Username tidak ditemukan.";
        }

        echo "<script>
                alert('$pesan');
              </script>";
        if($login == true) {
            session_start();
            $_SESSION['namauser'] = $user;

            echo "<script>
                location.href='home.php';
              </script>";
        }
    }
?>