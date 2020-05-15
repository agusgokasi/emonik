@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Buka Permohonan User
        </li>
    </ol>

    @include('layouts.pesan')
    
    {{-- <a class="btn btn-primary" href="{{ route('usersCreate') }}">
        <i class="fa fa-plus"></i>
        Buat User
    </a> 
    <br><br>--}}
    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Buka Permohonan User</i>
            </div>

            <div class="card-body">
            	<div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th>No</th>
                            	<th>Nama User</th>
                                <th>Login Email</th>
                                <th>Nomor Telepon</th>
                                <th>Permission</th>
                                <th>Jenis Unit</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($users->count())
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>@if(!$user->phone)
                                        Tidak Mengisi
                                        @else
                                        {{$user->phone}}
                                        @endif
                                    </td>
                                    <td>{{$user->permissionsGroup->nama}}</td>
                                    <td>@if(!$user->unit_id)
                                        Tidak Punya Unit
                                        @else
                                        {{$user->units->nama}}
                                        @endif
                                    </td>
                                    <td>
                                    @if(!$user->tor)
                                    Bisa Mengajukan Permohonan
                                    @else
                                    Mempunyai Permohonan yang belum selesai
                                    @endif
                                    </td>
                                    <td>
                                    @if(!$user->tor)
                                    -
                                    @else
                                        <button class="btn btn-sm btn-block btn-success" data-toggle="modal"
                                                data-target="#m-{{ $user->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate">
                                            <small> Buka Akses</small>
                                        </button>
                                        @include('exception._user')
                                    @endif
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
