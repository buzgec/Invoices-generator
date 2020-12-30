<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\InvoicesController;
use \App\Http\Controllers\InvoiceItemsController;
use App\Http\Controllers\ItemsController;

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
    return view('index');
});
Route::get('/index', function () {
    return view('index');
});



Route::middleware(['auth'])->group(function (){
    Route::get('/all_users', [UsersController::class, 'show']);
    Route::get('/home', function (){
        return view('home');
    });
    Route::get('/permissions', [PermissionsController::class, 'index'])->name('all_permissions');
    Route::get('/permissions/create_permission', function (){
        return view('permission.create_permission');
    });
    Route::get('edit/{id}', [UsersController::class, 'showUserEdit']);
    Route::post('edit', [UsersController::class, 'update']);
    Route::get('/all_users', [UsersController::class, 'show']);
    Route::get('/home', function (){
        return view('home');
    });
    Route::post('/create_permission', [PermissionsController::class, 'store'])->name('permission_create');
    Route::get('/permissions/edit/{id}', [PermissionsController::class, 'edit'])->name('showPermissionEdit');
    Route::get('/roles', [RolesController::class, 'index'])->name('all_roles');
    Route::get('/create_role', function (){
        return view('role.create_role');
    });
    Route::post('/create_role', [RolesController::class, 'store'])->name('role_create');
    Route::get('/roles/edit/{id}', [RolesController::class, 'showRoleEdit']);
    Route::post('/roles/edit', [RolesController::class, 'updateRole'])->name('update_role');
    Route::get('/roles_and_permissions_properties', [RolesController::class, 'rolesProperties'])->name('properties');
    Route::post('/roles_and_permissions_properties', [RolesController::class, 'rolesPropertiesUpdate'])->name('propertiesUpdate');
    Route::get('/clients/all_clients', [ClientsController::class, 'index'])->name('all_clients');
    Route::get('/clients/create', [ClientsController::class, 'create'])->name('client_create');
    Route::post('/clients/create', [ClientsController::class, 'store'])->name('client_store');
    Route::get('/clients/edit/{client}', [ClientsController::class, 'edit'])->name('edit_client');
    Route::post('/client/update', [ClientsController::class, 'update'])->name('client_update');
    Route::get('/clients/delete/{client_id}', [ClientsController::class, 'destroy'])->name('delete_client');
    Route::get('clients/client-id={id}/create_invoice', [InvoicesController::class, 'index']);
    Route::get('/clients/client-name=/create_invoice', function (){
        return view('invoices.create_invoice_template');
    })->name('template');
    Route::get('/clients/client_id={client_id}/create_invoice', [InvoicesController::class, 'create'])->name('create_invoice');
    Route::get('/invoices/all_invoices', [InvoicesController::class, 'showAll'])->name('all_invoices');
    Route::get('/invoices/clients_invoices/client_id={client_id}', [InvoicesController::class, 'client_invoices'])->name('client_invoices');
    Route::get('edit/{id}', [UsersController::class, 'showUserEdit']);
    Route::post('edit', [UsersController::class, 'update']);
    Route::get('/permissions', [PermissionsController::class, 'index'])->name('all_permissions');
    Route::get('/permissions/create_permission', function (){
        return view('permission.create_permission');
    });
    Route::post('/permissions/edit', [PermissionsController::class, 'update'])->name('permission_update');
    Route::post('/client/update', [ClientsController::class, 'update'])->name('client_update');
    Route::get('/clients/delete/{client_id}', [ClientsController::class, 'destroy'])->name('delete_client');
    Route::get('clients/client-id={id}/create_invoice', [InvoicesController::class, 'index']);
    Route::get('/clients/client-name=/create_invoice', function (){
        return view('invoices.create_invoice_template');
    })->name('template');
    Route::get('/clients/client_id={client_id}/create_invoice', [InvoicesController::class, 'create'])->name('create_invoice');
    Route::post('/products/create_items_for_invoice', [InvoicesController::class, 'store'])->name('invoice');
    Route::get('/invoices/all_invoices', [InvoicesController::class, 'showAll'])->name('all_invoices');
    Route::get('/invoices/clients_invoices/client_id={client_id}', [InvoicesController::class, 'client_invoices'])->name('client_invoices');
    Route::get('/invoices/view_invoice/invoice_id={invoice}', [InvoicesController::class, 'show'])->name('view_invoice');
    Route::get('invoices/view_invoice/invoice_id={invoice}/pdf_download', [InvoicesController::class, 'downloadPDF'])->name('pdf_download');
});




