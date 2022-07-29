<?php

session_start();
date_default_timezone_set("Asia/Taipei");


function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($href){
    header("location:".$href);
}


class DB{
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=b_quiz-2";
    protected $user = "root";
    protected $pw = "";
    protected $table;
    protected $pdo;
    
    public function __construct($table){
        $this->table = $table; 
        $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
    }
    
    /*
    * 1.新增資料 insert()     insert into $table
    * 2.修改資料 update()     update $table set
    *  ->save()
    * 3.查詢資料 all(),find() selete from $table 
    * 4.刪除資料 del()        delete from $table
    * 5.計算 max(),min(),count() ->math()  select math() from $table
    */

    /*
    * all()函式可能會有的狀況 
    * ($array) //特定欄位條件的多筆資料
    * ($sql)  //只有額外條件的多筆資料...limit $start,$div .... ,order by....,group by......
    * ($array,$sql) //有欄位條件又有額外條件的多筆資料....where  ..... limit ...., ..where ....order by.....
    * ($sql,$sql) //有欄位條件又有額外條件的多筆資料....where  ..... limit ...., ..where ....order by.....
    * ()  //整張資料表的內容
     */



    function all(...$arg){
        //基本前半段SQL語
        $sql = "SELECT * FROM $this->table ";
        //如果第一個參數存在
        if(isset($arg[0])){
  
            //如果第一個參數存在,而且是陣列 表示是要特定的範圍的全部資料
            if (is_array($arg[0])) {  
                foreach($arg[0] as $key=>$value){
                    $tmp[]="`$key`='$value'";
                }
                $sql .= " WHERE ". join(" AND ", $tmp);

            //如果第一個參數存在,但是是限定條件的話,直接接在前半段SQL後面(order by||group by)
            }else{   
                $sql .= $arg[0];
            }
        }
        //如果第二個參數存在,一定要放字串
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        
        //如果$arg[0],$arg[0]都不存在  直接SELECT * FROM $table
        // echo $sql."<br>";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    //只會傳一個條件進來
    function find($id){
        $sql = "SELECT * FROM $this->table WHERE ";

        //從all()複製過來  
        if (is_array($id)) { 
            foreach($id as $key=>$value){
                $tmp[]=" `$key`='$value' ";
            }
            $sql .= join(" AND ", $tmp);
        }else{
            $sql .= " `id` = '$id'";
        }
    // echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        
    }



    function save($array){
        if(isset($array['id'])){
            //更新
            foreach($array as $key => $val){
                $tmp[]="`$key`='$val'";
            }

            $sql="update $this->table set  ".join(',',$tmp)."  where `id`='{$array['id']}'";
        }else{
            $sql="insert into $this->table (`".join("`,`",array_keys($array))."`) 
                                     values('".join("','",$array)."')";
        }
        // echo $sql;

        return $this->pdo->exec($sql);
    }

    function del($id){

        //複製find
        $sql = "DELETE FROM $this->table WHERE ";
        if (is_array($id)) {
            foreach($id as $key=>$value){
                $tmp[]="`$key`='$value'";
            }
            $sql .= join(" AND ", $tmp);
        }else{
            $sql .= "`id` = '$id'";
        }
        echo $sql;

        return $this->pdo->exec($sql);
    }

    function math($math,$col,...$arg){
        $sql = "SELECT $math($col) FROM $this->table ";
        

        //以下都複製all()
        if(isset($arg[0])){
            if (is_array($arg[0])) {
                foreach($arg[0] as $key=>$value){
                    $tmp[]="`$key`='$value'";
                }
                $sql .= " WHERE ". join(" AND ", $tmp);

            }else{
                $sql .= $arg[0];
            }
        }

        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        
        // echo $sql."<br>";
                                    //fetchAll改成fetchColumn
        return $this->pdo->query($sql)->fetchColumn();
    }

    function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }
} //物件class宣告結束
$Total = new DB("total");
$User = new DB("user");

//瀏覽人次的功能

    //判斷現在有沒有SESSION
if(!isset($_SESSION['total'])){
    //包含下面的判斷式 確認有沒有該筆日期的紀錄 
    $chkDate = $Total->math('count','id',['date'=>date("Y-m-d")]);
    //若有
    if($chkDate>=1){  
        //宣告$total變數為資料庫抓回來的資料
        $total = $Total->find(['date'=>date("Y-m-d")]);
        //把抓回來的total欄位加一筆
        $total['total']++;
        //回寫
        $Total->save($total);
        //有登入狀態
        $_SESSION['total']=1;
    //若無紀錄
    }else{
        $Total->save(['date'=>date("Y-m-d"),'total'=>1]);
        $_SESSION['total']=1;
    }
}






?>