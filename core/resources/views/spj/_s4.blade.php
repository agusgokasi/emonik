<!-- .modal -->
    <div id="m-s4{{$permohonan->slug}}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Peringatan Submit SPJ!</strong></h5>
                </div>
                <div class="modal-body text-center p-lg">
                    <p>
                        Total realisasi yang anda masukkan lebih besar dari Total usulan
                        <br>
                        <strong>[ Klik <a href="{{ route('spjShow' , ['permohonan' => $permohonan->slug]) }}">Disini</a> untuk mengubah File Bukti rincian SPJ! ]</strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md"
                            data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->