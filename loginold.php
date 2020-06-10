<?php
require('header.php');
require('connection.inc.php');


$email=get_safe_value($con,$_POST['email']);
$password=get_safe_value($con,$_POST['password']);

$res=mysqli_query($con,"select * from users where email='$email' and password='$password'");
$check_user=mysqli_num_rows($res);
if($check_user>0){
	$row=mysqli_fetch_assoc($res);
	$_SESSION['ADMIN_LOGIN']='yes';
	$_SESSION['ADMIN_ID']=$row['id'];
	$_SESSION['ADMIN_NAME']=$row['name'];
	echo "valid";
}else{
	echo "Invalid Credentials!!!";
}
?>


<body>
    <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Login</h2>
                    <form method="POST">

                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Email*" name="login_email" id="login_email">
                        </div>
                        <span class="field_error" id="login_email_error"></span><br/><br/>

                        <div class="input-group">
                            <input class="input--style-2" type="password" placeholder="Password*" name="login_password" id="login_password">
                        </div>
                        <span class="field_error" id="login_password_error"></span><br/><br/>
                        
                        <div class="p-t-30">
                            <button class="btn btn--radius btn--green" type="button" onclick="user_login()">Login</button>
                        </div>
                        <br/><br/>
                        <a href="index.php" style="color:#000;">Create account? Register</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php 
require('footer.php');
?>