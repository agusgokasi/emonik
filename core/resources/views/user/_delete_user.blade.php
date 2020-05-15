<!-- .modal -->
    <div id="m-{{ $user->id }}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                </div>
                <div class="modal-body text-center p-lg">
                    <p>
                        Anda yakin ingin menghapus?
                        <br>
                        <strong>[ {{ $user->name }} ]</strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md"
                            data-dismiss="modal">Tidak</button>
                    <a href="{{ route("usersDestroy",["id"=>$user->id]) }}"
                       class="btn btn-danger p-x-md">&nbsp;Ya&nbsp;</a>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->