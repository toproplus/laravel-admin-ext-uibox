<?php

use Toproplus\UiBox\Http\Controllers\UiBoxController;

Route::get('uibox', UiBoxController::class.'@index');

//统计信息展示-看板
Route::get('uibox/StasticsInfoBox', UiBoxController::class.'@stasticsInfoBox');
//统计信息展示-看板-异步获取用户数据
Route::get('uibox/StasticsInfoBox/users', UiBoxController::class.'@usersStatics');