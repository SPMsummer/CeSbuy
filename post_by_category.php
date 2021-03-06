    <?php
    
      include'core/init.php';
      
      $general->logged_out_protect();
       
      $username = $user['username']; // using the $user variable defined in init.php and getting the username.

      $post_data=array();

      $user_id = $users->fetch_info('id', 'username', $username); // Getting the user's id from the username in the Url.

      $profile_data = $users->userdata($user_id);
      
      $post_data = $users->post_data($user_id);

      $post_data = $users->get_post($user_id);
      $names = $users->user_convo($p_data['post_id']);
      $size = $users->notif_size($user_id);
      $notifications = $users->get_notif($user_id);
      $allnotif = $users->get_all_notif($user_id);
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

  <link href="css/style_light.css" rel="stylesheet">

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
            <ul class="nav navbar-nav navbar-right">
              <?php include 'includes/menu.php'; ?>

            </ul>
          </div>
          &nbsp; &nbsp; <div class="btn-group">

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
            <div class="row carousel-holder">

              <div class="col-md-12">

              </div>

            </div> 
          </div>
          <div class="row">

            <?php 
              // stores the results to $posts by the use of method "post_by_category()"
              $posts = $users->post_by_category($_GET["category"]);
            ?>

            <?php 
            // loops the $posts variable then display it below
            foreach ($posts as $product) {
            
            $image = $product['image_location'];
            $price = $product['price'];
            $name = $product['name'];
            $category = $product['category'];
            $description = $product['description'];
          ?>

            <div class="col-sm-4 col-lg-4 col-md-4">
              <div class="thumbnail">
               <!--display results--> 
               <?php echo '<a href="view_post.php?post_id='.$product['post_id'].'"><img src='.$image.' width="400px" height="400px" >'; ?>
                <div class="caption">
                  <h4 class="pull-right">P<?php echo $price;?></h4>
                  <h4><a href="#"><?php echo $name;?></a></h4>
                  <p><?php echo $description; ?><br /><h4><?php echo $category;?></h4></a></p>
                </div>
                <div class="ratings">
                  <p class="pull-right">0 reviews</p>
                  <p>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                  </p>
                </div>
              </div>
            </div>
            <?php 
          }
          ?>


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