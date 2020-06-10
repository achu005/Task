<?php 
require('header.php');
require('connection.inc.php');

$msg = '';
if(isset($_POST['submit'])){
   $username = get_safe_value($con,$_POST['username']);
   $password = get_safe_value($con,$_POST['password']);

   $sql = "select * from users where email='$username' and password = '$password' ";
   $res = mysqli_query($con,$sql);
   $count = mysqli_num_rows($res);

   if($count>0){
      $_SESSION['ADMIN_LOGIN'] = 'yes'; //session of admin login started
      $_SESSION['ADMIN_USERNAME'] = $username;//i.e if username is correct then redirect
      header('location:home.php');//redirecting to categories.php page
      die();

   }
   else{

      $msg = "Invalid credentials";
   }

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
                            <input class="input--style-2" type="text" placeholder="Email*" name="username" id="username" required>
                        </div>
                        <span class="field_error" id="login_email_error"></span><br/><br/>

                        <div class="input-group">
                            <input class="input--style-2" type="password" placeholder="Password*" name="password" id="password" required>
                        </div>
                        <span class="field_error" id="login_password_error"></span><br/><br/>
                        
                        <div class="p-t-30">
                            <button class="btn btn--radius btn--green" type="submit" name="submit">Login</button>
                        </div>
                        <div class="field_error"><?php  echo $msg; ?></div>
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