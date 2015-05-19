 <?php
    
    include'core/init.php';

    $general->logged_out_protect();
     
    $username = $user['username']; // using the $user variable defined in init.php and getting the username.

    $c_data=array();
    $commentID = $_GET['commentID'];
    $comment = $_GET['comment'];
  
    $c_data = $users->comment_data($commentID);

    if (isset($_POST['edit'])) {
      $id =$_POST['id'];
      $post_id = $_POST['post_id'];
      $comment = $_POST['comment'];
      $users->update_comment($id, $post_id, $comment, $commentID);

    echo "<script> 
    window.location.href = 'http://localhost/CesBuy/view_post.php?post_id=".$post_id."'</script>";
      exit();
    }
    ?>

<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $c_data['id']; ?>">
    <input type="hidden" name="post_id" value="<?php echo $c_data['post_id'];?>">
    <input type="text" name="comment" value="<?php echo $comment;?>"></text>
    <button type="submit" name="edit">Submit</button>
</form>
