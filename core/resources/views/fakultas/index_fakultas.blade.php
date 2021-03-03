@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Fakultas
        </li>
    </ol>

    @include('layouts.pesan')
    
    <button class="btn btn-primary" data-toggle="modal" data-target="#m-c" ui-toggle-class="bounce" ui-target="#animate">
        <i class="fa fa-plus"></i>
        Buat Fakultas
    </button>
    @include('fakultas._buat_fakultas')
    <br><br>
    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Fakultas</i>
            </div>

            <div class="card-body">
            	<div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th style="width:10px;">No</th>
                            	<th>Nama Fakultas</th>
                                <th class="text-center" style="width:80px;">Status</th>
                                <th class="text-center" style="width:80px;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($fakultases->count())
                            @foreach($fakultases as $key => $fakultase)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$fakultase->nama}}</td>
                                    <td class="text-center">
                                    <i class="fa {{ ($fakultase->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-block btn-primary" data-toggle="modal"
                                                data-target="#m-e-{{ $fakultase->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate" style="margin-bottom: 5px">
                                            <small> Edit</small>
                                        </button>
                                        @include('fakultas._edit_fakultas')
                                        <button class="btn btn-sm btn-block btn-danger" data-toggle="modal"
                                                data-target="#m-{{ $fakultase->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate">
                                            <small> Hapus</small>
                                        </button>
                                        @include('fakultas._delete_fakultas')
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
@foreach($fakultases as $fakultase)
@if (count($errors) > 0 && Session::get('error_code') == $fakultase->id)
    $(document).ready(function(){
        $('#m-e-{{ $fakultase->id }}').modal('show'); 
    });
@endif
@endforeach
</script>
@endsection
