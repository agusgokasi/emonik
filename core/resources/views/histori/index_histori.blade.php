@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Dashboard</a>
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
                <div class="form-group row input-daterange">
                    <div class="col-md-4">
                        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="Dari Tanggal" readonly />
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="Ke Tanggal" readonly />
                    </div>
                    <div class="col-md-4">
                        <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn btn-outline-secondary">Refresh</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="table_histori" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:5px;">No</th>
                                <th>Nama Kegiatan</th>
                                <th>Dibuat Oleh</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aktivitas Terakhir</th>
                                <th style="width:30px;">Status</th>
                                <th style="width:30px;">Detail</th>
                                <th style="width:150px;">Keterangan</th>
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
            $.fn.datepicker.defaults.language = 'id';
         $('.input-daterange').datepicker({
          todayBtn:'linked',
          format:'dd-mm-yyyy',
          autoclose:true,
         });
            load_data();
            function load_data(from_date = '', to_date = ''){
                $('#table_histori').DataTable({
                processing: true,
                serverSide: true,
                // autoWidth: false,
                // ajax: ""+apiHistori,
                ajax: {
                    url:'{{ route("apiHistori") }}',
                    data:{from_date:from_date, to_date:to_date}
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nama', name: 'nama'},
                    {data: 'pemohon', name: 'pemohon'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'status', name: 'status'},
                    {data: 'detail', name: 'detail'},
                    {data: 'keterangan', name: 'keterangan'},
                ],
                });
            }
            $('#filter').click(function(){
              var from_date = $('#from_date').val();
              var to_date = $('#to_date').val();
              if(from_date != '' &&  to_date != '')
              {
               $('#table_histori').DataTable().destroy();
               load_data(from_date, to_date);
              }
              else
              {
               alert('Semua tanggal harus diisi');
              }
             });
             $('#refresh').click(function(){
              $('#from_date').val('');
              $('#to_date').val('');
              $('#table_histori').DataTable().destroy();
              load_data();
             });
            
        });
    </script>
@endsection