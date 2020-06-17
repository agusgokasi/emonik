<!-- .modal -->
    <div id="m-c" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat Prodi</h5>
                </div>
            <form method="post" role="form" action="{{ route('prodisCreate') }}" enctype="multipart/form-data" id="myForm">
                {{ csrf_field() }}
                <div class="modal-body text-left p-lg">
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-left">{{ __('Nama Prodi') }}</label>
                        <div class="col-md-8">
                            <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required autofocus>

                            @if ($errors->has('nama'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- fakultas --}}
                    <div class="form-group row">
                        <label for="fakultas" class="col-md-4 col-form-label text-md-left">{{ __('Fakultas') }}</label>

                        <div class="col-md-8">
                            <select name="fakultas" class="form-control{{ $errors->has('fakultas') ? ' is-invalid' : '' }}" id="fakultas" value="{{ old('fakultas') }}" required autofocus>
                                <option hidden disabled selected value>--Pilih Fakultas--</option>
                                @foreach($fakultases as $fakultas)
                                <option value="{{$fakultas->id}}" {!! old('fakultas')==$fakultas->id ? "selected='selected'":"" !!} data-id="{{$fakultas->id}}">{{$fakultas->nama}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('fakultas'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('fakultas') }}</strong>
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

