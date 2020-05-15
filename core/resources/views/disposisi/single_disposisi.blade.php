@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Dashboard</a>
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
                                        </tr>
                                    </thead>
                                    <tfoot class="">
                                        <tr>
                                            <th class="table-info" colspan="3">Maksimal Dana : Rp{{format_uang($permohonan->totalbiaya)}}</th>
                                            {{-- <th scope="col">Maksimal Dana</th> --}}
                                            {{-- <th>Rp.{{format_uang($permohonan->totalbiaya)}}</th> --}}
                                            <th class="table-info" colspan="3">Total Biaya : Rp{{format_uang($permohonan->biayarincian)}}</th>
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
                        <p class="text-center"><a class="btn btn-outline-primary" href="{{ asset('filetor/'.$permohonan->filetor) }}" download="{{$permohonan->filetor}}"><i class="fa fa-file-download "> Download file TOR</i></a></p>
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