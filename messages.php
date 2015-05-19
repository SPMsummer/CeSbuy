    <?php
    
    include'core/init.php';

    $general->logged_out_protect();
     
    $username = $user['username']; // using the $user variable defined in init.php and getting the username.
    $p_data=array();

    $user_id = $users->fetch_info('id', 'username', $username); // Getting the user's id from the username in the Url.
    
    $post_id = $_GET['post_id'];

    $p_data = $users->post_data($post_id);

    $comment_size = $users->notif_size($user_id, "comment");
    $msg_size = $users->notif_size($user_id, "messages");
    $notifications = $users->get_notif($user_id, "comment");
    $messages = $users->get_notif($user_id, "messages");
    $post_maker = $users->fetch_info_post('id', 'post_id', $post_id);
    $allmsg = $users->get_all_msg($user_id);
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
     
        
    

        </div>

        <div class="col-md-9">

          <div class="col-md-15 col-md-offset-1">

          <ul class="nav nav-tabs">
             <form class="form-inline pull-left" role="form" method="post">
              
               <h1>MESSAGES</h1>
           
            </button>


              </form>
          </ul> 
          <div class="panel-body">
         <div class="row carousel-holder">
             <?php
                foreach ($allmsg as $all) {
                          $user_name = $users->fetch_info('username', 'id', $all['id']);
                          echo "<a href='update_notif.php?id=".$all['id']."&post_id=".$all['post_id']."&convo_user=".$all['convo_user']."&type=".$all['type']."&notifNo=".$all['notifNo']."' class='list-group-item'><b>".$user_name.'<br/>';
                          echo "</a>";
                         }
             ?>

            </div>

          </div> 
        </div>
        <div class="row">

          
   

          </div>
        </div>
      </div>
      </div>

        </div>

      </div>
        <!-- Button trigger modal -->


    </div><!-- /.container -->
    
    <div class="container">

      

      <footer>
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright @ CesBuy 2014</p>
            </div>
        </div>
      </footer>


    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

  </body>
</html>