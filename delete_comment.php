    <?php
    
      include'core/init.php';
      $general->logged_out_protect();
      $commentID = $_GET['commentID'];     
      $users->delete_comment($commentID);
      $post_id = $_GET['post_id']; 
      echo "<script> 
      window.location.href = 'http://localhost/CesBuy/view_post.php?post_id=".$post_id."'</script>";
      exit();
    ?>
