
<a href="javascript:void(0);" onclick="showJsonFormatData{{$jsonFormatRandStr}}('{{$jsonFormatRandStr}}')" class="a{{$jsonFormatRandStr}}"><i class="fa {{$jsonFormatIcon}}"></i> {{$jsonFormatTips}}</a>
<div class="jsonFormatContainer{{$jsonFormatRandStr}} jsonFormatContainer" style="display: none">
    <div class="jsonFormatViewShow{{$jsonFormatRandStr}} jsonFormatViewShow"></div>
    <div class="jsonFormatActions">
        <i class="fa fa-copy" onclick="copyJsonFormatData{{$jsonFormatRandStr}}('{{$jsonFormatRandStr}}')"> 复制</i>
        <i class="fa fa-power-off" onclick="closeJsonFormatView{{$jsonFormatRandStr}}()"> 关闭</i>
    </div>
</div>

<span class="jsonFormatViewData{{$jsonFormatRandStr}}"  style="display: none">{{$jsonFormatStrings}}</span>


<script type="text/javascript">

    function renderJsonFormat{{$jsonFormatRandStr}}(randStr) {
        let jsonStr = getJsonStr{{$jsonFormatRandStr}}(randStr);
        try {
            $('.jsonFormatViewShow' + randStr).JSONView(jsonStr);
        }catch (e) {
            $('.jsonFormatViewShow' + randStr).html(jsonStr)
        }

    }

    function getJsonStr{{$jsonFormatRandStr}}(randStr) {
        let jsonStr = $('.jsonFormatViewData' + randStr).html();
        return jsonStr;
    }
    function showJsonFormatData{{$jsonFormatRandStr}}(randStr) {
        closeJsonFormatView{{$jsonFormatRandStr}}();
        $('.jsonFormatContainer' + randStr).show();
        $('.a' + randStr).css('color', '#305777');
    }


    function closeJsonFormatView{{$jsonFormatRandStr}}() {
        $('.jsonFormatContainer').hide();
    }

    function copyJsonFormatData{{$jsonFormatRandStr}}(randStr) {
        let jsonStr = getJsonStr{{$jsonFormatRandStr}}(randStr);
        let oInput = document.createElement('input');
        oInput.value = jsonStr;
        document.body.appendChild(oInput);
        oInput.select();
        document.execCommand("Copy");
        oInput.style.display='none';
        oInput.remove();

        $('.jsonFormatActions > .fa-copy').removeClass('fa-copy').addClass('fa-check');
        setTimeout(function () {
            $('.jsonFormatActions > .fa-check').removeClass('fa-check').addClass('fa-copy');
        }, 1500);

    }

    $(function () {
        renderJsonFormat{{$jsonFormatRandStr}}('{{$jsonFormatRandStr}}');
        $('.jsonFormatContainer').on('click', function (event) {
            if (event.target==this) {
                closeJsonFormatView{{$jsonFormatRandStr}}();
            }
        });
    });


</script>
<style>
    .jsonFormatContainer{
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        z-index: 9999;
        background: rgba(0, 0, 0, 0.2);
    }
    .jsonFormatContainer > .jsonFormatViewShow{
        margin: 3.5% auto 30px auto;
        padding: 15px;
        width: 75%;
        height: 80%;
        background: #ffffff;
        overflow-y: scroll;
        border-radius: 10px;
    }
    .jsonFormatContainer > .jsonFormatActions{
        background-color: #ffffff;
        width: 200px;
        height: 45px;
        border-radius: 5px;
        line-height: 45px;
        margin: 0px auto;
    }
    .jsonFormatContainer > .jsonFormatActions > i{
        width: 98px;
        height: 45px;
        line-height: 45px;
        text-align: center;
        cursor: pointer;

    }
    .jsonFormatViewShow::-webkit-scrollbar {
        width : 8px;
        height: 8px;
    }
    .jsonFormatViewShow::-webkit-scrollbar-thumb {
        border-radius   : 10px;
        background-color: #CCCCCC;
    }
    .jsonFormatViewShow::-webkit-scrollbar-track {
        box-shadow   : inset 0 0 5px rgba(0, 0, 0, 0.2);
        background   : #ffffff;
        border-radius: 8px;
    }
</style>

