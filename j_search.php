    <?php

    require 'core/init.php';

    $general->logged_out_protect();
     
    $username = $user['username']; // using the $user variable defined in init.php and getting the username.
         

    ?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
	<title>CeSbuy Search</title>
	<link href="css/bootstrap.css" rel="stylesheet">
  <script type='text/javascript' src='js/jquery-1.10.2.js'></script>
  <script type='text/javascript' src='js/jquery.searchable.js'></script>
  <style type="text/css">
    body {
      padding-top: 40px;
      padding-bottom: 40px;
    }
  </style>
  <script type="text/javascript">        
    $(document).ready(function(){
        $( '.table' ).searchable({
            striped: true,
            searchType: 'fuzzy',
            show: function( elem ) {
                elem.slideDown(100);
            },
            hide: function( elem ) {
                elem.slideUp( 100 );
            }
        });
    });
  </script>
	
   </head>

  <body>

    <div class="container">
	<div class="row">
		<h3 class="text-center">CeSbuy Search</h3>
        <div class="col-md-6 col-md-offset-3">
          <input type="search" id="search" value="" class="form-control" placeholder="Search using Fuzzy searching">
          <hr>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              <?php 

                  foreach ($users->get_all_posts() as $product) 
                    {
                      $image = $product['image_location'];
                      $price = $product['price'];
                      $name = $product['name'];
                      $category = $product['category'];
                      $description = $product['description'];
                      echo '<td><a href="view_post.php?post_id='.$product['post_id'].'"><img src='.$image.'></a></td>';

                    }
               ?>
                <!-- <td>Azhagu</td> -->
                <!-- <td>Pandian</td> -->
                <td>@azhagu</td>
              </tr>
              <tr>
                <td>wsnippets</td>
                <td>wsnippets</td>
                <td>@wsnippets</td>
              </tr>
              <tr>
                <td>test</td>
                <td>test</td>
                <td>@test</td>
              </tr>
              <tr>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <td>Mark</td>
                <td>Otto</td>
                <td>@TwBootstrap</td>
              </tr>
              <tr>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>

           
            </tbody>
          </table>
        </div>

        </div>
      </div>
	</div> 
  </body>
</html>
