<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\Front\ContenuSiteWebController;
use App\Http\Controllers\Front\ReferentialsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('search-document/{code_demande}', [DemandeController::class, 'search_documents']);


Route::controller(ReferentialsController::class)->group(function () {
    Route::get('get-products', 'getProducts');
    Route::get('get-services', 'getServices');
    Route::get('get-teams', 'getTeams');
    Route::get('get-sliders', 'getSliders');
    Route::get('get-social-link', 'getSocialLink');
    Route::get('get-enrolment-point', 'getPointEnrolement');
    Route::get('get-ferry-day', 'getPublicHoliday');
    Route::get('get-partners', 'getPartners');
    Route::get('get-actualities', 'getActualitiesPaginate');
    Route::get('get-one-actuality/{id}', 'getOneArticle');
});

Route::controller(ContenuSiteWebController::class)->group(function () {
    Route::post('send-request', 'send_request');
    Route::get('get-about-content/{tag}', 'get_content_web_site');
    Route::get('get-articles/{type}', 'get_articles_paginate');
    Route::get('get-one-articles/{id}', 'get_one_articles');
});


Route::controller(ClientController::class)->group(function () {
    Route::post('register_client', 'register_client');
    Route::post('login_client', 'login_client');
    Route::any('cinetpayNotify', 'cinetpay_notify');

    // secure api
    /**
     * auth.api => middleware
     * apiJwt => guard name
     */
    Route::middleware('auth.api:apiJwt')->group(function () {
        Route::get('get-appointment', 'get_appointment_client');
        Route::get('get-user-info', 'user_info');
        Route::post('save-appointment', 'save_appointment_client');
        Route::post('save-pre-demande', 'save_predemande_client');
        Route::get('get-one-appointment/{id}', 'get_one_appointment_client');
        Route::get('init-pay-demande/{id}', 'init_pay_demande');
        Route::put('update-password', 'update_password_client');
    });

});
