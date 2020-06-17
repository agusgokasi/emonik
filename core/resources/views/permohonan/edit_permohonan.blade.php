@extends('layouts.backend') 

@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('permohonan') }}">Permohonan</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('permohonanShow' , ['permohonan' => $permohonan->slug]) }}">{{$permohonan->nama}}</a>
    </li>
    <li class="breadcrumb-item active">
        Edit Permohonan
    </li>
</ol>


<div class="card">

    <div class="card-header text-center">Edit Permohonan</div>

    <div class="card-body">

        <form method="post" role="form" action="{{ route('permohonanUpdate', ['permohonan' => $permohonan->slug]) }}" enctype="multipart/form-data" id="myForm">
            
            {{ csrf_field() }}
            {{-- nama --}}
            <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label text-md-left">{{ __('Nama Kegiatan') }}</label>
                <div class="col-md-8">
                    <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ $permohonan->nama }}" required autofocus> 
                    @if ($errors->has('nama'))
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $errors->first('nama') }}</strong>
                        </span> 
                    @endif
                </div>
            </div>

            {{-- kegiatan --}}
            <div class="form-group row">
                <label for="role" class="col-md-4 col-form-label text-md-left">{{ __('Kategori') }}</label>

                <div class="col-md-8">
                    <select name="kegiatan" class="form-control{{ $errors->has('kegiatan') ? ' is-invalid' : '' }}" id="kegiatan" value="{{ $permohonan->kegiatan_id }}" required>
                        <option value="{{$permohonan->kegiatan_id}}" data-id="{{$permohonan->kegiatan_id}}" selected>{{$permohonan->kegiatan->nama}}</option>
                        @foreach($kegiatans as $kegiatan)
                        <option value="{{$kegiatan->id}}" data-id="{{$kegiatan->id}}">{{$kegiatan->nama}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('kegiatan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('kegiatan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            {{-- pemohon --}}
            <div class="form-group row">
                <label for="pemohon" class="col-md-4 col-form-label text-md-left">{{ __('Nama Pemohon') }}</label>
                <div class="col-md-8">
                    <input id="pemohon" type="text" class="form-control{{ $errors->has('pemohon') ? ' is-invalid' : '' }}" name="pemohon" value="{{ $permohonan->pemohon }}" required autofocus> 
                    @if ($errors->has('pemohon'))
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $errors->first('pemohon') }}</strong>
                        </span> 
                    @endif
                </div>
            </div>

            {{-- nomorinduk --}}
            <div class="form-group row">
                <label for="nomorinduk" class="col-md-4 col-form-label text-md-left">{{ __('Nomor Induk') }}</label>

                <div class="col-md-8">
                    <input id="nomorinduk" type="text" class="form-control{{ $errors->has('nomorinduk') ? ' is-invalid' : '' }}" name="nomorinduk" value="{{ $permohonan->nomorinduk }}" required>

                    @if ($errors->has('nomorinduk'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nomorinduk') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="latarbelakangkegiatan" class="col-md-4 col-form-label text-md-left">{{ __('Latar Belakang Kegiatan') }}</label>

                <div class="col-md-8">
                    <textarea name="latarbelakangkegiatan" class="form-control{{ $errors->has('latarbelakangkegiatan') ? ' is-invalid' : '' }}" id="latarbelakangkegiatan" value="{{ $permohonan->latarbelakangkegiatan }}" required>{{ $permohonan->latarbelakangkegiatan }}</textarea>
                    @if ($errors->has('latarbelakangkegiatan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('latarbelakangkegiatan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="role" class="col-md-4 col-form-label text-md-left">{{ __('Tujuan Kegiatan') }}</label>

                <div class="col-md-8">
                    <textarea name="tujuankegiatan" class="form-control{{ $errors->has('tujuankegiatan') ? ' is-invalid' : '' }}" id="tujuankegiatan" value="{{ $permohonan->tujuankegiatan }}" required>{{ $permohonan->tujuankegiatan }}</textarea>
                    @if ($errors->has('tujuankegiatan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tujuankegiatan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="tempatkegiatan" class="col-md-4 col-form-label text-md-left">{{ __('Tempat Kegiatan') }}</label>

                <div class="col-md-8">
                    <input type="text" name="tempatkegiatan" class="form-control{{ $errors->has('tempatkegiatan') ? ' is-invalid' : '' }}" id="tempatkegiatan" value="{{ $permohonan->tempatkegiatan }}" required>
                    @if ($errors->has('tempatkegiatan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tempatkegiatan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="tanggalkegiatan" class="col-md-4 col-form-label text-md-left">{{ __('Tanggal Kegiatan') }}</label>

                <div class="col-md-8">
                    <input type="date" name="tanggalkegiatan" class="form-control{{ $errors->has('tanggalkegiatan') ? ' is-invalid' : '' }}" id="tanggalkegiatan" value="{{ $permohonan->tanggalkegiatan }}" required>
                    @if ($errors->has('tanggalkegiatan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tanggalkegiatan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="pesertakegiatan" class="col-md-4 col-form-label text-md-left">{{ __('Peserta Kegiatan') }}</label>

                <div class="col-md-8">
                    <textarea name="pesertakegiatan" class="form-control{{ $errors->has('pesertakegiatan') ? ' is-invalid' : '' }}" id="pesertakegiatan" value="{{ $permohonan->pesertakegiatan }}" required>{{ $permohonan->pesertakegiatan }}</textarea>
                    @if ($errors->has('pesertakegiatan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('pesertakegiatan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="strategipencapaiankeluaran" class="col-md-4 col-form-label text-md-left">{{ __('Strategi Pencapaian Keluaran') }}</label>

                <div class="col-md-8">
                    <textarea name="strategipencapaiankeluaran" class="form-control{{ $errors->has('strategipencapaiankeluaran') ? ' is-invalid' : '' }}" id="strategipencapaiankeluaran" value="{{ $permohonan->strategipencapaiankeluaran }}" required>{{ $permohonan->strategipencapaiankeluaran }}</textarea>


                    @if ($errors->has('strategipencapaiankeluaran'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('strategipencapaiankeluaran') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="susunanpanitia" class="col-md-4 col-form-label text-md-left">{{ __('Susunan Panitia') }}</label>

                <div class="col-md-8">
                    <textarea name="susunanpanitia" class="form-control{{ $errors->has('susunanpanitia') ? ' is-invalid' : '' }}" id="susunanpanitia" value="{{ $permohonan->susunanpanitia }}" required>{{ $permohonan->susunanpanitia }}</textarea>
                    @if ($errors->has('susunanpanitia'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('susunanpanitia') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="filetor" class="col-md-4 col-form-label text-md-left">{{ __('File TOR') }}</label>
                <div class="col-md-8">
                    <input type="file" name="filetor" class="form-control{{ $errors->has('filetor') ? ' is-invalid' : '' }}" id="filetor" value="{{ old('filetor') }}">
                    @if ($errors->has('filetor'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('filetor') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group-row">
                <br style="margin-bottom: 10px">
                <div class="form-group d-flex justify-content-end" style="margin-bottom: 50px">
                    <div>
                        <a class="btn btn-outline-secondary rounded" href="{{ route('permohonanShow' , ['permohonan' => $permohonan->slug]) }}">{{ __('Kembali') }}</a>
                        <span>&nbsp;&nbsp;</span>
                        <button type="submit" class="btn btn-primary rounded" style="padding-left: 30px; padding-right: 30px">
                            {{ __('Simpan' ) }}
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
@section('add_js')
<script>
    // jQuery(function($){
    $(document).ready(function($){
    $("#nomorinduk").mask("0000 0000 0000 0000 0000 0000", {reverse: false});
    $("#myForm").submit(function() {
        $("#nomorinduk").unmask();
        });
    });
</script>
@endsection