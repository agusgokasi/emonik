@extends('layouts.backend')

@section('content')

@include('layouts.css_single_ckeditor')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            @if($permohonan->status==6)
            <a href="{{ route('dis5') }}">Disposisi SPJ</a>
            @elseif($permohonan->status==7)
            <a href="{{ route('dis6') }}">Disposisi SPJ</a>
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
                            {{-- <li class="nav-item nav-justified">
                                <a class="flex-sm-fill text-sm-center nav-link" data-toggle="tab" href="#spj" role="tab"><i class="fa fa-file-upload"> File SPJ</i></a>
                            </li> --}}
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
                            <label for="danaterpakai"><i class="fa fa-money-bill-alt"> Total Realisasi</i></label>
                            <input type="text" class="form-control" id="danaterpakai" value="Rp{{format_uang($permohonan->danaterpakai)}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="sisarincian"><i class="fa fa-money-bill-alt"> Total Sisa Usulan</i></label>
                            <input type="text" class="form-control" id="sisarincian" value="Rp{{format_uang($permohonan->sisarincian)}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="sisadana"><i class="fa fa-money-bill-alt"> Total Sisa Perencanaan</i></label>
                            <input type="text" class="form-control" id="sisadana" value="Rp{{format_uang($permohonan->sisadana)}}" readonly>
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
                                            <th scope="col">Biaya Usulan</th>
                                            <th scope="col">Biaya Realisasi</th>
                                            <th scope="col">Sisa Usulan</th>
                                            <th scope="col">File Bukti</th>
                                            @if ($permohonan->status == 5)
                                            <th scope="col">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot class="">
                                        <tr>
                                            <th class="table-info" colspan="2">Biaya Perencanaan : Rp.{{format_uang($permohonan->totalbiaya)}}</th>
                                            <th class="table-info" colspan="1">Total Usulan : Rp.{{format_uang($permohonan->biayarincian)}}</th>
                                            <th class="table-info" colspan="2">Total Realisasi : Rp.{{format_uang($permohonan->danaterpakai)}}</th>
                                            <th class="table-info" colspan="2">Total Sisa Usulan : Rp.{{format_uang($permohonan->sisadana)}}</th>
                                            <th class="table-info" colspan="2">Total Sisa Perencanaan : Rp.{{format_uang($permohonan->sisarincian)}}</th>
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
                                                    <td scope="col">Rp{{ format_uang($rincian->biayaterpakai) }}</td>
                                                    <td scope="col">Rp{{ format_uang($rincian->sisabiaya) }}</td>
                                                    @if($rincian->file == null)
                                                    <td>
                                                    -
                                                    </td>
                                                    @else
                                                    <td scope="col"><p> <a class="btn btn-sm btn-block btn-success" href="{{ asset('uploadfile/file/'.$rincian->file) }}" download="{{$rincian->file}}"><i class="fa fa-file-download"> Download</i></a></p></td>
                                                    @endif
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
                <div class="tab-pane" id="report" role="tabpanel">
                    <br>
                    @if ($permohonan->filetor==null)
                    <p class="text-center"><i class="fas fa-book"></i> Tidak Ada File</p>
                    @else
                    <p class="text-center"><a class="btn btn-outline-primary" href="{{ asset('uploadfile/filetor/'.$permohonan->filetor) }}" download="{{$permohonan->filetor}}"><i class="fa fa-file-download "> Download file TOR</i></a></p>
                    @endif
                </div>
                {{-- <div class="tab-pane" id="spj" role="tabpanel">
                    <br>
                    <p class="text-center"><a class="btn btn-outline-secondary" href="{{ asset('filespj/'.$permohonan->filespj) }}" download="{{$permohonan->filespj}}"><i class="fa fa-file-download"> Download File SPJ</i></a></p>
                </div> --}}
            </div>
            <br>
            <p class="d-flex justify-content-center">
                @if($permohonan->status==6)
                <a href="{{ route('dis5')}}" class="btn btn-outline-primary btn-md">Kembali Ke List Disposisi</a>
                @elseif($permohonan->status==7)
                <a href="{{ route('dis6')}}" class="btn btn-outline-primary btn-md">Kembali Ke List Disposisi</a>
                @endif
            </p>
            </div>
@endsection
@section('add_js')
@include('layouts.js_single_ckeditor')
@endsection