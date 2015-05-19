<?php 
session_start();

require_once 'core/connect/database.php';
$sessID = $_SESSION['id'];

if (isset($_GET['article'], $_GET['rating'])) {
	
	$article = (int)$_GET['article'];
	$rating = (int)$_GET['rating'];

	if (in_array($rating, [1,2,3,4,5])) {
		
		$exists = $db->query("SELECT post_id, id FROM posts WHERE post_id = $article")->fetch(PDO::FETCH_ASSOC);
		$pId = $exists['post_id'];
		$id = $exists['id'];

		$check = $db->query("SELECT id FROM `article_rating` WHERE article = $pId AND id = $sessID ")->fetch(PDO::FETCH_ASSOC);

		if($exists){

			if($check < 1){
				$db->query("INSERT INTO article_rating (id, article, ratings) VALUES ($sessID, $article, $rating)");


				header('Location: view_post.php?post_id=' . $article);
			}else{

				$db->query("UPDATE `article_rating` SET ratings = $rating WHERE article = $pId ");
				header('Location: view_post.php?post_id=' . $article);
			}
		}
		
	}

	
}

?>