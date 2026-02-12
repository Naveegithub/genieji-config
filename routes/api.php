<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\CuisineController;
use App\Http\Controllers\Api\ProspectPersonalController;
use App\Http\Controllers\Api\ProspectHouseholdController;
use App\Http\Controllers\Api\ProspectPreferenceController;
use App\Http\Controllers\Api\ProspectPurchaseController;
use App\Http\Controllers\Api\CommunityController;

/*
|--------------------------------------------------------------------------
| Users & Roles
|--------------------------------------------------------------------------
*/

Route::post('/users', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'index']);

Route::post('/roles', [RoleController::class, 'store']);
Route::get('/roles', [RoleController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Master Data
|--------------------------------------------------------------------------
*/

Route::get('/cuisines', [CuisineController::class, 'index']);
Route::post('/admin/cuisines', [CuisineController::class, 'store']);

Route::post('/community', [CommunityController::class, 'store']);
/*
|--------------------------------------------------------------------------
| Prospect – Personal & Location
|--------------------------------------------------------------------------
*/

Route::post('/prospect/personal', [ProspectPersonalController::class, 'store']);


/*
|--------------------------------------------------------------------------
| Prospect – Household
|--------------------------------------------------------------------------
*/

Route::post('/prospect/household', [ProspectHouseholdController::class, 'store']);

/*
|--------------------------------------------------------------------------
| Prospect – Preferences
|--------------------------------------------------------------------------
*/

Route::post('/prospect/preferences', [ProspectPreferenceController::class, 'store']);

/*
|--------------------------------------------------------------------------
| Prospect – Purchase
|--------------------------------------------------------------------------
*/

Route::post('/prospect/purchase', [ProspectPurchaseController::class, 'store']);
