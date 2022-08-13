<style>
    .type {
        cursor: pointer;
        color: blue;
        margin: 1rem 0;
        max-width: max-content;
    }

    .type:hover {
        border-bottom: 1px solid blue;
    }
</style>

<div>目前位置 : 首頁 > 分類網誌 > <span id="header"></span></div>
<div style="display: flex;">
    <fieldset style="width: 20%;">
        <legend>分類網誌</legend>
        <div class="type">健康新知</div>
        <div class="type">菸害防治</div>
        <div class="type">癌症防治</div>
        <div class="type">慢性病防治</div>
    </fieldset>
    <fieldset style="width: 80%;">
        <legend>文章列表</legend>
        <div id="content"></div>
    </fieldset>
</div>

<script>
    //網頁載入完就先讀取一次健康新知
    getList('健康新知');

    $(".type").on("click", function() {
        let type = $(this).text()
        console.log(type);
        $("#header").text(type);
        getList(type);  //並執行一次getList()
    })

    function getList(type) {
        $.get("./api/get_list.php", {type}, (list) => {
            $("#content").html(list)
        })
    }

    function getNews(id) {
        $.get("./api/get_news.php", {id}, (news) => {
            $("#content").html(news)
        })
    }
</script>