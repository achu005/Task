<?php
require('connection.inc.php');
require('functions.inc.php');

$name=get_safe_value($con,$_POST['name']);
$email=get_safe_value($con,$_POST['email']);
$password=get_safe_value($con,$_POST['password']);

$check_user=mysqli_num_rows(mysqli_query($con,"select * from users where email='$email'"));
if($check_user>0){
	echo "Email already in use!!!";
}else{
	mysqli_query($con,"insert into users(name,email,password) values('$name','$email','$password')");
    echo "success";
    
}
?>