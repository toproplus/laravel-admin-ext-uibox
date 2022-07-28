
## laravel-admin UI组件
laravel-admin extension UiBox

### 安装
拉取 [package](https://packagist.org/packages/toproplus/laravel-admin-ext-uibox)
```bash
composer require toproplus/laravel-admin-ext-uibox
```

发布资源
```bash
php artisan vendor:publish --provider="Toproplus\UiBox\UiBoxServiceProvider"
```



### 使用
- StatisticsInfoBox 组件
```php
use Toproplus\UiBox\Widgets\StatisticsInfoBox;

$row->column(12, function (Column $column) {
    $data = ['总计' => 999999, '昨天' => 999, '今天' => 999];
    $stastics = new StatisticsInfoBox('新增用户数', $data, 'purple', 'users');
    $column->append($stastics->render());
});
```
- JsonFormatBox 组件
```php
use Toproplus\UiBox\Widgets\JsonFormatBox;

$grid->column('json_string', 'Json字符串')->display(function ($json_string) {
    $jsonFormat = new JsonFormatBox($json_string);
    return $jsonFormat->render();
});
```
- MarkdownBox 组件

```php
use Toproplus\UiBox\Widgets\MarkdownBox;

$row->column(12, function (Column $column) {
     $mdText = file_get_contents('vendor/toproplus/laravel-admin-ext-uibox/md/MarkdownBox.md');
     $theme = 'okaidia';
     $data = new MarkdownBox($mdText, $theme);
     $column->append($data->render());
});
```

### 在线演示

演示地址：[http://uibox.lee23.top/admin](http://uibox.lee23.top/admin)

账号：uibox
密码：uibox

