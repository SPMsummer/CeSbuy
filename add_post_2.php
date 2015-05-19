    <?php
       include'core/init.php';

    $general->logged_out_protect();
     
    $username = $user['username']; // using the $user variable defined in init.php and getting the username.
    
    $p_data=array();

    $user_id = $users->fetch_info('id', 'username', $username); // Getting the user's id from the username in the Url.
    
    $post_id = $_GET['post_id'];
    
    $profile_data = $users->userdata($user_id);

    $p_data = $users->post_data($post_id);

    $comments = $users->get_comments($p_data['post_id']);

    $sessID = $_SESSION['id'];
     //notif
    $names = $users->user_convo($p_data['post_id']);
    $comment_size = $users->notif_size($user_id, "comment");
    $msg_size = $users->notif_size($user_id, "messages");
    $notifications = $users->get_notif($user_id, "comment");
    $messages = $users->get_notif($user_id, "messages");
    $post_maker = $users->fetch_info_post('id', 'post_id', $post_id); 
     
    ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome to Cesbuy </title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/shop-homepage.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        
          <!--<h1>Hello <?php echo $username, '!'; ?></h1>-->
          
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

        <a href="#" class="navbar-brand">Hello <?php echo $username, '!'; ?></a>

        </div>
        
         

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
                    
        

          <form class="form-inline pull-right" role="form">
                <div class="form-group">
                  <ul class="nav navbar-nav">
                    <?php include 'includes/menu.php'; ?>

                  </ul>
                </div>
                <div class="btn-group">
                
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                   <span class="glyphicon glyphicon-cog"></span><span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="profile.php?username=<?php echo $user['username'];?>">Profile</a></li>
                  <li><a href="settings.php">Account Setting</a></li>
                  <li><a href="#">Privacy Setting</a></li>
                  <li class="divider"></li>
                  <li><a href="logout.php">Log-out</a></li>
                </ul>
              </div>
              </form>

        </div><!-- /.navbar-collapse -->
      

      </div><!-- /.container -->
    </nav>

    <div class="container">

      <div class="row">

        <div class="col-md-3">
          <p class="lead"><img src="img/logo1.png" width="290x" height="80px"></p>
       
      
          <div class="list-group">
            <?php include 'includes/category.php'; ?>
          </div>
          <p>
            <button class="btn btn-warning" data-toggle="modal" data-target="#" onclick="window.location.href='/cesbuy_rosie/add_post_2.php'">
              <u>Post a Free Ad</u><br>
            Sell your products for cash!
            </button>
  
      </p>
    

        </div>

             <div class="col-md-9">

            <div class="col-md-15 col-md-offset-1">

              <ul class="nav nav-tabs">
                <button class="btn btn-warning " data-toggle="modal" data-target="#" onclick="window.location.href='/CeSbuy/add_post_2.php'">
                  <span class="glyphicon glyphicon-hand-up"></span> Sell your products!
                </button>

               <form class="form-inline pull-right" role="form" method="post"  action="search.php">
                <div class="form-group">               
                  <input type="search" class="form-control" placeholder="Search for over 10,000 products" name="search_product">
                </div>  
                <button type="submit" class="btn btn-default" name = "search" >Search Products</button>
              </form>

              <form class="form-inline pull-right" role="form" method="post"  action="search_by_category.php">
                <div class="form-group">               
                  <input type="search" class="form-control" placeholder="Search for over 10,000 products" name="search_product">
                </div>  
                 <select name="category">
                    <option name="clothings">Clothings</option>
                    <option name="phones">Phones</option>
                    <option name="gadgets">Gadgets</option>
                    <option name="electronics">Electronics</option>
                    <option name="furnitures">Furnitures</option>
                    <option name="others">Others</option>
                  </select>
                <button type="submit" class="btn btn-default" name = "search" >Search By Category</button>
                </div> 
              </form>
            </ul> 
            
          <div class="panel-body">
            
            <div class="row">
                   <?php
                if (isset($_GET['success']) && empty($_GET['success'])) {
                echo '<h3>Your product has been posted!</h3>';    
                } else{
             
                if(empty($_POST) === false) {   
                if (isset($_POST['first_name']) && !empty ($_POST['first_name'])){ // We only allow names with alphabets
                if (ctype_alpha($_POST['first_name']) === false) {
                $errors[] = 'Please enter your First Name with only letters!';
                }   
                }
                if (isset($_POST['last_name']) && !empty ($_POST['last_name'])){
                if (ctype_alpha($_POST['last_name']) === false) {
                $errors[] = 'Please enter your Last Name with only letters!';
                }   
                }
                if (isset($_POST['gender']) && !empty($_POST['gender'])) {
                $allowed_gender = array('undisclosed', 'Male', 'Female');// specifying the allowed genders.
                 
                if (in_array($_POST['gender'], $allowed_gender) === false) {
                $errors[] = 'Please choose a Gender from the list'; 
                }
                 
                }
                 
                if (isset($_FILES['myfile']) && !empty($_FILES['myfile']['name'])) {// check if the user has uploaded a new file
                $name = $_FILES['myfile']['name']; // getting the name of the file
                $tmp_name = $_FILES['myfile']['tmp_name']; // getting the temporary file name.
                $allowed_ext = array('jpg', 'jpeg', 'png', 'gif' );// specifying the allowed extentions
                $a = explode('.', $name);
                $file_ext = strtolower(end($a)); unset($a);// getting the allowed extenstions
                $file_size = $_FILES['myfile']['size'];
                $path = "uploads";// the folder in which we store the profile pictures or avatars of the user.
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
                $newpath = 'uploads/default_product.png';
                }
                $name = htmlentities(trim($_POST['name']));
                $category = htmlentities(trim($_POST['category']));
                $price = htmlentities(trim($_POST['price']));
                $description = htmlentities(trim($_POST['description']));
                
                $image_location = htmlentities(trim($newpath));
                $users->post_product($image_location, $name, $category, $price, $description, $user_id);
                //$users->update_user($first_name, $last_name, $gender, $bio, $image_location, $user_id);
                header('Location: add_post_2.php?success');
                exit();
                } else if (empty($errors) === false) {
                echo '<p>' . implode('</p><p>', $errors) . '</p>';  
                }   
                }
                ?>
                <h2>Post Ad</h2> <p><b>Note: Information you post here is made viewable to others.</b></p>
                <hr />
                 
                <form action="" method="post" enctype="multipart/form-data">
                               <div class="form-group">
                                        <?php
                                          if(!empty ($user['image_location'])) {
                                            $image = $user['image_location'];
                                            // echo "<img src='$image' width='400' >";
                                          }
                                        ?>
                                        <div class="form-group">
                                        <h4 class="modal-title" id="myModalLabel">Step 1 of 2: Fill Up the Insert Ad Form</h4>
                                      </div>
                                        <div class="form-group">
                                       <div class="control-group">
                                            <div class="controls">
                                              <input type="file" name="myfile" />
                                            </div>
                                       </div>
                                     </div>
                                        
                                        </li>
                                        <?php if($image != 'uploads/default_product.jpg'){ ?>
                                        <?php } ?>
                                          
                                           <div class="form-group">
                                              <div class="control-group">
                                                  <div class="controls">
                                                     <label for="exampleInputPassword1">Product Name</label>
                                                         <input name="name" type="text" class="form-control" id="exampleInputPassword1" placeholder="Product Name">
                                                  </div>
                                             </div>
                                           </div>
                                             
                                     
                                        <div class="form-group">         
                                        <div class="control-group">
                                            <div class="controls">
                                               <label for="exampleInputPassword1">Category</label>
                                             </div>
                                              <div class="controls">
                                                <select name="category">
                                                  <option name="clothings">Clothings</option>
                                                  <option name="phones">Phones</option>
                                                  <option name="gadgets">Gadgets</option>
                                                  <option name="electronics">Electronics</option>
                                                  <option name="furnitures">Furnitures</option>
                                                  <option name="others">Others</option>
                                                </select>
                                               </div>
                                       </div> 
                                     </div>

                                      <div class="form-group"> 
                                       <div class="control-group">
                                            <div class="controls">
                                               <label for="exampleInputPassword1">Price</label>
                                            </div>
                                            <div class="controls">
                                               <input name="price" type="text" class="form-control" id="exampleInputPassword1" placeholder="Price">
                                            </div>
                                          </div>
                                        </div>
          
                                      <div class="form-group">
                                        <div class="controls">
                                               <label for="exampleInputPassword1">Description</label>
                                            </div>
                                        <textarea class="form-control"  name="description" placeholder="Please use the English language."></textarea>
                                        <!-- <input name="description" type="text" class="form-control" id="exampleInputPassword1" placeholder="Description"> -->
                                      </div>
                                      <button type="submit" name = "submit" class="btn btn-primary">Submit</button>
                                      <button type="reset" name = "cancel" class="btn btn-default">Cancel</button>
                </form>
                 </div>
                </div>
               

              </div>
        </div>
        
        </div>
      </div>
      </div>

        </div>

      </div>
        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
              <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">Add Details</h3>
                    </div>
                    <div class="panel-body">
                     <form class="form-horizontal" role="form">
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail3" placeholder="Category">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Region</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail3" placeholder="Region">
                        </div>
                      </div>
                  
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Province</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail3" placeholder="Province">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">City</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail3" placeholder="City">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Ad title</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail3" placeholder="Ad title">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Add Description</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" rows="3"></textarea>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail3" placeholder="Price">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail3" placeholder="Image">
                        </div>
                      </div>
                      
                      </forn>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div><!-- /.container -->
    
    <div class="container">

      <hr>

      <footer>
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright @ CesBuy 2014</p>
            </div>
        </div>
      </footer>

    </div><!-- /.container -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

  </body>
</html>
<?php
    }
 ?>  