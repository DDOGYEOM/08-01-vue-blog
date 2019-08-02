<?php
    require('db.php');
    
    $db = new DB();

    $sql = "SELECT * FROM todoList";
    $list = $db->fetchAll($sql);

    // header('Access-Control-Allow-Origin: *');
    echo json_encode($list, JSON_UNESCAPED_UNICODE);