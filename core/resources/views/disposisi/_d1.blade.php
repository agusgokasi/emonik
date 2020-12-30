<!-- .modal -->
    <div id="m-d1{{$permohonan->slug}}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Lanjutkan Permohonan!</h5>
                </div>
                <div class="modal-body text-center p-lg">
                    <p>
                        Anda yakin ingin menlanjukan?
                        <br>
                        <strong>[ {{ $permohonan->nama }} ]</strong>
                        <br>
                        <small>*Melanjukan ke PPK (disposisi 2)!</small>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary p-x-md"
                            data-dismiss="modal">Tidak</button>
                    <a href="{{ route('dis1Submit' , ['permohonan' => $permohonan->slug]) }}"
                       class="btn btn-success p-x-md">&nbsp;Lanjutkan&nbsp;</a>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->