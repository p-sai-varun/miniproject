<?php

$host="localhost";
$user="root";
$pass="";
$db="ytdnzygr_login";
//to prevent mysql injection
//$username=stripslashes($username);
//$password=stripslashes($password);
//$username=mysql_real_escape_string($username);
//$password=mysql_real_escape_string($password);
//connect to server and database
$link=mysqli_connect($host,$user,$pass);
$db1=mysqli_select_db($link,$db); 
if(!$db1) {
		die("Unable to select database");
	}

//query the database for user
/*if(isset($_POST['username'])){
    $uname=$_POST['username'];
    $password=$_POST['password'];
}*/
$uname=$_GET['username'];
$password=$_GET['password'];
$sql="select * from loginform where username='$uname' AND password='$password' ";
$result=mysqli_query($link,$sql)or die("failed to fetch databse".mysqli_error($link));
if(mysqli_num_rows($result)==1){
    echo "login sucessful";
    exit();
}
else{
    echo $uname;
    echo " login failed";
    exit();
}

?>    