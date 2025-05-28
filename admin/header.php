<?php
    session_start();
    include '../assets/connect/config.php';                   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penerapan Metode Topsis</title>
    <link rel="stylesheet" href="../assets/css/cosmo.min.css">
</head>
<body>

<style>
     body {
        padding-top: 70px;
    }
    .navbar {
        background-color:rgb(39, 40, 42); 
    }
    .navbar a {
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        transition: all 0.3s ease;
        border-radius: 5px;
        padding: 10px;
        display: inline-block;
    }
    .navbar a:hover {
        background-color: darkgoldenrod !important;   
        transform: translateX(5px); 
    }
    .navbar .nav > li.active > a {
        background-color: darkgoldenrod !important;
        color: black !important;
    }
</style>

    <?php
    $current = basename($_SERVER['PHP_SELF']);
    ?>

<nav class="navbar navbar-fixed-top">
    <div class="container">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="<?= ($current == 'index.php') ? 'active' : '' ?>"><a href="index.php">Home</a></li>
                <li class="<?= ($current == 'alternatif.php') ? 'active' : '' ?>"><a href="alternatif.php">Alternatif</a></li>
                <li class="<?= ($current == 'kriteria.php') ? 'active' : '' ?>"><a href="kriteria.php">Kriteria</a></li>
                <li class="<?= ($current == 'nilai.php') ? 'active' : '' ?>"><a href="nilai.php">Nilai Alternatif</a></li>
                <li class="<?= ($current == 'metode-topsis.php') ? 'active' : '' ?>"><a href="metode-topsis.php">Metode Topsis</a></li>
            </ul>
        </div>
    </div>     
</nav>

    
</body>
</html>