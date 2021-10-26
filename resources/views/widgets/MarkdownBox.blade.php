<div class="col-md-12" id="markdownBox{{$randomStr}}"></div>
<input id="markdownText{{$randomStr}}" type="hidden" value="{{$markdownStrings}}">
<script type="text/javascript">
    $(function () {
        showdownRender($("#markdownText{{$randomStr}}").val(), "#markdownBox{{$randomStr}}");
    });

</script>