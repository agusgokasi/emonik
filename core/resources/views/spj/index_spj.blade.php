@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Manajemen SPJ
        </li>
    </ol>

    @include('layouts.pesan')

    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Manajemen SPJ</i>
            </div>

            <div class="card-body">
            	<div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th style="width:5px;">No</th>
                                <th>Nama Kegiatan</th>
                                <th>Dibuat Oleh</th>
                                <th>Tanggal Dibuat</th>
                                {{-- <th>Tanggal Diedit</th> --}}
                                <th style="width:30px;">Status</th>
                                <th style="width:30px;">Detail</th>
                                <th style="width:30px;">Options</th>
                                <th style="width:200px;">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($permohonans->count())
                            @foreach($permohonans as $key => $permohonan)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td><small>{{$permohonan->nama}}</small></td>
                                    <td><small>{{$permohonan->pemohon}}</small></td>
                                    <td><small>{{date('d-m-Y, H:i:s', strtotime($permohonan->created_at))}}</small></td>
                                    {{-- <td><small>{{date('d-m-Y, H:i:s', strtotime($permohonan->updated_at))}}</small></td> --}}
                                    <td class="text-center">
                                    {{-- @if($permohonan->status == 5)
                                    <span class="bg-secondary text-light rounded" style="padding: 5px">Pending</span>
                                    @elseif($permohonan->status == 6)
                                    <span class="bg-primary text-light rounded" style="padding: 5px">Submited</span>
                                    @elseif($permohonan->status == 7)
                                    <span class="bg-success text-light rounded" style="padding: 5px">Accepted</span>
                                    @elseif($permohonan->status == 10)
                                    <span class="bg-success text-light rounded" style="padding: 5px">Success</span>
                                    @elseif($permohonan->status == 8)
                                    <span class="bg-danger text-light rounded" style="padding: 5px">Rejected</span>
                                    @endif --}}
                                    <i class="fa @if($permohonan->status==10)
                                        fa-check text-success
                                        @elseif($permohonan->status==6 || $permohonan->status==7)
                                        fa-hourglass-half text-primary
                                        @else
                                        fa-times text-danger
                                        @endif inline"></i>
                                    </td>
                                    <td><a href="{{ route('spjShow' , ['permohonan' => $permohonan->slug]) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a></td>
                                    <td>
                                        @if($permohonan->status==5 || $permohonan->status==8)
                                            {{-- @if($permohonan->filespj == null)
                                            <button class="btn btn-sm btn-outline-primary btn-block" data-toggle="modal" data-target="#m-s1{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate" style="font-size: 15px; background-color: red; color: white; border-radius: 2em"><i class="fas fa-ban" style="font-size: 15px"> Submit</i></button>
                                            @include('spj._s1')
                                            @else --}}
                                            @if($permohonan->totalrincian == $permohonan->totalspj)
                                                @if($permohonan->danaterpakai < $permohonan->biayarincian)
                                                <button class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#m-s2{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="fa fa-arrow-circle-right" style="font-size: 15px"> Submit</i></button>
                                                @include('spj._s2')

                                                @elseif($permohonan->danaterpakai == $permohonan->biayarincian)
                                                <button class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#m-s3{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="fa fa-arrow-circle-right" style="font-size: 15px"> Submit</i></button>
                                                @include('spj._s3')

                                                @elseif($permohonan->danaterpakai > $permohonan->biayarincian)
                                                <button class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#m-s4{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="fas fa-ban" style="font-size: 15px"> Submit</i></button>
                                                @include('spj._s4')
                                                @endif
                                            @else
                                            <button class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#m-s5{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="fas fa-ban" style="font-size: 15px"> Submit</i></button>
                                            @include('spj._s5')

                                            @endif
                                            {{-- @endif --}}
                                        @elseif($permohonan->status==10)
                                        <button class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#m-s6{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="far fa-check-circle" style="font-size: 15px"> Selesai</i></button>
                                        @include('spj._s6')
                                        @else
                                        <button class="btn btn-sm btn-primary btn-block" data-toggle="modal" data-target="#m-s7{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="fas fa-hourglass-half" style="font-size: 15px"> Diproses</i></button>
                                        @include('spj._s7')
                                        @endif
                                    </td>
                                    <td>
                                        @if( $permohonan->keterangan == null )
                                        <small>Silahkan klik tombol submit untuk melanjutkan permohonan Anda</small>
                                        @else
                                        <small> {{ $permohonan->keterangan }} </small>
                                        @endif
                                        <br>
                                        @if($permohonan->spj_tolak_kas == null)
                                        @else
                                        <a class="btn btn-sm btn-block btn-outline-dark" href="{{ asset('spj_tolak_kas/'.$permohonan->spj_tolak_kas) }}" download="{{$permohonan->spj_tolak_kas}}"><i class="fa fa-file-download "> Download File Penolakan Kas</i></a>
                                        @endif
                                        @if($permohonan->spj_tolak_bpp == null)
                                        @else
                                        <a class="btn btn-sm btn-block btn-outline-dark" href="{{ asset('spj_tolak_bpp/'.$permohonan->spj_tolak_bpp) }}" download="{{$permohonan->spj_tolak_bpp}}"><i class="fa fa-file-download "> Download File Penolakan BPP</i></a>
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
