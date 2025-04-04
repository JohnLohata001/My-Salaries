<?php


// if($_SERVER['REQUEST_METHOD'] == 'POST')

//     if ($_POST["btn-search"]) {

//         unset($_POST["btn-search"]);

//         $date1 = $_POST["time_started"];
//         $date2 = $_POST["time_ended"];

//         $dates = seclectDateBetween('my_times', $date1, $date2);
        
       

        
//     }

/**
 * Fetch records from the database based on the provided date range.
 *
 * @param string $startDate The start date (Y-m-d).
 * @param string $endDate The end date (Y-m-d).
 * @param mysqli $conn The active MySQLi connection.
 * @return array The result set as an associative array, or an empty array on failure.
 */
function fetchRecordsByDateRange($startDate, $endDate, $conn) {
    $result = [];
    try {
        $sql = "SELECT * FROM my_times WHERE STR_TO_DATE(date_type, '%Y-%m-%d') BETWEEN ? AND ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error in preparing query: " . $conn->error);
        }

        $stmt->bind_param("ss", $startDate, $endDate);

        if (!$stmt->execute()) {
            throw new Exception("Error in executing query: " . $stmt->error);
        }

        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    } catch (Exception $e) {
        // Log the error or display it for debugging
        error_log($e->getMessage());
    }
    return $result;
}

