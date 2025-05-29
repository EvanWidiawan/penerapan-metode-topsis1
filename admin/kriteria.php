<?php include 'header.php' ?>
<div class="container">
    <div class="row"> 
        <ol class="breadcrumb"><h4><b>KRITERIA</b></h4></ol>
    </div>

    <div class="panel panel-container">
        <div class="bootstrap-table">
            <a href="kriteria-aksi.php?aksi=tambah" class="btn btn-success btn-rounded">Tambah Data</a>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered"> <!-- ganti 'borderer' jadi 'bordered' -->
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Kriteria</th>
                            <th class="text-center">Bobot</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Opsi</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                        $no = 1;
                        while ($a = mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td class="text-center"><?php echo $a['nama_kriteria']; ?></td>
                            <td class="text-center"><?php echo $a['bobot_kriteria']; ?></td>
                            <td class="text-center"><?php echo $a['jenis_kriteria']; ?></td>

                            <td class="text-center">
                                <a href="kriteria-aksi.php?id_kriteria=<?php echo $a['id_kriteria']; ?>&aksi=ubah" class="btn btn-primary btn-rounded">Ubah</a>
                                <a href="kriteria-proses.php?id_kriteria=<?php echo $a['id_kriteria']; ?>&proses=hapus" class="btn btn-danger btn-rounded">Hapus</a>
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
