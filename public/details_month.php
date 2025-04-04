<?php
 if (!class_exists('FPDF')) {
    require_once 'assets/fpdf/fpdf.php'; 
 }
 
 // Custom error log file
//  define('ERROR_LOG_FILE', __DIR__ . '/error_log.php');
 define('ERROR_LOG_FILE', dirname( dirname(__FILE__)) . '/app/controllers/log.php' );

 // Turn off MySQL default error reporting
 mysqli_report(MYSQLI_REPORT_OFF);
//  connection to database
 $conn = @new mysqli('localhost', 'root', 'Lo81t1#a9g9', 'work2024');

 // Check for connection errors
if ($conn->connect_error) {
    // Log the error to the custom log file
    error_log(
        "[" . date('Y-m-d H:i:s') . "] Database Connection Error: " . $conn->connect_error . "\n",
        3,
        ERROR_LOG_FILE
    );

    echo '
    <div style="
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 30vh;
        text-align: center;
        font-family: Arial, sans-serif;
        color: #333;
        background-color: #f8d7da;
        border: 1px solid #f5c2c7;
        padding: 20px;
        max-width: 500px;
        margin:5rem auto;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    ">
        <h1 style="font-size: 24px; color: #842029;">Oops! Something went wrong.</h1>
        <p style="font-size: 16px; color: #842029;">We are unable to connect to the database at the moment. Please try again later.</p>
    </div>
    ';
   exit;
}
$table = $conn->real_escape_string('my_times');

 function details_month($table, $DateMonth){
    global $conn;
    $sql = "SELECT * FROM $table WHERE date_type LIKE '$DateMonth%'";
   
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

    
}


class PDF extends FPDF
{
    // Header of the table
    // function Header()
    // {
    //     // Select Arial bold 15
    //     $this->SetFont('Arial', 'B', 12);
    //     // Title
    //     $this->Cell(80, 10, 'Date', 1, 0, 'C');
    //     $this->Cell(40, 10, 'Times', 1, 0, 'C');
    //     $this->Cell(60, 10, 'Money', 1, 0, 'C');
    //     $this->Ln();
    // }

    // Footer of the table
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Table content
    function Table($data) {
        $this->SetFont('Arial', '', 12);
       
        foreach ($data as $row) {
            $timeStart = strtotime($row['time_started']);
            $timeEnd = strtotime($row['time_ended']);

            if ($timeStart && $timeEnd && $timeEnd > $timeStart) {
                $hourWork = ($timeEnd - $timeStart);
                $this->Cell(80, 10, $row['date_type'], 1, 0, 'C');
                $this->Cell(40, 10, floor($hourWork / (60 * 60)) . ' H', 1, 0, 'C');            
                $this->Cell(60, 10, chr(128). ' ' . floor($hourWork / (60 * 60) * 5), 1, 0, 'C');
            } else {
                $this->Cell(80, 10, $row['date_type'], 1, 0, 'C');
                $this->Cell(40, 10, 'No Work', 1, 0, 'C');
                $this->Cell(60, 10, '0,00', 1, 0, 'C');
            }

            $this->Ln();
        }
    }

  
}

// Instantiate the PDF class
$pdf = new PDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTitle('Monthly Wage');
$pdf->Cell(0, 10, 'Monthly Wage', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(80, 10, 'Date', 1, 0, 'C');
$pdf->Cell(40, 10, 'Times', 1, 0, 'C');
$pdf->Cell(60, 10, 'Total', 1, 0, 'C');
$data = current_date($table);

$pdf->Ln();

// Output the table
if (!empty($data)) {

    // echo "€ " . number_format(floor($hourWork / (60*60)*5), 2);
    // $tot = floor($hourWork / (60*60)*5);
    // $total=$total+$tot;
    $total = 0;

    foreach ($data as $row) {
        $timeStart = strtotime($row['time_started']);
        $timeEnd = strtotime($row['time_ended']);
        
        if ($timeStart && $timeEnd && $timeEnd > $timeStart) {
            $hourWork = ($timeEnd - $timeStart); 
            floor($hourWork / (60 * 60) * 5);
            $total += floor($hourWork / (60 * 60) * 5);
        }

    }

 
    $pdf->Table($data);
    $pdf->Cell(80, 10, 'Total : ', 1, 0, 'C');
    $pdf->Cell(100, 10, chr(128). ' ' . $total , 1, 0, 'C');

   

} else {
    $pdf->Cell(0, 10, 'No data available for the current month.', 0, 1, 'C');
}




// Output the PDF
$pdf->Output();


?>
