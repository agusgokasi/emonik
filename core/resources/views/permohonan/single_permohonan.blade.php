@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('permohonan') }}">Permohonan</a>
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
                            @if ($permohonan->status == 0 || $permohonan->status==9)
                            @if ($permohonan->created_by==Auth::user()->id)
                            <li class="nav-item nav-justified {{ empty($tabMenu) || $tabMenu == 'messages' ? 'active' : '' }}">
                                <a class="flex-sm-fill text-sm-center nav-link" data-toggle="tab" href="#messages" role="tab"><i class="fa fa-cog"> Action</i></a>
                            </li>
                            @endif
                            @endif
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
                            <label for="biayarincian"><i class="fa fa-money-bill-wave"> Total Usulan</i></label>
                            <input type="text" class="form-control" id="biayarincian" placeholder="Rp{{format_uang($permohonan->biayarincian)}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="totalbiaya"><i class="fa fa-money-bill-alt"> Biaya Perencanaan</i></label>
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
                            @if($rincians->count()==0)
                            <strong>Anda Belum Memasukkan Rincian Biaya Apapun</strong>
                            <br>
                            <button class="btn btn-primary" data-toggle="modal"
                                    data-target="#r-c" ui-toggle-class="bounce"
                                    ui-target="#animate">
                                <i class="fa fa-plus">{{ __(' Buat Rincian') }}</i>
                            </button>
                            @include('rincian._buat_rincian')
                            <br><br>
                            @else
                            @if($permohonan->status == 0 || $permohonan->status==9)
                            <button class="btn btn-primary" data-toggle="modal"
                                    data-target="#r-c" ui-toggle-class="bounce"
                                    ui-target="#animate">
                                <i class="fa fa-plus">{{ __(' Tambah Rincian') }}</i>
                            </button>
                            @include('rincian._buat_rincian')
                            @endif
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
                                            @if ($permohonan->status == 0 || $permohonan->status==9)
                                            <th scope="col">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot class="">
                                        <tr>
                                            <th class="table-info" colspan="3">Biaya Perencanaan : Rp{{format_uang($permohonan->totalbiaya)}}</th>
                                            {{-- <th scope="col">Maksimal Dana</th> --}}
                                            {{-- <th>Rp.{{format_uang($permohonan->totalbiaya)}}</th> --}}
                                            <th class="table-info" colspan="3">Total Usulan : Rp{{format_uang($permohonan->biayarincian)}}</th>
                                            {{-- <th scope="col">Rp.{{format_uang($permohonan->biayarincian)}}</th> --}}
                                            @if ($permohonan->status == 0 || $permohonan->status==9)
                                            @if($permohonan->biayarincian < $permohonan->totalbiaya)
                                            <th class="table-info">Lebih Kecil</th>
                                            @elseif($permohonan->biayarincian == $permohonan->totalbiaya)
                                            <th class="table-success">Sama Besar</th>
                                            @elseif($permohonan->biayarincian > $permohonan->totalbiaya)
                                            <th class="table-danger">Lebih Besar</th>
                                            @endif
                                            @endif
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
                                                    @if($permohonan->status == 0 || $permohonan->status==9)
                                                    <td scope="col">
                                                    <button class="btn btn-block btn-success" data-toggle="modal"
                                                            data-target="#r-e-{{$rincian->id}}" ui-toggle-class="bounce"
                                                            ui-target="#animate">
                                                        <i class="fa fa-edit">{{ __(' Edit Rincian') }}</i>
                                                    </button>
                                                    @include('rincian._edit_rincian')
                                                    <button class="btn btn-block btn-danger" data-toggle="modal"
                                                            data-target="#r-d-{{$rincian->id}}" ui-toggle-class="bounce"
                                                            ui-target="#animate">
                                                        <i class="fa fa-eraser">{{ __(' Hapus Rincian') }}</i>
                                                    </button>
                                                    @include('rincian._delete_rincian')
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    </table>
                                </table>
                            </table>
                            </div>
                            @endif
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
                <!-- admin -->
                @if ($permohonan->status == 0 || $permohonan->status==9)
                @if ($permohonan->created_by==Auth::user()->id)
                <div class="tab-pane {{ !empty($tabMenu) && $tabMenu == 'messages' ? 'active' : '' }}" id="messages" role="tabpanel">
                        <br>
                        <h5 class="text-center">Actions</h5>
                        <hr>
                        <p class="d-flex justify-content-center"><a href="{{ route('permohonanEdit' , ['permohonan' => $permohonan->slug]) }}" class="btn btn-warning btg-lg text-dark"><i class="fa fa-edit"> Edit Permohonan</i></a></p>
                        <p class="d-flex justify-content-center">
                        <button class="btn btn-danger" data-toggle="modal"
                                data-target="#m-d" ui-toggle-class="bounce"
                                ui-target="#animate">
                            <i class="fa fa-trash">{{ __(' Hapus Permohonan') }}</i>
                        </button></p>
                        @include('permohonan._delete_permohonan')
                        <br>
                </div>
                @endif
                @endif
            </div>
            <br>
            <p class="d-flex justify-content-center"><a href="{{ route('permohonan')}}" class="btn btn-outline-primary btn-md">Kembali Ke List Permohonan</a></p>
            </div>
@endsection
@section('add_js')
<script type="text/javascript">
    jQuery(function($){
       $("#biayasatuan").mask("000.000.000", {reverse: true});
       $("#volume").mask("000", {reverse: true});
       $("#myForm").submit(function() {
          $("#biayasatuan").unmask();
          $("#volume").unmask();
        });
    });

@foreach ($rincians as $rincian)
    jQuery(function($){
       $("#biayasatuan").mask("000.000.000", {reverse: true});
       $("#volume").mask("000", {reverse: true});
       $("#biayasatuan{{ $rincian->id }}").mask("000.000.000", {reverse: true});
       $("#volume{{ $rincian->id }}").mask("000", {reverse: true});
       $("#myForm").submit(function() {
          $("#biayasatuan").unmask();
          $("#volume").unmask();
        });
       $("#myForm{{$rincian->id}}").submit(function() {
          $("#biayasatuan{{$rincian->id}}").unmask();
          $("#volume{{$rincian->id}}").unmask();
        });

    });
    $(document).ready(function () {
     $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
    });
    @if (count($errors) > 0 && Session::get('error_code') == 'create')
        $(document).ready(function(){
            $('#r-c').modal('show'); 
        });
    @endif
    @if (count($errors) > 0 && Session::get('error_code') == $rincian->id)
        $(document).ready(function(){
            $('#r-e-{{$rincian->id}}').modal('show'); 
        });
    @endif
@endforeach
</script>
@endsection