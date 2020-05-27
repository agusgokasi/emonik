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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th>No</th>
                            	<th>Nama Permohonan</th>
                                <th>Dibuat Oleh</th>
                                <th>Tanggal Dibuat</th>
                                <th>Tanggal Diedit</th>
                                <th>Status</th>
                                <th>Detail</th>
                                <th>Options</th>
                                <th>Keterangan</th>
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
                                    <td><small>{{date('d-m-Y, H:i:s', strtotime($permohonan->updated_at))}}</small></td>
                                    <td>
                                    @if($permohonan->status == 0)
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
                                    @endif
                                    </td>
                                    <td><a href="{{ route('disShow' , ['permohonan' => $permohonan->slug]) }}" class="btn btn-outline-primary btn-sm">Lihat Detail Permohonan</a></td>
                                    <td>
                                        @if($permohonan->status==1)
                                        <button class="btn btn-sm btn-outline-primary btn-block" data-toggle="modal" data-target="#m-d1{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate" style="font-size: 15px; background-color: green; color: white; border-radius: 2em"><i class="fa fa-forward" style="font-size: 15px"> Lanjutkan</i></button>
                                        @include('disposisi._d1')
                                        @elseif($permohonan->status==2)
                                        <button class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#m-dt2{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate" style="font-size: 15px; background-color: red; color: white; border-radius: 2em"><i class="far fa-times-circle" style="font-size: 15px"> Tolak</i></button>
                                        @include('disposisi._dt2')
                                        <button class="btn btn-sm btn-outline-primary btn-block" data-toggle="modal" data-target="#m-d2{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate" style="font-size: 15px; background-color: green; color: white; border-radius: 2em"><i class="fa fa-forward" style="font-size: 15px"> Lanjutkan</i></button>
                                        @include('disposisi._d2')
                                        @elseif($permohonan->status==3)
                                        <button class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#m-dt3{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate" style="font-size: 15px; background-color: red; color: white; border-radius: 2em"><i class="far fa-times-circle" style="font-size: 15px"> Tolak</i></button>
                                        @include('disposisi._dt3')
                                        <button class="btn btn-sm btn-outline-primary btn-block" data-toggle="modal" data-target="#m-d3{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate" style="font-size: 15px; background-color: green; color: white; border-radius: 2em"><i class="fa fa-forward" style="font-size: 15px"> Lanjutkan</i></button>
                                        @include('disposisi._d3')
                                        @elseif($permohonan->status==4)
                                        <button class="btn btn-sm btn-outline-primary btn-block" data-toggle="modal" data-target="#m-d4{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate" style="font-size: 15px; background-color: green; color: white; border-radius: 2em"><i class="fa fa-forward" style="font-size: 15px"> Lanjutkan</i></button>
                                        @include('disposisi._d4')
                                        @endif
                                    </td>
                                    <td>
                                        @if( $permohonan->keterangan == null )
                                        <small>Silahkan klik tombol submit untuk melanjutkan permohonan Anda.</small>
                                        @else
                                        <small> {{ $permohonan->keterangan }} </small>
                                        @endif
                                        <br>
                                        @if( $permohonan->revisi == null )
                                        @else
                                        <a class="btn btn-sm btn-block btn-outline-dark" href="{{ asset('revisi/'.$permohonan->revisi) }}" download="{{$permohonan->revisi}}"><i class="fa fa-file-download "> Download keterangan</i></a>
                                        @endif
                                        @if( $permohonan->revisi2 == null )
                                        @else
                                        <a class="btn btn-sm btn-block btn-outline-dark" href="{{ asset('revisi2/'.$permohonan->revisi2) }}" download="{{$permohonan->revisi2}}"><i class="fa fa-file-download "> Download Keterangan 2</i></a>
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
