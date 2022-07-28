<?php
include_once "../base.php";

/*$acc = $post['acc'];
echo $User->math('count','id',['acc'=>$acc])*/

                //用count回傳1或0   當作布林值使用
$chk=$User->math('count','id',['acc'=>$_POST['acc'],'pw'=>$_POST['pw']]);


    
if($chk){  //若為true
    $_SESSION['user']=$_POST['acc'];  //設定SESSION
    echo 1;  //傳1給login.php
}else{
    echo 0;  //傳0給login.php
}

?>