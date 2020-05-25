<!-- .modal -->
    <div id="m-dt3{{$permohonan->slug}}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi tolak permohonan</h5>
                </div>
            <form method="post" role="form" action="{{ route('dis3Tolak' , ['permohonan' => $permohonan->slug]) }}" enctype="multipart/form-data" id="myForm">
                {{ csrf_field() }}
                <div class="modal-body text-left p-lg">
                    <div class="form-group row">
                        <label for="keterangan" class="col-md-4 col-form-label text-md-left">{{ __('Alasan ditolak') }}</label>
                        <div class="col-md-8">
                            <textarea name="keterangan" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" id="keterangan" value="{{ old('keterangan') }}" required>{{ old('keterangan') }}</textarea>
                            @if ($errors->has('keterangan'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('keterangan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="revisi2" class="col-md-4 col-form-label text-md-left">{{ __('Bukti Penolakan') }}</label>
                        <div class="col-md-8">
                            <input type="file" name="revisi2" class="form-control{{ $errors->has('revisi2') ? ' is-invalid' : '' }}" id="revisi2" value="{{ old('revisi2') }}" required>
                            @if ($errors->has('revisi2'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('revisi2') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md"
                            data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger p-x-md">
                            {{ __('Tolak' ) }}
                    </button>
                </div>
            </form>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->

