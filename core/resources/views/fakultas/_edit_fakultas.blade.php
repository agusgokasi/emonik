<!-- .modal -->
    <div id="m-e-{{ $fakultase->id }}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Fakultas</h5>
                </div>
            <form method="post" role="form" action="{{ route('fakultasUpdate',["id"=>$fakultase->id]) }}" enctype="multipart/form-data" id="myForm{{ $fakultase->nama }}">
                {{ csrf_field() }}
                <div class="modal-body text-left p-lg">
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-left">{{ __('Nama Fakultas') }}</label>
                        <div class="col-md-8">
                            <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ $fakultase->nama }}" required autofocus>

                            @if ($errors->has('nama'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- status --}}
                    <div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label text-md-left">{{ __('Status') }}</label>

                        <div class="col-md-8">
                            <div class="form-check form-check-inline">
                                <input id="status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="1" {{ $fakultase->status == '1' ? 'checked' : '' }} required>
                                <label> Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="0" {{ $fakultase->status == '0' ? 'checked' : '' }} required>
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
                    <button type="button" class="btn dark-white p-x-md"
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

