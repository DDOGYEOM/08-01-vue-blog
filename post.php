<?php
    require('db.php');

    $date = $_POST['date'];
    $name = $_POST['todo'];

    $sql = "INSERT INTO todoList (name, date, complete) VALUES (?, ?, 0)";

    $db = new DB();
    $result = $db -> query($sql, [$name, $date]);
    $id = $db->getLast();

    $response = ['success'=>true, 'id'=>$id];
    echo.json_encode($response);

