
<?php
include_once "../base.php";


//  這寫法也可以 但寫太常容易錯
// $User->save(['acc'=>$_POST['acc'],'pw'=>$_POST['pw'],'email'=>$_POST['email'],])

// 所以直接拿$_POST的陣列 再把pw2取消 


unset($_POST['pw2']);
$User->save($_POST);

?>