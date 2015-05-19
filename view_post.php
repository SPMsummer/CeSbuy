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
    // ?>


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

    <script src="js/jquery.min.js"></script>
    <script type="text/javascript"></script>

     <link rel="stylesheet" type="text/css" href="star.css">
      <script type="text/javascript" src="bituin.js"></script>
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
                
                  <li class="divider"></li>
                  <li><a href="logout.php">Log out</a></li>
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
            <p>Categories</p>
            <!-- Put some categories -->
            <a href="post_by_category.php?category=Clothings" class="list-group-item">Clothings</a>
            <a href="post_by_category.php?category=Phones" class="list-group-item">Phones</a>
            <a href="post_by_category.php?category=Gadgets" class="list-group-item">Gadgets</a>
            <a href="post_by_category.php?category=Electronics" class="list-group-item">Electronics</a>
            <a href="post_by_category.php?category=Furnitures" class="list-group-item">Furnitures</a>
            <a href="post_by_category.php?category=Others" class="list-group-item">Others</a>
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
            
          <?php
          if (isset($_POST['message'])) 
                {
                  $description = htmlentities(trim($_POST['description']));
                  $users->add_message($user_id,$p_data['post_id'],$post_maker,$description);
                  header('Location: view_post.php?post_id='.$post_id);
                  $users->add_notif($user_id, $post_id, $post_maker ,"messages");

                  exit();
               
                }
                ?>
          
           <div class="panel-body">

            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-8"><!-- dri ibutang ang code sa setting plss h1 ang code lang. -->


                <?php

                if(isset($_POST['delete']))
                {
                  $users->delete_post($p_data['post_id']);
                  header('Location: view_post.php?success');
                  exit();
                }

                if (isset($_POST['comment'])) 
                {
                  // echo '<h3>You added a comment to this post.</h3>'; 
                  $description = htmlentities(trim($_POST['description']));

                  $filter->strings = array('damn','atay','pisti', 'bullshit', 'fuck','shit');

                  $filter->text = $_POST['description'];

                  $filter->keep_first_last = false;

                  $filter->replace_matches_inside_words = false;

                  $description = $filter->filter();

                  $users->add_comment($user_id,$p_data['post_id'],$description);

                  foreach ($names as $a) 
                  {
                    if($user_id != $a['id'])
                    {
                      
                        $users->add_notif($user_id, $post_id, $a['id'] ,"comment");
                    }
                   

                  } 
                  if($user_id != $post_maker)
                    { 
                       $users->add_notif($user_id, $post_id, $post_maker ,"comment");
                    }

                  header('Location: view_post.php?post_id='.$post_id);
                  exit();

                }

                ?>
                
                
                <?php 


                if (isset($_GET['success']) && empty($_GET['success'])) {
                  echo '<h3>Your product has been deleted!  </h3>';    
                }

                else
                {
                  echo '<form method="POST" action="">';
                  echo '<a href="your_posts.php?username='.$user['username'].'"></a>';
                  $image = $p_data['image_location'];
                  echo "<img src='$image'>".'<br />';
                  echo 'Name: '.$p_data['name'].'<br />';
                  echo 'Price: '.$p_data['price'].'<br />';
                  echo 'Category: '.$p_data['category'].'<br />';
                  echo 'Description: '.$p_data['description'].'<br />';
                  echo '<form/>';

                 echo '<br>Rate Item: ';

                  $article = null;

                  if(isset($post_id)) {
                    $id = (int)$post_id;



                    $article = $db->query("SELECT * FROM posts WHERE post_id = $id")->fetch(PDO::FETCH_ASSOC);
                    $pID = $article['id'];

                    $article2 = $db->query("SELECT ratings FROM `article_rating` WHERE article = $id AND id = $sessID")->fetch(PDO::FETCH_ASSOC);
                    $ratings = $article2['ratings'];
                    $check = $db->query("SELECT id FROM `article_rating` WHERE article = $id AND id = $sessID ")->fetch(PDO::FETCH_ASSOC);

                    if($article){

                    //   echo '<br><div id="r1" class="rate_widget">';
                    //   foreach(range(1,5) as $rating){         
                    //   echo '<a href="rate.php?article='. $article['post_id'] . ' &rating= ' . $rating . '"><div class="star_1 ratings_stars"></div></a>';
                    // }
                    // echo '</div><br>';
                      
                      
                      
                      echo '<div class="starRate">';
                      echo '<div><b></b></div>';
                      echo '<ul>';


                      foreach(range(5,1) as $rating){

                        if($ratings == $rating){
                          echo '<li><a href="rate.php?article='. $article['post_id'] . ' &rating= ' . $rating . '"><span>Give it '.$rating.' stars</span><b></b></a></li>';    
                    
                        }
                        else{
                          echo '<li><a href="rate.php?article='. $article['post_id'] . ' &rating= ' . $rating . '"><span>Give it '.$rating.' stars</span></a></li>';    
                        }
                    }

                      echo '</ul>';
                      echo '</div>';
                      

                      if($check){
                        echo '<p class="pull-relative">You rated this with <b>'.round($article2['ratings'],2).'</b> points.</p>';
                        echo '</p>  
                        </div>
                        '; 
                      }else{

                        echo '</br>You have not rated this item yet';
                        echo '</p>  
                        </div>
                        '; 

                      }


                    }

                    echo '
                    </div>  
                    </div>  
                    ';



                  }


                  ?> 
                  <hr />

                  <h4>Comments</h4>
                 <?php 

                    if(empty($comments))
                    {
                      echo 'There are no comments in this post...';
                    }

                    else
                    {
                      foreach ($comments as $c) {
                      $user_name = $users->fetch_info('username', 'id', $c['id']);
                      echo "<b>".$user_name.' </b>said at '.date('m/d/Y H:i A', strtotime($c['time_added'])).'<br />&nbsp;';
                      echo $c['comment'];  
                      
                     if($user_id == $c['id'])
                          include "includes/comment_button.php";
                      
                     
                      echo "<br/>"; }
                    } ?>

                  <br />
                  <br />
                  <!-- <p><strong><?php echo $row['username']; ?></strong> said at <?php echo date('m/d/Y H:i A', strtotime($row['date_added'])) ?><br /></p> -->

                  <form action="" method="post" id="form" enctype="multipart/form-data">

                    <div class="form-group">
                      <div class="controls">
                       <label for="exampleInputPassword1">Add Comment</label>
                     </div>
                     <textarea class="form-control"  name="description" placeholder="Please use the English language."></textarea>
                     <!-- <input name="description" type="text" class="form-control" id="exampleInputPassword1" placeholder="Description"> -->
                   </div>
                   <button type="submit" name = "comment" id="submit" class="btn btn-primary" >Add Comment</button>
                   <button type="reset" name = "cancel" class="btn btn-default">Cancel</button>
                 </form>

                 <?php } ?>
                  <?php
                if($user_id == $post_maker){

                }else{
           ?>     
          <div class = "panel-body">
          <form action="" method="post" id="form" enctype="multipart/form-data">
          
                      <div class="form-group">
                        <div class="controls">
                         </div>
                        <textarea class="form-control"  name="description" placeholder="Please use the English language."></textarea>
                        <!-- <input name="description" type="text" class="form-control" id="exampleInputPassword1" placeholder="Description"> -->
                      </div>
                      <button type="submit" name = "message" id="submit" class="btn btn-primary" onclick="alert('Message Sent')"> Send seller a message</button>
                      <button type="reset" name = "cancel" class="btn btn-default">Cancel</button>
                </form>
              </div><?php } ?>
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
                <h4 class="modal-title" id="myModalLabel">Step 1 of 2: Fill Up the Insert Ad Form</h4>
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
