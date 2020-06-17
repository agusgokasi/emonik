<!-- .modal -->
    <div id="m-fspj" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit File SPJ</h5>
                </div>
            <form method="post" role="form" action="{{ route('spjFile' , ['permohonan' => $permohonan->slug]) }}" enctype="multipart/form-data" id="myForm">
                {{ csrf_field() }}
                <div class="modal-body text-left p-lg">
                    <div class="form-group row">
                        <label for="filespj" class="col-md-4 col-form-label text-md-left">{{ __('File Spj') }}</label>
                        <div class="col-md-8">
                            <input type="file" name="filespj" class="form-control{{ $errors->has('filespj') ? ' is-invalid' : '' }}" id="filespj" value="{{ old('filespj') }}" required>
                            @if ($errors->has('filespj'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('filespj') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary p-x-md"
                            data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary p-x-md">
                            {{ __('Submit' ) }}
                    </button>
                </div>
            </form>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->

