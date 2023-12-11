<?php
use Illuminate\Support\Facades\Route; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function (){
    return view('welcome');
});
// Route::get('login', '\App\Http\Controllers\ProductController@login')->name('login');
// Route::post('login', '\App\Http\Controllers\ProductController@loginsubmit')->name('login.post');
// Route::get('forgotpassword','\App\Http\Controllers\ProductController@forgotpassword')->name('forgotpassword'); 
// Route::get('register','\App\Http\Controllers\ProductController@register')->name('register');
// Route::post('register','\App\Http\Controllers\ProductController@registerSubmit')->name('register.post');
Route::get('table','\App\Http\Controllers\ProductController@affichertable')->name('table');
Route::get('storehomepage','\App\Http\Controllers\ProductController@afficherproduits')->name('storehomepage');
//Route::resource('photos', PhotoController::class);
route::get('/product/{id}','ProductController@index')->name('product.list');
Route::get('ajouterproduit', '\App\Http\Controllers\ProductController@ajouterproduit')->name('ajouterproduit');
Route::get('produit/edit/{idproduit}', '\App\Http\Controllers\ProductController@modificationProduit')->name('produit.edit');
Route::post('ajouterproduit', '\App\Http\Controllers\ProductController@ajouter')->name('ajouterproduit.post');



Route::post('ajoutercommande', '\App\Http\Controllers\ProductController@ajoutercommande')->name('ajoutercommande.post');
Route::get('ajoutercommande', '\App\Http\Controllers\ProductController@affichercommande')->name('ajoutercommande');



Route::post('produit/edit/{id}','\App\Http\Controllers\ProductController@modificationProduitPost')->name('produit.edit.post');
Route::get('produit/delete/{id}','\App\Http\Controllers\ProductController@DeleteProduct')->name('produit.delete');
Route::get('detail/{id}','\App\Http\Controllers\ProductController@MoreDetail')->name('detail');
Route::get('carte','\App\Http\Controllers\ProductController@affichercarte')->name('carte');
Route::post('/categorie', 'CategorieController@index')->name('categorie.list.post');
Route::get('AddCart/{id}','\App\Http\Controllers\ProductController@AddCart')->name('AddCart');
Route::get('Add/{id}/{quantite}','\App\Http\Controllers\ProductController@Add')->name('Add');
Route::get('/cart/show','\App\Http\Controllers\ProductController@cart')->name('cart.show');
// route::put('/categorie', 'CategorieController@index')->name('categorie.list.put');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 
