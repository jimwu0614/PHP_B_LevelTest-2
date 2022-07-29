<?php
include_once "../base.php";

foreach($_POST['id'] as $id){
    if(isset($_POST['del']) && in_array($id,$_POST['del'])){
        $News->del($id);
    }else{
        $row=$News->find($id);
        $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
        $News->save($row);
    }
}
to("../back.php?do=news"); 

?>



<?php
/*
include_once "../base.php";


//刪除的功能
if(isset($_POST['del'])){
    foreach($_POST['del'] as $id){
        $News->del($id);
    }
}


//隱藏的功能
$rows=$News->all();

// dd($rows);
foreach($rows as $row){
    if(in_array($row['id'],$_POST['sh'])){  //如果"$row['id']" 存在於"$_POST['sh']" 就是true
        $row['sh']=1;

    }else{
        $row['sh']=0;

    }
    $News->save($row);
}

to("../back.php?do=news"); 
*/
?>