<?php
 
    $errors = [];
    $table = "users";
    $data = [];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(empty($_POST['email'])){

            array_push($errors, "Please put your email");
           
        }else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "format email not valide");
            
        }
        if(empty($_POST['password'])){

            array_push($errors, "password is required");
           
        }

        $data['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);


        if(count($errors) == 0){          

            $rows = selectOne($table, ['email'=>$data['email'] ]);
            if ($rows && password_verify($_POST['password'], $rows['password'])){
                $_SESSION['USER'] = [
                    'username' => $rows['username'],
                    'email' => $rows['email'],
                    'user_image' => $rows['user_image'],
                    'data_created' => $rows['data_created']
                ];                   
                
                header('Location: '. ROOT .'/home');
                exit();
                
            }else{
                array_push($errors,'wrong Credentials');
            }
        }

        
            
        
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | My Website</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
    <style>
        body{
            
            padding: 0;
            margin: 0;
            background: url('./../public/assets/img/bg_login.png') no-repeat center;
            background-size: cover;

        }
        .navbar{
            height: 50px;
            border-bottom: solid 2px #eee;
            box-shadow: 0px 3px 2px #707070;
        }
        .container-login{
            max-width: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            margin:13rem auto;
            padding: 1rem;
            border-radius: 5px;
            box-shadow: 2px 1px rgba(150, 149, 149, 0.5);
            border: solid 1px rgba(27, 27, 27, 0.33);
        }
        .content-login{
            display: flex;
            flex-direction: column;
        }
        .content-login h2{
            color: #000;
        }
        input{
            padding: 0.5rem 1rem;
            border: solid 1px #eee;
            font-size: 16px;
            /* color: rgba(248, 243, 243, 0.9); */
            background-color: rgba(255, 254, 254, 0.33);
           
        }
        input[type="checkbox"]{
            text-align: left;
            display: block;
            align-items: left;
        }
        input[type="email"]{
            border: solid 1px rgba(182, 180, 180, 0.5);
            border-radius: 5px 5px 0 0;
            border-bottom: none;
        }
        input[type="email"]:focus{
            outline: none;
            border-bottom: none;
        }
        input[type="password"]:focus
        {
            outline: none;
            
        }

        input[type="password"]{
            border: none;
            border: solid 1px rgba(138, 138, 138, 0.5);
            border-radius: 0 0 5px 5px ;
        }
        input:focus{
            border: solid 1px rgba(182, 180, 180, 0.5);
        }
        .submit-login{
            padding: 0.8rem 1rem;
            background:rgb(29, 122, 221);
            color: #fff;
            border: solid 1px #707070;
            font-size: 16px;
            margin: 1.5rem 0;
            border-radius: 5px;
            font-size: 16px;

        }
        .submit-login:hover{

            background: #fff;
            color: #0056b3;
            border: solid 1px #0056b3;         
            cursor: pointer;

        }
        hr{
            border-bottom: solid 1px #2280e6;
        }
        .errors{
            padding: 0.5rem;
            background-color:rgba(179, 51, 0, 0.3);
            border: solid 1px rgba(179, 51, 0, 0.6);
            color: rgba(179, 51, 0, 0.6);
            margin-bottom: 0.5rem;
            border-radius: 3px;
        }
    </style>
<div class="navbar">

</div>
        <div class="container-login">
            <form action="" method="post">
               
                <div class="content-login">
                    <h2>Login</h2><hr>

                     <?php if (count($errors) > 0):?>
                        <div class="errors">
                            <?php foreach($errors as $row):?>                    
                                <li><?=$row?></li>
                            <?php endforeach; ?>
                        </div>
                    <?php endif;?>
                    <input type="text" name="email" placeholder="Email" value="<?=isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                    <input type="password" name="password" placeholder="Password" id=""><br>
                    <button type="submit" class="submit-login">Login</button>
                </div>
            </form>

        </div>
        
</body>
</html>