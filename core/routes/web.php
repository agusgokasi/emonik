<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{id}/edit', 'HomeController@edit')->name('ProfileEdit');
Route::post('/profile/{id}/update', 'HomeController@update')->name('ProfileUpdate');

// Clear Cache
    Route::get('/cache-clear', function () {
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('view:cache');
        Artisan::call('route:clear');
        // return redirect()->route('home')->with('msg', 'berhasil clear cache');
        echo "berhasil clear cache";
    })->name('cacheClear');

Route::Group(['middleware' => ['auth']], function () {
	// Users & Permissions
    Route::get('/users', 'UserController@index')->name('users');
    Route::get('/users/create', 'UserController@create')->name('usersCreate');
    Route::post('/users/store', 'UserController@store')->name('usersStore');
    Route::get('/users/{id}/edit', 'UserController@edit')->name('usersEdit');
    Route::post('/users/{id}/update', 'UserController@update')->name('usersUpdate');
    Route::get('/users/destroy/{id}', 'UserController@destroy')->name('usersDestroy');

    Route::get('/permissions', 'PermissionController@index')->name('permissions');
    Route::get('/permissions/create', 'PermissionController@create')->name('permissionsCreate');
    Route::post('/permissions/store', 'PermissionController@store')->name('permissionsStore');
    Route::get('/permissions/{id}/edit', 'PermissionController@edit')->name('permissionsEdit');
    Route::post('/permissions/{id}/update', 'PermissionController@update')->name('permissionsUpdate');
    Route::get('/permissions/destroy/{id}', 'PermissionController@destroy')->name('permissionsDestroy');

    // Exeption
    Route::get('/exception', 'ExceptionController@index')->name('exception');
    Route::get('/exception/buka/{id}', 'ExceptionController@buka')->name('exceptionBuka');

    // Fakultas
    Route::get('/fakultas', 'FakultasController@index')->name('fakultas');
    Route::post('/fakultas/create', 'FakultasController@post')->name('fakultasCreate');
    Route::post('/fakultas/{id}/update', 'FakultasController@update')->name('fakultasUpdate');
    Route::get('/fakultas/destroy/{id}', 'FakultasController@destroy')->name('fakultasDestroy');
    // Prodi
    Route::get('/prodis', 'ProdisController@index')->name('prodis');
    Route::post('/prodis/create', 'ProdisController@post')->name('prodisCreate');
    Route::post('/prodis/{id}/update', 'ProdisController@update')->name('prodisUpdate');
    Route::get('/prodis/destroy/{id}', 'ProdisController@destroy')->name('prodisDestroy');
    // Unit
    Route::get('/getUnits/{id}', 'UnitController@getUnits');
    Route::get('/units', 'UnitController@index')->name('units');
    Route::post('/units/create', 'UnitController@post')->name('unitsCreate');
    Route::post('/units/{id}/update', 'UnitController@update')->name('unitsUpdate');
    Route::get('/units/destroy/{id}', 'UnitController@destroy')->name('unitsDestroy');

    // Kategori
    Route::get('/kategori', 'KategoriController@index')->name('kategori');
    Route::post('/kategori/create', 'KategoriController@post')->name('kategoriCreate');
    Route::post('/kategori/{id}/update', 'KategoriController@update')->name('kategoriUpdate');
    Route::get('/kategori/destroy/{id}', 'KategoriController@destroy')->name('kategoriDestroy');

    // Kegiatan
    Route::get('/kegiatan', 'KegiatanController@index')->name('kegiatan');
    Route::post('/kegiatan/create', 'KegiatanController@post')->name('kegiatanCreate');
    Route::post('/kegiatan/{id}/update', 'KegiatanController@update')->name('kegiatanUpdate');
    Route::get('/kegiatan/destroy/{id}', 'KegiatanController@destroy')->name('kegiatanDestroy');

    // Permohonan
    Route::get('/kategoripermohonan', 'PermohonanController@indexkategori')->name('kategoripermohonan');
    Route::get('/permohonan', 'PermohonanController@index')->name('permohonan');
    Route::get('/permohonan/create', 'PermohonanController@create')->name('permohonanCreate');
    Route::post('/permohonan/store', 'PermohonanController@store')->name('permohonanStore');
    Route::get('/permohonan/{permohonan}', 'PermohonanController@show')->name('permohonanShow');
    Route::get('/permohonan/{permohonan}/edit', 'PermohonanController@edit')->name('permohonanEdit');
    Route::post('/permohonan/{permohonan}/update', 'PermohonanController@update')->name('permohonanUpdate');
    Route::get('/permohonan/destroy/{permohonan}', 'PermohonanController@destroy')->name('permohonanDestroy');
    Route::get('/permohonan/submit/{permohonan}', 'PermohonanController@submit')->name('permohonanSubmit');
    //Rincian
    Route::post('/rincian/create/{id}', 'RincianController@create')->name('rincianCreate');
    Route::post('/rincian/{id}/edit', 'RincianController@update')->name('rincianUpdate');
    Route::get('/rincian/destroy/{id}', 'RincianController@destroy')->name('rincianDestroy');

    //Disposisi Permohonan
    Route::get('/dis1', 'DisposisiController@dis1')->name('dis1');
    Route::get('/dis1/submit/{permohonan}', 'DisposisiController@di1')->name('dis1Submit');
    Route::get('/dis2', 'DisposisiController@dis2')->name('dis2');
    Route::post('/dis2/tolak/{permohonan}', 'DisposisiController@dt2')->name('dis2Tolak');
    Route::get('/dis2/submit/{permohonan}', 'DisposisiController@di2')->name('dis2Submit');
    Route::get('/dis3', 'DisposisiController@dis3')->name('dis3');
    Route::post('/dis3/tolak/{permohonan}', 'DisposisiController@dt3')->name('dis3Tolak');
    Route::get('/dis3/submit/{permohonan}', 'DisposisiController@di3')->name('dis3Submit');
    Route::get('/dis4', 'DisposisiController@dis4')->name('dis4');
    Route::get('/dis4/submit/{permohonan}', 'DisposisiController@di4')->name('dis4Submit');
    Route::get('/disposisi/{permohonan}', 'DisposisiController@show')->name('disShow');

    //SPJ
    Route::get('/spj', 'SpjController@index')->name('spj');
    Route::get('/spj/{permohonan}', 'SpjController@show')->name('spjShow');
    // Route::post('/spj/{permohonan}/spjFile', 'SpjController@submitFile')->name('spjFile');
    Route::get('/spj/submit/{permohonan}', 'SpjController@submit')->name('spjSubmit');
    //Rincian
    Route::post('/rincian/{id}/fileBukti', 'RincianController@fileBukti')->name('fileBukti');
    Route::post('/rincian/{id}/editBukti', 'RincianController@editBukti')->name('editBukti');
    //Disposisi SPJ
    Route::get('/dis5', 'DisposisiController@dis5')->name('dis5');
    Route::post('/dis5/tolak/{permohonan}', 'DisposisiController@dt5')->name('dis5Tolak');
    Route::get('/dis5/submit/{permohonan}', 'DisposisiController@di5')->name('dis5Submit');
    Route::get('/dis6', 'DisposisiController@dis6')->name('dis6');
    Route::post('/dis6/tolak/{permohonan}', 'DisposisiController@dt6')->name('dis6Tolak');
    Route::post('/dis6/submit/{permohonan}', 'DisposisiController@di6')->name('dis6Submit');
    Route::get('/disposis/{permohonan}', 'DisposisiController@spjShow')->name('dissShow');

    //History Permohonan
    Route::get('/histori', 'HistoriController@index')->name('histori');
    Route::get('/histori/{permohonan}', 'HistoriController@show')->name('historiShow');

    //Export Excel
    Route::get('exportExcel/{permohonan}', 'HistoriController@export')->name('export');
});





















// // No Permission
 //    Route::get('/403', function () {
 //        return view('errors.403');
 //    })->name('NoPermission');
    
 //    // Not Found
 //    Route::get('/404', function () {
 //        return view('errors.404');
 //    })->name('NotFound');