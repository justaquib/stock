<?php 
require_once 'php_action/db_connect.php';

session_start();

if(isset($_SESSION['userId'])) {
	header('location: http://localhost/stock/dashboard.php');	
}

$errors = array();

if($_POST) {		

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		if($username == "") {
			$errors[] = "Username is required";
		} 

		if($password == "") {
			$errors[] = "Password is required";
		}
	} else {
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			$password = $password;
			// exists
			$mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				$user_id = $value['user_id'];

				// set session
				$_SESSION['userId'] = $user_id;

				header('location: http://localhost/stock/dashboard.php');	
			} else{
				
				$errors[] = "Incorrect username/password combination";
			} // /else
		} else {		
			$errors[] = "Username doesnot exists";		
		} // /else
	} // /else not empty username // password
	
} // /if $_POST
?>

<!DOCTYPE html>
<html>
<head>
    <title>Production Management System</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
    <!-- bootstrap theme-->
    <link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="custom/css/custom.css">

    <!-- jquery -->
    <script src="assests/jquery/jquery.min.js"></script>
    <!-- jquery ui -->
    <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
    <script src="assests/jquery-ui/jquery-ui.min.js"></script>

    <!-- bootstrap js -->
    <script src="assests/bootstrap/js/bootstrap.min.js"></script>
    <style>
body  {
  background-image: url("assests/images/hill.jpg");
  background-size: cover;
}
</style>
</head>
<body>
<div class="container">
        <div class="row vertical">
            <div class="col-md-5 col-md-offset-4">
               <center><a href="index.php" class="site-logo"><img src="assests/images/index.png" width="auto" height="auto" alt=""></a></center>
                 <center>
                <h3>Production Management System</h3>
            </center>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <center><h3 class="panel-title">Please Sign in</h3></center>
                    </div>
                    <div class="panel-body">
                       <div class="messages">
                            <?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
                        </div>
                        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
                            <fieldset>
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-default"> <i class="glyphicon glyphicon-log-in"></i> Sign in</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <!-- panel-body -->
                </div>
                <!-- /panel -->
                <footer>
    <center><div class="copyright">
					<p><font color="white">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Powered <i class="fa fa-bolt"></i> by <a href="http://www.srijontechnologies.com/" target="_blank">Srijon Technologies</a></font>
</p>
				</div></center>
    </footer>
            </div>
            <!-- /col-md-4 -->
        </div>
    
    
        <!-- /row -->
    </div>
    <!-- container -->
    
    
</body>

</html>