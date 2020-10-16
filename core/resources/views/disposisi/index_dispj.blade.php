@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Disposisi SPJ
        </li>
    </ol>

    @include('layouts.pesan')
    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Disposisi SPJ</i>
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
                                    @if($permohonan->status == 5)
                                    <span class="bg-secondary text-light rounded" style="padding: 5px">Pending</span>
                                    @elseif($permohonan->status == 6)
                                    <span class="bg-primary text-light rounded" style="padding: 5px">Submited</span>
                                    @elseif($permohonan->status == 7)
                                    <span class="bg-success text-light rounded" style="padding: 5px">Accepted</span>
                                    @elseif($permohonan->status == 10)
                                    <span class="bg-success text-light rounded" style="padding: 5px">Success</span>
                                    @elseif($permohonan->status == 8)
                                    <span class="bg-danger text-light rounded" style="padding: 5px">Rejected</span>
                                    @endif
                                    </td>
                                    <td><a href="{{ route('dissShow' , ['permohonan' => $permohonan->slug]) }}" class="btn btn-outline-primary btn-sm">Lihat Detail SPJ</a></td>
                                    <td>
                                        @if($permohonan->status==6)
                                        <button class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#m-dt5{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate" style="font-size: 15px; background-color: red; color: white; border-radius: 2em"><i class="far fa-times-circle" style="font-size: 15px"> Tolak</i></button>
                                        @include('disposisi._dt5')
                                        <button class="btn btn-sm btn-outline-primary btn-block" data-toggle="modal" data-target="#m-d5{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate" style="font-size: 15px; background-color: green; color: white; border-radius: 2em"><i class="fa fa-forward" style="font-size: 15px"> Lanjutkan</i></button>
                                        @include('disposisi._d5')
                                        @elseif($permohonan->status==7)
                                        {{-- <button class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#m-dt6{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate" style="font-size: 15px; background-color: red; color: white; border-radius: 2em"><i class="far fa-times-circle" style="font-size: 15px"> Tolak</i></button> --}}
                                        {{-- @include('disposisi._dt6') --}}
                                        <button class="btn btn-sm btn-outline-primary btn-block" data-toggle="modal" data-target="#m-d6{{$permohonan->slug}}" ui-toggle-class="bounce" ui-target="#animate" style="font-size: 15px; background-color: green; color: white; border-radius: 2em"><i class="fa fa-forward" style="font-size: 15px"> Lanjutkan</i></button>
                                        @include('disposisi._d6')
                                        @endif
                                    </td>
                                    <td>
                                        @if( $permohonan->keterangan == null )
                                        <small>Silahkan klik tombol submit untuk melanjutkan permohonan Anda.</small>
                                        @else
                                        <small> {{ $permohonan->keterangan }} </small>
                                        @endif
                                        <br>
                                        @if($permohonan->spj_tolak_kas == null)
                                        @else
                                        <a class="btn btn-sm btn-block btn-outline-dark" href="{{ asset('spj_tolak_kas/'.$permohonan->spj_tolak_kas) }}" download="{{$permohonan->spj_tolak_kas}}"><i class="fa fa-file-download "> Download penolakan 1</i></a>
                                        @endif
                                        {{-- @if($permohonan->spj_tolak_ppk == null)
                                        @else
                                        <a class="btn btn-sm btn-block btn-outline-dark" href="{{ asset('spj_tolak_ppk/'.$permohonan->spj_tolak_ppk) }}" download="{{$permohonan->spj_tolak_ppk}}"><i class="fa fa-file-download "> Download penolakan 2</i></a>
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
            $('#m-dt5{{$permohonan->slug}}').modal('show');
            $('#m-dt6{{$permohonan->slug}}').modal('show');
        });
    @endif
@endforeach
</script>
@endsection
