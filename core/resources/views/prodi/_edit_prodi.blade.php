<!-- .modal -->
    <div id="m-e-{{ $prodi->id }}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Prodi</h5>
                </div>
            <form method="post" role="form" action="{{ route('prodisUpdate',["id"=>$prodi->id]) }}" enctype="multipart/form-data" id="myForm{{ $prodi->id }}">
                {{ csrf_field() }}
                <div class="modal-body text-left p-lg">
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-left">{{ __('Nama Prodi') }}</label>
                        <div class="col-md-8">
                            <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ $prodi->nama }}" required autofocus>

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
                            <select name="fakultas" id="fakultas" class="form-control">
                                {{-- <option value="" {!! (!$prodi->fakultas_id) ? "selected='selected'":"" !!}>Tidak Punya Fakultas</option> --}}
                                @foreach($fakultases as $fakultas)
                                <option value="{{$fakultas->id}}" {!! ($prodi->fakultas_id==$fakultas->id) ? "selected='selected'":"" !!}>{{$fakultas->nama}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('fakultas'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('fakultas') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- status --}}
                    <div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label text-md-left">{{ __('Status') }}</label>

                        <div class="col-md-8">
                            <div class="form-check form-check-inline">
                                <input id="status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="1" {{ $prodi->status == '1' ? 'checked' : '' }} required>
                                <label> Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="0" {{ $prodi->status == '0' ? 'checked' : '' }} required>
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

