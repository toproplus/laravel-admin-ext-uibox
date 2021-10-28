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
                    $stastics = new StasticsInfoBox('最近7天新增用户数', [], 'purple', 'database', admin_url('uibox'), admin_url('uibox/StasticsInfoBox/users'));
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
        $headers = ['序号', '字符串', '随机JSON', '时间'];
        $data = [];
        for ($i = 10; $i > 0; $i--){
            $array = $this->getRandomArray();
            $jsonStrings = json_encode($array, JSON_UNESCAPED_UNICODE);
            $jsonFormat = new JsonFormatBox($jsonStrings, 'square-o', '点击查看Json格式化');
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

    /**
     * 随机数组
     * @param int $flag
     * @return array|string
     */
    protected function getRandomArray($flag=0)
    {
        if ($flag > 8) {
            return Str::random(8);
        }
        $array = [];
        $length = rand(1, 8);
        for ($index = 0; $index <= $length; $index++) {
            if (in_array($index, [3, 6])) {
                $flag++;
                $array[Str::random(8)] = $this->getRandomArray($flag);
                continue;
            }
            $temp = [];
            $len = rand(1, 8);
            for ($i = 0; $i <= $len; $i++) {
                $temp[Str::random(8)]  = Str::random(8);
            }
            $array[Str::random(8)] = $temp;
        }
        return $array;
    }



}