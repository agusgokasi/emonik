@extends('layouts.backend')

@section('content')

@include('layouts.css_single_ckeditor')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            @if($permohonan->status==1)
            <a href="{{ route('dis1') }}">Disposisi Permohonan</a>
            @elseif($permohonan->status==2)
            <a href="{{ route('dis2') }}">Disposisi Permohonan</a>
            @elseif($permohonan->status==3)
            <a href="{{ route('dis3') }}">Disposisi Permohonan</a>
            @elseif($permohonan->status==4)
            <a href="{{ route('dis4') }}">Disposisi Permohonan</a>
            @endif
        </li>
        <li class="breadcrumb-item active">
            {{$permohonan->nama}}
        </li>
    </ol>

    @include('layouts.pesan')

    <div class="col-md-12 border border-dark" style="border-radius: 40px">

                <h2 class="text-center" style="margin-top: 30px">{{$permohonan->nama}}</h2>
                <br>
                <div class="nav-tabs-navigation d-flex justify-content-center">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs nav-pills nav-fill" role="tablist" id="tabMenu">
                            <li class="nav-item nav-justified">
                                <a class="flex-sm-fill text-sm-center nav-link active" data-toggle="tab" href="#home" role="tab"><i class="fas fa-home"> Detail</i></a>
                            </li>
                            <li class="nav-item nav-justified">
                                <a class="flex-sm-fill text-sm-center nav-link" data-toggle="tab" href="#profile" role="tab"><i class="fas fa-info"> Rincian Biaya</i></a>
                            </li>
                            <li class="nav-item nav-justified">
                                <a class="flex-sm-fill text-sm-center nav-link" data-toggle="tab" href="#report" role="tab"><i class="fa fa-file-download"> File TOR</i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            <!-- Tab panes -->
            <div class="tab-content container border border-info" style="border-radius: 10px">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <br>
                    <form>
                        <div class="form-group">
                            <label for="created"><i class="fa fa-id-card"> Dibuat Oleh</i></label>
                            <input type="text" class="form-control" id="created" value="{{ $permohonan->pemohon }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="pemohon"><i class="fa fa-chevron-circle-right"> Nama Kegiatan</i></label>
                            <input type="text" class="form-control" id="pemohon" value="{{ $permohonan->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="kegiatan"><i class="fa fa-place-of-worship"> Program Kerja</i></label>
                            <input type="text" class="form-control" id="kegiatan" value="{{ $permohonan->kegiatan->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="biayarincian"><i class="fa fa-money-bill-wave"> Total Usulan</i></label>
                            <input type="text" class="form-control" id="biayarincian" value="Rp{{format_uang($permohonan->biayarincian)}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="totalbiaya"><i class="fa fa-money-bill-alt"> Biaya Perencanaan</i></label>
                            <input type="text" class="form-control" id="totalbiaya" value="Rp{{format_uang($permohonan->totalbiaya)}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="latarbelakang"><i class="fa fa-edit"> Latar Belakang Kegiatan</i></label>
                            <textarea type="text" class="form-control" id="latarbelakang" value="{{ $permohonan->latarbelakang }}" readonly>{{ $permohonan->latarbelakang }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="tujuan"><i class="fa fa-pen"> Tujuan / Penerima Manfaat</i></label>
                            <textarea type="text" class="form-control" id="tujuan" value="{{ $permohonan->tujuan }}" readonly>{{ $permohonan->tujuan }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="ruanglingkup"><i class="fa fa-stream"> Ruang Lingkup / Strategi Pencapaian Keluaran</i></label>
                            <textarea type="text" class="form-control" id="ruanglingkup" value="{{ $permohonan->ruanglingkup }}" readonly>{{ $permohonan->ruanglingkup }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="waktupencapaian"><i class="fas fa-calendar-day"> Waktu Pencapaian Keluaran</i></label>
                            <textarea type="text" class="form-control" id="waktupencapaian" value="{{ $permohonan->waktupencapaian }}" readonly>{{ $permohonan->waktupencapaian }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="luaran"><i class="fas fa-calendar-check"> Susunan Acara / Luaran</i></label>
                            <textarea type="text" class="form-control" id="luaran" value="{{ $permohonan->luaran }}" readonly>{{ $permohonan->luaran }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="pembiayaan"><i class="fas fa-money-check"> Pembiayaan / Rencana Anggaran</i></label>
                            <textarea type="text" class="form-control" id="pembiayaan" value="{{ $permohonan->pembiayaan }}" readonly>{{ $permohonan->pembiayaan }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="created_at"><i class="fa fa-calendar"> Tanggal Dibuat</i></label>
                            <input type="text" class="form-control" id="created_at" value="{{date('d-m-Y, H:i:s', strtotime($permohonan->created_at))}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="updated_at"><i class="fas fa-calendar-week"> Aktivitas Terakhir</i></label>
                            <input type="text" class="form-control" id="updated_at" value="{{date('d-m-Y, H:i:s', strtotime($permohonan->updated_at))}}" readonly>
                        </div>

                    </form>



                </div>
                <div class="tab-pane" id="profile" role="tabpanel">
                    <div class="panel panel-default">
                    <br>

                        <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-striped" border="solid">
                                <table class="table table-bordered table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Jenis Belanja</th>
                                            <th scope="col">Biaya Satuan</th>
                                            <th scope="col">Volume</th>
                                            <th scope="col">Satuan</th>
                                            <th scope="col">Biaya usulan</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="">
                                        <tr>
                                            <th class="table-info" colspan="3">Biaya Perencanaan : Rp{{format_uang($permohonan->totalbiaya)}}</th>
                                            {{-- <th scope="col">Maksimal Dana</th> --}}
                                            {{-- <th>Rp.{{format_uang($permohonan->totalbiaya)}}</th> --}}
                                            <th class="table-info" colspan="3">Total Usulan : Rp{{format_uang($permohonan->biayarincian)}}</th>
                                            {{-- <th scope="col">Rp.{{format_uang($permohonan->biayarincian)}}</th> --}}
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @if($rincians->count())
                                            @foreach($rincians as $key => $rincian)
                                                <tr>
                                                    <td scope="col">{{ ++$key }}</td>
                                                    <td scope="col">{{ $rincian->jenisbelanja }}</td>
                                                    <td scope="col">Rp{{ format_uang($rincian->biayasatuan) }}</td>
                                                    <td scope="col">{{ $rincian->volume }}</td>
                                                    <td scope="col">{{ $rincian->satuan }}</td>
                                                    <td scope="col">Rp{{ format_uang($rincian->biayatotal) }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    </table>
                                </table>
                            </table>
                            </div>
                        </div>

                    </div>
                </div>
                @if ($permohonan->filetor==null)
                    <div class="tab-pane" id="report" role="tabpanel">
                        <br>
                        <p class="text-center"><i class="fas fa-book"></i> Tidak Ada File</p>
                    </div>
                @else
                    <div class="tab-pane" id="report" role="tabpanel">
                        <br>
                        <p class="text-center"><a class="btn btn-outline-primary" href="{{ asset('uploadfile/filetor/'.$permohonan->filetor) }}" download="{{$permohonan->filetor}}"><i class="fa fa-file-download "> Download file TOR</i></a></p>
                    </div>
                @endif
            </div>
            <br>
            <p class="d-flex justify-content-center">
                @if($permohonan->status==1)
                <a href="{{ route('dis1')}}" class="btn btn-outline-primary btn-md">Kembali Ke List Disposisi</a>
                @elseif($permohonan->status==2)
                <a href="{{ route('dis2')}}" class="btn btn-outline-primary btn-md">Kembali Ke List Disposisi</a>
                @elseif($permohonan->status==3)
                <a href="{{ route('dis3')}}" class="btn btn-outline-primary btn-md">Kembali Ke List Disposisi</a>
                @elseif($permohonan->status==4)
                <a href="{{ route('dis4')}}" class="btn btn-outline-primary btn-md">Kembali Ke List Disposisi</a>
                @endif
            </p>
            </div>
@endsection
@section('add_js')
@include('layouts.js_single_ckeditor')
@endsection