<?php

Route::group([
    'namespace' => 'Bendt\Option\Controllers\API',
    'middleware' => 'auth:api'
], function() {
    Route::get('/api/options/{key}', 'OptionController@key');

    Route::get('/api/option/select', 'OptionController@select');
    Route::post('/api/option/destroyBulk', 'OptionController@destroyBulk');
    Route::resource('/api/option', 'OptionController');

    Route::post('/api/option_detail/destroyBulk', 'OptionDetailController@destroyBulk');
    Route::resource('/api/option_detail', 'OptionDetailController');
});