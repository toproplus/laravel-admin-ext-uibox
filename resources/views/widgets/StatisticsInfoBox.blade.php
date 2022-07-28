<div class="row">
    <div class="col-md-12">
        <div class="small-box bg-{{$color}}">
            <div class="inner info-boxs-inline-box {{$class}}">
                @if (!$isRequest && $statistics)
                    @foreach ($statistics as $key => $val)
                        <div  style="width: {{$columnWdith}}%;">
                            <p class="info-boxs-centext-num" title="{{$val}}">{{$val}}<p/>
                            <p class="info-boxs-centext-tip" title="{{$key}}">{{$key}}</p>
                        </div>
                    @endforeach
                @else
                    <div  style="width: 100%;">
                        <p class="info-boxs-centext-num">loading...</p>
                        <p class="info-boxs-centext-tip">loading...</p>
                    </div>
                @endif
            </div>
            <div style="clear:both;"></div>
            <div class="icon">
                <i class="fa fa-{{$icon}}"></i>
            </div>
            <a href="{{$url}}" class="small-box-footer info-boxs-footer-text">
                {{$description}}&nbsp;
                @if ($url && $url != 'javascript:void(0);')
                    <i class="fa fa-arrow-circle-right"></i>
                @endif
            </a>
        </div>
    </div>
</div>

@csrf

<script type="text/javascript">
  $(function () {
      staticsInfoBoxRender("{{$isRequest}}", "{{$requestUrl}}", "{{$class}}", "{{$idName}}");
  });
</script>

<script id="item{{$idName}}" type="text/html">
    <% for(var i = 0; i < list.length; i++){ %>
    <div style="width: <%= columnWdith %>%;">
        <p class="info-boxs-centext-num" title="<%= list[i].val %>"><%= list[i].val %></p>
        <p class="info-boxs-centext-tip" title="<%= list[i].key %>"><%= list[i].key %></p>
    </div>
    <% } %>
</script>

