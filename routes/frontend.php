<?php

Route::group(['as' => 'home.'], function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('market', 'HomeController@market')->name('market');
    Route::get('market/page/{size}', 'HomeController@setPageSize')->name('market.pageSize');
    Route::get('coin/{symbol}', 'HomeController@coin')->name('coin');
    Route::post('search', 'HomeController@search')->name('search');
    Route::get('cron', 'HomeController@cron')->name('cron');
    Route::get('reset', 'HomeController@reset')->name('reset');
});

Route::group(['as' => 'static.'], function () {
    Route::get('terms', 'HomeController@terms')->name('terms');
    Route::get('privacy', 'HomeController@privacy')->name('privacy');
    Route::get('disclaimer', 'HomeController@disclaimer')->name('disclaimer');
});

Route::group(['as' => 'contact.', 'prefix' => 'contact'], function () {
    Route::get('/', 'ContactController@index')->name('index');
    Route::post('store', 'ContactController@store')->name('store');
});

Route::group(['as' => 'news.', 'prefix' => 'news'], function () {
    Route::get('/', 'NewsController@index')->name('index');
    Route::get('go/{id}', 'NewsController@go')->name('go');
});

Route::group(['as' => 'api.', 'prefix' => 'api'], function () {
    Route::post('history/', 'ApiController@history')->name('history');
});

Route::group(['prefix' => 'sitemap', 'as' => 'sitemap.'], function () {
    Route::get('/', 'SitemapController@html')->name('index');
    Route::get('html', 'SitemapController@html')->name('html');
    Route::get('xml', 'SitemapController@xml')->name('xml');
    Route::get('txt', 'SitemapController@txt')->name('txt');
});