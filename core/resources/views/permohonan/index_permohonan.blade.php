@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Manajemen Permohonan
        </li>
    </ol>

    @include('layouts.pesan')
    @if($kegiatans->count()==0)
    <button class="btn btn-primary" data-toggle="modal"
            data-target="#m-k" ui-toggle-class="bounce"
            ui-target="#animate">
            <i class="fa fa-plus"></i>
            Buat Permohonan
    </button>
    @include('permohonan._ck')
    @else
        @if(!$user->tor)
        <a class="btn btn-primary" href="{{ route('permohonanCreate') }}">
            <i class="fa fa-plus"></i>
            Buat Permohonan
        </a>
        @else
        <button class="btn btn-primary" data-toggle="modal"
                data-target="#m-c" ui-toggle-class="bounce"
                ui-target="#animate">
                <i class="fa fa-plus"></i>
                Buat Permohonan
        </button>
        @include('permohonan._cp')
        @endif
    @endif
    <br><br>
    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Manajemen Permohonan</i>
            </div>

            <div class="card-body">
            	<div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                    {{-- @if($permohonan->status == 0)
                                    <span class="bg-secondary text-light rounded" style="padding: 5px">Pending</span>
                                    @elseif($permohonan->status == 1)
                                    <span class="bg-primary text-light rounded" style="padding: 5px">Submited</span>
                                    @elseif($permohonan->status == 2)
                                    <span class="bg-primary text-light rounded" style="padding: 5px">Confirmed</span>
                                    @elseif($permohonan->status == 3)
                                    <span class="bg-success text-light rounded" style="padding: 5px">Accepted</span>
                                    @elseif($permohonan->status == 4)
                                    <span class="bg-success text-light rounded" style="padding: 5px">Success</span>
                                    @elseif($permohonan->status == 9)
                                    <span class="bg-danger text-light rounded" style="padding: 5px">Rejected</span>
                                    @endif --}}
                                    <i class="fa @if($permohonan->status==4)
                                        fa-check text-success
                                        @elseif($permohonan->status==1 || $permohonan->status==2 || $permohonan->status==3)
                                        fa-hourglass-half text-primary
                                        @else
                                        fa-times text-danger
                                        @endif inline"></i>
                                    </td>
                                    <td class="text-center"><a href="{{ route('permohonanShow' , ['permohonan' => $permohonan->slug]) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a></td>
                                    <td class="text-center">
                                        @if($permohonan->status==0 || $permohonan->status==9 || $permohonan->status==11)
                                            @if($permohonan->biayarincian == 0)
                                            <button class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#m-p1{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="fas fa-ban" style="font-size: 15px"> Submit</i></button>
                                            @include('permohonan._p1')

                                            @elseif($permohonan->biayarincian > $permohonan->totalbiaya)
                                            <button class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#m-p2{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="fas fa-ban" style="font-size: 15px"> Submit</i></button>
                                            @include('permohonan._p2')

                                            @elseif($permohonan->biayarincian < $permohonan->totalbiaya)
                                            <button class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#m-p3{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="fas fa-arrow-circle-right" style="font-size: 15px"> Submit</i></button>
                                            @include('permohonan._p3')

                                            @elseif($permohonan->biayarincian == $permohonan->totalbiaya)
                                            <button class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#m-p4{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="fas fa-arrow-circle-right" style="font-size: 15px"> Submit</i></button>
                                            @include('permohonan._p4')

                                            @endif
                                        @elseif($permohonan->status==4)
                                        <button class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#m-p6{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="far fa-check-circle" style="font-size: 15px"> Selesai</i></button>
                                        @include('permohonan._p6')

                                        @else
                                        <button class="btn btn-sm btn-primary btn-block" data-toggle="modal" data-target="#m-p5{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="fas fa-hourglass-half" style="font-size: 15px"> Diproses</i></button>
                                        @include('permohonan._p5')

                                        @endif
                                    </td>
                                    <td>
                                        @if( $permohonan->keterangan == null )
                                        <small>Silahkan klik tombol submit untuk melanjutkan permohonan Anda</small>
                                        @else
                                        <small> {{ $permohonan->keterangan }} </small>
                                        @endif
                                        <br>
                                        @if( $permohonan->revisi == null )
                                        @else
                                        <a class="btn btn-sm btn-block btn-outline-dark" href="{{ asset('revisi/'.$permohonan->revisi) }}" download="{{$permohonan->revisi}}"><i class="fa fa-file-download "> Download Keterangan PPK</i></a>
                                        @endif
                                        @if( $permohonan->revisi2 == null )
                                        @else
                                        <a class="btn btn-sm btn-block btn-outline-dark" href="{{ asset('revisi2/'.$permohonan->revisi2) }}" download="{{$permohonan->revisi2}}"><i class="fa fa-file-download "> Download Keterangan Kasubag</i></a>
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
