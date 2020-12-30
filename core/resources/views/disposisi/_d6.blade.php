
    <div id="m-d6{{$permohonan->slug}}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Lanjutkan SPJ!</h5>
                </div>
                <form method="post" role="form" action="{{ route('dis6Submit' , ['permohonan' => $permohonan->slug]) }}" enctype="multipart/form-data" id="myForm">
                {{ csrf_field() }}
                <div class="modal-body text-left p-lg">
                    {{-- nama --}}
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-left">{{ __('Nama Kegiatan') }}</label>
                        <div class="col-md-8">
                            <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ $permohonan->nama }}" disabled="disabled" autofocus>

                            @if ($errors->has('nama'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- Dibuat Oleh --}}
                    <div class="form-group row">
                        <label for="pemohon" class="col-md-4 col-form-label text-md-left">{{ __('Dibuat Oleh') }}</label>
                        <div class="col-md-8">
                            <input id="pemohon" type="text" class="form-control{{ $errors->has('pemohon') ? ' is-invalid' : '' }}" name="pemohon" value="{{ $permohonan->pemohon }}" disabled="disabled" autofocus>

                            @if ($errors->has('pemohon'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pemohon') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{--  --}}
                    <div class="form-group row">
                        <label for="keterangan" class="col-md-4 col-form-label text-md-left">{{ __('Catatan Pemohon') }}</label>
                        <div class="col-md-8">
                            <textarea name="keterangan" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" id="keterangan" value="{{ old('keterangan') }}" required>{{ old('keterangan') }}</textarea>
                            @if ($errors->has('keterangan'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('keterangan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary p-x-md"
                            data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-success p-x-md">
                            {{ __('Lanjutkan' ) }}
                    </button>
                </div>
            </form>
                {{-- <div class="modal-body text-center p-lg">
                    <p>
                        Anda yakin ingin menlanjukan?
                        <br>
                        <strong>[ {{ $permohonan->nama }} ]</strong>
                        <br>
                        <small>*Melanjukan ke pedoman SPJ akhir!</small>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md"
                            data-dismiss="modal">Tidak</button>
                    <a href="{{ route('dis6Submit' , ['permohonan' => $permohonan->slug]) }}"
                       class="btn btn-success p-x-md">&nbsp;Lanjutkan&nbsp;</a>
                </div> --}}
            </div>
        </div>
    </div>