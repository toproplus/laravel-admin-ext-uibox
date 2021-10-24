<div class="row">
    <div class="col-md-12">
        <div class="small-box bg-{{$color}}">
            <div class="inner info-boxs-inline-box {{$class}}">
                @if (!$isRequest && $stastics)
                    @foreach ($stastics as $key => $val)
                        <div  style="width: {{$columnWdith}}%;">
                            <p class="info-boxs-centext-num" title="{{$val}}">{{$val}}<p/>
                            <p class="info-boxs-centext-tip">{{$key}}</p>
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
    function infoboxrender{{$idName}}()
    {
        let isRequest = "{{$isRequest}}";
        let requestUrl = "{{$requestUrl}}";
        let className = "{{$class}}";
        let idName = "{{$idName}}";
        if (parseInt(isRequest)) {
            $.ajax({
                method: 'get',
                url: requestUrl,
                data: {
                    _method: 'get',
                    _token: $("input[name='_token']").val()
                },
                success: function (data) {
                    let columnWdith = 100 / Object.keys(data).length;
                    let list = [];
                    Object.keys(data).forEach(function(key){
                        let temp = {
                            key: key,
                            val: data[key]
                        };
                        list.push(temp);
                    });
                    let htmlData = template('item' + idName, {list: list, columnWdith: columnWdith});
                    $("." + className).html(htmlData);
                }
            });
        }
    }
    infoboxrender{{$idName}}();
</script>

<style>
    .info-boxs-inline-box > div{float: left;text-align: left;}
    .info-boxs-centext-num,
    .info-boxs-centext-tip{
        font-size: 3rem !important;text-overflow: ellipsis;
        white-space: nowrap;overflow:hidden;padding-right:6px;
    }
    .info-boxs-centext-tip{font-size: 1.5rem !important;}
    .info-boxs-footer-text{height: 30px;line-height:25px;}
</style>

<script id="item{{$idName}}" type="text/html">
    <% for(var i = 0; i < list.length; i++){ %>
    <div style="width: <%= columnWdith %>%;">
        <p class="info-boxs-centext-num" title="<%= list[i].val %>"><%= list[i].val %></p>
        <p class="info-boxs-centext-tip"><%= list[i].key %></p>
    </div>
    <% } %>
</script>

