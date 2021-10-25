
## laravel-admin UI组件
laravel-admin extension UiBox

### 安装
拉取
> composer require toproplus/laravel-admin-ext-uibox

发布资源
> php artisan vendor:publish --provider=Toproplus\UiBox\UiBoxServiceProvider

### 使用
- StasticsInfoBox 组件
```php
$row->column(12, function (Column $column) {
    $data = ['总计' => 999999, '昨天' => 999, '今天' => 999];
    $stastics = new StasticsInfoBox('新增用户数', $data, 'purple', 'users');
    $column->append($stastics);
});
```
- JsonFormatBox 组件
```php
$grid->column('json_string', 'Json字符串')->display(function ($json_string) {
    $jsonFormat = new JsonFormatBox($json_string);
    return $jsonFormat;
});
```
### 演示
安装uibox扩展后，打开路由`/admin/uibox`查看演示。