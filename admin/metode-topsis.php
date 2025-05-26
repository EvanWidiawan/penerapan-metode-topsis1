<?php
include 'header.php';
include '../assets/connect/config.php';

echo '<div class="container">
    <div class="row"> 
        <ol class="breadcrumb"><h4><b>METODE TOPSIS</b></h4></ol>
    </div>';


// 1. Ambil data
$kriteria = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
$alternatif = mysqli_query($conn, "SELECT * FROM tbl_alternatif");

// Buat array nilai
$nilai = [];
$all_alternatif = [];
while ($alt = mysqli_fetch_array($alternatif)) {
    $id_alt = $alt['id_alternatif'];
    $all_alternatif[$id_alt] = $alt['nama_alternatif'];
    $nilai[$id_alt] = [];

    $kr = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
    while ($k = mysqli_fetch_array($kr)) {
        $id_k = $k['id_kriteria'];
        $n = mysqli_query($conn, "SELECT * FROM tbl_nilai WHERE id_alternatif='$id_alt' AND id_kriteria='$id_k'");
        $r = mysqli_fetch_array($n);
        $nilai[$id_alt][$id_k] = $r ? $r['nilai'] : 0;
    }
}

// 2. Matriks Keputusan
echo "<h4>Matriks Keputusan (X)</h4><table class='table table-bordered'><thead><tr><th>Alternatif</th>";
$kriteria_arr = [];
$kriteria_result = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
while ($k = mysqli_fetch_array($kriteria_result)) {
    echo "<th>" . $k['nama_kriteria'] . "</th>";
    $kriteria_arr[$k['id_kriteria']] = [
        'nama' => $k['nama_kriteria'],
        'bobot' => $k['bobot_kriteria'],
        'tipe' => $k['jenis_kriteria']
    ];
}
echo "</tr></thead><tbody>";
foreach ($nilai as $id_alt => $nilai_alt) {
    echo "<tr><td>{$all_alternatif[$id_alt]}</td>";
    foreach ($kriteria_arr as $id_k => $data_k) {
        echo "<td>" . number_format($nilai_alt[$id_k], 0, '.', '') . "</td>";
    }
    echo "</tr>";
}
echo "</tbody></table>";

// 3. Matriks Normalisasi
$normalisasi = [];
echo "<h4>Matriks Normalisasi (R)</h4><table class='table table-bordered'><thead><tr><th>Alternatif</th>";
foreach ($kriteria_arr as $id_k => $k) echo "<th>{$k['nama']}</th>";
echo "</tr></thead><tbody>";

// Perbaikan: Hindari pembagian nol
$pembagi = [];
foreach ($kriteria_arr as $id_k => $k) {
    $jumlah = 0;
    foreach ($nilai as $id_alt => $alt_val) {
        $jumlah += pow($alt_val[$id_k], 2);
    }
    $pembagi[$id_k] = $jumlah != 0 ? sqrt($jumlah) : 1; // Gunakan 1 untuk menghindari division by zero
}

foreach ($nilai as $id_alt => $alt_val) {
    echo "<tr><td>{$all_alternatif[$id_alt]}</td>";
    foreach ($kriteria_arr as $id_k => $k) {
        $r = $alt_val[$id_k] / $pembagi[$id_k];
        $normalisasi[$id_alt][$id_k] = $r;
        echo "<td>" . number_format($r, 4, '.', '') . "</td>";
    }
    echo "</tr>";
}
echo "</tbody></table>";

// 4. Matriks Ternormalisasi Terbobot
$terbobot = [];
echo "<h4>Matriks Ternormalisasi Terbobot (Y)</h4><table class='table table-bordered'><thead><tr><th>Alternatif</th>";
foreach ($kriteria_arr as $id_k => $k) echo "<th>{$k['nama']}</th>";
echo "</tr></thead><tbody>";
foreach ($normalisasi as $id_alt => $alt_val) {
    echo "<tr><td>{$all_alternatif[$id_alt]}</td>";
    foreach ($kriteria_arr as $id_k => $k) {
        // Ubah dari dikali menjadi dibagi
        if ($alt_val[$id_k] != 0) {
            $y = $k['bobot'] * $alt_val[$id_k];
        } else {
            $y = 0; // Hindari pembagian nol
        }
        $terbobot[$id_alt][$id_k] = $y;
        echo "<td>" . number_format($y, 4, '.', '') . "</td>";
    }
    echo "</tr>";
}
echo "</tbody></table>";

// 5. Solusi Ideal Positif dan Negatif
$idealPos = [];
$idealNeg = [];

foreach ($kriteria_arr as $id_k => $k) {
    $kolom = array_column(array_map(fn($v) => [$id_k => $v[$id_k]], $terbobot), $id_k);

    if ($k['tipe'] == 'benefit') {
        $idealPos[$id_k] = max($kolom);
        $idealNeg[$id_k] = min($kolom);
    } else {
        $idealPos[$id_k] = min($kolom);
        $idealNeg[$id_k] = max($kolom);
    }
}

echo "<h4>Solusi Ideal Positif (Si<sup>+</sup>) dan Negatif (Si<sup>-</sup>)</h4><table class='table table-bordered'><thead><tr><th>Kriteria</th>";
foreach ($kriteria_arr as $id_k => $k) echo "<th>{$k['nama']}</th>";
echo "</tr></thead><tbody><tr><td>Si+</td>";
foreach ($idealPos as $val) echo "<td>" . number_format($val, 4, '.', '') . "</td>";
echo "</tr><tr><td>Si-</td>";
foreach ($idealNeg as $val) echo "<td>" . number_format($val, 4, '.', '') . "</td>";
echo "</tr></tbody></table>";

// 6. Jarak dan Preferensi
$preferensi = [];
echo "<h4>Jarak ke Solusi Ideal dan Nilai Preferensi</h4><table class='table table-bordered'><thead><tr><th>Alternatif</th><th>D+</th><th>D-</th><th>V</th></tr></thead><tbody>";
foreach ($terbobot as $id_alt => $alt_val) {
    $dplus = 0;
    $dmin = 0;
    foreach ($kriteria_arr as $id_k => $k) {
        $dplus += pow($alt_val[$id_k] - $idealPos[$id_k], 2);
        $dmin += pow($alt_val[$id_k] - $idealNeg[$id_k], 2);
    }
    $dplus = sqrt($dplus);
    $dmin = sqrt($dmin);
    $v = ($dplus + $dmin) != 0 ? $dmin / ($dplus + $dmin) : 0; // Cegah pembagian nol
    $preferensi[$id_alt] = $v;
    echo "<tr><td>{$all_alternatif[$id_alt]}</td><td>" . number_format($dplus, 4, '.', '') . "</td><td>" . number_format($dmin, 4, '.', '') . "</td><td><b>" . number_format($v, 4, '.', '') . "</b></td></tr>";
}
echo "</tbody></table>";

// 7. Ranking
arsort($preferensi);
echo "<h4>Ranking</h4><table class='table table-bordered'><thead><tr><th>Peringkat</th><th>Alternatif</th><th>Nilai Preferensi</th></tr></thead><tbody>";
$rank = 1;
foreach ($preferensi as $id => $v) {
    echo "<tr><td>{$rank}</td><td>{$all_alternatif[$id]}</td><td>" . number_format($v, 4, '.', '') . "</td></tr>";
    $rank++;
}
echo "</tbody></table></div>";
?>
