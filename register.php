<?php 
require 'core/init.php';
$general->logged_in_protect();

if (isset($_POST['submit'])) {

	if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['firstname']) || empty($_POST['middlename']) || empty($_POST['lastname'])){

		$errors[] = '<div class="alert alert-danger">
                    <a href="#" class="alert-link">All fields are required.</a>
                 </div>';

	}else{
        
        if ($users->user_exists($_POST['username']) === true) {
            $errors[] = '<div class="alert alert-danger">
                    <a href="#" class="alert-link">That username already exists</a>
                 </div>';
        }
        if(!ctype_alnum($_POST['username'])){
            $errors[] = '<div class="alert alert-danger">
                    <a href="#" class="alert-link">Please enter a username with only alphabets and numbers</a>
                 </div>';	
        }
        if (strlen($_POST['password']) <6){
            $errors[] = '<div class="alert alert-danger">
                    <a href="#" class="alert-link">Your password must be atleast 6 characters</a>
                 </div>';
        } else if (strlen($_POST['password']) >18){
            $errors[] = '<div class="alert alert-danger">
                    <a href="#" class="alert-link">Your password cannot be more than 18 characters long</a>
                 </div>';
        }
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'Please enter a valid email address';
        }else if ($users->email_exists($_POST['email']) === true) {
            $errors[] = '<div class="alert alert-danger">
                    <a href="#" class="alert-link">That email already exists.</a>
                 </div>';
        }
	}

	if(empty($errors) === true){
		
		$username 	= htmlentities($_POST['username']);
		$firstname 	= htmlentities($_POST['firstname']);
		$middlename 	= htmlentities($_POST['middlename']);
		$lastname 	= htmlentities($_POST['lastname']);
		$password 	= $_POST['password'];
		$email 		= htmlentities($_POST['email']);

		$users->register($username, $password, $email, $firstname, $middlename, $lastname);
		header('Location: register.php?success');
		exit();
	}
}

?>
<!DOCTYPE html>

<?php

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registration :: Cesbuy</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/shop-homepage.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#home">Start Shopping!</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
         
          </ul>

        </div><!-- /.navbar-collapse -->
      

      </div><!-- /.container -->
    </nav>

    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <p class="lead"><img src="img/logo1.png" width="290x" height="80px"></p>
          
        </div>

        <div class="col-md-7 col-md-offset-1">
          
            <?php

              if (isset($_GET['success']) && empty($_GET['success'])) {
                echo '<div class="alert alert-success">
                    <a href="#" class="alert-link">Thank you for registering.</a>
                 </div';
              }
            ?>
       

          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">  
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading"<h1>Registration</h1></div>
                            <div class="panel-body">
                                 <div class="col-md-7 col-md-offset-1">
                                      <div class="form-group">

                                        <label for="exampleInputEmail1">Email address</label>
                                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                      </div>
                                      <div class="form-group">

                                        <label for="exampleInputPassword1">Username</label>
                                        <input name="username" type="text" class="form-control" id="exampleInputPassword1" placeholder="Username">
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Complete Name</label>
                                        <label class="sr-only" for="exampleInputPassword1">First Name</label>
                                        <input name="firstname" type="text" class="form-control" id="exampleInputPassword1" placeholder="First Name">
                                      </div>
                                      <div class="form-group">
                                        <label class="sr-only" for="exampleInputPassword1">Middle Name</label>
                                        <input name="middlename" type="text" class="form-control" id="exampleInputPassword1" placeholder="Middle Name">
                                      </div>
                                      <div class="form-group">
                                        <label class="sr-only" for="exampleInputPassword1">Last Name</label>
                                        <input name="lastname" type="text" class="form-control" id="exampleInputPassword1" placeholder="Last Name">
                                      </div>
                                  
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                      </div>

                                       <div class="form-group">
                                       
                                     </div>
                                         <button type="submit" class="btn btn-default" name="submit">Submit</button>
                                      </form>

            <?php 
            
              if(empty($errors) === false){
                echo '<p>' . implode('</p><p>', $errors) . '</p>';  
              }

            ?>
                                </div>
                            </div>
                    </div>
                </div>     
        </div>

        </div>

      </div>

    </div><!-- /.container -->
    
    <div class="container">

      <hr>

      <footer>
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright &copy; Cesbuy 2013 -  </p>
          </div>
        </div>
      </footer>

    </div><!-- /.container -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

  </body>
</html>

























