<?php
include_once "../base.php";
$users = $User->all();
foreach($users as $user){
    if($user['acc']!=='admin'){//如果帳號為admin  就不顯示
        echo "<tr>";
        echo "<td>{$user['acc']}</td>";
        echo "<td>".str_repeat("*",strlen($user['pw']))."</td>";   //把密碼根據長度  全部換成*
        echo "<td><input type='checkbox' name='del[]' value='{$user['id']}'></td>";
        echo "</tr>";
    }
}
?>

