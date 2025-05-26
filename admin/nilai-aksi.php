<?php
include 'header.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'tambah') { ?>

        <div class="container">
            <div class="row">
                <ul class="breadcrumb">
                    <h4>NILAI / TAMBAH DATA</h4>
                </ul>
            </div>
        </div>

        <div class="panel container">
            <div class="bootstrap-table">
                <form action="nilai-proses.php?proses=simpan" method="post">

                    <div class="form-group">
                        <label>Nama Alternatif</label>
                        <select class="form-control" name="id_alternatif" required>
                            <option selected disabled>Pilih</option>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                            while ($result = mysqli_fetch_array($query)) {
                                echo "<option value='" . $result['id_alternatif'] . "'>" . $result['nama_alternatif'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <?php
                    $query1 = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                    while ($result1 = mysqli_fetch_array($query1)) {
                        $id_kriteria = $result1['id_kriteria'];
                        $nama_kriteria = $result1['nama_kriteria'];

                        echo "<div class='form-group'>";
                        echo "<label>" . $nama_kriteria . "</label>";
                        echo "<input type='number' class='form-control' name='nilai[" . $id_kriteria . "]' placeholder='Masukkan nilai untuk " . $nama_kriteria . "' required>";
                        echo "</div>";
                    }
                    ?>

                    <div class="modal-footer">
                        <a href="nilai.php" class="btn btn-primary">Batal</a>
                        <input type="submit" class="btn btn-danger" value="SIMPAN">
                    </div>
                </form>
            </div>
        </div>

    <?php } elseif ($_GET['aksi'] == 'ubah') { ?>

        <div class="container">
            <div class="row">
                <ul class="breadcrumb">
                    <h4>NILAI / UBAH DATA</h4>
                </ul>
            </div>
        </div>

        <div class="panel container">
            <div class="bootstrap-table">
                <form action="nilai-proses.php?proses=ubah" method="post">
                    <?php
                    $id_alternatif = $_GET['id_alternatif'];
                    $query3 = mysqli_query($conn, "SELECT * FROM tbl_alternatif WHERE id_alternatif='" . $id_alternatif . "'");
                    $result3 = mysqli_fetch_array($query3);
                    ?>

                    <div class="form-group">
                        <label>Nama Alternatif</label>
                        <select class="form-control" name="id_alternatif" required>
                            <option selected value="<?php echo $result3['id_alternatif']; ?>"><?php echo $result3['nama_alternatif']; ?></option>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                            while ($result = mysqli_fetch_array($query)) {
                                echo "<option value='" . $result['id_alternatif'] . "'>" . $result['nama_alternatif'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <?php
                    $query1 = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                    while ($result1 = mysqli_fetch_array($query1)) {
                        $id_kriteria = $result1['id_kriteria'];
                        $nama_kriteria = $result1['nama_kriteria'];

                        $query4 = mysqli_query($conn, "SELECT * FROM tbl_nilai WHERE id_kriteria='$id_kriteria' AND id_alternatif='$id_alternatif'");
                        $result4 = mysqli_fetch_array($query4);
                        $nilai = $result4 ? $result4['nilai'] : "";

                        echo "<div class='form-group'>";
                        echo "<label>" . $nama_kriteria . "</label>";
                        echo "<input type='number' class='form-control' name='nilai[" . $id_kriteria . "]' value='" . $nilai . "' placeholder='Masukkan nilai untuk " . $nama_kriteria . "' required>";
                        echo "</div>";
                    }
                    ?>

                    <div class="modal-footer">
                        <a href="nilai.php" class="btn btn-primary">Batal</a>
                        <input type="submit" class="btn btn-danger" value="UBAH">
                    </div>
                </form>
            </div>
        </div>

<?php }
} ?>
