<!-- 文字壓圖的系統TAG組合 -->
<fieldset>
    <legend>會員登入</legend>

    <table>
        <tr>
            <td class="clo">帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td class="clo">密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td>
                <button onclick="login()">登入</button>
                <button onclick="reset()">清除</button>
            </td>
            <td>
                <a href="?do=forgot">忘記密碼</a>
                <a href="?do=reg">尚未註冊</a>
            </td>
        </tr>
    </table>

</fieldset>


<script>
    function login(){
        let acc = $("#acc").val();
        let pw = $("#pw").val();
     // $.post("./api/chk_acc.php",{acc:acc},(res)=>{
        $.post("./api/chk_acc.php",{acc},(res)=>{
            console.log(res)
            if(parseInt(res)===1){

            }else{
                alert("查無帳號")
            }
        })

    }
</script>