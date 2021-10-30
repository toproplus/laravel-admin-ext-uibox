<?php

use Toproplus\UiBox\Http\Controllers\UiBoxController;




Route::prefix('uibox')->group(function () {

    Route::get('/', UiBoxController::class.'@index');

    //统计信息展示-看板
    Route::get('StatisticsInfoBox', UiBoxController::class.'@statisticsInfoBox');
    //统计信息展示-看板-异步获取用户数据
    Route::get('StatisticsInfoBox/users', UiBoxController::class.'@usersStatistics');

    //json字符串格式化
    Route::get('JsonFormatBox', UiBoxController::class.'@jsonFormatBox');

});

