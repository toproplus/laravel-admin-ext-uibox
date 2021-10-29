### MarkdownBox 组件

```php
use Toproplus\UiBox\Widgets\MarkdownBox;

$row->column(12, function (Column $column) {
     $mdText = file_get_contents('vendor/toproplus/laravel-admin-ext-uibox/md/MarkdownBox.md');
     $theme = 'default'; //可选：default|okaidia|solarized-light|tomorrow-night
     $data = new MarkdownBox($mdText, $theme);
     $column->append($data);
});
```

