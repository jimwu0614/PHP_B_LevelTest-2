<?php
$subject = $Que->find($_GET['id']);
$options = $Que->all(['subject_id'=>$_GET['id']]);

?>

<fieldset>
    <legend>目前位置：首頁 > 問卷調查 > <?=$subject['text']?></legend>

    <h3><?=$subject['text']?></h3>
    <form action="./api/vote.php" method="post">
        <?php
            foreach($options as $opt){

            }
        ?>
    <p>
    <input type="radio" name="opt" value="">
    </p>
    </form>
</fieldset>