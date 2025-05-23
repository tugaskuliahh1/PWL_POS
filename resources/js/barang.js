$(document).ready(function () {
    $('#form-import').on('submit', function (e) {
        e.preventDefault(); // Cegah reload halaman

        let form = $(this)[0];
        let formData = new FormData(form); // Ambil semua input, termasuk file_barang

        $.ajax({
            url: '/barang/import-ajax', // Ganti jika route berbeda
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#btn-import').prop('disabled', true).text('Importing...');
            },
            success: function (response) {
                if (response.status) {
                    alert(response.message);
                    // Optional: refresh tabel barang atau halaman
                    location.reload();
                } else {
                    alert("Gagal: " + response.message);
                    console.log(response.msgField);
                }
            },
            error: function (xhr) {
                alert("Terjadi kesalahan server!");
                console.error(xhr.responseText);
            },
            complete: function () {
                $('#btn-import').prop('disabled', false).text('Import');
            }
        });
    });
});
