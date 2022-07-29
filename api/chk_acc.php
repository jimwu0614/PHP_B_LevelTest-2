<?php
include_once "../base.php";

/*$acc = $post['acc'];
echo $User->math('count','id',['acc'=>$acc])*/

                //用count回傳1或0   當作布林值使用
// echo $User->math('count','id',['acc'=>$_POST['acc']])

//上面寫法更改版  使GET POST都可以用
$acc=$_POST['acc']??$_GET['acc'];
echo $User->math('count','id',['acc'=>$acc]);

?>