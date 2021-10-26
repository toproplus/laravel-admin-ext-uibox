
## laravel-admin UI组件
laravel-admin extension UiBox

### 安装
拉取 [package](https://packagist.org/packages/toproplus/laravel-admin-ext-uibox)
> composer require toproplus/laravel-admin-ext-uibox

发布资源
> php artisan vendor:publish --provider=Toproplus\UiBox\UiBoxServiceProvider

### 使用
- StasticsInfoBox 组件
```php
use Toproplus\UiBox\Widgets\StasticsInfoBox;

$row->column(12, function (Column $column) {
    $data = ['总计' => 999999, '昨天' => 999, '今天' => 999];
    $stastics = new StasticsInfoBox('新增用户数', $data, 'purple', 'users');
    $column->append($stastics);
});
```
- JsonFormatBox 组件
```php
use Toproplus\UiBox\Widgets\JsonFormatBox;

$grid->column('json_string', 'Json字符串')->display(function ($json_string) {
    $jsonFormat = new JsonFormatBox($json_string);
    return $jsonFormat;
});
```
- MarkdownBox 组件

```php
use Toproplus\UiBox\Widgets\MarkdownBox;

$row->column(12, function (Column $column) {
     $md = file_get_contents('vendor/toproplus/laravel-admin-ext-uibox/md/MarkdownBox.md');
     $data = new MarkdownBox($md);
     $column->append($data);
});
```



### 演示

安装UiBox扩展后，打开路由`/admin/uibox`查看演示