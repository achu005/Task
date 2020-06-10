<?php 
require('connection.inc.php');
require('functions.inc.php');


if(isset( $_SESSION['ADMIN_LOGIN']) &&  $_SESSION['ADMIN_LOGIN']!=''){

}   
else{
    header('location:login.php');
      die();
}

if(isset($_GET['type']) &&  $_GET['type']!=''){
   $type = get_safe_value($con,$_GET['type']);
   //update status on click 
   if($type=='status'){
       $operation = get_safe_value($con,$_GET['operation']);
       $id = get_safe_value($con,$_GET['id']);

       if($operation=='active'){
           $status ="1";
       }else{
           $status ="0";
       }
       $update_status_sql ="update categories set status ='$status' where id='$id'";
       mysqli_query($con,$update_status_sql);
   }
   //delete command
   if($type=='delete'){
       $id = get_safe_value($con,$_GET['id']);
       $delete_sql ="delete from categories where id='$id'";
       mysqli_query($con,$delete_sql);
   }

   //edit command
   
}

$sql = "select * from categories order by categories asc";
$res = mysqli_query($con,$sql);



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
                  <a class="navbar-brand" href="home.php"><img src="images/logo.png" alt="Logo"></a>
                  <a class="navbar-brand hidden" href="home.php"><img src="images/logo2.png" alt="Logo"></a>
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
               </div>
            </div>
            <!-- <div class="top-right">
               <div class="header-menu">
                  <div class="user-area dropdown float-right">
                     <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome Admin</a>
                     <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="#"><i class="fa fa-power-off"></i>Logout</a>
                     </div>
                  </div>
               </div>
            </div> -->
         </header>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                        <div>
                              <table class="table ">
                                 <thead>
                                    <tr>                            
                                       <th class="box-title" style="text-align:left">Categories</th>
                                       <!-- <th style="font-size:12px;text-align:right;">Add Category</th> -->
                                       <th class="addbutton" style="text-align:right">
                                            <Button  class="button2" style="border-radius:15px;background-color:#218211;">
                                           <a class="add_link " style=" padding:5px;color:#fff" 
                                             href="manage_categories.php">Add Category</a> </Button>
                                        </th>
                                    </tr>
                                 </thead>
                                
                              </table>
                           </div>
                           <!-- <h3 class="box-title">Categories </h3>
                           <h6 style="font-size:14px;">Add Categories</h6> -->
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Categories</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                     $i=1;//serial number
                                     while($row = mysqli_fetch_assoc($res)){ ?>
                                    <tr>
                                       <td class="serial"><?php echo $i?></td>
                                       <td><?php echo $row['id']?></td>
                                       <td><?php echo $row['categories']?></td>
                                       <td>
                                            <?php
                                                // if($row['status']==1){
                                                //     // echo "Active";
                                                //     echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a> </span> &nbsp;";
                                                // }else{
                                                //     // echo "Deactive";
                                                //     echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a> </span> &nbsp;";
                                                // }
                                                echo "<span class='badge badge-edit' style='background-color:#677DD7;'><a style='color:#fff;' href='manage_categories.php?id=".$row['id']."'>Edit</a></span> &nbsp";
                                                echo "<span class='badge badge-delete' style='background-color:#DF2C2C;'><a style='color:#fff;' href='?type=delete&id=".$row['id']."'>Delete</a></span>";
                                            ?>
                                        </td>
                                    </tr> 
                                     <?php $i=$i+1;
                                    } ?>                                  
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
          </div>
         <footer class="site-footer">
            <div class="footer-inner bg-white">
               <div class="row">
                  <div class="col-sm-6">
                     Copyright &copy; 2020
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