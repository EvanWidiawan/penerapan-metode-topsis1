<?php
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'login') {
        session_start();
        include 'assets/connect/config.php';

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = mysqli_query($conn, "SELECT * FROM tbl_akun1 WHERE username = '$username' AND password = '$password'");
        
        if ($query && mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            if ($data['level'] == 'ADMIN') {
                $_SESSION['username'] = $username;
                header("Location: admin/index.php");
                exit();
            } else {
                header("Location: index.php?pesan=gagal");
                exit();
            }
        } else {
            header("Location: index.php?pesan=gagal");
            exit();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penerapan MEtode Topsis</title>
    <link rel="stylesheet" type="text/css" href="assets/css/cosmo.min.css">

    <style type="text/css">
        .kotak{
            margin-top: 150px;
            margin-left:300px;
        }
        .kotak .input-group {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan']=='gagal') {
                echo "<div style='margin-bottom:-1px;' class='alert alert-danger' role='alert'> Login Anda Gagal, Silahkan cek Username dan Password</div>";
            }
        }
        ?>
    </div>    

    <form action="index.php?aksi=login" method="post" enctype="multipart/form-data">
        <div class="col-md-7 col-md-offset-2 kotak">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="username">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="*****">
            </div>
            
            <div class="form-group">
                <input type="submit" name="Username" class="btn btn-success" value="LOGIN">
            </div>

        </div>
    </form>
</body>
</html>