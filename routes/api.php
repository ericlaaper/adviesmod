<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('mod1s', 'Mod1sController', ['except' => ['create', 'edit']]);

});
