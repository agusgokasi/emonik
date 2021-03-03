@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Unit
        </li>
    </ol>

    @include('layouts.pesan')
    
    <button class="btn btn-primary" data-toggle="modal" data-target="#m-c" ui-toggle-class="bounce" ui-target="#animate">
        <i class="fa fa-plus"></i>
        Buat Unit
    </button>
    @include('unit._buat_unit')
    <br><br>
    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Unit</i>
            </div>

            <div class="card-body">
            	<div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th style="width:10px;">No</th>
                            	<th>Nama Unit</th>
                                <th>Fakultas</th>
                                <th>Prodi</th>
                                <th class="text-center" style="width:80px;">Status</th>
                                <th class="text-center" style="width:80px;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($units->count())
                            @foreach($units as $key => $unit)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$unit->nama}}</td>
                                    <td>@if($unit->fakultas_id == null)
                                        Tidak Punya Fakultas
                                        @else
                                        {{$unit->fakultas->nama}}
                                        @endif</td>
                                    <td>@if($unit->prodi_id == null)
                                        Tidak Punya Prodi
                                        @else
                                        {{$unit->prodi->nama}}
                                        @endif</td>
                                    <td class="text-center">
                                    <i class="fa {{ ($unit->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-block btn-primary" data-toggle="modal"
                                                data-target="#m-e-{{ $unit->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate" style="margin-bottom: 5px">
                                            <small> Edit</small>
                                        </button>
                                        @include('unit._edit_unit')
                                        <button class="btn btn-sm btn-block btn-danger" data-toggle="modal"
                                                data-target="#m-{{ $unit->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate">
                                            <small> Hapus</small>
                                        </button>
                                        @include('unit._delete_unit')
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
@if (count($errors) > 0 && Session::get('error_code') == 'create')
    $(document).ready(function(){
        $('#m-c').modal('show'); 
    });
@endif
@foreach($units as $unit)
@if (count($errors) > 0 && Session::get('error_code') == $unit->id)
    $(document).ready(function(){
        $('#m-e-{{ $unit->id }}').modal('show'); 
    });
@endif
@endforeach
</script>
<script>
     $(document).ready(function() {

    $('select[name="fakultas"]').on('change', function(){
        var unitID = $(this).val();
        if(unitID) {
            $.ajax({
                url: 'getUnits/'+unitID,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('select[name="prodi"]').append('<option hidden disabled selected value>--Please Wait--</option>');
                },
                success:function(data) {
                    // console.log(data);
                    $('select[name="prodi"]').empty();
                    if(data == ''){
                        // console.log(data);
                        $('select[name="prodi"]').append('<option hidden disabled selected value>Tidak Punya Prodi</option>');
                    }
                    else{
                    $('select[name="prodi"]').append('<option value>Tidak Punya Prodi</option>');
                    $.each(data, function(key, value){
                            $('select[name="prodi"]').append('<option value="'+ key +'">' + value + '</option>');
                        });
                    }
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        }
        else {
            $('select[name="prodi"]').empty();
            $('select[name="prodi"]').append('<option hidden disabled selected value>Tidak Punya Prodi</option>');
        }

    });

});
 </script>
@endsection
