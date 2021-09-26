<?php

use App\Http\Controllers\AdminQueryController;
use App\Http\Controllers\BitController;
use App\Http\Controllers\BitThemeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProjectConfigController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ShippingMethodController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::view('test', 'mail.test');
Route::view('/contact-us', 'contact-us')->name('contact-us');
Route::post('/admin-query', [AdminQueryController::class, 'store'])
    ->name('admin-query.store');

Route::post(
    '/stripe/webhook',
    [WebhookController::class, 'handleWebhook']
);

Route::group(['middleware' => ['auth', 'get.project', 'set.tags.menu', 'verified']], function () {
    Route::resource('/tag', TagController::class);
    Route::get('/tag/{tag}/bits', [TagController::class, 'showBits'])
        ->name('tag.bits');

    Route::resource('/project', ProjectController::class)
        ->except(['show'])
        ->withoutMiddleware(['get.project']);

    Route::get('/project/{project}/set', [ProjectController::class, 'setProject'])
        ->name('project.set')
        ->withoutMiddleware(['get.project']);
    Route::resource('/bit', BitController::class);
    Route::resource('/bit-theme', BitThemeController::class);

    Route::get('/project-config', [ProjectConfigController::class, 'index'])
        ->name('project.config.index');
    Route::patch('/project-config', [ProjectConfigController::class, 'update'])
        ->name('project.config.update');

    Route::resource('/query', QueryController::class);

    Route::resource('/order', OrderController::class)
        ->only(['index', 'show']);

    Route::resource('/shipping-method', ShippingMethodController::class)
        ->only(['index']);

    Route::get('/settings', [UserSettingsController::class, 'index'])
        ->withoutMiddleware(['get.project'])
        ->name('user.settings');

    Route::get('/subscription-plan/create', [SubscriptionPlanController::class, 'create'])
        ->name('subscription-plan.create');

    Route::get('/billing-portal', function () {
        return auth()->user()->redirectToBillingPortal();
    });
});
