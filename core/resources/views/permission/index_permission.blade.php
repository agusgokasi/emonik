@extends('layouts.backend')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Permission
        </li>
    </ol>

    @include('layouts.pesan')
    
    <a class="btn btn-primary" href="{{ route('permissionsCreate') }}">
        <i class="fa fa-plus"></i>
        Buat Permission
    </a>
    <br><br>
    <div class="card border border-info">
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-table">&nbsp;Permission</i>
            </div>

            <div class="card-body">
            	<div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th>No</th>
                            	<th>Nama Permission</th>
                                <th>List Permission</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($permissions->count())
                            @foreach($permissions as $key => $permission)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$permission->nama}}</td>
                                    <td>
                                        <small>
                                            {{ $permission->view_status ? 'Membaca Data, ' : ''  }}
                                            {{ $permission->permission_status ? 'CRUD User & permission, ' : ''  }}
                                            {{ $permission->unit_status ? 'CRUD Unit, ' : ''  }}
                                            {{ $permission->kategori_status ? 'CRUD Kategori, ' : ''  }}
                                            {{ $permission->kegiatan_status ? 'CRUD Kegiatan, ' : ''  }}
                                            {{ $permission->exception_status ? 'Membuka Pengajuan Pemohon, ' : ''  }}
                                            {{ $permission->permohonan_status ? 'CRUD Permohonan & SPJ, ' : ''  }}
                                            {{ $permission->dispo1p_status ? 'Disposisi 1 Permohonan, ' : ''  }}
                                            {{ $permission->dispo2p_status ? 'Disposisi 2 Permohonan, ' : ''  }}
                                            {{ $permission->dispo3p_status ? 'Disposisi 3 Permohonan, ' : ''  }}
                                            {{ $permission->dispo4p_status ? 'Disposisi 4 Permohonan, ' : ''  }}
                                            {{ $permission->dispo1s_status ? 'Disposisi 1 SPJ, ' : ''  }}
                                            {{ $permission->dispo2s_status ? 'Disposisi 2 SPJ, ' : ''  }}
                                            @if(!$permission->view_status&&!$permission->permission_status&&!$permission->unit_status&&!$permission->kategori_status&&!$permission->kegiatan_status&&!$permission->exception_status&&!$permission->permohonan_status&&!$permission->dispo1p_status&&!$permission->dispo2p_status&&!$permission->dispo3p_status&&!$permission->dispo4p_status&&!$permission->dispo1s_status&&!$permission->dispo2s_status)
                                            View Only
                                            @endif
                                        </small>
                                    </td>
                                    <td class="text-center">
                                    <i class="fa {{ ($permission->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                    </td>
                                    <td>
                                        <a href="{{ route('permissionsEdit' , ['id' => $permission->id]) }}" class="btn btn-block btn-sm btn-primary">Edit</a>
                                        <button class="btn btn-sm btn-block btn-danger" data-toggle="modal"
                                                data-target="#m-{{ $permission->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate">
                                            <small> Hapus</small>
                                        </button>
                                        @include('permission._delete_permission')
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
