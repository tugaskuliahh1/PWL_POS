<form action="{{ url('/barang/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Barang</label>
                    <input type="text" name="barang_kode" class="form-control" required>
                    <small id="error-barang_kode" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="barang_nama" class="form-control" required>
                    <small id="error-barang_nama" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">- Pilih Kategori -</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->kategori_id }}">{{ $kat->kategori_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-kategori_id" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input type="number" name="harga_beli" class="form-control" required>
                    <small id="error-harga_beli" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Harga Jual</label>
                    <input type="number" name="harga_jual" class="form-control" required>
                    <small id="error-harga_jual" class="text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
    </form>
    
    <script>
    $(document).ready(function () {
        $('#form-tambah').validate({
            rules: {
                barang_kode: { required: true, minlength: 2, maxlength: 10 },
                barang_nama: { required: true, minlength: 3 },
                kategori_id: { required: true },
                harga_beli: { required: true, number: true },
                harga_jual: { required: true, number: true },
            },
            submitHandler: function (form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function (res) {
                        if (res.status) {
                            $('#myModal').modal('hide');
                            Swal.fire('Berhasil', res.message, 'success');
                            dataBarang.ajax.reload();
                        } else {
                            $('.text-danger').text('');
                            $.each(res.msgField, function (key, val) {
                                $('#error-' + key).text(val[0]);
                            });
                            Swal.fire('Error', res.message, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });
    </script>
    