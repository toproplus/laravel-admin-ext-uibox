/*JsonFormatBox*/
function renderJsonFormat(randStr) {
    let jsonStr = getJsonStr(randStr);
    try {
        $('.jsonFormatViewShow' + randStr).JSONView(jsonStr);
    }catch (e) {
        $('.jsonFormatViewShow' + randStr).html(jsonStr)
    }

}

function getJsonStr(randStr) {
    let jsonStr = $('.jsonFormatViewData' + randStr).html();
    return jsonStr;
}

function showJsonFormatData(randStr) {
    closeJsonFormatView();
    $('.jsonFormatContainer' + randStr).show();
    $('.a' + randStr).css('color', '#305777');
}


function closeJsonFormatView() {
    $('.jsonFormatContainer').hide();
}

function copyJsonFormatData(randStr) {
    let jsonStr = getJsonStr(randStr);
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

/*StasticsInfoBox*/
function staticsInfoBoxRender(isRequest, requestUrl, className, idName)
{
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
/*MarkdownBox*/
function showdownRender(markdownText, ContainerId) {
    let converter = new showdown.Converter(),
        html      = converter.makeHtml(markdownText);
    converter.setFlavor('github');
    $(ContainerId).html(html);
}