<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\LaboratoriesController;
use App\Http\Controllers\ManagersController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\SalesRecordsController;
use App\Http\Controllers\SellersController;
use App\Http\Controllers\StoresController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('categories', [CategoriesController::class, 'index']);
Route::post('categories/create', [CategoriesController::class, 'store']);
Route::get('categories/{categoryId}/sw', [CategoriesController::class, 'show']);
Route::put('categories/{category}/up', [CategoriesController::class, 'update']);
Route::delete('categories/{categoryId}', [CategoriesController::class, 'destroy']);

Route::get('contacts', [ContactsController::class, 'index']);
Route::post('contacts/create', [ContactsController::class, 'store']);
Route::get('contacts/{contactId}/sw', [ContactsController::class, 'show']);
Route::put('contacts/{contact}/up', [ContactsController::class, 'update']);
Route::delete('contacts/{contactId}', [ContactsController::class, 'destroy']);

Route::get('items', [ItemsController::class, 'index']);
Route::post('items/create', [ItemsController::class, 'store']);
Route::get('items/{itemId}/sw', [ItemsController::class, 'show']);
Route::put('items/{item}/up', [ItemsController::class, 'update']);
Route::delete('items/{itemId}', [ItemsController::class, 'destroy']);

Route::get('laboratories', [LaboratoriesController::class, 'index']);
Route::post('laboratories/create', [LaboratoriesController::class, 'store']);
Route::get('laboratories/{laboratoryId}/sw', [LaboratoriesController::class, 'show']);
Route::put('laboratories/{laboratory}/up', [LaboratoriesController::class, 'update']);
Route::delete('laboratories/{laboratoryId}', [LaboratoriesController::class, 'destroy']);

Route::get('managers', [ManagersController::class, 'index']);
Route::post('managers/create', [ManagersController::class, 'store']);
Route::get('managers/{managerId}/sw', [ManagersController::class, 'show']);
Route::put('managers/{manager}/up', [ManagersController::class, 'update']);
Route::delete('managers/{managerId}', [ManagersController::class, 'delete']);

Route::get('providers', [ProvidersController::class, 'index']);
Route::post('providers/create', [ProvidersController::class, 'store']);
Route::get('providers/{providerId}/sw', [ProvidersController::class, 'show']);
Route::put('providers/{provider}/up', [ProvidersController::class, 'update']);
Route::delete('providers/{providerId}', [ProvidersController::class, 'destroy']);

Route::get('sales/records', [SalesRecordsController::class, 'index']);
Route::post('sales/records/create', [SalesRecordsController::class, 'store']);
Route::get('sales/records/{recordId}/sw', [SalesRecordsController::class, 'show']);
Route::put('sales/records/{record}/up', [SalesRecordsController::class, 'update']);
Route::delete('sales/records/{recordId}', [SalesRecordsController::class, 'destroy']);

Route::get('sellers', [SellersController::class, 'index']);
Route::post('sellers/create', [SellersController::class, 'store']);
Route::get('sellers/{sellerId}/sw', [SellersController::class, 'show']);
Route::put('sellers/{sellerId}/up', [SellersController::class, 'update']);
Route::delete('sellers/{sellerId}', [SellersController::class, 'destroy']);

Route::get('stores', [StoresController::class, 'index']);
Route::post('stores/create', [StoresController::class, 'store']);
Route::get('stores/{storeId}/sw', [StoresController::class, 'show']);
Route::put('stores/{storeId}/up', [StoresController::class, 'update']);
Route::delete('stores/{storeId}', [StoresController::class, 'destroy']);

Route::view('inventories', 'modules/inventories/admin/index')->name("module.inventories.index");
Route::view('inventories/stores', 'modules/inventories/admin/inventories')->name("module.inventories.admin.stores.inventories");
Route::view('inventories/stores/integrity', 'modules/inventories/admin/integrity')->name("module.inventories.admin.stores.integrity");
Route::view('inventories/stores/see-all', 'modules/inventories/admin/see-all')->name("module.inventories.admin.stores.seeall");

Route::view('purchases', 'modules/purchases/admin/index')->name("module.purchases.index");
Route::view('purchases/new', 'modules/purchases/admin/new-purchase')->name("module.purchases.new.purchase");
Route::view('items/new', 'modules/purchases/admin/new-item')->name("module.items.new.item");
Route::view('purchases/record', 'modules/purchases/admin/records')->name("module.purchases.records.purchases");
Route::view('purchases/credits', 'modules/purchases/admin/credits-phone')->name("module.purchases.credits.phones.purchase");

Route::view('market/warehouse', 'modules/market/admin/index')->name("module.market.admin.index");
Route::view('market', 'modules/market/seller/index')->name("module.market.seller.index");
Route::view('market/warehouse/shipments', 'modules/market/admin/warehouse-shipments')->name("module.market.admin.warehouse.shipments");
Route::view('market/warehouse/records', 'modules/market/admin/records')->name("module.market.admin.warehouse.records");
Route::view('market/warehouse/invoicing', 'modules/market/admin/invoicing')->name("module.market.admin.warehouse.invoicing");
Route::view('market/invoice/record', 'modules/market/seller/recordOfInvoices')->name("module.market.seller.invoice.record");

Route::view('admin/settings/editOrAdd', 'modules/edit/index')->name("module.settings.editoradd.index");
Route::view('admin/settings/editOrAdd/users', 'modules/edit/users/index')->name("module.settings.editoradd.users.index");
Route::view('admin/settings/editOrAdd/inventories', 'modules/edit/inventories/index')->name("module.settings.editoradd.inventories.index");
Route::view('admin/settings/editOrAdd/items', 'modules/edit/items/index')->name("module.settings.editoradd.items.index");
Route::view('admin/settings/editOrAdd/telephonies', 'modules/edit/telephonies/index')->name("module.settings.editoradd.telephonies.index");
