<form action="{{ url('/barang/' . $barang->barang_id . '/update_ajax') }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Barang</label>
                    <input type="text" name="barang_kode" class="form-control" value="{{ $barang->barang_kode }}" required>
                    <small id="error-barang_kode" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="barang_nama" class="form-control" value="{{ $barang->barang_nama }}" required>
                    <small id="error-barang_nama" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">- Pilih Kategori -</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->kategori_id }}" {{ $kat->kategori_id == $barang->kategori_id ? 'selected' : '' }}>
                                {{ $kat->kategori_nama }}
                            </option>
                        @endforeach
                    </select>
                    <small id="error-kategori_id" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" name="satuan" class="form-control" value="{{ $barang->satuan }}" required>
                    <small id="error-satuan" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input type="number" name="harga_beli" class="form-control" value="{{ $barang->harga_beli }}" required>
                    <small id="error-harga_beli" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Harga Jual</label>
                    <input type="number" name="harga_jual" class="form-control" value="{{ $barang->harga_jual }}" required>
                    <small id="error-harga_jual" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}" required>
                    <small id="error-stok" class="text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </div>
    </form>
    
    <script>
    $(document).ready(function () {
        $('#form-edit').validate({
            rules: {
                barang_kode: { required: true, minlength: 2, maxlength: 10 },
                barang_nama: { required: true, minlength: 3 },
                kategori_id: { required: true },
                satuan: { required: true },
                harga_beli: { required: true, number: true },
                harga_jual: { required: true, number: true },
                stok: { required: true, digits: true },
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
    