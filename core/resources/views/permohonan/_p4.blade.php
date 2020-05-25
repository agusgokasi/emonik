<!-- .modal -->
    <div id="m-p4{{$permohonan->slug}}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Submit Permohonan!</h5>
                </div>
                <div class="modal-body text-center p-lg">
                    <p>
                        Anda yakin ingin mensubmit?
                        <br>
                        <strong>[ {{ $permohonan->nama }} ]</strong>
                        <br>
                        <small>*Total usulan sama dengan Biaya perencanaan!</small>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md"
                            data-dismiss="modal">Tidak</button>
                    <a href="{{ route('permohonanSubmit' , ['permohonan' => $permohonan->slug]) }}"
                       class="btn btn-success p-x-md">&nbsp;Submit&nbsp;</a>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->