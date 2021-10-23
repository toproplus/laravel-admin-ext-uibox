<?php

namespace Toproplus\UiBox\Http\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;
use Toproplus\UiBox\Widgets\StasticsInfoBox;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;

class UiBoxController extends Controller
{
    protected $prefix;

    public function __construct()
    {
        $this->prefix = config('admin.route.prefix');

    }

    public function index(Content $content)
    {
        return $content
            ->title('UiBox')
            ->description('UiBox组件示例')
            ->body(view('uibox::index'));
    }

    /**
     * UiBox-统计信息展示-看板
     */
    public function stasticsInfoBox(Content $content)
    {

        return $content
            ->title('StasticsInfoBox')
            ->description('UiBox-统计信息展示-看板')
            ->row(function (Row $row){
                $row->column(12, function (Column $column) {
                    $data = ['总计' => 999999, '昨天' => 999, '今天' => 9999];
                    $stastics = new StasticsInfoBox('新增用户数', $data, 'purple', 'users');
                    $column->append($stastics);
                });
                $row->column(12, function (Column $column) {
                    $stastics = new StasticsInfoBox('最近7天新增用户数', [], 'purple', 'database', '/', "/$this->prefix/uibox/StasticsInfoBox/users");
                    $column->append($stastics);
                });
            });
    }

    /**
     * 最近7天新增用户数 异步数据
     */
    public function usersStatics()
    {
        $stastics = [];
        for ($i = 0; $i < 7; $i++) {
            $date = date('Y-m-d', strtotime("-$i day"));
            $stastics[$date] = random_int(1, 999999);
        }
        return $stastics;
    }

}