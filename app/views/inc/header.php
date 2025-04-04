<?php

  
if(!isset($_SESSION["USER"])){
    header("Location:".REAL_PATH."/app/view/login");
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

  <link rel="stylesheet" href="./assets/css/styles.css">
  <!-- <link rel="stylesheet" href="<?=ROOT?>/assets/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="navbar">
  <h1>Dashboard</h1>
</div>
<div style="position:relative;width:1000%">
  <div style="">
    <?php if (count($_SESSION["USER"]) > 0): ?>
    <ul class="tabs">
      <li class="tab" onclick="openForm('product')"><a href="<?=ROOT?>/home">Home</a></li>
      <!-- <li class="tab" onclick="openForm('category')"><a href="<?=ROOT?>/admin/add">Add Info</a></li> -->
      <li class="tab" onclick="openForm('package')"><a href="<?=ROOT?>/admin/general_situation">Situations</a></li>
       <li class="tab" onclick="openForm('product')"><a href="<?=ROOT?>/logout">logout</a></li>
       <li class="tab" onclick="openForm('product')" style="padding:0;margin:0">
       <img src="./../public/assets/img/<?=$_SESSION['USER']['user_image']?>" alt="img" style="width:50px;height:30px;padding:0;margin:0;object-fit:cover">
       </li>
       <li class="tab" onclick="openForm('product')">
          <?= $_SESSION["USER"]['username'];?>
       </li>
    </ul>
    <?php endif; ?>
    
  </div>
  
</div>