<!-- .modal -->
    <div id="m-{{ $kegiatan->id }}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                </div>
                <div class="modal-body text-center p-lg">
                    <p>
                        Anda yakin ingin menghapus?
                        <br>
                        <strong>[ {{ $kegiatan->nama }} ]</strong> <br>
                        <small>*tindakan ini akan menghapus semua id proker yang berhubungan!</small>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary p-x-md"
                            data-dismiss="modal">Tidak</button>
                    <a href="{{ route("prokerDestroy",["id"=>$kegiatan->id]) }}"
                       class="btn btn-danger p-x-md">&nbsp;Ya&nbsp;</a>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->