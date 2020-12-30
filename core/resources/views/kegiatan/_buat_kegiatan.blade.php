<!-- .modal -->
    <div id="m-c" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat Kegiatan</h5>
                </div>
            <form method="post" role="form" action="{{ route('kegiatanCreate') }}" enctype="multipart/form-data" id="myForm">
                {{ csrf_field() }}
                <div class="modal-body text-left p-lg">
                    {{-- nama --}}
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-left">{{ __('Nama Kegiatan') }}</label>
                        <div class="col-md-8">
                            <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required autofocus>

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
                            <select name="bulan" class="form-control{{ $errors->has('bulan') ? ' is-invalid' : '' }}" id="bulan" value="{{ old('bulan') }}" required autofocus>
                                <option hidden disabled selected value>--Pilih Bulan--</option>
                                <option value="Januari" {!! old('bulan')=="Januari" ? "selected='selected'":"" !!} data-id="Januari">Januari</option>
                                <option value="Februari" {!! old('bulan')=="Februari" ? "selected='selected'":"" !!} data-id="Februari">Februari</option>
                                <option value="Maret" {!! old('bulan')=="Maret" ? "selected='selected'":"" !!} data-id="Maret">Maret</option>
                                <option value="April" {!! old('bulan')=="April" ? "selected='selected'":"" !!} data-id="April">April</option>
                                <option value="Mei" {!! old('bulan')=="Mei" ? "selected='selected'":"" !!} data-id="Mei">Mei</option>
                                <option value="Juni" {!! old('bulan')=="Juni" ? "selected='selected'":"" !!} data-id="Juni">Juni</option>
                                <option value="Juli" {!! old('bulan')=="Juli" ? "selected='selected'":"" !!} data-id="Juli">Juli</option>
                                <option value="Agustus" {!! old('bulan')=="Agustus" ? "selected='selected'":"" !!} data-id="Agustus">Agustus</option>
                                <option value="September" {!! old('bulan')=="September" ? "selected='selected'":"" !!} data-id="September">September</option>
                                <option value="Oktober" {!! old('bulan')=="Oktober" ? "selected='selected'":"" !!} data-id="Oktober">Oktober</option>
                                <option value="November" {!! old('bulan')=="November" ? "selected='selected'":"" !!} data-id="November">November</option>
                                <option value="Desember" {!! old('bulan')=="Desember" ? "selected='selected'":"" !!} data-id="Desember">Desember</option>
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
                            <input id="maksimaldana" type="text" class="form-control{{ $errors->has('maksimaldana') ? ' is-invalid' : '' }}" name="maksimaldana" value="{{ old('maksimaldana') }}" required autofocus>

                            @if ($errors->has('maksimaldana'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('maksimaldana') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- kategori --}}
                    {{-- <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label text-md-left">{{ __('Kategori') }}</label>

                        <div class="col-md-8">
                            <select name="kategori" class="form-control{{ $errors->has('kategori') ? ' is-invalid' : '' }}" id="kategori" value="{{ old('kategori') }}" required autofocus>
                                <option hidden disabled selected value>--Pilih Kategori--</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{$kategori->id}}" {!! old('kategori')==$kategori->id ? "selected='selected'":"" !!} data-id="{{$kategori->id}}">{{$kategori->nama}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('kategori'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('kategori') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> --}}
                    {{-- unit --}}
                    <div class="form-group row">
                        <label for="unit" class="col-md-4 col-form-label text-md-left">{{ __('Unit') }}</label>

                        <div class="col-md-8">
                            <select name="unit" class="form-control{{ $errors->has('unit') ? ' is-invalid' : '' }}" id="unit" value="{{ old('unit') }}" required autofocus>
                                <option hidden disabled selected value>--Pilih Unit--</option>
                                @foreach($units as $unit)
                                <option value="{{$unit->id}}" {!! old('unit')==$unit->id ? "selected='selected'":"" !!} data-id="{{$unit->id}}">{{$unit->nama}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('unit'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('unit') }}</strong>
                                </span>
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
                    {{-- <button  class="btn btn-primary p-x-md" id="ajaxSubmit">{{ __('Simpan' ) }}</button> --}}
                </div>
            </form>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->

