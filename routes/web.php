<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Buyer\DashboardController as BuyerDashboardController;
use App\Http\Controllers\Buyer\browseProductsController;
use App\Http\Controllers\Buyer\MyOffersController;
use App\Http\Controllers\Buyer\OrdersController;
use App\Http\Controllers\Buyer\ReviewFeedbackController;
use App\Http\Controllers\Farmer\DashboardController as FarmerDashboardController;
use App\Http\Controllers\Farmer\PublishProductController;
use App\Http\Controllers\Farmer\ManageOffersController;
use App\Http\Controllers\Farmer\ConfirmOrdersController;
use App\Http\Controllers\Farmer\MyProductsController;
use App\Http\Controllers\Farmer\DemandAnalysisController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserManageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CounterOfferController;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'account.active',
])->get('/dashboard', function () {

    $user = Auth::user();

    return match ($user->role) {
        'buyer' => redirect()->route('buyer.dashboard'),

        'farmer' => redirect()->route('farmer.dashboard'),

        'admin' => redirect()->route('admin.dashboard'),

        default => redirect()->route('login'),
    };

})->name('dashboard');

Route::middleware(['auth','verified','account.active',])->group(function(){

    Route::get('/buyer/dashboard', [BuyerDashboardController::class, 'index'])
       ->name('buyer.dashboard');

    Route::get('/buyer/browseProducts', [browseProductsController::class, 'index'])
        ->name('buyer.browseProducts');

    Route::get('/buyer/products/{product}', [browseProductsController::class, 'show'])
        ->name('buyer.products.show');


    Route::get('/buyer/myOffers', [MyOffersController::class, 'index'])
        ->name('buyer.myOffers');

    Route::get('/buyer/orders', [OrdersController::class, 'index'])
        ->name('buyer.orders');

    Route::post('/buyer/offers/store', [OfferController::class, 'store'])
        ->name('buyer.offers.store');

    Route::post('/buyer/orders/{order}/review', [ReviewFeedbackController::class, 'store'])
        ->name('buyer.orders.review');

    Route::PATCH('/buyer/counter/{offer}/reject', [MyOffersController::class, 'counterReject'])
        ->name('buyer.counter.reject');

    Route::PATCH('/buyer/counter/{offer}/accept', [MyOffersController::class, 'counterAccept'])
        ->name('buyer.counter.accept');



    Route::get('/farmer/dashboard', [FarmerDashboardController::class, 'index'])
        ->name('farmer.dashboard');

    Route::get('/farmer/publishProducts', [PublishProductController::class, 'index'])
        ->name('farmer.publishProducts');

    Route::get('/farmer/manageOffers', [ManageOffersController::class, 'index'])
        ->name('farmer.manageOffers');

    Route::get('/farmer/confirmOrders', [ConfirmOrdersController::class, 'index'])
        ->name('farmer.confirmOrders');

    Route::get('/farmer/products/myProducts', [MyProductsController::class, 'index'])
        ->name('farmer.products.myProducts');

    Route::get('/farmer/products/{product}/editProducts', [MyProductsController::class, 'edit'])
        ->name('farmer.products.editProducts');

    Route::get('/farmer/demandAnalysis', [DemandAnalysisController::class, 'index'])
        ->name('farmer.demandAnalysis');

    Route::PATCH('/farmer/offers/{offer}/accept', [ManageOffersController::class, 'accept'])
        ->name('farmer.offers.accept');

    Route::PATCH('/farmer/offers/{offer}/reject', [ManageOffersController::class, 'reject'])
        ->name('farmer.offers.reject');

    Route::PATCH('/farmer/offers/{offer}/counter', [CounterOfferController::class, 'counter'])
        ->name('farmer.offers.counter');

    Route::PATCH('/farmer/orders/{order}/status', [ConfirmOrdersController::class, 'updateStatus'])
        ->name('farmer.orders.status');

    Route::PATCH('/farmer/products/{product}/update', [MyProductsController::class, 'update'])
        ->name('farmer.products.update');

    Route::post('/farmer/products/store', [ProductController::class, 'store'])
        ->name('farmer.products.store');

    Route::post('/farmer/smart-pricing/suggest',[ProductController::class, 'suggestPrice'])
        ->name('farmer.smart-pricing.suggest');

});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'admin', 'account.active',])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'] )
            ->name('dashboard');

        Route::get('/userManage', [UserManageController::class, 'index'] )
            ->name('userManage');
        
        Route::PATCH('/userManage/{user}/status', [UserManageController::class, 'updateStatus'] )
            ->name('userManage.status');

    });