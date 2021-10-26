<?php

namespace Toproplus\UiBox\Widgets;

use Encore\Admin\Admin;
use Illuminate\Support\Str;

class MarkdownBox
{

    protected $view = 'uibox::widgets.MarkdownBox';
    protected $data = [];


    public function __construct(string $markdownStrings)
    {
        $randomStr = Str::random(18);
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
        $admin::js('vendor/toproplus/laravel-admin-ext-uibox/js/showdown.min.js');
        return $this->html();

    }

    public function __toString()
    {
        return (string) $this->render();
    }

}