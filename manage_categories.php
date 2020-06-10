<?php 
require('connection.inc.php');
require('functions.inc.php');
$categories='';
$msg='';

if(isset($_GET['id']) && $_GET['id']!=''){
    $id = get_safe_value($con,$_GET['id']);
    $res = mysqli_query($con,"select * from categories where id='$id'");
    $check = mysqli_num_rows($res);

    if($check>0){    
        $row=mysqli_fetch_assoc($res); 
        $categories = $row['categories']; 
    } 
    else{
        header('location:home.php');
        die();        
    }
}


if(isset($_POST['submit'])){
    $categories = get_safe_value($con,$_POST['categories']);
    $res = mysqli_query($con,"select * from categories where categories='$categories'");
    $check = mysqli_num_rows($res);

    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData = mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            }else{
                $msg = "Category already exist";    
            }

        }else{
            $msg = "Category already exist";
        }
    }
    
    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){

            mysqli_query($con,"update categories set categories = '$categories' where  id='$id'");

        }else
        {
            mysqli_query($con,"insert into categories(categories,status) values('$categories','1')");
        }
        header('location:home.php');
        die();
    }
}
?>

<!Doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Dashboard Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body>
      <aside id="left-panel" class="left-panel">
         <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  <li class="menu-title">Menu</li>
                  <li class="menu-item-has-children dropdown">
                     <a href="home.php" > Categories</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="logout.php" > Logout</a>
                  </li>
               </ul>
            </div>
         </nav>
      </aside>
      <div id="right-panel" class="right-panel">
         <header id="header" class="header">
            <div class="top-left">
               <div class="navbar-header">
                  <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="Logo"></a>
                  <a class="navbar-brand hidden" href="index.html"><img src="images/logo2.png" alt="Logo"></a>
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
               </div>
            </div>
            <div class="top-right">
               <div class="header-menu">
                  <div class="user-area dropdown float-right">
                     <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome Admin</a>
                     <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="#"><i class="fa fa-power-off"></i>Logout</a>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Add Category</strong></div>
                        <form method="post">
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label for="categories" class=" form-control-label">Category Name</label>
                                    <input type="text" name="categories" placeholder="Enter category name" class="form-control" value ="<?php echo $categories ?>" required>
                                </div>
                                <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount" >Submit</span>
                                </button>
                                <div class="field_error"><?php  echo $msg; ?></div>
                            </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <footer class="site-footer">
            <div class="footer-inner bg-white">
               <div class="row">
                  <div class="col-sm-6">
                     Copyright &copy; 2018 Ela Admin
                  </div>
                  <div class="col-sm-6 text-right">
                     Designed by <a href="https://colorlib.com/">Colorlib</a>
                  </div>
               </div>
            </div>
         </footer>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>