@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Disposisi Permohonan
        </li>
    </ol>

    @include('layouts.pesan')
    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Disposisi Permohonan</i>
            </div>

            <div class="card-body">
            	<div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th style="width:5px;">No</th>
                                <th>Nama Kegiatan</th>
                                <th>Dibuat Oleh</th>
                                {{-- <th>Tanggal Dibuat</th> --}}
                                <th>Tanggal Masuk</th>
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
                                    {{-- <td><small>{{date('d-m-Y, H:i:s', strtotime($permohonan->created_at))}}</small></td> --}}
                                    <td><small>{{date('d-m-Y, H:i:s', strtotime($permohonan->updated_at))}}</small></td>
                                    <td class="text-center">
                                    <i class="fa @if($permohonan->status==4)
                                        fa-check text-success
                                        @elseif($permohonan->status==1 || $permohonan->status==2 || $permohonan->status==3)
                                        fa-hourglass-half text-primary
                                        @else
                                        fa-times text-danger
                                        @endif inline"></i>
                                    </td>
                                    <td class="text-center"><a href="{{ route('disShow' , ['permohonan' => $permohonan->slug]) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a></td>
                                    <td>
                                        @if($permohonan->status==1)
                                        <button class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#m-d1{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="fa fa-forward" style="font-size: 15px"> Lanjutkan</i></button>
                                        @include('disposisi._d1')
                                        @elseif($permohonan->status==2)
                                        <button class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#m-d2{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate" style="margin-bottom: 5px"><i class="fa fa-forward" style="font-size: 15px"> Lanjutkan</i></button>
                                        @include('disposisi._d2')
                                        <button class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#m-dt2{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="far fa-times-circle" style="font-size: 15px"> Tolak</i></button>
                                        @include('disposisi._dt2')
                                        @elseif($permohonan->status==3)
                                        <button class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#m-d3{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate" style="margin-bottom: 5px"><i class="fa fa-forward" style="font-size: 15px"> Lanjutkan</i></button>
                                        @include('disposisi._d3')
                                        <button class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#m-dt3{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="far fa-times-circle" style="font-size: 15px"> Tolak</i></button>
                                        @include('disposisi._dt3')
                                        @elseif($permohonan->status==4)
                                        <button class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#m-d4{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate"><i class="fa fa-forward" style="font-size: 15px"> Lanjutkan</i></button>
                                        @include('disposisi._d4')
                                        @endif
                                    </td>
                                    <td>
                                        @if( $permohonan->keterangan == null )
                                        <small>Silahkan klik tombol submit untuk melanjutkan permohonan Anda.</small>
                                        @else
                                        <small> {{ $permohonan->keterangan }} </small>
                                        @endif
                                        {{-- <br>
                                        @if( $permohonan->revisi == null )
                                        @else
                                        <a class="btn btn-sm btn-block btn-outline-dark" href="{{ asset('revisi/'.$permohonan->revisi) }}" download="{{$permohonan->revisi}}"><i class="fa fa-file-download "> Download Keterangan PPK</i></a>
                                        @endif
                                        @if( $permohonan->revisi2 == null )
                                        @else
                                        <a class="btn btn-sm btn-block btn-outline-dark" href="{{ asset('revisi2/'.$permohonan->revisi2) }}" download="{{$permohonan->revisi2}}"><i class="fa fa-file-download "> Download Keterangan Kasubag</i></a>
                                        @endif --}}
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
@foreach ($permohonans as $permohonan)
    @if (count($errors) > 0 && Session::get('error_code') == $permohonan->slug)
        $(document).ready(function(){
            $('#m-dt2{{$permohonan->slug}}').modal('show');
        });
    @endif
    @if (count($errors) > 0 && Session::get('error_code') == 'dt3'.$permohonan->slug)
        $(document).ready(function(){
            $('#m-dt3{{$permohonan->slug}}').modal('show');
        });
    @endif
@endforeach
</script>
@endsection
