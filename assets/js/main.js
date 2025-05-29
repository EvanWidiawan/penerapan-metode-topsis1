document.addEventListener('DOMContentLoaded', function () {
    const hapusButtons = document.querySelectorAll('.btn-hapus');

    hapusButtons.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            const confirmDelete = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (!confirmDelete) {
                e.preventDefault(); 
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const ubahButtons = document.querySelectorAll('.btn-ubah');

    ubahButtons.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            const confirmDelete = confirm("Apakah Anda yakin ingin mengubah data ini?");
            if (!confirmDelete) {
                e.preventDefault(); 
            }
        });
    });
});