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

            {{-- Proker --}}
            <div class="form-group row">
                <label for="role" class="col-md-4 col-form-label text-md-left">{{ __('Program Kerja') }}</label>

                <div class="col-md-8">
                    <select name="kegiatan" class="form-control{{ $errors->has('kegiatan') ? ' is-invalid' : '' }}" id="kegiatan" value="{{ old('kegiatan') }}" readonly>
                        <option value="{{$permohonan->kegiatan_id}}" selected>{{$permohonan->kegiatan->nama}}</option>
                    </select>
                    @if ($errors->has('kegiatan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('kegiatan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            {{-- Maksimal Dana --}}
            <div class="form-group row">
                <label class="col-sm-4 col-form-label text-md-left">{{ __('Maksimal Dana (Rp)') }}</label>
                <div class="col-md-8">

                    <input id="maksimaldana" type="text" class="form-control {{ $errors->has('maksimaldana') ? ' is-invalid' : '' }}" name="maksimaldana" value="{{ $permohonan->kegiatan->maksimaldana }}" disabled autofocus>
                    @if ($errors->has('maksimaldana'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('maksimaldana') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            {{-- Latar Belakang --}}
            <div class="form-group row">
                <label for="latarbelakang" class="col-md-4 col-form-label text-md-left">{{ __('Latar Belakang') }}</label>

                <div class="col-md-8">
                    <textarea name="latarbelakang" class="form-control{{ $errors->has('latarbelakang') ? ' is-invalid' : '' }}" id="latarbelakang" value="{{ $permohonan->latarbelakang }}" required>{{ $permohonan->latarbelakang }}</textarea>
                    @if ($errors->has('latarbelakang'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('latarbelakang') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            {{-- Tujuan / Penerima Manfaat --}}
            <div class="form-group row">
                <label for="role" class="col-md-4 col-form-label text-md-left">{{ __('Tujuan / Penerima Manfaat') }}</label>

                <div class="col-md-8">
                    <textarea name="tujuan" class="form-control{{ $errors->has('tujuan') ? ' is-invalid' : '' }}" id="tujuan" value="{{ $permohonan->tujuan }}" required>{{ $permohonan->tujuan }}</textarea>
                    @if ($errors->has('tujuan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tujuan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            {{-- Ruang Lingkup / Strategi Pencapaian Keluaran --}}
            <div class="form-group row">
                <label for="ruanglingkup" class="col-md-4 col-form-label text-md-left">{{ __('Ruang Lingkup / Strategi Pencapaian Keluaran') }}</label>

                <div class="col-md-8">
                    <textarea name="ruanglingkup" class="form-control{{ $errors->has('ruanglingkup') ? ' is-invalid' : '' }}" id="ruanglingkup" value="{{ $permohonan->ruanglingkup }}" required>{{ $permohonan->ruanglingkup }}</textarea>
                    @if ($errors->has('ruanglingkup'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ruanglingkup') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            {{-- Waktu Pencapaian Keluaran --}}
            <div class="form-group row">
                <label for="waktupencapaian" class="col-md-4 col-form-label text-md-left">{{ __('Waktu Pencapaian Keluaran') }}</label>

                <div class="col-md-8">
                    <textarea name="waktupencapaian" class="form-control{{ $errors->has('waktupencapaian') ? ' is-invalid' : '' }}" id="waktupencapaian" value="{{ $permohonan->waktupencapaian }}" required>{{ $permohonan->waktupencapaian }}</textarea>


                    @if ($errors->has('waktupencapaian'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('waktupencapaian') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            {{-- Susunan Acara / Luaran --}}
            <div class="form-group row">
                <label for="luaran" class="col-md-4 col-form-label text-md-left">{{ __('Susunan Acara / Luaran') }}</label>

                <div class="col-md-8">
                    <textarea name="luaran" class="form-control{{ $errors->has('luaran') ? ' is-invalid' : '' }}" id="luaran" value="{{ $permohonan->luaran }}" required>{{ $permohonan->luaran }}</textarea>
                    @if ($errors->has('luaran'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('luaran') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            {{-- Pembiayaan / Rencana Anggaran --}}
            <div class="form-group row">
                <label for="pembiayaan" class="col-md-4 col-form-label text-md-left">{{ __('Pembiayaan / Rencana Anggaran') }}</label>

                <div class="col-md-8">
                    <textarea name="pembiayaan" class="form-control{{ $errors->has('pembiayaan') ? ' is-invalid' : '' }}" id="pembiayaan" value="{{ $permohonan->pembiayaan }}" required>{{ $permohonan->pembiayaan }}</textarea>
                    @if ($errors->has('pembiayaan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('pembiayaan') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            {{-- File TOR --}}
            <div class="form-group row">
                <label for="filetor" class="col-md-4 col-form-label text-md-left">{{ __('File TOR') }}</label>
                <div class="col-md-8">
                    <input type="file" name="filetor" class="form-control{{ $errors->has('filetor') ? ' is-invalid' : '' }}" id="filetor" value="{{ old('filetor') }}">
                    @if ($errors->has('filetor'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('filetor') }}</strong>
                        </span>
                    @else
                        <span class="feedback" role="alert">
                            <small><strong>*Kosongkan bila tidak ingin mengubah</strong></small>
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
@include('layouts.form_ckeditor')
<script>
    $(document).ready(function() {
    $('select[name="kegiatan"]').on('change', function(){
        var kegiatanID = $(this).val();
        if(kegiatanID) {
            $.ajax({
                url: '/emonik/permohonan/getProkers/'+kegiatanID,
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