<?php  
    include 'header.php';
    include 'footer.php';
?>
<div class="container">
    <div class="row"> 
        <ol class="breadcrumb"><h4><b>NILAI ALTERNATIF</b></h4></ol>
    </div>

    <div class="panel panel-container">
        <div class="bootstrap-table">
            <a href="nilai-aksi.php?aksi=tambah" class="btn btn-success btn-rounded">Tambah Data</a>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered"> <!-- ganti 'borderer' jadi 'bordered' -->
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Alternatif</th>

                            <?php 
                                $query = mysqli_query($conn,"SELECT * FROM tbl_kriteria");
                                while ($b=mysqli_fetch_array($query)) {
                                    echo "<th class='text-center'>$b[nama_kriteria]</th>";
                                }
                            ?>

                            <th class="text-center">Opsi</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                        $no = 1;
                        while ($a = mysqli_fetch_array($data)) {
                            $nomor = $no++;
                            $id_alternatif = $a['id_alternatif'];
                            $nama_alternatif = $a['nama_alternatif'];
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $nomor ?></td>
                            <td class="text-center"><?php echo $nama_alternatif ?></td>

                            <?php
                                $query1 = mysqli_query($conn, "
                                SELECT nilai 
                                FROM tbl_nilai 
                                WHERE id_alternatif = '$id_alternatif' 
                                ORDER BY id_kriteria
                            ");

                            while ($result = mysqli_fetch_array($query1)) {
                                echo "<td class='text-center'>" . $result['nilai'] . "</td>";
                            }
                            ?>

                            <td class="text-center">
                                <a href="nilai-aksi.php?id_alternatif=<?php echo $a['id_alternatif']; ?>&aksi=ubah" class="btn btn-primary btn-rounded">Ubah</a>
                                <a href="nilai-proses.php?id_alternatif=<?php echo $a['id_alternatif']; ?>&proses=hapus" class="btn btn-danger btn-rounded btn-hapus">Hapus</a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>
