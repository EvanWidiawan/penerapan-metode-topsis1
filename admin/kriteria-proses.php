<?php
include '../assets/connect/config.php';

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'simpan') {
        $nama_kriteria = $_POST['nama_kriteria'];
        $bobot_kriteria = $_POST['bobot_kriteria'];
        $jenis_kriteria = $_POST['jenis_kriteria'];
        mysqli_query($conn, "INSERT INTO tbl_kriteria (nama_kriteria,bobot_kriteria,jenis_kriteria) VALUES ('$nama_kriteria','$bobot_kriteria','$jenis_kriteria')");
        header("Location: kriteria.php");

    } elseif ($_GET['proses'] == 'ubah') {
        $id_kriteria = $_POST['kriteria']; // Sesuai input hidden name
        $nama_kriteria = $_POST['nama_kriteria'];
        $bobot_kriteria = $_POST['bobot_kriteria'];
        $jenis_kriteria = $_POST['jenis_kriteria'];
        mysqli_query($conn, "UPDATE tbl_kriteria SET nama_kriteria='$nama_kriteria',bobot_kriteria='$bobot_kriteria',jenis_kriteria='$jenis_kriteria' WHERE id_kriteria='$id_kriteria'");
        header("Location: kriteria.php");

    } elseif ($_GET['proses'] == 'hapus') {
        $id_kriteria = $_GET['id_kriteria'];
        mysqli_query($conn, "DELETE FROM tbl_kriteria WHERE id_kriteria='$id_kriteria'");
        header("Location: kriteria.php");
    }
}
?>
