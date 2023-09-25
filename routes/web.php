<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\OrderPaidController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripePaymentController;
use League\CommonMark\Extension\SmartPunct\DashParser;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([auth::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
//Admin profile Route
Route::middleware([CheckAdminRole::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//Admin custmer Route
Route::middleware([CheckAdminRole::class])->group(function () {
    Route::get('/custmer', [UserController::class, 'index'])->name('custmer.index');
    Route::get('/custmer/create',[UserController::class, 'create'])->name('custmer.create');
    Route::post('/custmer/store',[UserController::class, 'store'])->name('custmer.store');
    Route::get('/custmer/edit/{user_id}',[UserController::class, 'edit'])->name('custmer.edit');
    Route::post('/custmer/update/{user_id}',[UserController::class, 'update'])->name('custmer.update');
    Route::get('/custmer/delete/{user_id}',[UserController::class, 'delete'])->name('custmer.delete');
    Route::get('/custmer/show/{user_id}',[UserController::class, 'show'])->name('custmer.show');
   
});
//Admin book  Route
Route::middleware([CheckAdminRole::class])->group(function () {
    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book/store', [BookController::class, 'Store'])->name('book.store');
    Route::get('/book/edit/{book_id}',[BookController::class, 'edit'])->name('book.edit');
    Route::post('/book/update/{book_id}',[BookController::class, 'update'])->name('book.update');
    Route::get('/book/delete/{book_id}',[BookController::class, 'delete'])->name('book.delete');
    Route::get('/book/show/{book_id}',[BookController::class, 'show'])->name('book.show');
   
});


// Admin Order Route
Route::middleware([CheckAdminRole::class])->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orderdetails/{trans_id}', [OrderController::class, 'show'])->name('details');
  
});


//Custmor Rent Route
Route::middleware([CheckCustomorRole::class])->group(function () {
    Route::get('/addcart', [RentController::class, 'index'])->name('addcart');
    Route::get('/rent/store/{bookId}', [RentController::class, 'rentNow'])->name('rent.rentNow');
    Route::get('/rent/delete/{rent_id}',[RentController::class, 'delete'])->name('rentbook.delete');
    Route::post('/update-rentcart', [RentController::class, 'updateRentCart'])->name('update-rentcart');
    Route::get('/contact_us', [RentController::class, 'contact_us'])->name('contact_us');
    Route::get('/get-book-details/{id}', [BookController::class, 'getBookDetails']);
});

//Custmor Stripe  payment 
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
    Route::get('return_payment/{order_id}', 'return_payment');
    Route::post('returns_payment/{order_id}', 'store')->name('returns_payment.store');
    
});


//Custmor Order  payment order
Route::middleware([CheckCustomorRole::class])->group(function () {
    Route::get('/user_piadorder', [OrderPaidController::class, 'index'])->name('paidorder.index');
    Route::get('/user_piadorder/{trans_id}',[OrderPaidController::class, 'show'])->name('paidorder.show');
});

Route::get('/returnbook/{order_id}', [RentController::class, 'return_book'])->name('return');
Route::post('/returns_book/{order_id}', [RentController::class, 'store'])->name('return.store');
  
   
  

require __DIR__ . '/auth.php';
