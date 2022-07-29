<fieldset>
    <legend>會員註冊</legend>
    <div style="color: red;">*請設定您要註冊的帳號及密碼（最長12個字元）</div>
    <table>
        <tr>
            <td class="clo">Step1:登入帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td class="clo">Step2:登入密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td class="clo">Step3:再次確認密碼</td>
            <td><input type="password" name="pw2" id="pw2"></td>
        </tr>
        <tr>
            <td class="clo">Step4:信箱(忘記密碼時使用)</td>
            <td><input type="text" name="email" id="email"></td>
        </tr>
        <tr>
            <td><button onclick="reg()">註冊</button><button onclick="reset()">清除</button></td>
            <td></td>
        </tr>
    </table>
</fieldset>

<script>
    function reset(){
        $("table input").val("");
    }

    function reg(){
        // JS的物件宣告方法
        let user={
            acc:$("#acc").val(),
            pw:$("#pw").val(),
            pw2:$("#pw2").val(),
            email:$("#email").val()
        }
       //JS的物件的呼叫方法
    if(user.acc=='' || user.pw=='' || user.pw2=='' || user.email==''){
        alert('不可空白');
    }else if(user.pw!=user.pw2){
        alert('密碼錯誤');
    }else{
        $.get("./api/chk_acc.php",{acc:user.acc},(res)=>{  //確認帳號
            // console.log(res);
            if (parseInt(res===1)) {
                alert('帳號重複')                
            } else {                  //這邊因為上面物件宣告已經有{} 所以這裡不用加
                $.post("./api/reg.php",user,(res)=>{
                    alert("註冊完成，歡迎加入");
                    location.href="?do=login"
                })
            }
        })
    }
    }
</script>