@extends('layouts.backend')

@section('content')
{{-- breadcrumb --}}
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('permissions') }}">Permission</a>
    </li>
    <li class="breadcrumb-item active">
        Edit Permission
    </li>
</ol>

@if (session('msg'))
    <div class="alert alert-success" role="alert">
        {{ session('msg') }}
    </div>
@endif

<div class="card">
    <div class="card-header text-center">Edit Permission</div>
    <div class="card-body">
        <form method="post" role="form" action="{{ route('permissionsUpdate' , ['id' => $permission->id]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label text-md-left">{{ __('Nama Permission') }}</label>
                <div class="col-md-8">
                    <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ $permission->nama }}" required autofocus> 
                    @if ($errors->has('nama'))
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $errors->first('nama') }}</strong>
                        </span> 
                    @endif
                </div>
            </div>

            <div class="form-group row">

                <label for="view_status" class="col-md-4 col-form-label text-md-left">{{ __('Membaca Data') }}</label>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input id="view_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('view_status') ? ' is-invalid' : '' }}" name="view_status" value="1" {{ $permission->view_status == '1' ? 'checked' : '' }} required>
                        <label> Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="view_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('view_status') ? ' is-invalid' : '' }}" name="view_status" value="0" {{ $permission->view_status == '0' ? 'checked' : '' }} required>
                        <label> Tidak</label>
                    </div>

                    @if ($errors->has('view_status'))
                        <div>
                            <small class="text-danger" role="alert">
                                 <strong>{{ $errors->first('view_status') }}</strong>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- permission_status --}}
            <div class="form-group row">

                <label for="permission_status" class="col-md-4 col-form-label text-md-left">{{ __('Mengelola User & permission') }}</label>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input id="permission_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('permission_status') ? ' is-invalid' : '' }}" name="permission_status" value="1" {{ $permission->permission_status == '1' ? 'checked' : '' }} required>
                        <label> Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="permission_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('permission_status') ? ' is-invalid' : '' }}" name="permission_status" value="0" {{ $permission->permission_status == '0' ? 'checked' : '' }} required>
                        <label> Tidak</label>
                    </div>

                    @if ($errors->has('permission_status'))
                        <div>
                            <small class="text-danger" role="alert">
                                 <strong>{{ $errors->first('permission_status') }}</strong>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- unit_status --}}
            <div class="form-group row">

                <label for="unit_status" class="col-md-4 col-form-label text-md-left">{{ __('Mengelola Unit') }}</label>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input id="unit_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('unit_status') ? ' is-invalid' : '' }}" name="unit_status" value="1" {{ $permission->unit_status == '1' ? 'checked' : '' }} required>
                        <label> Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="unit_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('unit_status') ? ' is-invalid' : '' }}" name="unit_status" value="0" {{ $permission->unit_status == '0' ? 'checked' : '' }} required>
                        <label> Tidak</label>
                    </div>

                    @if ($errors->has('unit_status'))
                        <div>
                            <small class="text-danger" role="alert">
                                 <strong>{{ $errors->first('unit_status') }}</strong>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- kegiatan_status --}}
            <div class="form-group row">

                <label for="kegiatan_status" class="col-md-4 col-form-label text-md-left">{{ __('Mengelola Kegiatan') }}</label>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input id="kegiatan_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('kegiatan_status') ? ' is-invalid' : '' }}" name="kegiatan_status" value="1" {{ $permission->kegiatan_status == '1' ? 'checked' : '' }} required>
                        <label> Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="kegiatan_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('unit_status') ? ' is-invalid' : '' }}" name="kegiatan_status" value="0" {{ $permission->kegiatan_status == '0' ? 'checked' : '' }} required>
                        <label> Tidak</label>
                    </div>

                    @if ($errors->has('kegiatan_status'))
                        <div>
                            <small class="text-danger" role="alert">
                                 <strong>{{ $errors->first('kegiatan_status') }}</strong>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- exception_status --}}
            <div class="form-group row">
                <label for="exception_status" class="col-md-4 col-form-label text-md-left">{{ __('Membuka Pengajuan Pemohon') }}</label>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input id="exception_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('exception_status') ? ' is-invalid' : '' }}" name="exception_status" value="1" {{ $permission->exception_status == '1' ? 'checked' : '' }} required>
                        <label> Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="exception_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('exception_status') ? ' is-invalid' : '' }}" name="exception_status" value="0" {{ $permission->exception_status == '0' ? 'checked' : '' }} required>
                        <label> Tidak</label>
                    </div>

                    @if ($errors->has('exception_status'))
                        <div role="alert">
                            <small>
                                <strong class="text-danger">{{ $errors->first('exception_status') }}</strong>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- permohonan_status --}}
            <div class="form-group row">
                <label for="permohonan_status" class="col-md-4 col-form-label text-md-left">{{ __('Membuat Pengajuan Permohonan') }}</label>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input id="permohonan_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('permohonan_status') ? ' is-invalid' : '' }}" name="permohonan_status" value="1" {{ $permission->permohonan_status == '1' ? 'checked' : '' }} required>
                        <label> Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="permohonan_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('permohonan_status') ? ' is-invalid' : '' }}" name="permohonan_status" value="0" {{ $permission->permohonan_status == '0' ? 'checked' : '' }} required>
                        <label> Tidak</label>
                    </div>

                    @if ($errors->has('permohonan_status'))
                        <div role="alert">
                            <small>
                                <strong class="text-danger">{{ $errors->first('permohonan_status') }}</strong>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- dispo1p_status --}}
            <div class="form-group row">
                <label for="dispo1p_status" class="col-md-4 col-form-label text-md-left">{{ __('Disposisi 1 Permohonan') }}</label>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input id="dispo1p_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('dispo1p_status') ? ' is-invalid' : '' }}" name="dispo1p_status" value="1" {{ $permission->dispo1p_status == '1' ? 'checked' : '' }} required>
                        <label> Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="dispo1p_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('dispo1p_status') ? ' is-invalid' : '' }}" name="dispo1p_status" value="0" {{ $permission->dispo1p_status == '0' ? 'checked' : '' }} required>
                        <label> Tidak</label>
                    </div>

                    @if ($errors->has('dispo1p_status'))
                        <div role="alert">
                            <small>
                                <strong class="text-danger">{{ $errors->first('dispo1p_status') }}</strong>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- dispo2p_status --}}
            <div class="form-group row">
                <label for="dispo2p_status" class="col-md-4 col-form-label text-md-left">{{ __('Disposisi 2 Permohonan') }}</label>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input id="dispo2p_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('dispo2p_status') ? ' is-invalid' : '' }}" name="dispo2p_status" value="1" {{ $permission->dispo2p_status == '1' ? 'checked' : '' }} required>
                        <label> Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="dispo2p_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('dispo2p_status') ? ' is-invalid' : '' }}" name="dispo2p_status" value="0" {{ $permission->dispo2p_status == '0' ? 'checked' : '' }} required>
                        <label> Tidak</label>
                    </div>

                    @if ($errors->has('dispo2p_status'))
                        <div role="alert">
                            <small>
                                <strong class="text-danger">{{ $errors->first('dispo2p_status') }}</strong>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- dispo3p_status --}}
            <div class="form-group row">
                <label for="dispo3p_status" class="col-md-4 col-form-label text-md-left">{{ __('Disposisi 3 Permohonan') }}</label>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input id="dispo3p_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('dispo3p_status') ? ' is-invalid' : '' }}" name="dispo3p_status" value="1" {{ $permission->dispo3p_status == '1' ? 'checked' : '' }} required>
                        <label> Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="dispo3p_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('dispo3p_status') ? ' is-invalid' : '' }}" name="dispo3p_status" value="0" {{ $permission->dispo3p_status == '0' ? 'checked' : '' }} required>
                        <label> Tidak</label>
                    </div>

                    @if ($errors->has('dispo3p_status'))
                        <div role="alert">
                            <small>
                                <strong class="text-danger">{{ $errors->first('dispo3p_status') }}</strong>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- dispo4p_status --}}
            <div class="form-group row">
                <label for="dispo4p_status" class="col-md-4 col-form-label text-md-left">{{ __('Disposisi 4 Permohonan') }}</label>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input id="dispo4p_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('dispo4p_status') ? ' is-invalid' : '' }}" name="dispo4p_status" value="1" {{ $permission->dispo4p_status == '1' ? 'checked' : '' }} required>
                        <label> Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="dispo4p_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('dispo4p_status') ? ' is-invalid' : '' }}" name="dispo4p_status" value="0" {{ $permission->dispo4p_status == '0' ? 'checked' : '' }} required>
                        <label> Tidak</label>
                    </div>

                    @if ($errors->has('dispo4p_status'))
                        <div role="alert">
                            <small>
                                <strong class="text-danger">{{ $errors->first('dispo4p_status') }}</strong>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- dispo1s_status --}}
            <div class="form-group row">
                <label for="dispo1s_status" class="col-md-4 col-form-label text-md-left">{{ __('Disposisi 1 SPJ') }}</label>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input id="dispo1s_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('dispo1s_status') ? ' is-invalid' : '' }}" name="dispo1s_status" value="1" {{ $permission->dispo1s_status == '1' ? 'checked' : '' }} required>
                        <label> Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="dispo1s_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('dispo1p_status') ? ' is-invalid' : '' }}" name="dispo1s_status" value="0" {{ $permission->dispo1s_status == '0' ? 'checked' : '' }} required>
                        <label> Tidak</label>
                    </div>

                    @if ($errors->has('dispo1s_status'))
                        <div role="alert">
                            <small>
                                <strong class="text-danger">{{ $errors->first('dispo1s_status') }}</strong>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- dispo2s_status --}}
            <div class="form-group row">
                <label for="dispo2s_status" class="col-md-4 col-form-label text-md-left">{{ __('Disposisi 2 SPJ') }}</label>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input id="dispo2s_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('dispo2s_status') ? ' is-invalid' : '' }}" name="dispo2s_status" value="1" {{ $permission->dispo2s_status == '1' ? 'checked' : '' }} required>
                        <label> Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="dispo2s_status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('dispo2s_status') ? ' is-invalid' : '' }}" name="dispo2s_status" value="0" {{ $permission->dispo2s_status == '0' ? 'checked' : '' }} required>
                        <label> Tidak</label>
                    </div>

                    @if ($errors->has('dispo2s_status'))
                        <div role="alert">
                            <small>
                                <strong class="text-danger">{{ $errors->first('dispo2s_status') }}</strong>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- status --}}
            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-left">{{ __('Status') }}</label>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input id="status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="1" {{ $permission->status == '1' ? 'checked' : '' }} required>
                        <label> Aktif</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="0" {{ $permission->status == '0' ? 'checked' : '' }} required>
                        <label> Tidak Aktif</label>
                    </div>

                    @if ($errors->has('status'))
                        <div role="alert">
                            <small>
                                <strong class="text-danger">{{ $errors->first('status') }}</strong>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group-row">
                <br style="margin-bottom: 10px">
                <div class="form-group d-flex justify-content-end" style="margin-bottom: 50px">
                    <div>
                        <a class="btn btn-outline-secondary rounded" href="{{ route('permissions') }}">{{ __('Kembali') }}</a>
                        <span>&nbsp;&nbsp;</span>
                        <button type="submit" class="btn btn-primary rounded" style="padding-right: 30px; padding-left: 30px">
                            {{ __(' Simpan') }}
                        </button>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</div>
@endsection