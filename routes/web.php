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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'api/catalogos'], function() {
    Route::get('servidores_publicos', 'Catalogos\CatServidorPublicoController@getCatServidoresPublicos');
    Route::get('tipos_servidores_publicos/{id}', 'Catalogos\CatServidorPublicoController@getCatTiposServidoresPublicos');    
});

Route::get('encuesta/get_encuestas', 'EncuestaController@getEncuestas');
Route::get('encuesta/get_all_encuestas', 'EncuestaController@getAllEncuestas');
Route::get('encuesta/graficas', 'EncuestaController@graficas');
Route::get('data_recepcion', 'EncuestaController@getDataEstadistica');
Route::get('data_documentos', 'EncuestaController@getEstadisticaDocumentos');
Route::get('grafica/atencion_servidor_publico', 'EncuestaController@getAtencionServidorPublico');
Route::resource('encuesta', 'EncuestaController');
Route::get('comentarios', 'ComentarioController@index');
//Route::get('get_comentarios', 'ComentarioController@getComentarios');