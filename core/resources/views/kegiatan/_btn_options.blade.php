@if($kegiatan->keterangan == 'Permohonan Belum Dibuat')
	<button class="btn btn-sm btn-block btn-primary" data-toggle="modal"
	data-target="#m-e-{{ $kegiatan->id }}" ui-toggle-class="bounce"
	ui-target="#animate" style="margin-bottom: 5px">
	<small> Edit</small>
	</button>
	@include('kegiatan._edit_kegiatan')
	<button class="btn btn-sm btn-block btn-danger" data-toggle="modal"
	data-target="#m-{{ $kegiatan->id }}" ui-toggle-class="bounce"
	ui-target="#animate">
	<small> Hapus</small>
	</button>
	@include('kegiatan._delete_kegiatan')
@else
	<center>-</center>
@endif