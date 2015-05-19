<li><a href="index.php">Home</a></li>
<?php
                             
if($general->logged_in()){?>
<!-- <li><a href="j_search.php">Search</a></li>        -->
<li><a href="your_posts.php?username=<?php echo $user['username'];?>">Your Posts</a></li>

 <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"></i> <img src = ./img/msg.png title='View Messages' width=20 height=20/>
                <?php if($msg_size == 0)
                {
                }
                else
                {
                    include "includes/msg_notif.php";
                }

               ?>
                   
                    <ul class="dropdown-menu">
                        
                    <?php 

                        if(empty($messages))
                        {
                          echo '<li><a href="#">You dont have new messages!</a></li>';
                        }

                        else
                        {
                         foreach ($messages as $m) {
                          $user_name = $users->fetch_info('username', 'id', $m['id']);
                          echo "<li>
                            <a href='update_notif.php?id=".$m['id']."&post_id=".$m['post_id']."&convo_user=".$m['convo_user']."&type=".$m['type']."&notifNo=".$m['notifNo']."'><b>".$user_name.' </b>sent you a private message '.date('m/d/Y H:i A', strtotime($m['time_added']));
                          echo "</a></li>";
                         }
                           
                    } ?>
    
                       <li class="divider"></li>
                       <li> <a href="messages.php?id=<?php echo $id;?>">See all messages
                        </a></li> 
                    </ul>
</li>

<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <img src = ./img/notif.png title='View Messages' width=20 height=20/> 
           		 	<?php if($comment_size == 0)
           		 	{

           		 	}
           		 	else
           		 	{
           		 			include "includes/notif_size.php";
           		 	}

           		 ?>
                   
                    <ul class="dropdown-menu">
                        
                    <?php 

                        if(empty($notifications))
                        {
                          echo '<li><a href="#">You dont have new notification!</a></li>';
                        }

                        else
                        {
                         foreach ($notifications as $n) {
                          $user_name = $users->fetch_info('username', 'id', $n['id']);
                          echo "<li>
                            <a href='update_notif.php?id=".$n['id']."&post_id=".$n['post_id']."&convo_user=".$n['convo_user']."&type=".$n['type']."&notifNo=".$n['notifNo']."'><b>".$user_name.' </b>commented on a post. '.date('m/d/Y H:i A', strtotime($n['time_added']));
                          echo "</a></li>";
                         }
                           
                    } ?>
    
                       <li class="divider"></li>
                       <li> <a href="notifications.php?id=<?php echo $user_id;?>">See all notifications
                        </a></li> 
                        
                    </ul>
</li>
<?php
}else{?>

<li><a href="register.php">Register</a></li>
<li><a href="login.php">Login</a></li>

<?php

}
?>