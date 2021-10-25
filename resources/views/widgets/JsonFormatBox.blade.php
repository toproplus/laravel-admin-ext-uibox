<a href="javascript:void(0);" onclick="showJsonFormatData('{{$jsonFormatRandStr}}')" class="a{{$jsonFormatRandStr}}"><i class="fa {{$jsonFormatIcon}}"></i> {{$jsonFormatTips}}</a>
<div class="jsonFormatContainer{{$jsonFormatRandStr}} jsonFormatContainer" style="display: none">
    <div class="jsonFormatViewShow{{$jsonFormatRandStr}} jsonFormatViewShow"></div>
    <div class="jsonFormatActions">
        <i class="fa fa-copy" onclick="copyJsonFormatData('{{$jsonFormatRandStr}}')"> 复制</i>
        <i class="fa fa-power-off" onclick="closeJsonFormatView()"> 关闭</i>
    </div>
</div>

<span class="jsonFormatViewData{{$jsonFormatRandStr}}"  style="display: none">{{$jsonFormatStrings}}</span>


<script type="text/javascript">
    $(function () {
        renderJsonFormat('{{$jsonFormatRandStr}}');
        $('.jsonFormatContainer').on('click', function (event) {
            if (event.target==this) {
                closeJsonFormatView();
            }
        });
    });
</script>


