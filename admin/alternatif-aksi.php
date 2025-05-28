<?php
include 'header.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi']=='tambah') { ?>
        <div class="container">
            <div class="row">
                <ul class="breadcrumb"><h4><b>ALTERNATIF/ TAMBAH DATA</b></h4></ul>
            </div>
        </div>

        <div class="panel container">
            <div class="bootsrap-table">
                <form action="alternatif-proses.php?proses=simpan" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Alternatif</label>
                        <input type="text" name="nama_alternatif" class="form-control" placeholder="nama alternatif">
                    </div>

                    <div class="modal-footer">
                        <a href="alternatif.php" class="btn btn-primary">Batal</a>
                        <input type="submit" class="btn btn-danger" value="SIMPAN">
                    </div>
                </form>
            </div>
        </div>
        
   <?php } elseif ($_GET['aksi'] == 'ubah') { ?>

    <div class="container">
        <div class="row">
            <ul class="breadcrumb"><h4><b>ALTERNATIF/ UBAH DATA</b></h4></ul>
        </div>
    </div>

    <div class="panel container">
        <div class="bootsrap-table">
            <?php
            $data = mysqli_query($conn, "SELECT * FROM tbl_alternatif WHERE id_alternatif='" . $_GET['id_alternatif'] . "'");
            while ($a = mysqli_fetch_array($data)) { ?>
                <form action="alternatif-proses.php?proses=ubah" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="alternatif" value="<?php echo $a['id_alternatif']; ?>">
                    <div class="form-group">
                        <label>Nama Alternatif</label>
                        <input type="text" name="nama_alternatif" class="form-control" placeholder="nama alternatif" value="<?php echo $a['nama_alternatif']; ?>">
                    </div>

                    <div class="modal-footer">
                        <a href="alternatif.php" class="btn btn-primary">Batal</a>
                        <input type="submit" class="btn btn-danger" value="UBAH">
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>

<?php } }?>

