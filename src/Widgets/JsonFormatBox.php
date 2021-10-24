<?php

namespace Toproplus\UiBox\Widgets;

use Encore\Admin\Admin;
use Illuminate\Support\Str;

/**
 * json字符串格式化
 * Class JsonFormatBox
 * @package Toproplus\UiBox\Widgets
 */
class JsonFormatBox
{

    protected $view = 'uibox::widgets.JsonFormatBox';
    protected $data = [];

    /**
     * JsonFormatBox constructor.
     * @param string $jsonFormatStrings JSON字符串
     * @param string $jsonFormatIcon 图标
     * @param string $jsonFormatTips 跳转提示
     */
    public function __construct(string $jsonFormatStrings, string $jsonFormatIcon = 'fa-info-circle', string $jsonFormatTips = '点击查看详情')
    {
        $jsonFormatRandStr = Str::random(12);
        $this->data = compact('jsonFormatStrings', 'jsonFormatIcon', 'jsonFormatTips', 'jsonFormatRandStr');

    }


    protected function html()
    {
        return view($this->view, $this->data);
    }

    public function render()
    {
        $admin = new Admin();
        $admin->disablePjax();
        $admin::css('vendor/toproplus/laravel-admin-ext-uibox/css/jquery.jsonview.min.css');
        $admin::js('vendor/toproplus/laravel-admin-ext-uibox/js/jquery.jsonview.min.js');
        return $this->html();

    }

    public function __toString()
    {
        return (string) $this->render();
    }

}