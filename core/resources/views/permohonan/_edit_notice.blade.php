<!-- .modal -->
    <div id="m-e" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Edit</h5>
                </div>
                <div class="modal-body text-center p-lg">
                    <p>
                        Pilih Tipe Edit!
                        @if($permohonan->totalrincian)
                        <p class="d-flex justify-content-center">
                        <button class="btn btn-primary" data-toggle="modal"
                                data-target="#m-ep" ui-toggle-class="bounce"
                                ui-target="#animate">
                            <i class="fa fa-edit">{{ __(' Mengedit Proker') }}</i>
                        </button></p>
                        @include('permohonan._edit_with_proker')
                        @else
                        <p class="d-flex justify-content-center"><a href="{{ route('permohonanEditp' , ['permohonan' => $permohonan->slug]) }}" class="btn btn-primary"><i class="fa fa-edit"> Mengedit Proker</i></a></p>
                        @endif
                        <p class="d-flex justify-content-center"><a href="{{ route('permohonanEdit' , ['permohonan' => $permohonan->slug]) }}" class="btn btn-primary"><i class="fa fa-edit"> Tidak Mengedit Proker</i></a></p>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary p-x-md"
                            data-dismiss="modal">Batal</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->