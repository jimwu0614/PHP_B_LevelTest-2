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
                //把東西送去給誰  送甚麼  送什麼回來
        $.post("./api/chk_acc.php",{acc},(res)=>{   //外圈先判斷帳號是否存在
            console.log('acc',res)
            if(parseInt(res)===1){                  //若帳號存在
                //內圈判斷帳號密碼是否正確
                $.post("./api/chk_pw.php",{acc,pw},(res)=>{
                    console.log('pw',res);
                    if(parseInt(res)===1){      //如果帳號密碼存在  用下面判斷式分流管理員與普通人
                        if(acc==='admin'){
                         location.href='back.php'
                        }else{
                        location.href='index.php'
                        }
                    }else{                      // 如果密碼不存在
                    alert("密碼錯誤");
                }

                })
            }else{                                  //若帳號不存在
                alert("查無帳號")
            }
        })

    }
</script>