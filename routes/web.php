<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\ProspectWizardController;

/*
|--------------------------------------------------------------------------
| User Registration
|--------------------------------------------------------------------------
*/
Route::get('/register', [UserController::class, 'create']);
Route::post('/register', [UserController::class, 'store'])->name('register.store');

/*
|--------------------------------------------------------------------------
| Prospect Wizard (UI)
|--------------------------------------------------------------------------
*/
Route::prefix('dashboard/prospect')->group(function () {

    /* STEP 1 */
    Route::get('/step-1', [ProspectWizardController::class, 'step1'])
        ->name('prospect.step1');

    Route::post('/step-1', [ProspectWizardController::class, 'storeStep1'])
        ->name('prospect.step1.store');

    /* STEP 2 */
    Route::get('/step-2', [ProspectWizardController::class, 'step2'])
        ->name('prospect.step2');

    Route::post('/step-2', [ProspectWizardController::class, 'storeStep2'])
        ->name('prospect.step2.store');

    /* STEP 3 */
    Route::get('/step-3', [ProspectWizardController::class, 'step3'])
        ->name('prospect.step3');

    Route::post('/step-3', [ProspectWizardController::class, 'storeStep3'])
        ->name('prospect.step3.store');

    /* STEP 4 */
    Route::get('/step-4', [ProspectWizardController::class, 'step4'])
        ->name('prospect.step4');

    Route::post('/step-4', [ProspectWizardController::class, 'storeStep4'])
        ->name('prospect.step4.store');

    /* STEP 5 */
    Route::get('/step-5', [ProspectWizardController::class, 'step5'])
        ->name('prospect.step5');

    Route::post('/step-5', [ProspectWizardController::class, 'storeStep5'])
        ->name('prospect.step5.store');
});
