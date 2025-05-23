<form action="{{ url('/level/import_ajax') }}" method="POST" id="form-import" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Data Level</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Download Template</label><br>
                    <a href="{{ asset('template_level.xlsx') }}" class="btn btn-success btn-sm" download>
                        <i class="fa fa-download"></i> Download Template
                    </a>
                </div>

                <div class="form-group">
                    <label>Pilih File Excel</label>
                    <input type="file" name="file_level" id="file_level" class="form-control" required>
                    <small id="error-file_level" class="form-text text-danger error-text"></small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    $("#form-import").submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status) {
                    $('#myModal').modal('hide');
                    Swal.fire('Berhasil', res.message, 'success');
                    if (typeof tableLevel !== 'undefined') {
                        tableLevel.ajax.reload();
                    }
                } else {
                    $('.error-text').text('');
                    $.each(res.msgField, function(field, val) {
                        $('#error-' + field).text(val[0]);
                    });
                    Swal.fire('Gagal', res.message, 'error');
                }
            },
            error: function(xhr) {
                Swal.fire('Error', 'Terjadi kesalahan saat mengupload file.', 'error');
            }
        });
    });
});
</script>
