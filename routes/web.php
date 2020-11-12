<?php

use Illuminate\Support\Facades\Route;
// admin routes 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\ProducerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\UsersController;
// user routes
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ThanksController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;

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

// show 404
Route::fallback(function () {
    return view("error");
});

// user
Route::group(['middleware' => 'localization'], function () {
    // change language
    Route::get('change-language/{language}', [HomeController::class, 'changeLanguage'])->name('changeLanguage');
    // search autocomplete
    Route::get('/search', [SearchController::class, 'index'])->name('userSearch');
    Route::post('/search', [SearchController::class, 'index'])->name('userPostSearch');
    // home
    Route::get('/', [HomeController::class, 'index'])->name('userHome');
    Route::post('/modal', [HomeController::class, 'modal'])->name('userModal');
    // login
    Route::post('/postRegister', [LoginController::class, 'postRegister'])->name('userPostRegister');
    Route::post('/postLogin', [LoginController::class, 'postLogin'])->name('userPostLogin');
    Route::post('/postLogout', [LoginController::class, 'postLogout'])->name('userPostLogout');
    Route::post('/showLogin', [LoginController::class, 'showLogin'])->name('userShowLogin');
    Route::post('/showLoginName', [LoginController::class, 'showLoginName'])->name('userShowLoginName');
    // products
    Route::get('/san-pham/{slug}', [ProductsController::class, 'detail'])->name('userProductDetail');
    Route::get('/danh-muc/{slug}', [ProductsController::class, 'catalog'])->name('userProductCatalog');
    Route::post('/danh-muc/{slug}', [ProductsController::class, 'catalog'])->name('userProductCatalogFilter');
    Route::get('/danh-muc/{slug}/page/{page?}', [ProductsController::class, 'catalog'])->name('userProductCatalogPage');
    Route::get('/danh-muc', [ProductsController::class, 'index'])->name('userProductShop');
    Route::post('/danh-muc', [ProductsController::class, 'index'])->name('userProductShopFilter');
    Route::get('/danh-muc/page/{page?}', [ProductsController::class, 'index'])->name('userProductShopPage');
    Route::post('/showComment/{id}', [ProductsController::class, 'showComment'])->name('userShowComment');
    Route::post('/showNameReply', [ProductsController::class, 'showNameReply'])->name('userShowNameReply');
    Route::post('/postReply', [ProductsController::class, 'postReply'])->name('userPostReply');
    Route::post('/postComment', [ProductsController::class, 'postComment'])->name('userPostComment');
    // cart ajax
    Route::post('/addToCart', [CartController::class, 'addToCart'])->name('userCartAdd');
    Route::post('/showCartSidebar', [CartController::class, 'showCartSidebar'])->name('userShowCartSidebar');
    Route::post('/removeCart', [CartController::class, 'removeCart'])->name('userRemoveCart');
    Route::post('/updateCart', [CartController::class, 'updateCart'])->name('userUpdateCart');
    Route::post('/showCartQuantity', [CartController::class, 'showCartQuantity'])->name('userShowCartQuantity');
    Route::post('/showCartTotal', [CartController::class, 'showCartTotal'])->name('userShowCartTotal');
    Route::post('/showCartTable', [CartController::class, 'showCartTable'])->name('userShowCartTable');
    Route::post('/showCartOrder', [CartController::class, 'showCartOrder'])->name('userShowCartOrder');
    // coupon ajax
    Route::post('/coupon', [CartController::class, 'showCoupon'])->name('userShowCoupon');
    // cart ui
    Route::get('/gio-hang', [CartController::class, 'index'])->name('userCart');
    // contact
    Route::get('/lien-he', [ContactsController::class, 'index'])->name('userContact');
    Route::post('/postContacts', [ContactsController::class, 'postContact'])->name('userPostContact');
    // about
    Route::get('/gioi-thieu', [AboutController::class, 'index'])->name('userAbout');
    // checkout
    Route::get('/thanh-toan', [CheckoutController::class, 'index'])->name('userCheckout');
    Route::post('/showCheckoutCart', [CheckoutController::class, 'showCheckoutCart'])->name('userShowCheckoutCart');
    Route::post('/showDistrict', [CheckoutController::class, 'showDistrict'])->name('userShowDistrict');
    Route::post('/postCheckout', [CheckoutController::class, 'postCheckout'])->name('userPostCheckout');
    // thanks
    Route::get('/thanks', [ThanksController::class, 'index'])->name('userThanks');
    // order
    Route::get('/lich-su-dat-hang', [OrderController::class, 'history'])->name('userOrderHistory');
    Route::get('/lich-su-dat-hang/{id}', [OrderController::class, 'detail'])->name('userOrderDetail');
    Route::get('/remove/{id}', [OrderController::class, 'remove'])->name('userOrderRemove');
    // user
    Route::get('/thong-tin-ca-nhan', [UserController::class, 'index'])->name('userProfile');
    Route::get('/cap-nhat-thong-tin/{id}', [UserController::class, 'edit'])->name('userEdit');
    Route::post('/postEdit/{id}', [UserController::class, 'postEdit'])->name('userPostEdit');
    Route::get('/doi-mat-khau/{id}', [UserController::class, 'reset'])->name('userReset');
    Route::post('/resetPassword/{id}', [UserController::class, 'postReset'])->name('userPostResetPassword');
    Route::get('/quen-mat-khau', [UserController::class, 'forgot'])->name('userForgotPassword');
    Route::post('/postForgot', [UserController::class, 'postForgot'])->name('userPostForgotPassword');
    Route::get('/lay-lai-mat-khau/{id}', [UserController::class, 'getForgot'])->name('userGetForgotPassword');
    Route::post('/postGetForgotPassword/{id}', [UserController::class, 'postForgotPassword'])->name('userGetPostForgotPassword');
});

