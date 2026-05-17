

<?php

use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\Admin\OrderAdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserDashboardController;

Route::get('/', [ProductController::class, 'home'])
    ->name('home');

Route::get('/products/{product}', [
    ProductController::class,
    'publicShow'
]);
    
Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get(
        '/dashboard',
        [UserDashboardController::class, 'index']
    )->name('user.dashboard');


    Route::get('/products', [
        ProductController::class,
        'publicIndex'
    ]);

    Route::get('/orders/create', [ OrderController::class, 'create' ]);
    Route::post('/orders', [ OrderController::class,'store']);
    Route::get('/my-orders', [OrderController::class,'myOrders']);
    Route::get('/my-orders/{order}', [OrderController::class,'showMyOrder']);
    Route::post('/orders/{order}/payment',[PaymentController::class, 'store']);
    
});


// ======================
// ADMIN
// ======================

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('products', ProductController::class);
        // Route::get('/orders', [OrderController::class, 'index']);
        Route::resource('accessories', AccessoryController::class);
        Route::resource('materials',MaterialController::class);

        // 
        Route::get(
        '/orders',
        [OrderAdminController::class, 'index']
    );

    Route::get(
        '/orders/{order}',
        [OrderAdminController::class, 'show']
    );

    Route::put(
        '/orders/{order}',
        [OrderAdminController::class, 'update']
    );
    });

    Route::post(
    '/admin/payments/{payment}/approve',
    [OrderAdminController::class, 'approvePayment']
)->middleware([
    'auth',
    'role:admin'
]);


// ======================
// SUPER ADMIN
// ======================

Route::middleware(['auth', 'role:super_admin'])
    ->prefix('super-admin')
    ->name('superadmin.')
    ->group(function () {

        Route::get('/', function () {
            return view('superadmin.dashboard');
        })->name('dashboard');
    });