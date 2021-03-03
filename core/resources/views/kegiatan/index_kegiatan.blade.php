@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Kalender Kegiatan
        </li>
    </ol>

    @include('layouts.pesan')
    <button class="btn btn-primary" data-toggle="modal" data-target="#m-c" ui-toggle-class="bounce" ui-target="#animate">
        <i class="fa fa-plus"></i>
        Buat Kegiatan
    </button>
    @include('kegiatan._buat_kegiatan')
    <br><br>
    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Kalender Kegiatan</i>
            </div>
            <div class="card-body">
                {{-- <div class="form-group row input-tahun">
                    <label class="col-md-2 col-form-label text-md-left">{{ __('Tahun :') }}</label>
                    <div class="col-md-4">
                        <select name="tahun" class="form-control{{ $errors->has('tahun') ? ' is-invalid' : '' }}" id="tahun" value="{{ old('tahun') }}">
                        <option selected value>Semua data</option>
                        @foreach($tahuns as $tahun)
                        <option value="{{$tahun}}" {!! old('tahun')==$tahun ? "selected='selected'":"" !!}>{{$tahun}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="button" name="filter" id="filter" class="btn btn-success">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn btn-outline-secondary">Refresh</button>
                    </div>
                </div> --}}
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Maksimal Dana</th>
                                <th>Unit</th>
                                <th class="text-center" style="width:50px;">Status</th>
                                <th class="text-center" style="width:50px;">Options</th>
                                <th class="text-center" style="width:150px;">Keterangan</th>
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
                                    <td>@if($kegiatan->keterangan == 'Permohonan Belum Dibuat')
                                        <button class="btn btn-sm btn-block btn-primary" data-toggle="modal"
                                        data-target="#m-e-{{ $kegiatan->id }}" ui-toggle-class="bounce"
                                        ui-target="#animate" style="margin-bottom: 5px">
                                        <small> Edit</small>
                                        </button>
                                        @include('kegiatan._edit_kegiatan')
                                        <button class="btn btn-sm btn-block btn-danger" data-toggle="modal"
                                        data-target="#m-{{ $kegiatan->id }}" ui-toggle-class="bounce"
                                        ui-target="#animate">
                                        <small> Hapus</small>
                                        </button>
                                        <div id="m-{{ $kegiatan->id }}" class="modal fade" data-backdrop="true">
                                        <div class="modal-dialog" id="animate">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi</h5>
                                                </div>
                                                <div class="modal-body text-center p-lg">
                                                    <p>
                                                        Anda yakin ingin menghapus?
                                                        <br>
                                                        <strong>[ {{ $kegiatan->nama }} ]</strong> <br>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary p-x-md"
                                                            data-dismiss="modal">Tidak</button>
                                                    <a href="{{ route("kegiatanDestroy",["id"=>$kegiatan->id]) }}"
                                                       class="btn btn-danger p-x-md">&nbsp;Ya&nbsp;</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <script type="text/javascript">

@if (count($errors) > 0 && Session::get('error_code') == 'create')
    $(document).ready(function(){
        $('#m-c').modal('show'); 
    });
@endif

$(document).ready(function($){
    $("#maksimaldana").mask("000.000.000.000", {reverse: true});
    $("#tahunform").mask("0000", {reverse: false});
        $("#myForm").submit(function() {
            $("#maksimaldana").unmask();
            $("#tahunform").unmask();
        });
});

@foreach ($kegiatans as $kegiatan)
    @if (count($errors) > 0 && Session::get('error_code') == $kegiatan->id)
        $(document).ready(function($){
            $('#m-e-{{ $kegiatan->id }}').modal('show');
            setTimeout(function () {
               $('#m-e-{{ $kegiatan->id }}').modal('hide');
            }, 60000);
        });
    @endif

$(document).ready(function($){
    $("#maksimaldana{{ $kegiatan->id }}").mask("000.000.000.000", {reverse: true});
    $("#tahunform{{ $kegiatan->id }}").mask("0000", {reverse: false});
        $("#myForm{{ $kegiatan->id }}").submit(function() {
             $("#maksimaldana{{ $kegiatan->id }}").unmask();
             $("#tahunform{{ $kegiatan->id }}").unmask();
        });
});
@endforeach

</script>
@endsection