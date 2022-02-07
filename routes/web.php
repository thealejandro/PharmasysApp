<?php

    use App\Models\Stores;
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

Route::middleware(['auth:sanctum', 'verified', 'role:Verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified', 'role:Super-Admin|Tester']], function () {
    Route::view('/system/database/load', 'modules.root.loadData')->name('system.database.load');
});

Route::middleware(['role:Super-Admin|Administrator', 'auth:sanctum', 'verified'])->group(function () {
    Route::get('/warehouse/purchases', [\App\Http\Controllers\PurchasesRecordsController::class, 'viewIndex'])->name('purchases.index');
    Route::post('/warehouse/purchases/create', [\App\Http\Controllers\PurchasesRecordsController::class, 'createRegisterPurchase'])->name('purchases.create');
    Route::put('/warehouse/purchases/verify/{idPurchase}', [\App\Http\Controllers\PurchasesRecordsController::class, 'verifyPurchase'])->name('purchases.verified');

    Route::view('/control/markets/inventories', 'modules.admin.inventories')->name('control.markets.inventories');
    Route::view('/control/markets/settlements', 'modules.admin.settlements')->name('control.markets.settlements');
});

Route::group(['middleware' => ['auth:sanctum', 'verified', 'role:Seller|Manager|Super-Admin']], function () {
    Route::view('/market', 'modules.sellers.market')->name('market.index');
    Route::view('/market/sales', 'modules.sellers.sales')->name('market.sales');
    Route::view('/market/inventory', 'modules.sellers.inventory')->name('market.inventory');
    Route::view('/market/orders', 'modules.sellers.orders')->name('market.orders');
    Route::view('/market/expired', 'modules.sellers.expired')->name('market.expired');
    Route::view('/market/requests', 'modules.sellers.requests')->name('market.requests');
});

Route::group(['middleware' => ['auth:sanctum', 'verified', 'role:Grocer|Super-Admin|Administrator']], function () {
    Route::view('/warehouse/shipments', 'modules.grocer.shipment')->name('warehouse.shipments');
    Route::view('/monitor/sales', 'modules.grocer.sales')->name('monitor.sales');
    Route::view('/monitor/inventories', 'modules.grocer.inventories')->name('monitor.inventories');
    Route::view('/monitor/orders', 'modules.grocer.orders')->name('monitor.orders');
    Route::view('/monitor/expired', 'modules.grocer.expired')->name('monitor.expired');
    Route::view('/warehouse/requirements', 'modules.grocer.warehouseRequirements')->name('warehouse.requirements');
});

Route::get('/sat/invoice/fel/nit/{nitReceptor}', [\App\Http\Controllers\SoapFELController::class, 'verifynit']);
Route::post('/sat/invoice/fel/dte/certificate', [\App\Http\Controllers\SoapFELController::class, 'certificateDTE'])->name('invoice.fel.dte.certificate');
Route::delete('/sat/invoice/fel/dte/void', [\App\Http\Controllers\SoapFELController::class, 'voidDTE'])->name('invoice.fel.dte.void');
Route::get('/sat/invoice/fel/dte', [\App\Http\Controllers\SoapFELController::class, 'getDTE']);

Route::get('/test', function () {
    $store = Stores::select('stores.dataFEL')->join('sellers', 'stores.storeID', 'sellers.store_id')->where('sellers.user_id', \Auth::id())->first();
    $dataFEL = json_decode($store->dataFEL);

    return $dataFEL->locationStore;
});

Route::view('/test/view', 'sat.fel.invoice')->name('test.view');
