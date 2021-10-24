<?php

use Toproplus\UiBox\Http\Controllers\UiBoxController;




Route::prefix('uibox')->group(function () {

    Route::get('/', UiBoxController::class.'@index');

    //统计信息展示-看板
    Route::get('StasticsInfoBox', UiBoxController::class.'@stasticsInfoBox');
    //统计信息展示-看板-异步获取用户数据
    Route::get('StasticsInfoBox/users', UiBoxController::class.'@usersStatics');

    //json字符串格式化
    Route::get('JsonFormatBox', UiBoxController::class.'@jsonFormatBox');

});

