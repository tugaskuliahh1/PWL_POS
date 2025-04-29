@empty($level)
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    Data yang anda cari tidak ditemukan.
                </div>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/level/' . $level->level_id . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Level</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Level</label>
                        <input type="text" name="level_kode" class="form-control" value="{{ $level->level_kode }}" required>
                        <small id="error-level_nama" class="text-danger"></small>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Level</label>
                            <input type="text" name="level_nama" class="form-control" value="{{ $level->level_nama }}" required>
                            <small id="error-level_nama" class="text-danger"></small>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>

    <script>
    $(document).ready(function(){
        $('#form-edit').validate({
            rules: {
                level_kode: { required: true, minlength: 2, maxlength: 10 },
                level_nama: { required: true, minlength: 3, maxlength: 100 },
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire('Berhasil', response.message, 'success');
                            dataLevel.ajax.reload();
                        } else {
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-'+prefix).text(val[0]);
                            });
                            Swal.fire('Gagal', response.message, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });
    </script>
@endempty
