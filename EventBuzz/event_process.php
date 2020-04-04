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
                        $mobile = $_GET['mobile'];
                        $college=$_GET['college'];
                        $department=$_GET['department'];
                        $rollno=$_GET['rollno'];
                        
                        $missingname = "<p><strong>Please enter your name!</strong></p>";
$missingemail = "<p><strong>Please enter your email!</strong></p>";
$invalidemail = "<p><strong>Please enter a valid email address!</strong></p>";
$missingmobile = "<p><strong>Please enter mobile no!</strong></p>";
$missingrollno="<p><strong>Please enter roll no</strong></p>";

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

    
    if($errors){
        $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
        echo $resultMessage;
    }
    else{
        //no errors, prepare variables for the query
        $tblname = "loginform";
        $firstname = mysqli_real_escape_string($link, $name);
        $email = mysqli_real_escape_string($link, $email);
//        $password = mysqli_real_escape_string($link, $password);
//        $password = md5($password);
//        
        //execute insert query
//        if(!$id){
            $sql = "INSERT INTO register (username,rollno,dept,college,email,mobile) VALUES ('$name','$rollno','$department','$college','$email', '$mobile')";   
//        }else{
//            $sql = "INSERT INTO users (ID,username,email, password) VALUES ('$id', '$name','$email', '$password')";   
//        }
           if(mysqli_query($link, $sql)){
            $resultMessage = '<div class="alert alert-success">Registered sucessfully please make the payment</div>
            <div class="col-md-12" style="display:flex; justify-content: center;align-items: center; padding-top:5px">
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="JFCAJ9D5TLAY2">
<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_paynowCC_LG.gif"  border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="" height="1">
</form></div>';
               
            echo $resultMessage;
        $sq="select * from mail where college='$college' and dept='$department'";
               $faculty=mysqli_query($link,$sq);
               //echo $faculty;
        $row=mysqli_fetch_array($faculty,MYSQLI_ASSOC);
            $to=$row["email"];
        $subject = "EVENTBUZZ";
        $message = "
        <p>Name: $name.</p>
        <p>Email: $email.</p>
        <p>Mobile:$mobile.</p>
        <p>Rollno:$rollno.</p>
        <p>Department:$department</p>
        <p>Message:</p>
        <p><strong>Please grant him attendance as he has attended event hosted in EVENTBUZZ</strong></p>"; 
        $headers = "Content-type: text/html";
                               if(mail($to, $subject, $message, $headers)){
           $result = '<div class="alert alert-success">Thanks for your message. We will get back to you as soon as possible!</div>';
    
        }
    else{
            $result = '<div class="alert alert-warning">Unable to send Email. Please try again later!</div>';  
        }

        echo $result;
               
        }else{
            $resultMessage = '<div class="alert alert-warning">ERROR: Unable to excecute: ' .$sql. '. ' . mysqli_error($link). '</div>';
            echo $resultMessage;
        }
    }
    
     


                        
                        
                        ?>
