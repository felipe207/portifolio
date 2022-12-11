<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Controle\MainController;
use App\Http\Controllers\Controle\ServiceController;
use App\Http\Controllers\Controle\PortifolioController;
use App\Http\Controllers\Controle\AboutController;
use App\Http\Controllers\PagesController;


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
// Route::controller(HomeController::class)->prefix('/')
// ->name('/.')->group(function () {
// Route::get('/', 'home')->name('home');
// });

Route::controller(PagesController::class)->prefix('/')
->name('/.')->group(function () {
Route::get('/', 'index')->name('home');
});

Route::group([
    'prefix' => 'controle/',
    'middleware' => ['web', 'auth:sanctum', 'verified'],
    'as' => 'controle.',
], function () {
    Route::get('controle/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*--------------------------------------------------------------------------
    | Rotas do controle (Exemplo)
    |--------------------------------------------------------------------------*/
    // Route::controller(CategoriaController::class)->prefix('categoria')->name('categoria.')->group(function () {
    //     Route::get('/', 'index')->middleware('permission:Visualizar categoria')
    //->name('index');
    //     Route::get('/form/{id?}', 'form')->middleware('permission:Cadastrar categoria')->name('form');
    //     Route::post('/store', 'store')->middleware('permission:Cadastrar categoria')->name('store');
    //     Route::post('/update/{id}', 'update')->middleware('permission:Alterar categoria')->name('update');
    //     Route::get('/delete/{id}', 'delete')->middleware('permission:Excluir categoria')->name('delete');
    // });

     /*--------------------------------------------------------------------------
    | Rotas de Serviço (Exemplo)
    |--------------------------------------------------------------------------*/
    Route::controller(ServiceController::class)->prefix('servico')->name('servico.')->group(function () {
        Route::get('/', 'index')->middleware('permission:Visualizar servico')
    ->name('index');
        Route::get('/form/{id?}', 'form')->middleware('permission:Cadastrar servico')->name('form');
        Route::post('/create', 'create')->middleware('permission:Cadastrar servico')->name('create');
        Route::post('/update/{id}', 'update')->middleware('permission:Alterar servico')->name('update');
        Route::get('/delete/{id}', 'delete')->middleware('permission:Excluir servico')->name('delete');
    });

});

// Route::get('/', 'PagesController@index')->name('home');

Route::prefix('admin')->group(function(){
    Route::get('/dashboard', 'MainPagesController@dashboard')->name('admin.dashboard');
    Route::get('/main', 'MainPagesController@index')->name('admin.main');
    Route::put('/main', 'MainPagesController@update')->name('admin.main.update');
    Route::get('/services/create', 'ServicePagesController@create')
    ->name('admin.services.create');
    Route::post('/services/create', 'ServicePagesController@store')
    ->name('admin.services.store');
    Route::get('/services/list', 'ServicePagesController@list')->name('admin.services.list');
    Route::get('/services/edit/{id}', 'ServicePagesController@edit')->name('admin.services.edit');
    Route::post('/services/update/{id}', 'ServicePagesController@update')->name('admin.services.update');
    Route::delete('/services/destroy/{id}', 'ServicePagesController@destroy')->name('admin.services.destroy');
    Route::get('/portfolios/create', 'PortfolioPagesController@create')->name('admin.portfolios.create');
    Route::put('/portfolios/create', 'PortfolioPagesController@store')->name('admin.portfolios.store');
    Route::get('/portfolios/list', 'PortfolioPagesController@list')->name('admin.portfolios.list');
    Route::get('/portfolios/edit/{id}', 'PortfolioPagesController@edit')->name('admin.portfolios.edit');
    Route::post('/portfolios/update/{id}', 'PortfolioPagesController@update')->name('admin.portfolios.update');
    Route::delete('/portfolios/destroy/{id}', 'PortfolioPagesController@destroy')->name('admin.portfolios.destroy');
    Route::get('/abouts/create', 'AboutPagesController@create')->name('admin.abouts.create');
    Route::put('/abouts/create', 'AboutPagesController@store')->name('admin.abouts.store');
    Route::get('/abouts/list', 'AboutPagesController@list')->name('admin.abouts.list');
    Route::get('/abouts/edit/{id}', 'AboutPagesController@edit')->name('admin.abouts.edit');
    Route::post('/abouts/update/{id}', 'AboutPagesController@update')->name('admin.abouts.update');
    Route::delete('/abouts/destroy/{id}', 'AboutPagesController@destroy')->name('admin.abouts.destroy');
});

Route::post('/contact','ContactFormController@store')->name('contact.store');

// Auth::routes();
