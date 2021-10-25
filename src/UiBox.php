<?php

namespace Toproplus\UiBox;

use Encore\Admin\Extension;

class UiBox extends Extension
{
    public $name = 'uibox';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'Uibox',
        'path'  => 'uibox',
        'icon'  => 'fa-square-o',
    ];
}