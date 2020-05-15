<!-- .modal -->
    <div id="r-e-{{$rincian->id}}" class="modal fade" data-backdrop="true">
        <div class="modal-dialog modal-lg" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Rincian</h5>
                </div>
            <form method="post" role="form" action="{{ route('rincianUpdate' , ['id' => $rincian->id]) }}" enctype="multipart/form-data" id="myForm{{$rincian->id}}">
                {{ csrf_field() }}
                <div class="modal-body text-left p-lg">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-md-left">{{ __('Nama Rincian Biaya') }}</label>
                        <div class="col-md-8">

                            <input id="jenisbelanja" type="text" placeholder="Masukkan Rincian Biaya" class="form-control {{ $errors->has('jenisbelanja') ? ' is-invalid' : '' }}" name="jenisbelanja" value="{{ $rincian->jenisbelanja }}" required autofocus>

                            @if ($errors->has('jenisbelanja'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('jenisbelanja') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-md-left">{{ __('Biaya Satuan (Rp)') }}</label>
                        <div class="col-md-8">

                            <input id="biayasatuan{{ $rincian->id }}" type="text" placeholder="Masukkan Biaya Satuan" class="form-control {{ $errors->has('biayasatuan') ? ' is-invalid' : '' }}" name="biayasatuan" value="{{ $rincian->biayasatuan }}" required autofocus>

                            @if ($errors->has('biayasatuan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('biayasatuan') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-md-left">{{ __('Volume yang dibutuhkan') }}</label>
                        <div class="col-md-8">

                            <input id="volume{{ $rincian->id }}" type="text" placeholder="Masukkan volume" class="form-control {{ $errors->has('volume') ? ' is-invalid' : '' }}" name="volume" value="{{ $rincian->volume }}" required autofocus>

                            @if ($errors->has('volume'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('volume') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-md-left">{{ __('Satuan') }}</label>
                        <div class="col-md-8">

                            <input id="satuan" type="text" placeholder="Masukkan Satuan" class="form-control {{ $errors->has('satuan') ? ' is-invalid' : '' }}" name="satuan" value="{{ $rincian->satuan }}" required autofocus>

                            @if ($errors->has('satuan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('satuan') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md"
                            data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-success p-x-md">
                            &nbsp;Edit&nbsp;
                    </button>
                </div>
            </form>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->

