<!-- .modal -->
    <div id="m-fb{{$rincian->id}}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit Bukti</h5>
                </div>
            <form method="post" role="form" action="{{ route('fileBukti' , ['id' => $rincian->id]) }}" enctype="multipart/form-data" id="myForm{{$rincian->id}}">
                {{ csrf_field() }}
                <div class="modal-body text-left p-lg">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-md-left">{{ __('Biaya Realisasi (Rp)') }}</label>
                        <div class="col-md-8">

                            <input id="biayaterpakai{{$rincian->id}}" type="text" placeholder="Masukkan Biaya Realisasi" class="form-control {{ $errors->has('biayaterpakai') ? ' is-invalid' : '' }}" name="biayaterpakai" value="{{ old('biayaterpakai') }}" required autofocus>

                            @if ($errors->has('biayaterpakai'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('biayaterpakai') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                      <label for="file" class="col-md-4 col-form-label text-md-left">{{ __('File Bukti') }}</label>
                      <div class="col-md-8">
                          <input type="file" name="file" style="font-size: 15px" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" id="file" value="{{ old('file') }}" required>
                          @if ($errors->has('file'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('file') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md"
                            data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary p-x-md">
                            &nbsp;Submit&nbsp;
                    </button>
                </div>
            </form>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->

