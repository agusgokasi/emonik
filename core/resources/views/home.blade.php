@extends('layouts.backend')

@section('content')
    @include('layouts.pesan')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        Anda Telah Login Sebagai <strong>{{Auth::user()->name}}</strong>! <br>
                        Untuk Mengubah Profile klik <strong><a href="{{ route('ProfileEdit' , ['id' => Auth::user()->id]) }}">disini!</a></strong>
                    </div>
                </div>
            </div>
        </div>
@endsection