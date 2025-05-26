<?php
include 'header.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi']=='tambah') { ?>
        <div class="container">
            <div class="row">
                <ul class="breadcrumb"><h4>KRITERIA/ TAMBAH DATA</h4></ul>
            </div>
        </div>

        <div class="panel container">
            <div class="bootsrap-table">
                <form action="kriteria-proses.php?proses=simpan" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Kriteria</label>
                        <input type="text" name="nama_kriteria" class="form-control" placeholder="nama kriteria">
                    </div>

                    <div class="form-group">
                        <label>Bobot Kriteria</label>
                        <input type="text" name="bobot_kriteria" class="form-control" placeholder="bobot kriteria">
                    </div>

                    <div class="form-group">
                        <label>Jenis Kriteria</label>
                        <div class="form-group">
                            <select name="jenis_kriteria" class="form-control" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="benefit">Benefit</option>
                                <option value="cost">Cost</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="kriteria.php" class="btn btn-primary">Batal</a>
                        <input type="submit" class="btn btn-danger" value="SIMPAN">
                     </div>
                </form>
            </div>
        </div>
        
   <?php } elseif ($_GET['aksi'] == 'ubah') { ?>

    <div class="container">
        <div class="row">
            <ul class="breadcrumb"><h4>KRITERIA/ UBAH DATA</h4></ul>
        </div>
    </div>

    <div class="panel container">
        <div class="bootsrap-table">
            <?php
            $data = mysqli_query($conn, "SELECT * FROM tbl_kriteria WHERE id_kriteria='" . $_GET['id_kriteria'] . "'");
            while ($a = mysqli_fetch_array($data)) { ?>
                <form action="kriteria-proses.php?proses=ubah" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="kriteria" value="<?php echo $a['id_kriteria']; ?>">
                    <div class="form-group">
                        <label>Nama Kriteria</label>
                        <input type="text" name="nama_kriteria" class="form-control" value="<?php echo $a['nama_kriteria']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Bobot Kriteria</label>
                        <input type="text" name="bobot_kriteria" class="form-control" value="<?php echo $a['bobot_kriteria']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Jenis Kriteria</label>
                        <div class="form-group">
                            <select name="jenis_kriteria" class="form-control" required>
                                <option value="benefit" <?php if ($a['jenis_kriteria'] == 'benefit') echo 'selected'; ?>>Benefit</option>
                                <option value="cost" <?php if ($a['jenis_kriteria'] == 'cost') echo 'selected'; ?>>Cost</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <a href="kriteria.php" class="btn btn-primary">Batal</a>
                        <input type="submit" class="btn btn-danger" value="UBAH">
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>

<?php } }?>

