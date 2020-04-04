<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Event Buzz -register</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<?php
                        $host="localhost";
                        $user="root";
                        $pass="";
                        $db="ytdnzygr_login";
$errors="";
                        $link=mysqli_connect($host,$user,$pass);
                        $db1=mysqli_select_db($link,$db); 
                        if(!$db1) {
                            die("Unable to select database");
	                               }
                        $name = $_GET['name'];
                        $email = $_GET['email'];
                        $password = $_GET['password'];
                        
                        $missingname = "<p><strong>Please enter your name!</strong></p>";
$missingemail = "<p><strong>Please enter your email!</strong></p>";
$invalidemail = "<p><strong>Please enter a valid email address!</strong></p>";
$missingPassword = "<p><strong>Please enter a password!</strong></p>";

 //check for errors
    if(!$name){
        $errors .= $missingname;   
    }else{
         $name = filter_var($name, FILTER_SANITIZE_STRING);  
    }
    if(!$email){
        $errors .= $missingemail;   
    }else{
         $email = filter_var($email, FILTER_SANITIZE_EMAIL); 
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors .= $invalidemail;   
        }
    }
    if(!$password){
        $errors .= $missingPassword;   
    }
    
    if($errors){
        $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
        echo $resultMessage;
    }
    else{
        //no errors, prepare variables for the query
        $tblname = "loginform";
        $firstname = mysqli_real_escape_string($link, $name);
        $email = mysqli_real_escape_string($link, $email);
        $password = mysqli_real_escape_string($link, $password);
        $password = md5($password);
        
        //execute insert query
//        if(!$id){
            $sql = "INSERT INTO loginform (username,email, password) VALUES ('$name', '$email', '$password')";   
//        }else{
//            $sql = "INSERT INTO users (ID,username,email, password) VALUES ('$id', '$name','$email', '$password')";   
//        }
           if(mysqli_query($link, $sql)){
            $resultMessage = '<div class="alert alert-success"> Registered Sucessfully!</div>
            <div class="container"><a href="login.html">Back to Login</a>    </div>';
            
               echo $resultMessage;
//               
        }else{
            $resultMessage = '<div class="alert alert-warning">ERROR: Unable to excecute: ' .$sql. '. ' . mysqli_error($link). '</div>';
            echo $resultMessage;
        }
    }
    
     


                        
                        
                        ?>
