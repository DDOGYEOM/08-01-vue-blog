<?php
    require('db.php');

    $sql = "DELETE FROM todoList WHERE id = ?";

    $id = $_POST['id'];
    $db = new DB();
    $res = $db->query($sql, [$id]);

    // $response = ['success'=>true, 'res'=>$res];

    // echo json_encode($response, JSON_UNESCAPED_UNICODE);