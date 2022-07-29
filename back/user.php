<fieldset>
    <legend>帳號管理</legend>

    <table>
        <tr>
            <td class="clo">帳號</td>
            <td class="clo">密碼</td>
            <td class="clo">刪除</td>
        </tr>
        <tbody id="users">

        </tbody>
        <div class="ct">
            <button>確定刪除</button>
            <button>清空選取</button>
        </div>
    </table>
</fieldset>

<script>
    $.get("./api/users.php", (users) => {
        $("#users").html(users)
    })
</script>