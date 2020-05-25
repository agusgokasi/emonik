<!-- .modal -->
    <div id="m-p2{{$permohonan->slug}}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Peringatan Submit Permohonan!</strong></h5>
                </div>
                <div class="modal-body text-center p-lg">
                    <p> 
                        Total usulan yang anda masukkan lebih besar dari Biaya perencanaan
                        <br>
                        <strong>[ Klik <a href="{{ route('permohonanShow' , ['permohonan' => $permohonan->slug]) }}">Disini</a> untuk mengubah rincian biaya! ]</strong>
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