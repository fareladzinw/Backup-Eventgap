<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/register', function () {
//     return view('page.Auth.register');
// });
// Route::get('/login', function () {
//     return view('page.Auth.login');
// });


Route::get('/login', [AuthController::class, 'indexLogin'])->name('login');
Route::post('/login', [AuthController::class, 'checkLogin'])->name('checkLogin');
Route::get('/register', [AuthController::class, 'indexRegister'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth','revalidate'])->group(function() {
    Route::get('/dashboard',[UserController::class, 'indexDashboard'] );
    Route::get('/event/kategori/{idKategori}', [UserController::class, 'indexKategori']);
    Route::get('/event/{id}', [UserController::class, 'indexDetailEvent']);
    Route::post('/event/{id}', [UserController::class, 'updateEvent'])->name('updateEvent');
    Route::get('/delete-event/{id}', [UserController::class, 'deleteEvent'])->name('deleteEvent');
    Route::get('/undraf/{id}', [UserController::class, 'unDraf'])->name('unDraf');
    Route::any('/search', [UserController::class, 'search'])->name('search');
    Route::get('/make-event', [UserController::class, 'indexMakeEvent']);
    Route::post('/make-event', [UserController::class, 'postMakeEvent'])->name('postEvent');
    Route::get('/buy-tiket/{idPembayaran}', [UserController::class, 'indexBuyTiket']);
    Route::post('/buy-tiket/{idPembayaran}', [UserController::class, 'postBuyTiket'])->name('buyTiket');
    Route::post('/buy-pembayaran/{idEvent}', [UserController::class, 'postPembayaran'])->name('buyPembayaran');
    Route::get('/my-profile', [UserController::class, 'indexMyProfile']);
    Route::post('/my-profile', [UserController::class, 'updateUser'])->name('updateUser');
    Route::post('/post-ktp', [UserController::class, 'postKtp'])->name('postKtp');
    Route::get('/make-ticket/{idEvent}', [UserController::class, 'indexMakeTiket']);
    Route::post('/make-ticket/{idEvent}', [UserController::class, 'postMakeTiket'])->name('postTiket');
    Route::get('/delete-ticket/{id}', [UserController::class, 'deleteTiket'])->name('deleteTiket');
    Route::get('/sponsori/{idEvent}', [UserController::class, 'indexSponsor']);
    Route::get('/table-acc/{idEvent}', [UserController::class, 'indexTable']);
    
    //ADMIN
    Route::get('/admin-page/dashboard',[UserController::class, 'indexDashboardAdmin'] );
    Route::post('/make-partner', [UserController::class, 'postMakePartner'])->name('postPartner');
    Route::get('/edit-partner/{id}', [UserController::class, 'indexUpdatePartner'])->name('indexEditPartner');
    Route::post('/edit-partner/{id}', [UserController::class, 'updatePartner'])->name('editPartner');
    Route::get('/delete-partner/{id}', [UserController::class, 'deletePartner'])->name('deletePartner');
    Route::get('/reject-ktp/{idUser}', [UserController::class, 'rejectKtp'])->name('rejectKtp');
    Route::get('/accept-ktp/{idUser}', [UserController::class, 'acceptKtp'])->name('acceptKtp');
    Route::get('/admin-page/dashboard-verifikasi',[UserController::class, 'indexVerifikasiUser'] );
});
Route::post('/sponsori/{idEvent}', [UserController::class, 'downloadProposal'])->name('downloadProposal');
Route::post('/table-acc/{idPembayaran}', [UserController::class, 'downloadBuktiPembayaran'])->name('downloadBuktiPembayaran');
Route::post('/bayar-nanti/{idPembayaran}', [UserController::class, 'bayarNanti'])->name('bayarNanti');
Route::post('/upload-bukti/{idPembayaran}', [UserController::class, 'postBuktiBayar']);
Route::get('/decline-pembayaran/{id}', [UserController::class, 'deletePembayaranA'])->name('declinePembayaran');
Route::post('/batal-pembayaran/{id}', [UserController::class, 'deletePembayaranU'])->name('batalPembayaran');


Route::get('/event-partner/{idTipe}',[UserController::class, 'indexPartner'] );
// Route::get('/foo', function () {
//   Artisan::call('config:cache');
// });











