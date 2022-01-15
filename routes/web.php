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
    Route::view('/warehouse/purchases', 'modules.grocer.purchases')->name('purchases.index');
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

//Route::get('/sat/invoice/fel', function () {
//    try{
//        $params = array ('Content-Type' => 'application/soap+xml;', 'charset' => 'utf-8', 'soap_version' => SOAP_1_2, 'verifypeer' => false, 'verifyhost' => true, 'trace' => 1, 'exceptions' => 1, 'cache_wsdl' => WSDL_CACHE_NONE, 'stream_context' => stream_context_create(
//            ['ssl' => [
//                'verify_peer'       => false,
//                'verify_peer_name'  => false,
//                'allow_self_signed' => true,
//            ]]
//        ));
//        $url = "https://app.corposistemasgt.com/getnitPruebas/ConsultaNIT.asmx?wsdl";
//
//        $client = new SoapClient($url, $params);
//        $paramsGetNit = array('vNIT' => '42348587', 'Entity' => '800000001026', 'Requestor' => '8A454E3F-CEA1-41D8-A13A-A748A4891BBF');
//        $data = $client->getNIT($paramsGetNit);
//        return $data;
//    }
//    catch(SoapFault $fault) {
//        echo '<br>'.$fault;
//    }
//});

Route::get('/sat/invoice/fel/nit/{nitReceptor}', [\App\Http\Controllers\SoapFELController::class, 'verifynit']);
Route::get('/sat/invoice/fel/dte', [\App\Http\Controllers\SoapFELController::class, 'getDTE']);
