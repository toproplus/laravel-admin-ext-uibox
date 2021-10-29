<?php

namespace Toproplus\UiBox\Widgets;

use Encore\Admin\Admin;
use Illuminate\Support\Str;

/**
 * 统计信息展示看板
 * Class StatisticsInfoBox
 */
class StatisticsInfoBox
{

    protected $view = 'uibox::widgets.StatisticsInfoBox';
    protected $data = [];

    /**
     * StatisticsInfoBox constructor.
     * @param string $description 看板底部文字
     * @param array $stastics 看板数据 (获取异步数据时，传空数组)
     * @param string $color 背景颜色 (如：aqua,orange,blue)
     * @param string $icon 背景图标
     * @param string $url  跳转地址
     * @param string $requestUrl 异步请求数据的地址
     * @throws \Exception
     */
    public function __construct(string $description, array $statistics, string $color, string $icon, string $url = 'javascript:void(0);', string $requestUrl = '')
    {
        $isRequest = (!$statistics && $requestUrl) ? 1 : 0;
        $class = 'stasticsClass' . Str::random(12);
        $idName = 'stasticsId' . Str::random(12);
        $columnWdith = bcdiv(100, count($statistics) ?: 1, 8);
        $this->data = compact('description','statistics', 'url', 'color', 'icon', 'requestUrl', 'isRequest', 'class', 'idName', 'columnWdith');
    }


    protected function html(){
        return view($this->view, $this->data);
    }

    public function render()
    {
        $admin = new Admin();
        $admin->disablePjax();
        $admin::js('vendor/toproplus/laravel-admin-ext-uibox/js/template-web.min.js');
        return $this->html();

    }

    public function __toString()
    {
        return (string) $this->render();
    }
}