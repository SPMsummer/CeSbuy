<?php 
require 'core/init.php';
$general->logged_in_protect();

if (isset($_POST['submit'])) {

		
		$origin 	= htmlentities($_POST['origin']);
		$destination 	= htmlentities($_POST['destination']);
		

		$users->insert($origin, $destination);
		header('Location: index.php');
		exit();
	
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

    <title>Welcome to Cesbuy</title>

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
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
         
          </ul>

              <!--<form class="form-inline pull-right" role="form">
                  <div class="form-group">
                    
                    <input type="search" class="form-control" placeholder="Search for over 10,000 products">
                  </div>
                  
                  <button type="submit" class="btn btn-default">Search</button>
              </form>
              -->
        </div><!-- /.navbar-collapse -->
      

      </div><!-- /.container -->
    </nav>

    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <p class="lead"><img src="img/logo1.png" width="290x" height="80px"></p>
          
        </div>

        <div class="col-md-7 col-md-offset-1">
          <h1>Register</h1>
    
            <?php

              if (isset($_GET['success']) && empty($_GET['success'])) {
                echo 'Thank you for registering. Please check your email.';
              }
            ?>

          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">  
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">Registration</div>
                            <div class="panel-body">
                                 <div class="col-md-7 col-md-offset-1">
                                      <div class="form-group">
                                        
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Username</label>
                                        <input name="origin" type="text" class="form-control" id="exampleInputPassword1" placeholder="Username">
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Username</label>
                                        <input name="destination" type="text" class="form-control" id="exampleInputPassword1" placeholder="Username">
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

          <!-- <div class="row carousel-holder">

            <div class="col-md-12">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img class="slide-image" src="slide0.jpg">
                  </div>
                  <div class="item">
                    <img class="slide-image" src="slide1.jpg">
                  </div>
                  <div class="item">
                    <img class="slide-image" src="slide2.jpg">
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-sm-4 col-lg-4 col-md-4">
              <div class="thumbnail">
                <img src="http://placehold.it/320x150" alt="">
                <div class="caption">
                  <h4 class="pull-right">$24.99</h4>
                  <h4><a href="#">First Product</a></h4>
                  <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                </div>
                <div class="ratings">
                  <p class="pull-right">15 reviews</p>
                  <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-sm-4 col-lg-4 col-md-4">
              <div class="thumbnail">
                <img src="http://placehold.it/320x150" alt="">
                <div class="caption">
                  <h4 class="pull-right">$64.99</h4>
                  <h4><a href="#">Second Product</a></h4>
                  <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="ratings">
                  <p class="pull-right">12 reviews</p>
                  <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-sm-4 col-lg-4 col-md-4">
              <div class="thumbnail">
                <img src="http://placehold.it/320x150" alt="">
                <div class="caption">
                  <h4 class="pull-right">$74.99</h4>
                  <h4><a href="#">Third Product</a></h4>
                  <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="ratings">
                  <p class="pull-right">31 reviews</p>
                  <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-sm-4 col-lg-4 col-md-4">
              <div class="thumbnail">
                <img src="http://placehold.it/320x150" alt="">
                <div class="caption">
                  <h4 class="pull-right">$84.99</h4>
                  <h4><a href="#">Fourth Product</a></h4>
                  <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="ratings">
                  <p class="pull-right">6 reviews</p>
                  <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-sm-4 col-lg-4 col-md-4">
              <div class="thumbnail">
                <img src="http://placehold.it/320x150" alt="">
                <div class="caption">
                  <h4 class="pull-right">$94.99</h4>
                  <h4><a href="#">Fifth Product</a></h4>
                  <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="ratings">
                  <p class="pull-right">18 reviews</p>
                  <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-sm-4 col-lg-4 col-md-4">
              <div class="thumbnail">
                <img src="http://placehold.it/320x150" alt="">
                <div class="caption">
                  <h4 class="pull-right">$94.99</h4>
                  <h4><a href="#">Fifth Product</a></h4>
                  <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="ratings">
                  <p class="pull-right">18 reviews</p>
                  <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                  </p>
                </div>
              </div>
            </div>

          </div> -->

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

























