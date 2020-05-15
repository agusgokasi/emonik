@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Prodi
        </li>
    </ol>

    @include('layouts.pesan')
    
    <button class="btn btn-primary" data-toggle="modal" data-target="#m-c" ui-toggle-class="bounce" ui-target="#animate">
        <i class="fa fa-plus"></i>
        Buat Prodi
    </button>
    @include('prodi._buat_prodi')
    <br><br>
    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Prodi</i>
            </div>

            <div class="card-body">
            	<div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th>No</th>
                                <th>Nama Prodi</th>
                            	<th>Fakultas</th>
                                <th class="text-center" style="width:80px;">Status</th>
                                <th class="text-center" style="width:80px;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($prodis->count())
                            @foreach($prodis as $key => $prodi)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$prodi->nama}}</td>
                                    <td>@if(!$prodi->fakultas_id)
                                        Tidak Punya Fakultas
                                        @else
                                        {{$prodi->fakultas->nama}}
                                        @endif</td>
                                    <td class="text-center">
                                    <i class="fa {{ ($prodi->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-block btn-primary" data-toggle="modal"
                                                data-target="#m-e-{{ $prodi->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate" style="margin-bottom: 5px">
                                            <small> Edit</small>
                                        </button>
                                        @include('prodi._edit_prodi')
                                        <button class="btn btn-sm btn-block btn-danger" data-toggle="modal"
                                                data-target="#m-{{ $prodi->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate">
                                            <small> Delete</small>
                                        </button>
                                        @include('prodi._delete_prodi')
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
@foreach($prodis as $prodi)
@if (count($errors) > 0 && Session::get('error_code') == $prodi->id)
    $(document).ready(function(){
        $('#m-e-{{ $prodi->id }}').modal('show'); 
    });
@endif
@endforeach
</script>
@endsection
