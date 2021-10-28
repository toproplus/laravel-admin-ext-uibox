<?php

namespace Toproplus\UiBox\Widgets;

use Encore\Admin\Admin;
use Illuminate\Support\Str;

class MarkdownBox
{

    protected $view = 'uibox::widgets.MarkdownBox';
    protected $data = [];
    protected $theme;


    /**
     * MarkdownBox constructor.
     * @param string $markdownStrings
     * @param string $theme  default|okaidia|solarized-light|tomorrow-night
     */
    public function __construct(string $markdownStrings, string $theme = 'okaidia')
    {
        $randomStr = Str::random(18);
        $this->theme = $theme;
        $this->data = compact('markdownStrings', 'randomStr');
    }


    protected function html()
    {
        return view($this->view, $this->data);
    }

    public function render()
    {
        $admin = new Admin();
        $admin->disablePjax();
        $admin::css("vendor/toproplus/laravel-admin-ext-uibox/prism/{$this->theme}/prism.css");
        $admin::js("vendor/toproplus/laravel-admin-ext-uibox/js/showdown.min.js");
        $admin::js("vendor/toproplus/laravel-admin-ext-uibox/prism/{$this->theme}/prism.js");
        return $this->html();

    }

    public function __toString()
    {
        return (string) $this->render();
    }

}