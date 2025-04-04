<?php

// define('HOST', 'localhost');
// define('USER', 'root');
// define('PWD', '');
// define('DBNAME', 'work2024');

// $conn = new mysqli(HOST, USER, PWD, DBNAME);
$rows = [];
$table = 'my_times';
$mistake = [];


// function getTotalHoursByMonthYear($table, $year) 
// {

//     global $conn;

//     $sql = "
//         SELECT 
//             DATE_FORMAT(date_type, '%Y-%m') AS month_year, 
//             SUM(TIMESTAMPDIFF(HOUR, time_started, time_ended)) AS total_hours
//         FROM $table
//         WHERE date_type LIKE ?
//         GROUP BY month_year
//         ORDER BY month_year DESC
//     ";
    
   
    
//     $stmt = $conn->prepare($sql);

//     if (!$stmt) {
//         die("Prepare failed: " . $conn->error);
//     }
//     $year = $year . '%';
//     $stmt->bind_param('s', $year);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if (!$result) {
//         die("Execute failed: " . $stmt->error);
//     }
//     $final_result = $result->fetch_all(MYSQLI_ASSOC);

//     $stmt->close();

//     return $final_result;
// }



// $conn->close();
