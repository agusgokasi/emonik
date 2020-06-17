<!-- .modal -->
    <div id="m-s5{{$permohonan->slug}}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Peringatan Submit SPJ!</strong></h5>
                </div>
                <div class="modal-body text-center p-lg">
                    <p>
                        Anda belum memasukkan semua File Bukti rincian SPJ
                        <br>
                        <strong>[ Klik <a href="{{ route('spjShow' , ['permohonan' => $permohonan->slug]) }}">Disini</a> untuk mengisi File Bukti rincian SPJ! ]</strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary p-x-md"
                            data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->