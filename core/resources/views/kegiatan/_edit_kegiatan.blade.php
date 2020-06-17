<!-- .modal -->
    <div id="m-e-{{ $kegiatan->id }}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kegiatan</h5>
                </div>
            <form method="post" role="form" action="{{ route('kegiatanUpdate',["id"=>$kegiatan->id]) }}" enctype="multipart/form-data" id="myForm{{ $kegiatan->id }}">
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
                            <select name="bulan" class="form-control{{ $errors->has('bulan') ? ' is-invalid' : '' }}" id="bulan" value="{{ $kegiatan->nama }}" required autofocus>
                                <option value="Januari" {!! $kegiatan->nama=="Januari" ? "selected='selected'":"" !!} data-id="Januari">Januari</option>
                                <option value="Februari" {!! $kegiatan->nama=="Februari" ? "selected='selected'":"" !!} data-id="Februari">Februari</option>
                                <option value="Maret" {!! $kegiatan->nama=="Maret" ? "selected='selected'":"" !!} data-id="Maret">Maret</option>
                                <option value="April" {!! $kegiatan->nama=="April" ? "selected='selected'":"" !!} data-id="April">April</option>
                                <option value="Mei" {!! $kegiatan->nama=="Mei" ? "selected='selected'":"" !!} data-id="Mei">Mei</option>
                                <option value="Juni" {!! $kegiatan->nama=="Juni" ? "selected='selected'":"" !!} data-id="Juni">Juni</option>
                                <option value="Juli" {!! $kegiatan->nama=="Juli" ? "selected='selected'":"" !!} data-id="Juli">Juli</option>
                                <option value="Agustus" {!! $kegiatan->nama=="Agustus" ? "selected='selected'":"" !!} data-id="Agustus">Agustus</option>
                                <option value="September" {!! $kegiatan->nama=="September" ? "selected='selected'":"" !!} data-id="September">September</option>
                                <option value="Oktober" {!! $kegiatan->nama=="Oktober" ? "selected='selected'":"" !!} data-id="Oktober">Oktober</option>
                                <option value="November" {!! $kegiatan->nama=="November" ? "selected='selected'":"" !!} data-id="November">November</option>
                                <option value="Desember" {!! $kegiatan->nama=="Desember" ? "selected='selected'":"" !!} data-id="Desember">Desember</option>
                            </select>
                            @if ($errors->has('bulan'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('bulan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- maksimaldana --}}
                    <div class="form-group row">
                        <label for="maksimaldana" class="col-md-4 col-form-label text-md-left">{{ __('Maksimal Dana (Rp)') }}</label>
                        <div class="col-md-8">
                            <input id="maksimaldana{{ $kegiatan->id }}" type="text" class="form-control{{ $errors->has('maksimaldana') ? ' is-invalid' : '' }}" name="maksimaldana" value="{!! $kegiatan->maksimaldana !!}" required autofocus>

                            @if ($errors->has('maksimaldana'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('maksimaldana') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- kategori --}}
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label text-md-left">{{ __('Kategori') }}</label>

                        <div class="col-md-8">
                            <select name="kategori" class="form-control{{ $errors->has('kategori') ? ' is-invalid' : '' }}" id="kategori" value="{{ $kegiatan->kategori_id }}" required autofocus>
                                <option value="" {!! (!$kegiatan->kategori_id) ? "selected='selected'":"" !!}>Tidak Punya Kategori</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{$kategori->id}}" {!! $kegiatan->kategori_id==$kategori->id ? "selected='selected'":"" !!} data-id="{{$kategori->id}}">{{$kategori->nama}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('kategori'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('kategori') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- unit --}}
                    <div class="form-group row">
                        <label for="unit" class="col-md-4 col-form-label text-md-left">{{ __('Unit') }}</label>

                        <div class="col-md-8">
                            <select name="unit" class="form-control{{ $errors->has('unit') ? ' is-invalid' : '' }}" id="unit" value="{{ $kegiatan->unit_id }}" required autofocus>
                                <option value="" {!! (!$kegiatan->unit_id) ? "selected='selected'":"" !!}>Tidak Punya Unit</option>
                                @foreach($units as $unit)
                                <option value="{{$unit->id}}" {!! $kegiatan->unit_id==$unit->id ? "selected='selected'":"" !!} data-id="{{$unit->id}}">{{$unit->nama}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('unit'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('unit') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- status --}}
                    <div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label text-md-left">{{ __('Status') }}</label>

                        <div class="col-md-8">
                            <div class="form-check form-check-inline">
                                <input id="status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="1" {{ $kegiatan->status == '1' ? 'checked' : '' }} required autofocus>
                                <label> Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="0" {{ $kegiatan->status == '0' ? 'checked' : '' }} required autofocus>
                                <label> Tidak Aktif</label>
                            </div>

                            @if ($errors->has('status'))
                                <div role="alert">
                                    <small>
                                        <strong class="text-danger">{{ $errors->first('status') }}</strong>
                                    </small>
                                </div>
                            @endif
                        </div>
                    </div>
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

