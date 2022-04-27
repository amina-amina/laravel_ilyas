<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
Route::get('/contacts/{id?}', [ContactController::class,'index']
   // return "<h1>All contacts</h1>";
   //return view('contacts.index');
)->name('contacts.index');




Route::post('/contacts', [ContactController::class,'store']

)->name('contacts.store');

Route::get('/contacts/create/test', [ContactController::class,'create']
   // return "<h1>Add new contact</h1>";
   //return view('contacts.create');
)->name('contacts.create');

Route::delete('/contacts/{id}' , [ContactController::class,'delete']
)->name('contacts.delete');

Route::get('/contacts/show/{id}', [ContactController::class,'show']
    //return App\Models\Contact::find($id);
    //$contact = App\Models\Contact::find($id);
    //return view('contacts.show', compact('contact'));
    
)->name('contacts.show');

Route::put('/contacts/{id}', [ContactController::class,'update']
    //return App\Models\Contact::find($id);
    //$contact = App\Models\Contact::find($id);
    //return view('contacts.show', compact('contact'));
    
)->name('contacts.update');






Route::get('/contacts/{id}/edit', [ContactController::class,'edit']
    
)->name('contacts.edit');
});


/*
Route::resources(
    '/contacts', ContactController::class
    
);
*/
Auth::routes(['verify' => true]);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
