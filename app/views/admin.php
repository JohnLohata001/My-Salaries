<?php
  
    
    if(!isset($_SESSION["USER"])){
        header("Location:".REAL_PATH."app/view/login");
    }

    $section = $url[1] ?? 'login';
    $filename = "../app/views/admin/" . $section . ".php";

    if (!file_exists($filename)) 
    {
        $filename = "../app/views/admin/404.php";
    }
    if ($section == 'add') 
    {
        require_once "../app/views/admin/controller-add.php";        
    }
    if ($section == 'search') 
    {
        require_once "../app/views/admin/controller-search.php";        
    }
    if ($section == 'search_monthly') 
    {
        require_once "../app/views/admin/search_monthly_controller.php";        
    }
    if ($section == 'printer') 
    {
        require_once "../app/views/admin/controller-print.php";        
    }
    if ($section == 'add-salary') 
    {
        require_once "../app/views/admin/controller-add-salary.php";        
    }
   
    
   


?>
   
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

  <link rel="stylesheet" href="<?=ROOT?>/assets/css/styles.css">
</head>
<body>

    <div class="navbar">
        <h1>Dashboard</h1>
    </div>
    <ul class="tabs">
        <li class="tab" onclick="openForm('product')"><a href="<?=ROOT?>/home">Home</a></li>
        <li class="tab" onclick="openForm('package')"><a href="<?=ROOT?>/admin/search">daily situation</a></li>
        <li class="tab" onclick="openForm('package')"><a href="<?=ROOT?>/admin/general_situation">Current Month</a></li>
        <li class="tab" onclick="openForm('package')"><a href="<?=ROOT?>/admin/search_monthly">Monthly Stituations</a></li>
        <li class="tab" onclick="openForm('category')"><a href="<?=ROOT?>/admin/add">Add Info</a></li>
        <li class="tab" onclick="openForm('package')"><a href="<?=ROOT?>/admin/add-salary">add-salary</a></li>
    </ul>
    <main>
        <?php require_once $filename; ?>
    </main>

    <script src="./assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    
    <script>       

        $(document).ready(function()
        {
            $(".Schedules").click(function(){
                $('#ulMenu').slideToggle();
            });
        });

        config = {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        }

        flatpickr("input[type=datetime]", config);
        configs = {
            enableTime: true,
            dateFormat: "Y-m-d",
        }

        flatpickr("input[type=date]", configs);

    </script>

</body>
</html>
