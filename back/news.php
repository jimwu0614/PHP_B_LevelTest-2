<form action="./api/news.php" method="post">

    <table style="width:80%;margin:auto;text-align:center">
        <tr>
            <th width="10%">編號</th>
            <th width="70%">標題</th>
            <th width="10%">顯示</th>
            <th width="10%">刪除</th>
        </tr>

    <?php
        $all = $News->math('count','id');  //用MATH抓出筆數
        $pages = ceil($all/3);  //總頁數  3為每頁顯示幾筆(題目要求)

        $now = $_GET['p']??1;
        $start = ($now-1)*3;   //-1是因為資料是從0開始   第一頁012  第二頁345

        $rows = $News->all(" limit $start ,3");   
        // $rows = $News->all();  //撈全部
        foreach($rows as $key =>$row){   //$row為陣列 是資料表內單筆的資料
    ?>

        <tr>
            <!-- <td><?=$key+1;?></td> -->
            <td><?=(($now*3) - 2)+$key;?></td>  <!-- 分頁後 編號會改變  原本不會 -->
            <td><?=$row['title']?></td>
            <!--                                                                          如果sh為0 就不打勾 -->
            <td><input type="checkbox" name="sh[]" id="" value="<?=$row['id'];?>" <?=($row['sh']==1)?'checked':'';?>></td>
            <td><input type="checkbox" name="del[]" id="" value="<?=$row['id'];?>"></td>
            <input type="hidden" name="id[]" value="<?=$row['id'];?>">
        </tr>

    <?php 
    };

    ?>

    </table>
    <div class="ct">
    <?php

        if(($now-1)>0){   //前一頁的"<"

            $bf = ($now-1);
            echo "<a href='?do=news&p={$bf}'> < </a>";
        }

        for($i=1;$i<=$pages;$i++){
            $fontsize = ($now==$i)?'24px':'16px';

            echo "<a href='?do=news&p={$i}' style='font-size:$fontsize'>";
            echo $i;
            echo "</a>";
        }

        if(($now+1)<=$pages){  //後一頁的">"

            $af = ($now+1);
            echo "<a href='?do=news&p=$af'> > </a>";
        }
    ?>
    </div>
    <div class="ct"><input type="submit" value="確定修改"></div>
</form>