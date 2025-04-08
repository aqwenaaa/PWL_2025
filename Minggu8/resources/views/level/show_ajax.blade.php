@empty($level)
    <div id="modal-master" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Data Tidak Ditemukan</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Maaf, data level tidak ditemukan.</p>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Detail Level: {{ $level->level_nama }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Kode Level</th>
                        <td>{{ $level->level_kode }}</td>
                    </tr>
                    <tr>
                        <th>Nama Level</th>
                        <td>{{ $level->level_nama }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
@endempty
