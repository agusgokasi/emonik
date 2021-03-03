<script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
<script>
    var config = {};
    var config1 = {};
    var config2 = {};
    var config3 = {};
    var config4 = {};
    var config5 = {};
    config.placeholder = 'Masukkan Latar Belakang';
    config1.placeholder = 'Masukkan Tujuan / Penerima Manfaat';
    config2.placeholder = 'Masukkan Ruang Lingkup / Strategi Pencapaian Keluaran';
    config3.placeholder = 'Masukkan Waktu Pencapaian Keluaran';
    config4.placeholder = 'Masukkan Susunan Acara / Luaran';
    config5.placeholder = 'Masukkan Pembiayaan / Rencana Anggaran';
    CKEDITOR.replace( 'latarbelakang', config );
    CKEDITOR.replace( 'tujuan', config1 );
    CKEDITOR.replace( 'ruanglingkup', config2 );
    CKEDITOR.replace( 'waktupencapaian', config3 );
    CKEDITOR.replace( 'luaran', config4 );
    CKEDITOR.replace( 'pembiayaan', config5 );
</script>