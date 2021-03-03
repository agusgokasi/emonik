@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Kalender Kegiatan
        </li>
    </ol>

    @include('layouts.pesan')
    @foreach ($kegiatans as $kegiatan)
    @if (count($errors) > 0 && Session::get('error_code') == $kegiatan->id)
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        @if ($errors->has('nama'))
            <span>{{ $errors->first('nama') }}</span>
        @endif
        @if ($errors->has('bulan'))
            <span>{{ $errors->first('bulan') }}</span>
        @endif
        @if ($errors->has('tahunform'))
            <span>{{ $errors->first('tahunform') }}</span>
        @endif
        @if ($errors->has('maksimaldana'))
            <span>{{ $errors->first('maksimaldana') }}</span>
        @endif
        @if ($errors->has('unit'))
            <span>{{ $errors->first('unit') }}</span>
        @endif
        </div>
    @endif
    @endforeach
    <button class="btn btn-primary" data-toggle="modal" data-target="#m-c" ui-toggle-class="bounce" ui-target="#animate">
        <i class="fa fa-plus"></i>
        Buat Kegiatan
    </button>
    @include('kegiatan._buat_kegiatan')
    <br><br>
    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Kalender Kegiatan</i>
            </div>
            <div class="card-body">
                <div class="form-group row input-tahun">
                    <label class="col-md-2 col-form-label text-md-left">{{ __('Tahun :') }}</label>
                    <div class="col-md-4">
                        <select name="tahun" class="form-control{{ $errors->has('tahun') ? ' is-invalid' : '' }}" id="tahun" value="{{ old('tahun') }}">
                        <option selected value>Semua data</option>
                        @foreach($tahuns as $tahun)
                        <option value="{{$tahun}}" {!! old('tahun')==$tahun ? "selected='selected'":"" !!}>{{$tahun}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="button" name="filter" id="filter" class="btn btn-success">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn btn-outline-secondary">Refresh</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="table_kegiatan" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Maksimal Dana</th>
                                <th>Unit</th>
                                <th class="text-center" style="width:50px;">Status</th>
                                <th class="text-center" style="width:50px;">Options</th>
                                <th class="text-center" style="width:150px;">Keterangan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('add_js')
    <script type="text/javascript">
        $(function () {
            load_data();
            function load_data(tahun = ''){
                $('#table_kegiatan').DataTable({
                processing: true,
                serverSide: true,
                @if (count($errors) > 0)
                stateSave: true,
                @endif
                // autoWidth: false,
                // ajax: ""+apiKegiatan,
                ajax: {
                    url:'{{ route("apiKegiatan") }}',
                    data:{tahun:tahun}
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nama', name: 'nama'},
                    {data: 'bulan', name: 'bulan'},
                    {data: 'tahun', name: 'tahun'},
                    {data: 'maksimaldana', name: 'maksimaldana'},
                    {data: 'unit_id', name: 'unit_id'},
                    {data: 'status', name: 'status'},
                    {data: 'options', name: 'options'},
                    {data: 'keterangan', name: 'keterangan'},
                ],
                });
            }
            $('#filter').click(function(){
              var tahun = $('#tahun').val();
              if(tahun != '')
              {
               $('#table_kegiatan').DataTable().state.clear().destroy();
               load_data(tahun);
              }
              else
              {
                $('#table_kegiatan').DataTable().state.clear().destroy();
               load_data();
              }
             });

             $('#refresh').click(function(){
              $('#tahun').val('');
              $('#table_kegiatan').DataTable().state.clear().destroy();
              load_data();
             });
            
        });

@if (count($errors) > 0 && Session::get('error_code') == 'create')
    $(document).ready(function(){
        $('#m-c').modal('show'); 
    });
@endif

$(document).ready(function($){
    $("#maksimaldana").mask("000.000.000.000", {reverse: true});
    $("#tahunform").mask("0000", {reverse: false});
        $("#myForm").submit(function() {
            $("#maksimaldana").unmask();
            $("#tahunform").unmask();
        });
});

@foreach ($kegiatans as $kegiatan)
    @if (count($errors) > 0 && Session::get('error_code') == $kegiatan->id)
        $(document).on("ajaxComplete", function(e){
            $('#m-e-{{ $kegiatan->id }}').modal('show');
            setTimeout(function () {
               $('#m-e-{{ $kegiatan->id }}').modal('hide');
            }, 60000);
        });
    @endif

$(document).on("ajaxComplete", function(e){
    $("#maksimaldana{{ $kegiatan->id }}").mask("000.000.000.000", {reverse: true});
    $("#tahunform{{ $kegiatan->id }}").mask("0000", {reverse: false});
        $("#myForm{{ $kegiatan->id }}").submit(function() {
             $("#maksimaldana{{ $kegiatan->id }}").unmask();
             $("#tahunform{{ $kegiatan->id }}").unmask();
        });
});
@endforeach

</script>
@endsection