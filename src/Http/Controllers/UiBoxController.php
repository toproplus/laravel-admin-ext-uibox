<?php

namespace Toproplus\UiBox\Http\Controllers;

use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Table;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Toproplus\UiBox\Widgets\JsonFormatBox;
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
     * UiBox-统计信息展示看板
     */
    public function stasticsInfoBox(Content $content)
    {

        return $content
            ->title('StasticsInfoBox')
            ->description('UiBox-统计信息展示看板')
            ->row(function (Row $row){
                $row->column(12, function (Column $column) {
                    $data = ['总计' => 999999, '昨天' => 999, '今天' => 999];
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

    /**
     * json字符串格式化
     */
    public function jsonFormatBox(Content $content)
    {
        $headers = ['序号', '订单号', '支付回调', '时间'];
        $data = [];
        for ($i = 10; $i > 0; $i--){
            $notify = [
                'respCode' => '00',
                'respMsg' => '支付成功',
                'sign' => Str::random(32),
                'orderNo' => Str::random(16),
                'amount' => random_int(1, 999999),
                'payTime' => time()
            ];
            $jsonStrings = json_encode($notify, JSON_UNESCAPED_UNICODE);
            $jsonFormat = new JsonFormatBox($jsonStrings);
            $temp = [$i, Str::random(16), $jsonFormat, date('Y-d-m H:i:s')];
            array_push($data, $temp);
        }
        $table = new Table($headers,$data);
        $box = new Box('Json格式化演示', $table);
        return $content
            ->title('JsonFormatBox')
            ->description('UiBox-Json字符串格式化')
            ->row($box);
    }

}