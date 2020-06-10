<?php 
require('header.php');
$name='';
$email='';
$password='';
$msg='';
if(isset($_POST['submit'])){
    $name = get_safe_value($con,$_POST['name']);
    $email = get_safe_value($con,$_POST['email']);
    $password = get_safe_value($con,$_POST['password']);
    $res = mysqli_query($con,"select * from users where email='$email'");
    $check = mysqli_num_rows($res);

    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData = mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            }else{
                $msg = "Email already exist";    
            }

        }else{
            $msg = "email already exist";
        }
    }
    
    if($msg==''){
        
            mysqli_query($con,"insert into users(name,email,password) values('$name','$email','$password')");
        
        header('location:login.php');
        die();
    }
}
    
?>


<body>
    <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registration Info</h2>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Name*" id="name" name="name">
                        </div>
                        <span class="field_error" id="name_error"></span><br/><br/>

                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Email*" id="email" name="email">
                        </div>
                        <span class="field_error" id="email_error"></span><br/><br/>

                        <div class="input-group">
                            <input class="input--style-2" type="password" placeholder="Password*" id="password" name="password">
                        </div>
                        <span class="field_error" id="password_error"></span><br/><br/>
                        
                        <div class="p-t-30">
                            <button class="btn btn--radius btn--green" type="submit" name="submit" >Register</button>
                        </div>
                        <br/><br/>
                        <?php if(isset($_SESSION['ADMIN_LOGIN'])){
                            echo '<a href="logout.php" style="color:#000;">Logout</a>';
											
										}else{
											echo '<a href="login.php" style="color:#000;">Already have an account? Login</a>';
                                            
                                        }
                                        ?>
                        
        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php 
require('footer.php');
?>