<?php
include_once "../base.php";

/*$acc = $post['acc'];
echo $User->math('count','id',['acc'=>$acc])*/

                //用count回傳1或0   當作布林值使用
echo $User->math('count','id',['acc'=>$_POST['acc']])



?>