// admin
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {
        // dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('adminDashboard');

        // catalog
        Route::prefix('catalog')->group(function () {
            Route::get('/', [CatalogController::class, 'index'])->name('adminCatalog');
            Route::get('/add', [CatalogController::class, 'add'])->name('adminCatalogAdd');
            Route::post('/postAdd', [CatalogController::class, 'postAdd'])->name('adminCatalogPostAdd');
            Route::get('/edit/{id}', [CatalogController::class, 'edit'])->name('adminCatalogEdit');
            Route::post('/postEdit/{id}', [CatalogController::class, 'postEdit'])->name('adminCatalogPostEdit');
            Route::get('/trash/{id}', [CatalogController::class, 'trash'])->name('adminCatalogTrash');
            Route::get('/status/{id}', [CatalogController::class, 'status'])->name('adminCatalogStatus');
            Route::get('/restore/{id}', [CatalogController::class, 'restore'])->name('adminCatalogRestore');
            Route::get('/recycle', [CatalogController::class, 'recycle'])->name('adminCatalogRecycle');
            Route::get('/delete/{id}', [CatalogController::class, 'delete'])->name('adminCatalogDelete');
        });

        // producer
        Route::prefix('producer')->group(function () {
            Route::get('/', [ProducerController::class, 'index'])->name('adminProducer');
            Route::get('/add', [ProducerController::class, 'add'])->name('adminProducerAdd');
            Route::post('/postAdd', [ProducerController::class, 'postAdd'])->name('adminProducerPostAdd');
            Route::get('/edit/{id}', [ProducerController::class, 'edit'])->name('adminProducerEdit');
            Route::post('/postEdit/{id}', [ProducerController::class, 'postEdit'])->name('adminProducerPostEdit');
            Route::get('/status/{id}', [ProducerController::class, 'status'])->name('adminProducerStatus');
            Route::get('/delete/{id}', [ProducerController::class, 'delete'])->name('adminProducerDelete');
        });

        // brand
        Route::prefix('brand')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('adminBrand');
            Route::get('/add', [BrandController::class, 'add'])->name('adminBrandAdd');
            Route::post('/postAdd', [BrandController::class, 'postAdd'])->name('adminBrandPostAdd');
            Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('adminBrandEdit');
            Route::post('/postEdit/{id}', [BrandController::class, 'postEdit'])->name('adminBrandPostEdit');
            Route::get('/status/{id}', [BrandController::class, 'status'])->name('adminBrandStatus');
            Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('adminBrandDelete');
        });

        // product
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('adminProduct');
            Route::get('/add', [ProductController::class, 'add'])->name('adminProductAdd');
            Route::post('/postAdd', [ProductController::class, 'postAdd'])->name('adminProductPostAdd');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('adminProductEdit');
            Route::post('/postEdit/{id}', [ProductController::class, 'postEdit'])->name('adminProductPostEdit');
            Route::get('/status/{id}', [ProductController::class, 'status'])->name('adminProductStatus');
            Route::get('/featured/{id}', [ProductController::class, 'featured'])->name('adminProductFeatured');
            Route::get('/trash/{id}', [ProductController::class, 'trash'])->name('adminProductTrash');
            Route::get('/recycle', [ProductController::class, 'recycle'])->name('adminProductRecycle');
            Route::get('/restore/{id}', [ProductController::class, 'restore'])->name('adminProductRestore');
            Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('adminProductDelete');
        });

        // slider
        Route::prefix('slider')->group(function () {
            Route::get('/', [SliderController::class, 'index'])->name('adminSlider');
            Route::get('/add', [SliderController::class, 'add'])->name('adminSliderAdd');
            Route::post('/postAdd', [SliderController::class, 'postAdd'])->name('adminSliderPostAdd');
            Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('adminSliderEdit');
            Route::post('/postEdit/{id}', [SliderController::class, 'postEdit'])->name('adminSliderPostEdit');
            Route::get('/status/{id}', [SliderController::class, 'status'])->name('adminSliderStatus');
            Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('adminSliderDelete');
        });

        // Coupon
        Route::prefix('coupon')->group(function () {
            Route::get('/', [CouponController::class, 'index'])->name('adminCoupon');
            Route::get('/add', [CouponController::class, 'add'])->name('adminCouponAdd');
            Route::post('/postAdd', [CouponController::class, 'postAdd'])->name('adminCouponPostAdd');
            Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('adminCouponEdit');
            Route::post('/postEdit/{id}', [CouponController::class, 'postEdit'])->name('adminCouponPostEdit');
            Route::get('/status/{id}', [CouponController::class, 'status'])->name('adminCouponStatus');
            Route::get('/delete/{id}', [CouponController::class, 'delete'])->name('adminCouponDelete');
        });

        // Orders
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrdersController::class, 'index'])->name('adminOrders');
            Route::get('/status/{id}', [OrdersController::class, 'status'])->name('adminOrdersStatus');
            Route::get('/cancel/{id}', [OrdersController::class, 'cancel'])->name('adminOrdersCancel');
            Route::get('/save', [OrdersController::class, 'save'])->name('adminOrdersSave');
            Route::get('/changeSave/{id}', [OrdersController::class, 'changeSave'])->name('adminOrdersChangeSave');
            Route::get('/changeRestore/{id}', [OrdersController::class, 'changeRestore'])->name('adminOrdersChangeRestore');
            Route::get('/detail/{id}', [OrdersController::class, 'detail'])->name('adminOrdersDetail');
            Route::get('/delete/{id}', [OrdersController::class, 'delete'])->name('adminOrdersDelete');
        });

        // Contact
        Route::prefix('contact')->group(function () {
            Route::get('/', [ContactController::class, 'index'])->name('adminContact');
            Route::get('/detail/{id}', [ContactController::class, 'detail'])->name('adminContactDetail');
            Route::post('/postDetail/{id}', [ContactController::class, 'postDetail'])->name('adminPostContact');
            Route::get('/delete/{id}', [ContactController::class, 'delete'])->name('adminContactDelete');
        });

         // User
         Route::prefix('user')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('adminUser');
            Route::get('/status/{id}', [UsersController::class, 'status'])->name('adminUserStatus');
            Route::get('/delete/{id}', [UsersController::class, 'delete'])->name('adminUserDelete');
        });
    });
});