<?php
include '../assets/connect/config.php';

if (isset($_GET['proses'])) {
    // ====== SIMPAN NILAI BARU ======
    if ($_GET['proses'] == 'simpan') {
        $id_alternatif = $_POST['id_alternatif'];
        $nilai_kriteria = $_POST['nilai']; // array: id_kriteria => nilai

        foreach ($nilai_kriteria as $id_kriteria => $nilai) {
            mysqli_query($conn, "INSERT INTO tbl_nilai (id_alternatif, id_kriteria, nilai) 
                                 VALUES ('$id_alternatif', '$id_kriteria', '$nilai')");
        }

        header("Location: nilai.php");

    // ====== UBAH NILAI YANG SUDAH ADA ======
    } elseif ($_GET['proses'] == 'ubah') {
        $id_alternatif = $_POST['id_alternatif'];
        $nilai_kriteria = $_POST['nilai']; // array: id_kriteria => nilai

        foreach ($nilai_kriteria as $id_kriteria => $nilai) {
            // Cek apakah data sudah ada
            $cek = mysqli_query($conn, "SELECT * FROM tbl_nilai WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria'");
            if (mysqli_num_rows($cek) > 0) {
                // Jika sudah ada, update
                mysqli_query($conn, "UPDATE tbl_nilai 
                                     SET nilai='$nilai' 
                                     WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria'");
            } else {
                // Jika belum ada, insert
                mysqli_query($conn, "INSERT INTO tbl_nilai (id_alternatif, id_kriteria, nilai) 
                                     VALUES ('$id_alternatif', '$id_kriteria', '$nilai')");
            }
        }

        header("Location: nilai.php");

    // ====== HAPUS NILAI BERDASARKAN ID ALTERNATIF ======
    } elseif ($_GET['proses'] == 'hapus') {
        $id_alternatif = $_GET['id_alternatif'];
        mysqli_query($conn, "DELETE FROM tbl_nilai WHERE id_alternatif='$id_alternatif'");
        header("Location: nilai.php");
    }
}
?>
