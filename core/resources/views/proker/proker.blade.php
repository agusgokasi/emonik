@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Program Kerja
        </li>
    </ol>

    @include('layouts.pesan')
    <button class="btn btn-primary" data-toggle="modal" data-target="#m-c" ui-toggle-class="bounce" ui-target="#animate">
        <i class="fa fa-plus"></i>
        Buat Proker
    </button>
    @include('proker._buat_proker')
    <br><br>
    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Pengajuan Program Kerja</i>
            </div>

            <div class="card-body">
            	<div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Maksimal Dana</th>
                            	{{-- <th>Kategori</th> --}}
                                <th>Unit</th>
                                <th class="text-center" style="width:50px;">Status</th>
                                <th class="text-center" style="width:50px;">Options</th>
                                <th class="text-center" style="width:100px;">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($kegiatans->count())
                            @foreach($kegiatans as $key => $kegiatan)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$kegiatan->nama}}</td>
                                    <td>{{$kegiatan->bulan}}</td>
                                    <td>{{$kegiatan->tahun}}</td>
                                    <td>Rp{{ format_uang($kegiatan->maksimaldana) }}</td>
                                    {{-- <td>@if(!$kegiatan->kategori_id)
                                        Tidak Punya Kategori
                                        @else
                                        {{$kegiatan->kategori->nama}}
                                        @endif</td> --}}
                                    <td>@if(!$kegiatan->unit_id)
                                        Tidak Punya Unit
                                        @else
                                        {{$kegiatan->unit->nama}}
                                        @endif</td>
                                    <td class="text-center">
                                    <i class="fa @if($kegiatan->status==1)
                                        fa-check text-success
                                        @elseif($kegiatan->status==9)
                                        fa-hourglass-half text-primary
                                        @else
                                        fa-times text-danger
                                        @endif inline"></i>
                                        
                                        {{-- <i class="fa {{ ($kegiatan->status==1) ? "fa-check text-success" : "fa-times text-danger" }} inline"></i> --}}
                                    </td>
                                    <td>@if($kegiatan->status==0)
                                        <button class="btn btn-sm btn-block btn-success" data-toggle="modal"
                                            data-target="#m-s-{{ $kegiatan->id }}" ui-toggle-class="bounce"
                                            ui-target="#animate" style="margin-bottom: 5px">
                                            <small> Submit</small>
                                        </button>
                                        @include('proker._submit_proker')
                                        <button class="btn btn-sm btn-block btn-primary" data-toggle="modal"
                                                data-target="#m-e-{{ $kegiatan->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate" style="margin-bottom: 5px">
                                            <small> Edit</small>
                                        </button>
                                        @include('proker._edit_proker')
                                        <button class="btn btn-sm btn-block btn-danger" data-toggle="modal"
                                                data-target="#m-{{ $kegiatan->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate">
                                            <small> Hapus</small>
                                        </button>
                                        @include('proker._delete_proker')
                                        @else
                                        <center>-</center>
                                        @endif
                                    </td>
                                    <td>@if(!$kegiatan->keterangan)
                                        Proker Belum Disubmit
                                        @else
                                        {{$kegiatan->keterangan}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('add_js')
<script>
@if (count($errors) > 0 && Session::get('error_code') == 'create')
    $(document).ready(function(){
        $('#m-c').modal('show'); 
    });
@endif

$(document).ready(function($){
    $("#maksimaldana").mask("000.000.000.000", {reverse: true});
    $("#tahun").mask("0000", {reverse: false});
        $("#myForm").submit(function() {
            $("#maksimaldana").unmask();
            $("#tahun").unmask();
        });
});

@foreach ($kegiatans as $kegiatan)
    @if (count($errors) > 0 && Session::get('error_code') == $kegiatan->id)
        $(document).ready(function(){
            $('#m-e-{{ $kegiatan->id }}').modal('show');
        });
    @endif

$(document).ready(function($){
    $("#maksimaldana{{ $kegiatan->id }}").mask("000.000.000.000", {reverse: true});
    $("#tahun{{ $kegiatan->id }}").mask("0000", {reverse: false});
        $("#myForm{{ $kegiatan->id }}").submit(function() {
             $("#maksimaldana{{ $kegiatan->id }}").unmask();
             $("#tahun{{ $kegiatan->id }}").unmask();
        });
});
@endforeach
</script>
@endsection
