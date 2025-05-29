<?php 
include 'header.php';
include 'footer.php';
?>

<div class="container">
    <div class="row"> 
        <ol class="breadcrumb"><h4><b>ALTERNATIF</b></h4></ol>
    </div>

    <div class="panel panel-container">
        <div class="bootstrap-table">
            <a href="alternatif-aksi.php?aksi=tambah" class="btn btn-success btn-rounded">Tambah Data</a>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered"> 
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Alternatif</th>
                            <th class="text-center">Opsi</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                        $no = 1;
                        while ($a = mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td class="text-center"><?php echo $a['nama_alternatif']; ?></td>
                            <td class="text-center">
                                <a href="alternatif-aksi.php?id_alternatif=<?php echo $a['id_alternatif']; ?>&aksi=ubah" class="btn btn-primary btn-rounded">Ubah</a>
                                <a href="alternatif-proses.php?id_alternatif=<?php echo $a['id_alternatif']; ?>&proses=hapus" class="btn btn-danger btn-rounded btn-hapus">Hapus</a>
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
