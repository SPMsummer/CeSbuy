<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
    <li><a href="edit_comment.php?commentID=<?php echo $c['commentID'];?>">Edit</a></li>
    <li><a onclick="return confirm('Are you sure you want to delete data?')" href="delete_comment.php?commentID=<?php echo $c['commentID'];?>&post_id=<?php echo $post_id;?>">Delete</a></li>
    </ul>
    </div>