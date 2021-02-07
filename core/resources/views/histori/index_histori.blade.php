@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Histori Permohonan
        </li>
    </ol>

    @include('layouts.pesan')

    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Histori Permohonan</i>
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
                                <th>Tanggal Diedit</th>
                                <th style="width:30px;">Status</th>
                                <th style="width:30px;">Detail</th>
                                <th style="width:180px;">Keterangan</th>
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
                                    @elseif($permohonan->status == 5)
                                    <span class="bg-secondary text-light rounded" style="padding: 5px">Pending</span>
                                    @elseif($permohonan->status == 6)
                                    <span class="bg-primary text-light rounded" style="padding: 5px">Submited</span>
                                    @elseif($permohonan->status == 7)
                                    <span class="bg-success text-light rounded" style="padding: 5px">Accepted</span>
                                    @elseif($permohonan->status == 8)
                                    <span class="bg-danger text-light rounded" style="padding: 5px">Rejected</span>
                                    @elseif($permohonan->status == 9)
                                    <span class="bg-danger text-light rounded" style="padding: 5px">Rejected</span>
                                    @elseif($permohonan->status == 10)
                                    <span class="bg-success text-light rounded" style="padding: 5px">Success</span>
                                    @endif --}}
                                    <i class="fa @if($permohonan->status==4 || $permohonan->status==10)
                                        fa-check text-success
                                        @elseif($permohonan->status==1 || $permohonan->status==2 || $permohonan->status==3 || $permohonan->status==6 || $permohonan->status==7)
                                        fa-hourglass-half text-primary
                                        @else
                                        fa-times text-danger
                                        @endif inline"></i>
                                    </td>
                                    </td>
                                    <td><a href="{{ route('historiShow' , ['permohonan' => $permohonan->slug]) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a></td>
                                    <td>
                                        @if( $permohonan->keterangan == null )
                                        <small>-</small>
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
                                        @endif
                                        @if($permohonan->spj_tolak_kas == null)
                                        @else
                                        <a class="btn btn-sm btn-block btn-outline-dark" href="{{ asset('spj_tolak_kas/'.$permohonan->spj_tolak_kas) }}" download="{{$permohonan->spj_tolak_kas}}"><i class="fa fa-file-download "> Download File Penolakan SPJ</i></a>
                                        @endif
                                        @if($permohonan->spj_tolak_bpp == null)
                                        @else
                                        <a class="btn btn-sm btn-block btn-outline-dark" href="{{ asset('spj_tolak_bpp/'.$permohonan->spj_tolak_bpp) }}" download="{{$permohonan->spj_tolak_bpp}}"><i class="fa fa-file-download "> Download File Penolakan BPP</i></a> --}}
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
