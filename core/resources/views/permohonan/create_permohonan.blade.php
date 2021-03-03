@extends('layouts.backend') 

@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('permohonan') }}">Permohonan</a>
    </li>
    <li class="breadcrumb-item active">
        Buat Permohonan
    </li>
</ol>


<div class="card">

    <div class="card-header text-center">Buat Permohonan</div>

    <div class="card-body">

        <form method="post" role="form" action="{{ route('permohonanStore') }}" enctype="multipart/form-data" id="myForm">
            
            {{ csrf_field() }}

            {{-- pemohon --}}
            <div class="form-group row">
                <label for="pemohon" class="col-md-4 col-form-label text-md-left">{{ __('Nama Pemohon') }}</label>
                <div class="col-md-8">
                    <input id="pemohon" type="text" placeholder="Masukkan Nama Pemohon" class="form-control{{ $errors->has('pemohon') ? ' is-invalid' : '' }}" name="pemohon" value="{{ old('pemohon') }}" required autofocus> 
                    @if ($errors->has('pemohon'))
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $errors->first('pemohon') }}</strong>
                        </span> 
                    @endif
                </div>
            </div>

            {{-- nama --}}
            <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label text-md-left">{{ __('Nama Kegiatan') }}</label>
                <div class="col-md-8">
                    <input id="nama" type="text" placeholder="Masukkan Nama Kegiatan" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required autofocus> 
                    @if ($errors->has('nama'))
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $errors->first('nama') }}</strong>
                        </span> 
                    @endif
                </div>
            </div>

            {{-- kegiatan --}}
            <div class="form-group row">
                <label for="role" class="col-md-4 col-form-label text-md-left">{{ __('Program Kerja') }}</label>

                <div class="col-md-8">
                    <select name="kegiatan" class="form-control{{ $errors->has('kegiatan') ? ' is-invalid' : '' }}" id="kegiatan" value="{{ old('kegiatan') }}" required>
                        <option hidden disabled selected value>--Pilih Program Kerja--</option>
                        @foreach($kegiatans as $kegiatan)
                        <option value="{{$kegiatan->id}}" {!! old('kegiatan')==$kegiatan->id ? "selected='selected'":"" !!}>{{$kegiatan->nama}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('kegiatan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('kegiatan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label text-md-left">{{ __('Maksimal Dana (Rp)') }}</label>
                <div class="col-md-8">

                    <input id="maksimaldana" type="text" placeholder="Pilih Program Kerja" class="form-control {{ $errors->has('maksimaldana') ? ' is-invalid' : '' }}" name="maksimaldana" 
                    @foreach($kegiatans as $kegiatan)
                        @if(old('kegiatan')==$kegiatan->maksimaldana)
                        value="{{ $kegiatan->maksimaldana }}"
                        @endif
                    @endforeach
                    disabled autofocus>

                    @if ($errors->has('maksimaldana'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('maksimaldana') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            {{-- pemohon --}}
            {{-- <div class="form-group row">
                <label for="pemohon" class="col-md-4 col-form-label text-md-left">{{ __('Nama Pemohon') }}</label>
                <div class="col-md-8">
                    <input id="pemohon" type="text" class="form-control{{ $errors->has('pemohon') ? ' is-invalid' : '' }}" name="pemohon" value="{{ old('pemohon') }}" required autofocus> 
                    @if ($errors->has('pemohon'))
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $errors->first('pemohon') }}</strong>
                        </span> 
                    @endif
                </div>
            </div> --}}

            {{-- nomorinduk --}}
            {{-- <div class="form-group row">
                <label for="nomorinduk" class="col-md-4 col-form-label text-md-left">{{ __('Nomor Induk') }}</label>

                <div class="col-md-8">
                    <input id="nomorinduk" type="text" class="form-control{{ $errors->has('nomorinduk') ? ' is-invalid' : '' }}" name="nomorinduk" value="{{ old('nomorinduk') }}" required>

                    @if ($errors->has('nomorinduk'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nomorinduk') }}</strong>
                        </span>
                    @endif
                </div>
            </div> --}}

            <div class="form-group row">
                <label for="latarbelakang" class="col-md-4 col-form-label text-md-left">{{ __('Latar Belakang') }}</label>

                <div class="col-md-8">
                    <textarea name="latarbelakang" class="form-control{{ $errors->has('latarbelakang') ? ' is-invalid' : '' }}" id="latarbelakang" value="{{ old('latarbelakang') }}" required>{{ old('latarbelakang') }}</textarea>
                    @if ($errors->has('latarbelakang'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('latarbelakang') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="role" class="col-md-4 col-form-label text-md-left">{{ __('Tujuan / Penerima Manfaat') }}</label>

                <div class="col-md-8">
                    <textarea name="tujuan" class="form-control{{ $errors->has('tujuan') ? ' is-invalid' : '' }}" id="tujuan" value="{{ old('tujuan') }}" required>{{ old('tujuan') }}</textarea>
                    @if ($errors->has('tujuan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tujuan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            {{-- <div class="form-group row">
                <label for="tanggalkegiatan" class="col-md-4 col-form-label text-md-left">{{ __('Tanggal Kegiatan') }}</label>

                <div class="col-md-8">
                    <input type="date" name="tanggalkegiatan" class="form-control{{ $errors->has('tanggalkegiatan') ? ' is-invalid' : '' }}" id="tanggalkegiatan" value="{{ old('tanggalkegiatan') }}" required>
                    @if ($errors->has('tanggalkegiatan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tanggalkegiatan') }}</strong>
                        </span>
                    @endif
                </div>
            </div> --}}

            <div class="form-group row">
                <label for="ruanglingkup" class="col-md-4 col-form-label text-md-left">{{ __('Ruang Lingkup / Strategi Pencapaian Keluaran') }}</label>

                <div class="col-md-8">
                    <textarea name="ruanglingkup" class="form-control{{ $errors->has('ruanglingkup') ? ' is-invalid' : '' }}" id="ruanglingkup" value="{{ old('ruanglingkup') }}" required>{{ old('ruanglingkup') }}</textarea>
                    @if ($errors->has('ruanglingkup'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ruanglingkup') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="waktupencapaian" class="col-md-4 col-form-label text-md-left">{{ __('Waktu Pencapaian Keluaran') }}</label>

                <div class="col-md-8">
                    <textarea name="waktupencapaian" class="form-control{{ $errors->has('waktupencapaian') ? ' is-invalid' : '' }}" id="waktupencapaian" value="{{ old('waktupencapaian') }}" required>{{ old('waktupencapaian') }}</textarea>


                    @if ($errors->has('waktupencapaian'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('waktupencapaian') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="luaran" class="col-md-4 col-form-label text-md-left">{{ __('Susunan Acara / Luaran') }}</label>

                <div class="col-md-8">
                    <textarea name="luaran" class="form-control{{ $errors->has('luaran') ? ' is-invalid' : '' }}" id="luaran" value="{{ old('luaran') }}" required>{{ old('luaran') }}</textarea>
                    @if ($errors->has('luaran'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('luaran') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="pembiayaan" class="col-md-4 col-form-label text-md-left">{{ __('Pembiayaan / Rencana Anggaran') }}</label>

                <div class="col-md-8">
                    <textarea name="pembiayaan" class="form-control{{ $errors->has('pembiayaan') ? ' is-invalid' : '' }}" id="pembiayaan" value="{{ old('pembiayaan') }}" required>{{ old('pembiayaan') }}</textarea>
                    @if ($errors->has('pembiayaan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('pembiayaan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="filetor" class="col-md-4 col-form-label text-md-left">{{ __('File TOR') }}</label>
                <div class="col-md-8">
                    <input type="file" name="filetor" class="form-control{{ $errors->has('filetor') ? ' is-invalid' : '' }}" id="filetor" value="{{ old('filetor') }}" required>
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
                        <a class="btn btn-outline-secondary rounded" href="{{ route('permohonan') }}">{{ __('Kembali') }}</a>
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
@include('layouts.form_ckeditor')
<script>
    $(document).ready(function() {
    $('select[name="kegiatan"]').on('change', function(){
        var kegiatanID = $(this).val();
        if(kegiatanID) {
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                url: 'getProkers/'+kegiatanID,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('input[name="maksimaldana"]').val('--Please Wait--');
                },
                success:function(data) {
                    // console.log(data);
                    $('input[name="maksimaldana"]').empty();
                    if(data == ''){
                        // console.log(data);
                        $('input[name="maksimaldana"]').val('--Tidak Ada--');
                    }
                    else{
                    $.each(data, function(){
                        // console.log(data);
                            $('input[name="maksimaldana"]').mask("000.000.000.000", {reverse: true}).val(data).trigger('input');
                        });
                    }
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        }
        else {
            $('input[name="maksimaldana"]').empty();
            $('input[name="maksimaldana"]').val('--Tidak Ada--');
        }

    });

});
$(document).ready(function($){
    $("#maksimaldana").mask("000.000.000.000", {reverse: true});
        $("#myForm").submit(function() {
            $("#maksimaldana").unmask();
        });
});
</script>
@endsection