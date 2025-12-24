<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\MenuPagesController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\OrderController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

/* =========> Sart Frontend All Routes <========= */
Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');
Route::post('/ielts/store', [FrontendController::class, 'IeltStore'])->name('ielts.store');
Route::post('/subscribe/store', [FrontendController::class, 'SubsStore'])->name('subs.store');
// single page route
Route::get('/study/abroad/{slug}', [FrontendController::class, 'SingleStudy'])->name('single.study.page');
Route::get('/education/{slug}', [FrontendController::class, 'SingleEducation'])->name('single.education.page');
Route::get('/tourist/{slug}', [FrontendController::class, 'SingleTourist'])->name('single.tourist.page');
Route::get('/single/service/{slug}', [FrontendController::class, 'SingleService'])->name('single.service.page');
Route::get('/single/product/{slug}', [FrontendController::class, 'SingleProduct'])->name('single.product.page');
Route::get('/single/umrah/{slug}', [FrontendController::class, 'SingleUmrah'])->name('single.umrah.page');
Route::get('/single/tour/{slug}', [FrontendController::class, 'SingleTour'])->name('single.tour.page');
// view all route
Route::get('/study/list', [FrontendController::class, 'StudyAll'])->name('study.all');
Route::get('/edu/list', [FrontendController::class, 'EducationAll'])->name('education.all');
Route::get('/tourist/visa/list', [FrontendController::class, 'TouristAll'])->name('tourist.all');
Route::get('/workparmit/visa/list', [FrontendController::class, 'WorkparmitAll'])->name('workparmit.all');
Route::get('/service/list', [FrontendController::class, 'ServiceAll'])->name('service.all');
Route::get('/product/list', [FrontendController::class, 'ProductAll'])->name('product.all');
Route::get('/agent/list', [FrontendController::class, 'AgentAll'])->name('agent.all');
// page all route
Route::get('/page/{url}', [MenuPagesController::class, 'index'])->name('menu.page');
Route::get('/pages/{page}', [MenuPagesController::class, 'FooterPages'])->name('footer.menu.page');
Route::post('/contact/store', [MenuPagesController::class, 'ContactPages'])->name('contact.store');
Route::post('/search/result', [MenuPagesController::class, 'SearchResult'])->name('result.search');
// payment methods
Route::post('/payment/method', [PaymentController::class, 'create'])->name('payment.method');
Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');

// product order now
Route::post('/product-checkout', [OrderController::class, 'storeSessionAndRedirect'])->name('product.checkout.redirect');
Route::get('/checkout', [OrderController::class, 'checkoutPage'])->name('product.checkout.page');
Route::post('/order/submit', [OrderController::class, 'store'])->name('product.order.store');
Route::get('/order/success', [OrderController::class, 'success'])->name('product.order.success');


/* =========> End Frontend All Routes <========== */

Route::redirect('/login', '/');
Route::redirect('/register', '/');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
