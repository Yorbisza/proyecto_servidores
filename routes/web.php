<?php

use App\Http\Controllers\SineaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AuditingController;
use App\Http\Controllers\ttmController;
use App\Http\Controllers\ServidoresController;
use App\Http\Controllers\AccessKeyController;
use App\Http\Controllers\BaseDatosController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/panel', function () {
        return view('panel.template');
    })->name('panel');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/solicitudes', function () {
        return view('solicitudes.index');
    })->name('solicitud.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/ttm', function () {
        return view('ttm.index');
    })->name('ttm.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/servidores', function () {
        return view('modules.servidores.index');
    })->name('modules.servidores.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/database', function () {
        return view('modules.baseDatos.index');
    })->name('modules.baseDatos.index');
});

//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function () {

    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    // Route::resource('sinea', SolicitudController::class, 'solicitudes' );
    // Route::resource('solicitudes', SolicitudController::class);
    //   Route::get('/solicitudes/{id}', [SolicitudController::class, 'solicitudes'])->name('solicitudes');

    Route::put('/ttm/solicitud/{vasolicitude_id}', [ttmController::class, 'update'])->name('vasolicitud.update');
    Route::post('/ttm/buscar', [ttmController::class, 'buscar'])->name('ttm');
    Route::post('/solicitud/buscar', [SolicitudController::class, 'buscar'])->name('solicitud.buscar');
    Route::delete('solicitudes/solicitud/{id}', [App\Http\Controllers\SolicitudController::class, 'destroy'])->name('solicitud.destroy');
    Route::delete('/ttm/delete/{id}', [App\Http\Controllers\ttmController::class, 'destroy'])->name('vasolicitud.destroy');
    Route::delete('/ttm/destroyOne/{id}', [App\Http\Controllers\ttmController::class, 'destroyOne'])->name('vasolicitud.destroyOne');
    Route::put('/ttm/solicitud/{vasolicitude_id}', [ttmController::class, 'update'])->name('vasolicitud.update');

    // En tu archivo de rutas (web.php o api.php)
    Route::get('/solicitudes/{id}/edit', [SolicitudController::class, 'edit'])->name('solicitud.edit');
    Route::put('/solicitudes/{id}', [SolicitudController::class, 'update'])->name('solicitud.update');
    Route::resource('audits', AuditingController::class);
    Route::post('/access-key/verify', [AccessKeyController::class, 'verifyAccessKey'])->name('access.key.verify');


    // Servidores

    Route::get('modules/servidores/create', [ServidoresController::class, 'create'])->name('servidores.create');
    Route::post('servidores/store', [ServidoresController::class, 'store'])->name('servidores.store');
    Route::get('/servidores/index', [ServidoresController::class, 'index'])->name('servidores.index');
    Route::delete('servidores/destroy/{id}', [ServidoresController::class, 'destroy'])->name('servidores.destroy');
    Route::get('servidores/show/{id}', [ServidoresController::class, 'show'])->name('servidores.show');
    Route::get('servidores/edit/{id}', [ServidoresController::class, 'edit'])->name('servidores.edit');
    Route::put('servidores/update/{id}', [ServidoresController::class, 'update'])->name('servidores.update');

      // Database
    Route::get('/baseDatos/index', [BaseDatosController::class, 'index'])->name('baseDatos.index');
    Route::get('/baseDatos/create', [BaseDatosController::class, 'create'])->name('baseDatos.create');
    Route::post('/baseDatos/store', [BaseDatosController::class, 'store'])->name('baseDatos.store');
    Route::get('/baseDatos/edit/{id}', [BaseDatosController::class, 'edit'])->name('baseDatos.edit');
    Route::put('/baseDatos/update/{id}', [BaseDatosController::class, 'update'])->name('baseDatos.update');
    Route::get('/baseDatos/show/{id}', [BaseDatosController::class, 'show'])->name('baseDatos.show');
    Route::delete('/baseDatos/destroy/{id}', [BaseDatosController::class, 'destroy'])->name('baseDatos.destroy');

    });

