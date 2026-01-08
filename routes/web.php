<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
//use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Register All Routes 
| !
|
*/

//Permissions Guarded
Route::middleware('auth')->group(function () {
    // Permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->name('settings.permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'createPermission'])->name('settings.permissions.create');
    Route::post('/permissions/store', [PermissionController::class, 'storePermission'])->name('settings.permissions.storePermission');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'editPermission'])->name('settings.permissions.edit');
    Route::put('/permissions/{id}/update', [PermissionController::class, 'updatePermission'])->name('settings.permissions.updatePermission');
    Route::delete('/permissions/{id}/delete', [PermissionController::class, 'deletePermission'])->name('settings.permissions.deletePermission');
     
    //Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('settings.roles.index');
    Route::get('/roles/create', [RoleController::class, 'createRole'])->name('settings.roles.create');
    Route::post('/roles/store', [RoleController::class, 'storeRole'])->name('settings.roles.storeRole');
    Route::get('/roles/{role}/edit', [RoleController::class, 'editRole'])->name('settings.roles.edit');
    Route::put('/roles/{role}/update', [RoleController::class, 'updateRole'])->name('settings.roles.updateRole');
    Route::delete('/roles/{role}/delete', [RoleController::class, 'deleteRole'])->name('settings.roles.deleteRole');
 

});


//accountant generate report 
Route::get('/reports', function () {
    return view('reports.index');})->name('reports.index');





//Welcome page

Route::get('/welcome', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Home page 
Route::get('/', [HomeController::class, 'home'])->name('layout');

//About Routes
Route::get('/about_external', [HomeController::class, 'aboutExternal'])->name('about_external');

Route::get('/about', [AdminController::class, 'about'])->name('about');

//Course Routes
Route::get('/course_external', [HomeController::class, 'courseExternal'])->name('course_external');

//Trainer Routes
Route::get('/trainer_external', [HomeController::class, 'trainerExternal'])->name('trainer_external');

Route::get('/trainer', [HomeController::class, 'trainer'])->name('trainer');


//event Routes
Route::get('/event', [HomeController::class, 'events'])->name('event');

//pricing Routes
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');

//pricing Routes
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

//pricing Routes
Route::get('/course', [HomeController::class, 'course'])->name('course');

//pricing Routes
// Route::get('/dark', [AdminController::class, 'index'])->name('admin.index');

//Access Users(use users controllers)
Route::get('/users', [UserController::class, 'index'])->name('settings.users.index');
Route::get('/users/create', [UserController::class, 'createUser'])->name('settings.users.create');
Route::post('/users/store', [UserController::class, 'storeUser'])->name('settings.users.storeUser');
Route::get('/users/{id}/edit', [UserController::class, 'editUser'])->name('settings.users.editUser');
Route::put('/users/{id}/update', [UserController::class, 'updateUser'])->name('settings.users.updateUser');
Route::delete('/users/{id}/delete',[UserController::class, 'deleteUser'])->name('settings.users.deleteUser');



//Access Users(use member controllers)
Route::get('/members', [AdminController::class, 'members'])->name('admin.members.index');

Route::get('/create', [AdminController::class, 'create'])->name('members.create');

Route::post('/members', [AdminController::class, 'store'])
    ->name('members.store');

    //Edit Members
Route::get('/admin/members/{id}/edit', [AdminController::class, 'edit'])
    ->name('admin.members.edit');

// Update member
Route::put('/admin/members/{id}', [AdminController::class, 'update'])
    ->name('admin.members.update');
//Delete Member
Route::delete('members/{id}/delete', [AdminController::class, 'deleteMember'])->name('admin.members.deleteMember');



//Regions
Route::get('/regions', [SettingController::class, 'regions'])
    ->name('admin.regions.index');


    //Setting
    Route::prefix('settings')->group(function () {
    
    Route::get('/regions', [SettingController::class, 'regions'])->name('settings.regions.region');
    Route::get('/regions/create', [SettingController::class, 'createRegion'])->name('settings.regions.create_region');
    Route::post('/regions/store', [SettingController::class, 'storeRegion'])->name('settings.regions.storeRegion');
    Route::get('/regions/{id}/edit', [SettingController::class, 'editRegion'])->name('settings.regions.editRegion');
    Route::put('/regions/{id}/update', [SettingController::class, 'updateRegion'])->name('settings.regions.updateRegion');
    Route::delete('/regions/{id}/delete',[SettingController::class, 'deleteRegion'])->name('settings.regions.deleteRegion');


    Route::get('/districts', [SettingController::class, 'districts'])->name('settings.district');
    Route::get('/district/create', [SettingController::class, 'createDistrict'])->name('settings.districts.create_district');
    Route::post('/districts/store', [SettingController::class, 'storeDistrict'])->name('settings.districts.storeDistrict');
    Route::get('/districts/{id}/edit', [SettingController::class, 'editDistrict'])->name('settings.districts.edit_district');
    Route::put('/districts/{id}/update', [SettingController::class, 'updateDistrict'])->name('settings.districts.updateDistrict');
    Route::delete('districts/{id}/delete', [SettingController::class, 'deleteDistrict'])->name('settings.districts.deleteDistrict');




        //Currencies route
    Route::get('/currencies', [SettingController::class, 'currencies'])->name('settings.currency');
    Route::get('/currencies/create', [SettingController::class, 'createCurrency'])->name('settings.currencies.create_currency');
    Route::post('/currencies/store', [SettingController::class, 'storeCurrency'])->name('settings.currencies.storeCurrency');
    Route::get('/currencies/{id}/edit', [SettingController::class, 'editCurrency'])->name('settings.currencies.edit_currency');
    Route::put('/currencies/{id}/update', [SettingController::class, 'updateCurrency'])->name('settings.currencies.updateCurrency');
    Route::delete('/currencies/{id}/delete',[SettingController::class, 'deleteCurrency'])->name('settings.currencies.deleteCurrency');


});


// List audit logs
Route::prefix('admin')->middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('admin.audit.index');
});


//Used for AuTH
require __DIR__.'/auth.php';
