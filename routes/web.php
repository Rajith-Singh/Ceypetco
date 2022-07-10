<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProposalController;


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

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->name('user.')->group(function(){

    Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
        Route::view('/login','dashboard.user.login')->name('login');
        Route::view('/register','dashboard.user.register')->name('register');
        Route::post('create',[UserController::class,'create'])->name('create');
        Route::post('/check',[UserController::class,'check'])->name('check');
    });

    Route::middleware(['auth:web','PreventBackHistory'])->group(function(){
        Route::view('/home','dashboard.user.home')->name('home');
        Route::post('/logout',[UserController::class,'logout'])->name('logout');

        Route::get('add-proposal', function () {
            return view('dashboard.user.add-proposal');
        });

        Route::get('add-comments', function () {
            return view('dashboard.user.add-comments');
        });

        Route::get('manage-proposals', function () {
            $data=App\Models\Proposal::all();
            return view('dashboard.user.manage-proposals')->with('data',$data);
        });

        Route::get('/deleteProposal/{id}', [ProposalController::class, 'deleteProposal']);

        Route::get('/editProposal/{id}', [ProposalController::class, 'editProposal']);

        Route::get('/addComments/{id}', [ProposalController::class, 'addComments']);

    });

});

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
        Route::view('/login','dashboard.admin.login')->name('login');
        Route::post('/check',[AdminController::class,'check'])->name('check');
    });

    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
        Route::view('/home','dashboard.admin.home')->name('home');
        Route::post('/logout',[AdminController::class,'logout'])->name('logout');
    });
});

Route::post('/saveProposal',[ProposalController::class,'storeProposal']);

Route::post('/updateProposal', [ProposalController::class, 'updateProposal']);

Route::post('/add_comment', [ProposalController::class, 'add_comment']);

Route::post('/add_reply', [ProposalController::class, 'add_reply']);



