@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Kategori
        </li>
    </ol>

    @include('layouts.pesan')
    
    <button class="btn btn-primary" data-toggle="modal" data-target="#m-c" ui-toggle-class="bounce" ui-target="#animate">
        <i class="fa fa-plus"></i>
        Buat Kategori
    </button>
    @include('kategori._buat_kategori')
    <br><br>
    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Kategori</i>
            </div>

            <div class="card-body">
            	<div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th>No</th>
                            	<th>Nama Kategori</th>
                                <th class="text-center" style="width:80px;">Status</th>
                                <th class="text-center" style="width:80px;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($kategoris->count())
                            @foreach($kategoris as $key => $kategori)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$kategori->nama}}</td>
                                    <td class="text-center">
                                    <i class="fa {{ ($kategori->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-block btn-primary" data-toggle="modal"
                                                data-target="#m-e-{{ $kategori->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate" style="margin-bottom: 5px">
                                            <small> Edit</small>
                                        </button>
                                        @include('kategori._edit_kategori')
                                        <button class="btn btn-sm btn-block btn-danger" data-toggle="modal"
                                                data-target="#m-{{ $kategori->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate">
                                            <small> Delete</small>
                                        </button>
                                        @include('kategori._delete_kategori')
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
<script type="text/javascript">
@if (count($errors) > 0 && Session::get('error_code') == 'create')
    $(document).ready(function(){
        $('#m-c').modal('show'); 
    });
@endif
@foreach ($kategoris as $kategori)
@if (count($errors) > 0 && Session::get('error_code') == $kategori->id)
    $(document).ready(function(){
        $('#m-e-{{ $kategori->id }}').modal('show');
    });
@endif
@endforeach
</script>
@endsection
