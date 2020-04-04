
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Event Buzz - Home</title>
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
$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];
if($_POST["submit"])
{
    $to = "psaivarun@gmail.com";
        $subject = "From:Eventbuzz";
        $message = "
        <p>Name: $name.</p>
        <p>Email: $email.</p>
        <p>Message:</p>
        <p><strong>$message</strong></p>"; 
        $headers = "Content-type: text/html";
        if(mail($to, $subject, $message, $headers)){
           $resultMessage = '<div class="alert alert-success">Thanks for your message. We will get back to you as soon as possible!</div>';  
            //header("Location: 20.thanksforyourmessage.php");
            echo $resultMessage;
        }
    else{
            $resultMessage = '<div class="alert alert-warning">Unable to send Email. Please try again later!</div>';
        echo $resultMessage;
        }
    }
?>
