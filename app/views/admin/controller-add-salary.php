<?php

    $table = " my_hours";
    $data = [];

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        unset($_POST['btn-submit']);

        $data['hours_works'] = $_POST['hours_works'] ;
       
        update($table, ['id'=>2], $data);

    }

    $result = selectOne($table, ['id'=>2]);