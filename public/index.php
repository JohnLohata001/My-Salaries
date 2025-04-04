<?php

    if (!session_start()) 
        session_start();

    if (!class_exists('FPDF')) {
        require_once 'assets/fpdf/fpdf.php'; 
     }
    

    require '../app/core/init.php';

    $url = $_GET['url'] ?? "login";
    $url = strtolower($url);
    $url = explode('/', $url);

    $actions = $url[1] ?? ''; 

    $page_name = trim($url[0]);

    $filename = "../app/views/" . $page_name . ".php";
    

  

    if (file_exists($filename)) {
        require_once $filename; 
    }else{
    require_once "../app/views/404.php"; 
   
    }

   if ($page_name == 'login') 
    {
        require_once "../app/views/admin/controller-log.php";        
    }
    if ($page_name == 'users-add') 
    {
        require_once "../app/views/admin/controller-users-add.php";        
    }
    if ($page_name == 'user') 
    {
        require_once "../app/views/admin/controller-log.php";        
    }