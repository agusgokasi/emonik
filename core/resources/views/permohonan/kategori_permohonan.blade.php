@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Kategori Permohonan
        </li>
    </ol>

    @include('layouts.pesan')

    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Kategori Permohonan Untuk Anda</i>
            </div>

            <div class="card-body">
            	<div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Bulan</th>
                                <th>Maksimal Dana</th>
                            	<th>Kategori</th>
                                <th>Unit</th>
                                <th class="text-center" style="width:50px;">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($kegiatans->count())
                            @foreach($kegiatans as $key => $kegiatan)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$kegiatan->nama}}</td>
                                    <td>{{$kegiatan->bulan}}</td>
                                    <td>Rp{{ format_uang($kegiatan->maksimaldana) }}</td>
                                    <td>@if(!$kegiatan->kategori_id)
                                        Tidak Punya Kategori
                                        @else
                                        {{$kegiatan->kategori->nama}}
                                        @endif</td>
                                    <td>@if(!$kegiatan->unit_id)
                                        Tidak Punya Unit
                                        @else
                                        {{$kegiatan->unit->nama}}
                                        @endif</td>
                                    <td>@if(!$kegiatan->keterangan)
                                        Belum Dibuat
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
