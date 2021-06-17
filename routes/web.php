<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){
    return redirect()->route('login');
});
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::group(['prefix' => 'masyarakat', 'middleware' => 'auth:masyarakat'], function () {
    Route::name('masyarakat.')->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\Masyarakat\DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout2'])->name('logout');

    Route::resource('/pengaduan', App\Http\Controllers\Masyarakat\PengaduanController::class,[
        'names' => [
            'index' => 'pengaduan'
        ]
    ]);
});
});

Route::group(['middleware' => 'auth:web,masyarakat'], function () {
    Route::resource('/profiles', App\Http\Controllers\Admin\ProfileController::class,[
        'names' => [
            'index' => 'profiles'
        ]
    ]);
        });

Route::group(['prefix' => 'admin'], function () {
Route::name('admin.')->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'role:admin'], function(){
        Route::get('/pengaduan/pdf', [App\Http\Controllers\Admin\PengaduanController::class, 'pdf'])->name('pengaduan.pdf');
        Route::get('/tanggapan/pdf', [App\Http\Controllers\Admin\TanggapanController::class, 'pdf'])->name('tanggapan.pdf');
        Route::get('/masyarakat/pdf', [App\Http\Controllers\Admin\MasyarakatController::class, 'pdf'])->name('masyarakat.pdf');

        Route::resource('/masyarakat', App\Http\Controllers\Admin\MasyarakatController::class,[
            'names' => [
                'index' => 'masyarakat'
            ]
        ]);

        Route::resource('/petugas', App\Http\Controllers\Admin\PetugasController::class,[
            'names' => [
                'index' => 'petugas'
            ]
        ]);
    });

    Route::resource('/pengaduan', App\Http\Controllers\Admin\PengaduanController::class,[
        'names' => [
            'index' => 'pengaduan'
        ]
    ]);

    Route::resource('/tanggapan', App\Http\Controllers\Admin\TanggapanController::class,[
        'names' => [
            'index' => 'tanggapan'
        ]
    ]);
    });
});
