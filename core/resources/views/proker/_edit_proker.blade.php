<!-- .modal -->
    <div id="m-e-{{ $kegiatan->id }}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Proker</h5>
                </div>
            <form method="post" role="form" action="{{ route('prokerUpdate',["id"=>$kegiatan->id]) }}" enctype="multipart/form-data" id="myForm{{ $kegiatan->id }}">
                {{ csrf_field() }}
                <div class="modal-body text-left p-lg">
                    {{-- nama --}}
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-left">{{ __('Nama Kegiatan') }}</label>
                        <div class="col-md-8">
                            <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ $kegiatan->nama }}" required autofocus>

                            @if ($errors->has('nama'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- bulan --}}
                    <div class="form-group row">
                        <label for="bulan" class="col-md-4 col-form-label text-md-left">{{ __('Bulan') }}</label>

                        <div class="col-md-8">
                            <select name="bulan" class="form-control{{ $errors->has('bulan') ? ' is-invalid' : '' }}" id="bulan" value="{{ $kegiatan->bulan }}" required autofocus>
                                <option value="Januari" {!! $kegiatan->bulan=="Januari" ? "selected='selected'":"" !!} data-id="Januari">Januari</option>
                                <option value="Februari" {!! $kegiatan->bulan=="Februari" ? "selected='selected'":"" !!} data-id="Februari">Februari</option>
                                <option value="Maret" {!! $kegiatan->bulan=="Maret" ? "selected='selected'":"" !!} data-id="Maret">Maret</option>
                                <option value="April" {!! $kegiatan->bulan=="April" ? "selected='selected'":"" !!} data-id="April">April</option>
                                <option value="Mei" {!! $kegiatan->bulan=="Mei" ? "selected='selected'":"" !!} data-id="Mei">Mei</option>
                                <option value="Juni" {!! $kegiatan->bulan=="Juni" ? "selected='selected'":"" !!} data-id="Juni">Juni</option>
                                <option value="Juli" {!! $kegiatan->bulan=="Juli" ? "selected='selected'":"" !!} data-id="Juli">Juli</option>
                                <option value="Agustus" {!! $kegiatan->bulan=="Agustus" ? "selected='selected'":"" !!} data-id="Agustus">Agustus</option>
                                <option value="September" {!! $kegiatan->bulan=="September" ? "selected='selected'":"" !!} data-id="September">September</option>
                                <option value="Oktober" {!! $kegiatan->bulan=="Oktober" ? "selected='selected'":"" !!} data-id="Oktober">Oktober</option>
                                <option value="November" {!! $kegiatan->bulan=="November" ? "selected='selected'":"" !!} data-id="November">November</option>
                                <option value="Desember" {!! $kegiatan->bulan=="Desember" ? "selected='selected'":"" !!} data-id="Desember">Desember</option>
                            </select>
                            @if ($errors->has('bulan'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('bulan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- tahun --}}
                    <div class="form-group row">
                        <label for="tahun" class="col-md-4 col-form-label text-md-left">{{ __('Tahun') }}</label>
                        <div class="col-md-8">
                            <input id="tahun{{ $kegiatan->id }}" type="text" class="form-control{{ $errors->has('tahun') ? ' is-invalid' : '' }}" name="tahun" value="{!! $kegiatan->tahun !!}" required autofocus>

                            @if ($errors->has('tahun'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tahun') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- maksimaldana --}}
                    @if(!$kegiatan->status)
                    <div class="form-group row">
                        <label for="maksimaldana" class="col-md-4 col-form-label text-md-left">{{ __('Usulan Dana (Rp)') }}</label>
                        <div class="col-md-8">
                            <input id="maksimaldana{{ $kegiatan->id }}" type="text" class="form-control{{ $errors->has('maksimaldana') ? ' is-invalid' : '' }}" name="maksimaldana" value="{!! $kegiatan->maksimaldana !!}" required autofocus>

                            @if ($errors->has('maksimaldana'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('maksimaldana') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary p-x-md"
                            data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary p-x-md">
                            {{ __('Simpan' ) }}
                    </button>
                </div>
            </form>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->

