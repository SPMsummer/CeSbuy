    <?php
    
      include'core/init.php';
      $general->logged_out_protect();
       
      $username = $user['username']; // using the $user variable defined in init.php and getting the username.

      $post_data=array();
      $p_data=array();

      $user_id = $users->fetch_info('id', 'username', $username); // Getting the user's id from the username in the Url.
      $profile_data = $users->userdata($user_id);

      $p_data = $users->get_post($user_id);
      
      $post_data = $users->post_data($user_id);

      $post_data = $users->get_post($user_id);
    
      $users->delete_post($_GET['post_id']);

      header('Location: your_posts.php');
      exit();
