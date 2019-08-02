<?php

class DB {
    private $db = null;

    function __construct(){
        //생성자
        $options = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];
        $this->db = new \PDO(
            "mysql:host=gondr.asuscomm.com; dbname=yy_20103; charset=utf8mb4",
            "yy_20103",
            "1234",
            $options );
    }

    public function fetch($sql, $param = []) {
        $q = $this->db->prepare($sql);
        $q->execute($param);
        return $q-> fetch();
    }

    public function fetchAll($sql, $param = []){
        $q = $this->db->prepare($sql);
        $q->execute($param);
        return $q-> fetchAll();
    }

    public function query($sql, $param = []){
        $q = $this->db->prepare($sql);
        return $q->execute($param);
    }

    public function getLast(){
        return $this -> db -> lastInsertId();//마지막으로 삽입된 AI 값이 나온다.
    }
}