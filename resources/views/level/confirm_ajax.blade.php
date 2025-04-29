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
    <form action="{{ url('/level/' . $level->level_id . '/delete_ajax') }}" method="POST" id="form-delete">
        @csrf
        @method('DELETE')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        Apakah anda yakin ingin menghapus Level berikut ini?
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>Kode Level</th>
                            <td>{{ $level->level_kode }}</td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Level</th>
                            <td>{{ $level->level_nama }}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </form>

    <script>
    $(document).ready(function(){
        $('#form-delete').validate({
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
