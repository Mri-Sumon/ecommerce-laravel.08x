<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayoutsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\SettingsController; 
use App\Http\Controllers\SectionController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\FrontendMainController;

////////////////////////////////////////////////FRONTEND HANDLING ROUTE//////////////////////////////////////////
//FrontendMainController
Route::post('frontend/feedbackemail', [FrontendMainController::class, 'feedbackemail']);
Route::get('/', [FrontendMainController::class, 'home']);
Route::get('frontend/subPages/{slug}', [FrontendMainController::class, 'subPages']);
Route::get('frontend/topbar', [FrontendMainController::class, 'topbar']);
Route::get('frontend/sidebar', [FrontendMainController::class, 'sidebar']);
Route::get('frontend/footer', [FrontendMainController::class, 'footer']);
Route::get('frontend/master', [FrontendMainController::class, 'master']);
Route::get('categoryWiseProduct/{id}', [FrontendMainController::class, 'categoryWiseProduct']);
Route::get('singleShow/{id}', [FrontendMainController::class, 'singleShow']);
Route::post('reviews', [FrontendMainController::class, 'reviews']);
Route::post('addToCart/{id}', [FrontendMainController::class, 'addToCart']);
Route::get('cart', [FrontendMainController::class, 'cart']);
Route::get('deleteItem/{id}', [FrontendMainController::class, 'deleteItem']);
Route::get('shippingAddress', [FrontendMainController::class, 'shippingAddress']);
Route::post('confirmOrder', [FrontendMainController::class, 'confirmOrder']);




///////////////////////////////////////////////FRONTEND & BACKEND HANDLING ROUTE/////////////////////////////////
//SettingsController
Route::resource('settings', SettingsController::class);





////////////////////////////////////////////////////BACKEND HANDLING ROUTE//////////////////////////////////////
//All Search
Route::get('categorySearch', [CategoryController::class, 'categorySearch']);
Route::get('productSearch', [ProductController::class, 'productSearch']);
Route::get('paymentMethodsSearch', [PaymentMethodsController::class, 'paymentMethodsSearch']);
Route::get('pageSearch', [PagesController::class, 'pageSearch']);
Route::get('sectionSearch', [SectionController::class, 'sectionSearch']);
Route::get('sectionBodySearch', [MediaController::class, 'sectionBodySearch']);
Route::get('userSearch', [UsersController::class, 'userSearch']);

//MediaController
Route::resource('medias', MediaController::class);
Route::get('videos', [MediaController::class, 'videos']);
Route::post('addVideos', [MediaController::class, 'addVideos']);
//PosController
Route::resource('pos', PosController::class);
//TransactionsController
Route::resource('transactions', TransactionsController::class);
//PaymentMethodsController
Route::resource('paymentsMethods', PaymentMethodsController::class);
Route::get('pmtrash', [PaymentMethodsController::class, 'pmtrash']);
Route::get('pmrestore/{id}', [PaymentMethodsController::class, 'pmrestore']);
Route::delete('pmdelete/{id}', [PaymentMethodsController::class, 'pmdelete']);
//UsersController
Route::resource('users', UsersController::class);
Route::get('utrash', [UsersController::class, 'utrash']);
Route::get('urestore/{id}', [UsersController::class, 'urestore']);
Route::delete('udelete/{id}', [UsersController::class, 'udelete']);
Route::get('users_pdf', [UsersController::class, 'pdf']);
//PagesController
Route::resource('pages', PagesController::class);
Route::get('pstrash', [PagesController::class, 'pstrash']);
Route::get('psrestore/{id}', [PagesController::class, 'psrestore']);
Route::delete('psdelete/{id}', [PagesController::class, 'psdelete']);
Route::get('pages_pdf', [PagesController::class, 'pdf']);
//SectionsController
Route::resource('sections', SectionController::class);  
//DiscountController
Route::resource('discounts', DiscountController::class);
//OrdersController
Route::resource('orders', OrdersController::class);
Route::get('allOrdersOfOneUser/{id}', [OrdersController::class, 'allOrdersOfOneUser']);
//ShippingController
Route::resource('shippings', ShippingController::class);
//AddressController
Route::resource('addresses', AddressController::class);
//BrandController
Route::resource('brands', BrandController::class);
//ProductController
Route::resource('products', ProductController::class);
Route::get('ptrash', [ProductController::class, 'ptrash']);
Route::get('prestore/{id}', [ProductController::class, 'prestore']);
Route::delete('pdelete/{id}', [ProductController::class, 'pdelete']);
Route::get('products_pdf', [ProductController::class, 'pdf']);
//CategoryController
Route::resource('categories', CategoryController::class);
Route::get('trash', [CategoryController::class, 'trash']);
Route::get('restore/{id}', [CategoryController::class, 'restore']);
Route::delete('delete/{id}', [CategoryController::class, 'delete']);
Route::get('categories_pdf', [CategoryController::class, 'pdf']);
//Dashboard Laravel Ready package controller
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
//LayoutsController
Route::get('/master', [LayoutsController::class, 'master']); 
Route::get('/sidebar', [LayoutsController::class, 'sidebar']);
Route::get('/topbar', [LayoutsController::class, 'topbar']);






























