<?php
$table = "users";
$data = [];
$errors = [];
$success = [];
$results = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    unset($_POST['btn-submit']);
    
    // Validate user input
    if (empty($_POST['username'])) {
        array_push($errors, 'username required');
    }
    
    if (empty($_POST['email'])) {
        array_push($errors, 'email required');
    } else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'incorrect format email');
        }
    }
    
    if (empty($_POST['password'])) {
        array_push($errors, 'password required');
    }

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Get file details
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        
        // Extract file extension
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Create a unique file name (e.g., "username_timestamp.jpg")
        $newFileName = time() . '.' . $fileExtension;

        // Specify the directory to upload to
        $uploadDirectory = './../public/assets/img/'; // Ensure this directory exists and is writable
        
        // Full path to save the file
        $uploadPath = $uploadDirectory . $newFileName;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $data['user_image'] = $newFileName;  // Save the new file name in the database
        } else {
            array_push($errors, 'Error uploading file');
        }
    } else {
        array_push($errors, 'No file uploaded or error in upload');
    }

    // Store other user information
    $data['username'] = htmlspecialchars($_POST['username']);
    $data['email'] = htmlspecialchars($_POST['email']);
    $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Debug output (optional)
    // show($data); die;

    // If no errors, proceed with database insert
    if (count($errors) == 0) {
        create($table, $data);  // Insert data into database
        array_push($success, 'User has been saved successfully');
    }
}

$results = selectAll($table);
