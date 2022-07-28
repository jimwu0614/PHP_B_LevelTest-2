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
    public $dsn = "mysql:host=localhost;charset=utf8;dbname=b_quiz-2";
    public $user = "root";
    public $pw = "";
    public $table;
    public $pdo;
    
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
    * 
    * ($array) //特定欄位條件的多筆資料
    * ($sql)  //只有額外條件的多筆資料...limit $start,$div .... ,order by....,group by......
    * ($array,$sql) //有欄位條件又有額外條件的多筆資料....where  ..... limit ...., ..where ....order by.....
    * ($sql,$sql) //有欄位條件又有額外條件的多筆資料....where  ..... limit ...., ..where ....order by.....
    * ()  //整張資料表的內容
     */



    function all(...$arg){
        //基本前半段SQL語
        $sql = "SELECT * FROM $this->table ";
        
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
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function find($id){
        $sql = "SELECT * FROM $this->table WHERE ";
        if (is_array($id)) {
            foreach($id as $key=>$value){
                $tmp[]="`$key`='$value'";
            }
            $sql .= join(" AND ", $tmp);
        }else{
            $sql .= "`id` = '$id'";
        }
        return $this->pdo->query($id)->fetch(PDO::FETCH_ASSOC);
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

        return $this->pdo->exec($sql);
    }

    function del($id){

        //複製find
        $sql = "SELECT  FROM $this->table WHERE ";
        if (is_array($id)) {
            foreach($id as $key=>$value){
                $tmp[]="`$key`='$value'";
            }
            $sql .= join(" AND ", $tmp);
        }else{
            $sql .= "`id` = '$id'";
        }
        return $this->pdo->exec($id);
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









}





?>