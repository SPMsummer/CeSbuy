<?php  
    
     include'core/init.php';
    $general->logged_out_protect();
	$id = $_GET['id'];
	$post_id = $_GET['post_id'];
	$convo_user = $_GET['convo_user'];
	$type = $_GET['type'];
	$notifNo = $_GET['notifNo'];
if($type == "comment"){
	$users->update_notify($id, $post_id, $convo_user, $type, $notifNo);
 echo "<script> 
      window.location.href = 'http://localhost/CesBuy/view_post.php?post_id=".$post_id."'</script>";
      exit();
}
else
{
	$users->update_notify($id, $post_id, $convo_user, $type, $notifNo);
	echo "<script> 
      window.location.href = 'http://localhost/CesBuy/exchange_messages.php?post_id=".$post_id."&id=".$id."'</script>";
      exit();
}
?>