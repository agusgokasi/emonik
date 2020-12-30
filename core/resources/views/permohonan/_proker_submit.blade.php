
    <!-- .modal -->
    <div id="m-s-{{ $kegiatan->id }}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Submit Proker!</h5>
                </div>
                <div class="modal-body text-center p-lg">
                    <p>
                        Anda yakin ingin mensubmit?
                        <br>
                        <strong>[ {{ $kegiatan->nama }} ]</strong> <br>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary p-x-md"
                            data-dismiss="modal">Tidak</button>
                    <a href="{{ route("prokerSubmit",["id"=>$kegiatan->id]) }}"
                       class="btn btn-success p-x-md">&nbsp;Submit&nbsp;</a>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->