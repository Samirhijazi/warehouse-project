<?php

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


Route::get('/login', App\Http\Livewire\User\Pages\LoginPage::class)
    ->name('login');
Route::get('/logout', App\Http\Livewire\User\Pages\LogoutPage::class)
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', App\Http\Livewire\Dashboard\Pages\IndexPage::class)
        ->name('dashboard.index');

    Route::prefix('/users')->group(function() {
        Route::get('/', App\Http\Livewire\User\Pages\UserIndexPage::class)
            ->middleware('permission:user.view')
            ->name('user.index');
        Route::get('/add', App\Http\Livewire\User\Pages\UserAddPage::class)
            ->name('user.add')
            ->middleware('permission:user.create');
        Route::get('{id}/edit', App\Http\Livewire\User\Pages\UserEditPage::class)
            ->name('user.edit')
            ->middleware('permission:user.update');
    });

    Route::prefix('/goods')->group(function() {
        Route::get('/', App\Http\Livewire\Goods\Pages\IndexPage::class)
            ->name('goods.index')
            ->middleware('permission:goods.view');
        Route::get('/add', App\Http\Livewire\Goods\Pages\AddGoodsPage::class)
            ->name('goods.add')
            ->middleware('permission:goods.create');
        Route::get('{id}/edit', App\Http\Livewire\Goods\Pages\EditGoodsPage::class)
            ->name('goods.edit')
            ->middleware('permission:goods.update');
        Route::get('{id}/detail', App\Http\Livewire\Goods\Pages\DetailGoodsPage::class)
            ->name('goods.detail');
    });

    Route::prefix('/goods-categories')->group(function() {
        Route::get('/', App\Http\Livewire\GoodsCategory\Pages\CategoryPage::class)
            ->name('goods-category.index')
            ->middleware('permission:goods-category.view');
        Route::get('/add', App\Http\Livewire\GoodsCategory\Pages\AddCategoryPage::class)
            ->name('goods-category.add')
            ->middleware('permission:goods-category.create');
        Route::get('/{id}/edit', App\Http\Livewire\GoodsCategory\Pages\EditCategoryPage::class)
            ->name('goods-category.edit')
            ->middleware('permission:goods-category.update');
    });

    Route::prefix('/suppliers')->group(function() {
        Route::get('/', App\Http\Livewire\Supplier\Pages\IndexPage::class)
            ->name('supplier.index')
            ->middleware('permission:supplier.view');
        Route::get('/add', App\Http\Livewire\Supplier\Pages\AddSupplierPage::class)
            ->name('supplier.add');
        Route::get('{id}/edit', App\Http\Livewire\Supplier\Pages\EditSupplierPage::class)
            ->name('supplier.edit');
    });

    Route::prefix('/shippers')->group(function() {
        Route::get('/', App\Http\Livewire\Shipper\Pages\IndexPage::class)
            ->name('shipper.index');
        Route::get('/add', App\Http\Livewire\Shipper\Pages\AddShipperPage::class)
            ->name('shipper.add')
            ->middleware('permission:shipper.create');
        Route::get('{id}/edit', App\Http\Livewire\Shipper\Pages\EditShipperPage::class)
            ->name('shipper.edit')
            ->middleware('permission:shipper.update');;
    });

    Route::prefix('/receiving')->group(function() {
        Route::get('/', App\Http\Livewire\Receiving\Pages\IndexPage::class)
            ->name('receiving.index');
        Route::get('{id}/detail', App\Http\Livewire\Receiving\Pages\DetailReceivingPage::class)
            ->name('receiving.detail');
        Route::get('/add', App\Http\Livewire\Receiving\Pages\AddReceivingPage::class)
            ->name('receiving.add')
            ->middleware('permission:goods-transaction.create');
    });

    Route::prefix('/dispatching')->group(function() {
        Route::get('/', App\Http\Livewire\Dispatching\Pages\IndexPage::class)
            ->name('dispatching.index');
        Route::get('/add', App\Http\Livewire\Dispatching\Pages\AddDispatchingPage::class)
            ->name('dispatching.add')
            ->middleware('permission:goods-transaction.create');
        Route::get('/{id}/detail', App\Http\Livewire\Dispatching\Pages\DetailDispatchingPage::class)
            ->name('dispatching.detail');
    });

    Route::prefix('/stock-opname')->group(function() {
        Route::get('/', App\Http\Livewire\StockOpname\Pages\IndexPage::class)
            ->name('stock-opname.index');
        Route::get('/add', App\Http\Livewire\StockOpname\Pages\AddStockOpnamePage::class)
            ->name('stock-opname.add')
            ->middleware('permission:goods-transaction.create');
        Route::get('/{id}/detail', App\Http\Livewire\StockOpname\Pages\DetailStockOpnamePage::class)
            ->name('stock-opname.detail');
    });

    Route::prefix('/transaction-categories')->group(function() {
        Route::get('/', App\Http\Livewire\TransactionCategory\Pages\IndexPage::class)
            ->name('transaction-category.index')
            ->middleware('permission:goods-transaction-category.view');
        Route::get('/add', App\Http\Livewire\TransactionCategory\Pages\AddTransactionCategory::class)
            ->name('transaction-category.add')
            ->middleware('permission:goods-transaction-category.create');
        Route::get('{id}/edit', App\Http\Livewire\TransactionCategory\Pages\AddTransactionCategory::class)
            ->name('transaction-category.edit')
            ->middleware('permission:goods-transaction-category.update');
    });

    Route::prefix('/print-pdf')->controller(\App\Http\Controllers\PrintPDFController::class)->group(function () {
        Route::get('/receiving-detail/{id}', 'receivingDetail')
            ->name('print-pdf.receiving-detail');
        Route::get('/dispatching-detail/{id}', 'dispatchingDetail')
            ->name('print-pdf.dispatching-detail');
        Route::get('/stock-opname-detail/{id}', 'stockOpnameDetail')
            ->name('print-pdf.stock-opname-detail');
    })->middleware(['role:Super Admin']);

    Route::prefix('/roles')->group(function() {
        Route::get('/', App\Http\Livewire\User\Pages\RoleIndexPage::class)
            ->name('role.index');
        Route::get('/add', App\Http\Livewire\User\Pages\RoleAddPage::class)
            ->name('role.add');
        Route::get('{id}/edit', App\Http\Livewire\User\Pages\RoleAddPage::class)
            ->name('role.edit');
    })->middleware(['role:Super Admin']);
});

