<?php 

  require 'core/init.php';
  //$general->logged_in_protect();

  if (isset($_POST['submit'])) {

  	if(empty($_POST['name']) || empty($_POST['category']) || empty($_POST['price']) || empty($_POST['description'])){

  		$errors[] = '<div class="alert alert-danger">
                      <a href="#" class="alert-link">All fields are required!</a>
                   </div>';

  	}

  	if(empty($errors) === true){
      $image_location = htmlentities(trim($newpath));
  		$name 	= htmlentities($_POST['name']);
  		$category 	= htmlentities($_POST['category']);
  		$price 	= htmlentities($_POST['price']);
      $description  = htmlentities($_POST['description']);
  		
      $users->post_product($image_location, $name, $category, $price, $description);
  		header('Location: add_post.php?success');
  		exit();
  	}
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Post :: Cesbuy</title>

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

              /*if (isset($_GET['success']) && empty($_GET['success'])) {
                echo '<div class="alert alert-success">
                    <a href="#" class="alert-link">Thank you for posting!</a>
                 </div';
              }*/
            ?>
       

          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">  
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading"<h1>Registration</h1></div>
                            <div class="panel-body">
                                 <div class="col-md-7 col-md-offset-1">
                                      <div class="form-group">
                                      <?php 

                                        if (isset($_FILES['myfile']) && !empty($_FILES['myfile']['name'])) {// check if the user has uploaded a new file
                                        $name = $_FILES['myfile']['name']; // getting the name of the file
                                        $tmp_name = $_FILES['myfile']['tmp_name']; // getting the temporary file name.
                                        $allowed_ext = array('jpg', 'jpeg', 'png');// specifying the allowed extentions
                                        $a = explode('.', $name);
                                        $file_ext = strtolower(end($a)); unset($a);// getting the allowed extenstions
                                        $file_size = $_FILES['myfile']['size'];
                                        $path = "uploads";// the folder in which we store the product pictures or products of the user.
                                        if (in_array($file_ext, $allowed_ext) === false) {
                                        $errors[] = 'Image file type not allowed';  
                                        }
                                        if ($file_size > 2097152) {
                                        $errors[] = 'File size must be under 2mb';
                                        }
                                        } else {
                                        $newpath = $user['image_location']; // if user did not upload a file, then use the one stored in the database
                                        }

                                        if(empty($errors) === true) {
                                        if (isset($_FILES['myfile']) && !empty($_FILES['myfile']['name']) && $_POST['use_default'] != 'on') {
                                        $newpath = $general->file_newpath($path, $name);
                                         
                                        move_uploaded_file($tmp_name, $newpath);
                                         
                                        }else if(isset($_POST['use_default']) && $_POST['use_default'] === 'on'){
                                        $newpath = 'uploads/default_product.jpg';
                                        }
                                        }
                                       ?>
                                      <div class="form-group">
                                        <?php
                                          if(!empty ($user['image_location'])) {
                                            $image = $user['image_location'];
                                            echo "<img src='$image'>";
                                          }
                                        ?>
                                        <li>
                                        <input type="file" name="myfile" />
                                        </li>
                                        <?php if($image != 'uploads/default_product.jpg'){ ?>
                                        <?php } ?>
                                        <li>    

                                        <label for="exampleInputPassword1">Product Name</label>
                                        <input name="name" type="text" class="form-control" id="exampleInputPassword1" placeholder="Product Name">
                                      </div>

                                      <div class="form-group">
                                        <label class="sr-only" for="exampleInputPassword1">Category</label>
                                        <!-- dropdown ni diri -->
                                        <?php
                                          $category = $user['category'];
                                          $options = array("Category1", "Category2", "Category3");

                                          echo '<select name="category">';

                                          foreach($options as $option)
                                          {
                                            if($category == $option)
                                            {
                                              $sel = 'selected="selected"';
                                            }

                                            else
                                            {
                                              $sel='';
                                            }

                                          echo '<option '. $sel .'>' . $option . '</option>';
                                          }
                                        ?>
                                        </select>

                                      </div>

                                      <div class="form-group">
                                        <!-- <label for="exampleInputPassword1">Category</label> -->
                                        <label class="sr-only" for="exampleInputPassword1">Price</label>
                                        <!-- dropdown ni diri -->
                                        <input name="price" type="text" class="form-control" id="exampleInputPassword1" placeholder="Price">
                                      </div>

                                      <div class="form-group">
                                        <label class="sr-only" for="exampleInputPassword1">Description</label>
                                        <textarea name="description" placeholder="Please use English. Tan-awa ang d2l para kibaw ka unsay ibutang diri"></textarea>
                                        <!-- <input name="description" type="text" class="form-control" id="exampleInputPassword1" placeholder="Description"> -->
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
