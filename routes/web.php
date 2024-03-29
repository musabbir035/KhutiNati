<?php

use App\Http\Controllers\Admin\BannerImageController as AdminBannerImageController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SellerController as AdminSellerController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebPushController;
use App\Http\Livewire\Admin\CategoryList;
use App\Http\Livewire\Admin\OrderList;
use App\Http\Livewire\Admin\ProductList;
use App\Http\Livewire\Admin\SellerList;
use App\Http\Livewire\Admin\UserList;
use App\Http\Livewire\Admin\BannerImageList;
use App\Http\Livewire\Admin\CouponList;
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


// Route::get('/abc', function () {
//     $places = file_get_contents(resource_path('json/places.json'));
//     $placesJson = json_decode($places, true);
//     $divisions = [];
//     foreach ($placesJson as $key => $division) {
//         Division
//         foreach($division)
//     }
//     return $divisions;
// });

Route::middleware('share-categories')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/authenticate', [AuthController::class, 'login'])->name('authenticate');
        Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register-submit', [AuthController::class, 'register'])->name('register.submit');
        Route::get('/password-recovery', [AuthController::class, 'showPasswordRecoveryForm'])->name('password.recovery.form');
        Route::post('/password-recovery', [AuthController::class, 'passwordRecovery'])->name('password.recovery');
        Route::get('/password-recovery-confirm', [AuthController::class, 'showPasswordRecoveryConfirmForm'])->name('password.recovery.confirm.form');
        Route::post('/password-recovery-confirm', [AuthController::class, 'passwordRecoveryConfirm'])->name('password.recovery.confirm');
    });

    Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/checkout', [OrderController::class, 'storeAddress'])->name('orders.address.store');
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('share-categoies')->group(function () {
        Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('change-password');
        Route::post('/change-password-submit', [AuthController::class, 'changePassword'])->name('change-password.submit');
        Route::get('/account', [UserController::class, 'show'])->name('user.account');
    });
    Route::post('/web-push', [WebPushController::class, 'store']);

    Route::middleware(['roles:1,2'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminUserController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard', [AdminUserController::class, 'dashboard']);

        Route::get('/users', UserList::class)->name('users.index');
        Route::get('/account', function () {
            return view('admin.user.show', ['user' => Auth::user()]);
        })->name('account');
        Route::post('/users/{user}/update-status', [AdminUserController::class, 'updateStatus'])->name('users.update-status');
        Route::resource('users', AdminUserController::class)->except(['index']);

        Route::get('/categories', CategoryList::class)->name('categories.index');
        Route::resource('categories', AdminCategoryController::class)->except(['index']);

        Route::get('/products', ProductList::class)->name('products.index');
        Route::resource('products', AdminProductController::class)->except(['index']);

        Route::get('/sellers', SellerList::class)->name('sellers.index');
        Route::resource('sellers', AdminSellerController::class)->except(['index']);

        Route::get('/orders', OrderList::class)->name('orders.index');
        Route::post('/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::resource('orders', AdminOrderController::class)->except(['index']);

        Route::get('/banner-images', BannerImageList::class)->name('banner-images.index');
        Route::resource('banner-images', AdminBannerImageController::class)->except(['index', 'show']);

        Route::get('/coupons', CouponList::class)->name('coupons.index');
        Route::resource('coupons', AdminCouponController::class)->except(['index', 'show']);

        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
        Route::get('/notification-check/{id}', [NotificationController::class, 'check']);
        Route::post('/notification-mark-read', [NotificationController::class, 'markAsRead']);
    });
});

Route::get('/notiftest', [NotificationController::class, 'test']);
