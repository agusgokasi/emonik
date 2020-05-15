@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Dashboard</a>
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
                            <li class="nav-item nav-justified">
                                <a class="flex-sm-fill text-sm-center nav-link" data-toggle="tab" href="#spj" role="tab"><i class="fa fa-file-upload"> File SPJ</i></a>
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
                            <label for="pemohon"><i class="fa fa-user"> Nama Pemohon</i></label>
                            <input type="text" class="form-control" id="pemohon" placeholder="{{ $permohonan->pemohon }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nomorinduk"><i class="fa fa-id-card"> Nomor Induk</i></label>
                            <input type="text" class="form-control" id="nomorinduk" placeholder="{{ $permohonan->nomorinduk }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="kegiatan"><i class="fa fa-place-of-worship"> Kategori Permohonan</i></label>
                            <input type="text" class="form-control" id="kegiatan" placeholder="{{ $permohonan->kegiatan->nama }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="latarbelakangkegiatan"><i class="fa fa-edit"> Latar Belakang Kegiatan</i></label>
                            <textarea type="text" class="form-control" id="latarbelakangkegiatan" placeholder="{{ $permohonan->latarbelakangkegiatan }}" disabled></textarea>
                        </div>
                        <div class="form-group">
                            <label for="latarbelakangkegiatan"><i class="fa fa-pen"> Tujuan Kegiatan</i></label>
                            <textarea type="text" class="form-control" id="latarbelakangkegiatan" placeholder="{{ $permohonan->tujuankegiatan }}" disabled></textarea>
                        </div>
                        <div class="form-group">
                            <label for="pesertakegiatan"><i class="fa fa-users"> Peserta Kegiatan</i></label>
                            <textarea type="text" class="form-control" id="pesertakegiatan" placeholder="{{ $permohonan->pesertakegiatan }}" disabled></textarea>
                        </div>
                        <div class="form-group">
                            <label for="strategipencapaiankeluaran"><i class="fa fa-stream"> Strategi pencapaian keluaran</i></label>
                            <textarea type="text" class="form-control" id="strategipencapaiankeluaran" placeholder="{{ $permohonan->strategipencapaiankeluaran }}" disabled></textarea>
                        </div>
                        <div class="form-group">
                            <label for="susunanpanitia"><i class="fa fa-users"> Susunan panitia</i></label>
                            <textarea type="text" class="form-control" id="susunanpanitia" placeholder="{{ $permohonan->susunanpanitia }}" disabled></textarea>
                        </div>
                        <div class="form-group">
                            <label for="biayarincian"><i class="fa fa-money-bill-wave"> Total Biaya</i></label>
                            <input type="text" class="form-control" id="biayarincian" placeholder="Rp{{format_uang($permohonan->biayarincian)}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="totalbiaya"><i class="fa fa-money-bill-alt"> Maksimal Dana</i></label>
                            <input type="text" class="form-control" id="totalbiaya" placeholder="Rp{{format_uang($permohonan->totalbiaya)}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="danaterpakai"><i class="fa fa-money-bill-alt"> Biaya Terpakai</i></label>
                            <input type="text" class="form-control" id="danaterpakai" placeholder="Rp{{format_uang($permohonan->danaterpakai)}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="sisarincian"><i class="fa fa-money-bill-alt"> Sisa Rancangan Biaya</i></label>
                            <input type="text" class="form-control" id="sisarincian" placeholder="Rp{{format_uang($permohonan->sisarincian)}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="sisadana"><i class="fa fa-money-bill-alt"> Sisa Biaya Real</i></label>
                            <input type="text" class="form-control" id="sisadana" placeholder="Rp{{format_uang($permohonan->sisadana)}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="tanggalkegiatan"><i class="fa fa-calendar"> Tanggal Kegiatan</i></label>
                            <input type="text" class="form-control" id="tanggalkegiatan" placeholder="{{date('d-m-Y', strtotime($permohonan->tanggalkegiatan))}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="tempatkegiatan"><i class="fa fa-map-marker"> Tempat Kegiatan</i></label>
                            <input type="text" class="form-control" id="tempatkegiatan" placeholder="{{($permohonan->tempatkegiatan)}}" disabled>
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
                                            <th scope="col">Biaya Total</th>
                                            <th scope="col">Biaya Terpakai</th>
                                            <th scope="col">Biaya Sisa</th>
                                            <th scope="col">File Bukti</th>
                                            @if ($permohonan->status == 5)
                                            <th scope="col">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot class="">
                                        <tr>
                                            <th class="table-info" colspan="2">Maks Dana : Rp.{{format_uang($permohonan->totalbiaya)}}</th>
                                            <th class="table-info" colspan="1">Total Biaya : Rp.{{format_uang($permohonan->biayarincian)}}</th>
                                            <th class="table-info" colspan="2">Biaya Terpakai : Rp.{{format_uang($permohonan->danaterpakai)}}</th>
                                            <th class="table-info" colspan="2">Sisa Biaya Real : Rp.{{format_uang($permohonan->sisadana)}}</th>
                                            <th class="table-info" colspan="2">Sisa Rancangan Biaya : Rp.{{format_uang($permohonan->sisarincian)}}</th>
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
                                                    <td scope="col"><p> <a class="btn btn-sm btn-block btn-success" href="{{ asset('file/'.$rincian->file) }}" download="{{$rincian->file}}"><i class="fa fa-file-download"> Download</i></a></p></td>
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
                    <p class="text-center"><a class="btn btn-outline-primary" href="{{ asset('filetor/'.$permohonan->filetor) }}" download="{{$permohonan->filetor}}"><i class="fa fa-file-download "> Download file TOR</i></a></p>
                    @endif
                </div>
                <div class="tab-pane" id="spj" role="tabpanel">
                    <br>
                    <p class="text-center"><a class="btn btn-outline-secondary" href="{{ asset('filespj/'.$permohonan->filespj) }}" download="{{$permohonan->filespj}}"><i class="fa fa-file-download"> Download File SPJ</i></a></p>
                </div>
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