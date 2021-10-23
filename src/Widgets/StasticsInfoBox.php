<?php

namespace Toproplus\UiBox\Widgets;

use Encore\Admin\Admin;

/**
 * 统计信息展示-看板
 * Class StasticsInfoBox
 */
class StasticsInfoBox
{

    protected $stastics;
    protected $colWdith;
    protected $desc;
    protected $url;
    protected $color;
    protected $icon;
    protected $requestUrl;
    protected $isAjaxData;
    protected $class;
    protected $idname;

    /**
     * StasticsInfoBox constructor.
     * @param string $desc 看板底部文字
     * @param array $stastics 看板数据 (获取异步数据时，传空数组)
     * @param string $color 背景颜色 (如：aqua,orange,blue)
     * @param string $icon 背景图标
     * @param string $url  跳转地址
     * @param string $requestUrl 异步请求数据的地址
     * @throws \Exception
     */
    public function __construct(string $desc, array $stastics, string $color, string $icon, string $url = 'javascript:void(0);', string $requestUrl = '')
    {
        $this->colWdith = bcdiv(100, count($stastics) ?: 1, 2);
        $this->stastics = $stastics;
        $this->desc = $desc;
        $this->url = $url;
        $this->color = $color;
        $this->icon = $icon;
        $this->requestUrl = $requestUrl;
        $this->isAjaxData = (!$stastics && $requestUrl) ? 1 : 0;
        $this->class = 'infoboxclass' . random_int(1000,99999999);
        $this->idname = 'infoboxid' . random_int(1000,99999999);
    }

    protected function script()
    {
        return <<<SCRIPT
          function infoboxrender{$this->idname}()
          {
              let isAjaxData = "{$this->isAjaxData}";
              let requestUrl = "{$this->requestUrl}";
              let className = "{$this->class}";
              let idname = "{$this->idname}";
              if (parseInt(isAjaxData)) {
                 $.ajax({
                            method: 'get',
                            url: requestUrl,
                            data: {
                                _method: 'get',
                                _token: LA.token
                            },
                            success: function (data) {
                                let colWdith = 100 / Object.keys(data).length;
                                let list = [];
                                Object.keys(data).forEach(function(key){
                                    let temp = {
                                        key: key,
                                        val: data[key]
                                    };
                                    list.push(temp);
                                });
                                let htmlData = template('html' + idname, {list: list, colWdith: colWdith});
                                $("." + className).html(htmlData);
                            }
                  });
              }
         }
         infoboxrender{$this->idname}();
SCRIPT;
    }

    protected function style()
    {
        return <<<STYLE
        .info-boxs-inline-box > div{float: left;text-align: left;}
        .info-boxs-centext-num,
        .info-boxs-centext-tip{font-size: 3rem !important;text-overflow: ellipsis;white-space: nowrap;
        overflow:hidden;padding-right:6px;}
        .info-boxs-centext-tip{font-size: 1.5rem !important;}
        .info-boxs-footer-text{height: 30px;line-height:25px;}
STYLE;
    }

    protected function html(){
        $item = '';
        if (!$this->isAjaxData && $this->stastics) {
            foreach ($this->stastics as $key => $val) {
                $item .= <<<ITEM
                  <div  style="width: {$this->colWdith}%;">
                         <p class="info-boxs-centext-num" title="{$val}">{$val}<p/>
                         <p class="info-boxs-centext-tip">{$key}</p>
                  </div>
ITEM;
            }
        } else {
            $item .= <<<ITEM
                  <div  style="width: 100%;">
                         <p class="info-boxs-centext-num">loading...<p/>
                         <p class="info-boxs-centext-tip">loading...</p>
                  </div>
ITEM;
        }

        $footerIcon = ($this->url && $this->url != 'javascript:void(0);') ? "<i class=\"fa fa-arrow-circle-right\"></i>" : '';

        return <<<HTML
        <div class="row">
            <div class="col-md-12">
                <div class="small-box bg-{$this->color}">
                    <div class="inner info-boxs-inline-box {$this->class}">
                       {$item}
                    </div>
                    <div style="clear:both;"></div>
                    <div class="icon">
                        <i class="fa fa-{$this->icon}"></i>
                    </div>
                    <a href="{$this->url}" class="small-box-footer info-boxs-footer-text">
                        {$this->desc}&nbsp;
                        {$footerIcon}
                    </a>
                </div>
            </div>
        </div>
        <script id="html{$this->idname}" type="text/html">
            <% for(var i = 0; i < list.length; i++){ %>
                  <div style="width: <%= colWdith %>%;">
                         <p class="info-boxs-centext-num" title="<%= list[i].val %>"><%= list[i].val %></p>
                         <p class="info-boxs-centext-tip"><%= list[i].key %></p>
                  </div>
            <% } %>
       </script>
HTML;
    }

    public function render()
    {
        $admin = new Admin();
        $admin::style($this->style());
        $admin->disablePjax();
        $admin::js('https://cdn.bootcdn.net/ajax/libs/art-template/4.12.0/lib/template-web.min.js');
        $admin::script($this->script());
        return $this->html();

    }

    public function __toString()
    {
        return $this->render();
    }
}