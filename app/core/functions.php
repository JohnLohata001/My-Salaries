<?php

function show($value){
    echo'<pre>';
        print_r($value);
    echo'</pre>';
}



function executeQuery($sql, $data){

    global $conn;

    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}
function executeQueryNum($sql, $data){

    global $conn;

    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('i', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}



// ================= select all from database ====================


    function selectAll($table, $conditions = []){

        global $conn;

        $sql ="SELECT * FROM $table";
        if (empty($conditions)) {
            
            $sql = $sql . " ORDER BY id DESC";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $records;


        }else{

            $i=0;
            foreach ($conditions as $key => $value) {

                if ($i === 0) {
                    
                    $sql = $sql . " WHERE $key=?";
                    
                } else {
                    
                    $sql = $sql . " AND $key=?";

                }
                $i++;           
            
            }

            $stmt = executeQuery($sql, $conditions);
            $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $records;

        }
    }
    function selectAllNum($table, $conditions = []){

        global $conn;

        $sql ="SELECT * FROM $table";
        if (empty($conditions)) {
            
            $sql = $sql . " ORDER BY time_started DESC";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $records;


        }else{

            $i=0;
            foreach ($conditions as $key => $value) {

                if ($i === 0) {
                    
                    $sql = $sql . " WHERE $key=?";
                    
                } else {
                    
                    $sql = $sql . " AND $key=?";

                }
                $i++;           
            
            }

            $stmt = executeQueryNum($sql, $conditions);
            $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $records;

        }
    }
// ====================select One record in database =====================

    function selectOne($table, $conditions){

        global $conn;
        $sql = "SELECT * FROM $table";

        $i=0;
        
        foreach($conditions as $key => $value){

            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            }else{
                $sql = $sql . " AND $key=?";
            }
            $i++;

        }
        $sql = $sql . " LIMIT 1";
        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_assoc();
        return $records;

    }


    // ===================================== insert data into database ===================

    function create($table, $data){

        global $conn;
    
        $sql ="INSERT INTO $table SET ";
        $i = 0;
    
        foreach ($data as $key => $value) {
    
           if($i === 0){
                $sql = $sql . " $key=?";
            }else{
                $sql = $sql . ", $key=?";
            }
    
            $i++;
        }
        $stmt = executeQuery($sql, $data);
        $id = $stmt->insert_id;
        return $id;
    
    }

    // =============== update info ========================

    function update($table, $id, $data){
        
        global $conn;
        $sql ="UPDATE $table SET";
        $i=0;        
            
        foreach ($data as $key => $value) {

            if ($i === 0){
                $sql = $sql . " $key=?";
            }else{
                $sql = $sql . ", $key=?";
            }
            $i++; 
        }

        $sql = $sql . " WHERE id=?";
        $data['id'] = $id;
        $stmt = executeQuery($sql, $data);
        return $stmt->affected_rows;

    }

    // ==================== Delete info ========================

    function delete($table, $id){

        global $conn;

        $sql = "DELETE FROM $table WHERE id =?";
        $stmt = executeQuery($sql, ['id'=>$id]);
        return $stmt->affected_rows;
         

    }
    
    // ===================== select different table ================================

    function seclectDateBetween($table, $date1, $date2){

        global $conn;

        $sql = "SELECT * FROM $table WHERE date_type BETWEEN ? AND ?";
        $stmt=$conn->prepare($sql);  
        $stmt->bind_param("ss", $date1, $date2);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;

    }

    // ================= select like ========================
    function SelectMonthYear($table, $DateMonth){

        global $conn;

        $sql = "SELECT * FROM $table WHERE date_type LIKE ?";
        $stmt = $conn->prepare($sql);  
       
        $searchTerm = $DateMonth . "%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);        
      
        return $result;

    }

    function current_date($table){
        global $conn;
        $sql ="SELECT * FROM $table
               WHERE MONTH(date_type) = MONTH(CURDATE())
               AND YEAR(date_type) = YEAR(CURDATE()) ORDER BY date_type ASC";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;

        
    }

    function getTotalHoursByMonthYear($table, $year) {

    global $conn;

    $sql = "
        SELECT 
            DATE_FORMAT(date_type, '%Y-%m') AS month_year, 
            SUM(TIMESTAMPDIFF(HOUR, time_started, time_ended)) AS total_hours
        FROM $table
        WHERE date_type LIKE ?
        GROUP BY month_year
        ORDER BY month_year DESC
    ";
    
   
    
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $year = $year . '%';
    $stmt->bind_param('s', $year);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Execute failed: " . $stmt->error);
    }
    $final_result = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    return $final_result;
}
// ========================= difference between time =======================

function getTimeDifference($start, $end) {
    // Convert times to timestamps
    $startTime = strtotime($start);
    $endTime = strtotime($end);
    
    // Check if both timestamps are valid
    if ($startTime === false || $endTime === false) {
        return "Invalid time";
    }

    // Calculate difference in seconds
    $diffInSeconds = $endTime - $startTime;
    
    // Convert to hours, minutes, and seconds
    $hours = floor($diffInSeconds / 3600);
    $minutes = floor(($diffInSeconds % 3600) / 60);
    $seconds = $diffInSeconds % 60;

    return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
}
// =============================== getting salary ==============================
function getDailySalary($table, $hourlyRate = 5) {
    global $conn;
    $sql = "SELECT DATE(time_started) AS work_date, 
                   SUM(TIMESTAMPDIFF(SECOND, time_started, time_ended) / 3600) AS total_hours
            FROM $table 
            GROUP BY work_date 
            ORDER BY work_date DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $row['total_salary'] = $row['total_hours'] * $hourlyRate; // Multiply hours by salary per hour
        $data[] = $row;
    }
    return $data;
}

function redirect($page){
    header('Location :'. ROOT .'/'. $page);
}
function old_value($key, $default = ''){
    if (!empty($_POST[$key]))     
        return $_POST[$key];
    return $default;
}
