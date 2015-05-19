<?php 
class Users{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	 
	// checks if the user exists in the user table
	public function user_exists($username) {
	
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `username`= ?");
		$query->bindValue(1, $username);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}
	
	// checks if the email exists in the user table
	public function email_exists($email) {

		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email`= ?");
		$query->bindValue(1, $email);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}

	// perfoms the registration method
	public function register($username, $password, $email, $firstname, $middlename, $lastname){
		
		global $bcrypt; // making the $bcrypt variable global so we can use here
 
		$time = time();
		$ip = $_SERVER['REMOTE_ADDR'];
		$email_code = $email_code = uniqid('code_',true);
		$password = $bcrypt->genHash($password);// generating a hash using the $bcrypt object
		$query = $this->db->prepare("INSERT INTO `users` (`username`, `password`, `email`, `first_name`,`middle_name`,`last_name`, `ip`, `time`, `email_code`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ");
		 
		$query->bindValue(1, $username);
		$query->bindValue(2, $password);
		$query->bindValue(3, $email);
		$query->bindValue(4, $firstname);
		$query->bindValue(5, $middlename);
		$query->bindValue(6, $lastname);
		$query->bindValue(7, $ip);
		$query->bindValue(8, $time);
		$query->bindValue(9, $email_code);
		 
		try{
		$query->execute();
		 
		// mail($email, 'Please activate your account', "Hello " . $username. ",\r\nThank you for registering with us. Please visit the link below so we can activate your account:\r\n\r\nhttp://www.example.com/activate.php?email=" . $email . "&email_code=" . $email_code . "\r\n\r\n-- Example team");
		}catch(PDOException $e){
		die($e->getMessage());
		}		
	}

	// performs the login method
	public function login($username, $password) {

		global $bcrypt; // Again make the bcrypt variable global, which is defined in init.php, which is included in login.php where this function is called
 
		$query = $this->db->prepare("SELECT `password`, `id` FROM `users` WHERE `username` = ?");
		$query->bindValue(1, $username);
		 
		try{
		$query->execute();
		$data = $query->fetch();
		$stored_password = $data['password']; // stored hashed password
		$id = $data['id'];
		if($bcrypt->verify($password, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
		return $id;	
		}else{
		return false;	
		}
		 
		}catch(PDOException $e){
		die($e->getMessage());
		}
		}

	// fetches the data of the user
	public function userdata($id) {

		$query = $this->db->prepare("SELECT * FROM `users` WHERE `id`= ?");
		$query->bindValue(1, $id);

		try{

			$query->execute();

			return $query->fetch();

		} catch(PDOException $e){

			die($e->getMessage());
		}

	}
	
	// get all users 	 
	public function get_users() {

		$query = $this->db->prepare("SELECT * FROM `users` ORDER BY `time` DESC");
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();

	}

	// fetch info on something
	public function fetch_info($what, $field, $value){
 
		$allowed = array('id', 'username', 'firstname', 'lastname', 'gender', 'bio', 'email'); // I have only added few, but you can add more. However do not add 'password' even though the parameters will only be given by you and not the user, in our system.
		if (!in_array($what, $allowed, true) || !in_array($field, $allowed, true)) {
		throw new InvalidArgumentException;
		}else{
		$query = $this->db->prepare("SELECT $what FROM `users` WHERE $field = ?");
		 
		$query->bindValue(1, $value);
		 
		try{
		 
		$query->execute();
		} catch(PDOException $e){
		 
		die($e->getMessage());
		}
		 
		return $query->fetchColumn();
		}
	}
 	
 	// change password
	public function change_password($user_id, $password) {
	 
		global $bcrypt;
		 
		/* Two create a Hash you do */
		$password_hash = $bcrypt->genHash($password);
		 
		$query = $this->db->prepare("UPDATE `users` SET `password` = ? WHERE `id` = ?");
		 
		$query->bindValue(1, $password_hash);
		$query->bindValue(2, $user_id);	
		 
		try{
		$query->execute();
		return true;
		} catch(PDOException $e){
		die($e->getMessage());
		}
	}

	// method for updating user info
	public function update_user($firstname, $lastname, $gender, $bio, $image_location, $id){
 
		$query = $this->db->prepare("UPDATE `users` SET
		`firstname` = ?,
		`lastname` = ?,
		`gender` = ?,
		`bio` = ?,
		`image_location`= ?
		WHERE `id` = ?
		");
		 
		$query->bindValue(1, $firstname);
		$query->bindValue(2, $lastname);
		$query->bindValue(3, $gender);
		$query->bindValue(4, $bio);
		$query->bindValue(5, $image_location);
		$query->bindValue(6, $id);
		try{
		$query->execute();
		}catch(PDOException $e){
		die($e->getMessage());
		}	
	}

	// fetch the information of posts
	public function fetch_info_post($what, $field, $value){

		$query = $this->db->prepare("SELECT $what FROM `posts` WHERE $field = ?");
		 
		$query->bindValue(1, $value);
		 
		try{
		 
		$query->execute();
		} catch(PDOException $e){
		 
		die($e->getMessage());
		}
		 
		return $query->fetchColumn();
		
	}

	// method for the posting of product 
	public function post_product($image_location, $name, $category, $price, $description,$id){
		$query = $this->db->prepare("INSERT INTO `posts`(`image_location`,`name`,`category`,`price`,`description`,`id`) VALUES(?, ?, ?, ?, ?, ?)");

		$query->bindValue(1, $image_location);
		$query->bindValue(2, $name);
		$query->bindValue(3, $category);
		$query->bindValue(4, $price);
		$query->bindValue(5, $description);
		$query->bindValue(6, $id);

		try
		{
			$query->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}		
	}

	// fetch post by id
	public function get_post($id)
	{

		$query = $this->db->prepare("SELECT * FROM `posts` WHERE `id` = ?");

		$query->bindValue(1, $id);
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();
	}


	// fetch all posts
	public function get_all_posts()
	{

		$query = $this->db->prepare("SELECT * FROM `posts` ORDER BY `date` DESC;");

		$query->bindValue(1, $id);
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();
	}

	// fetch data of a post
	public function post_data($id) {

		$query = $this->db->prepare("SELECT * FROM `posts` WHERE `post_id`= ?");
		$query->bindValue(1, $id);

		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}

		return $query->fetch();

	}

	// method for performing an update of a specific post
	public function update_post($name, $price, $category, $description, $post_id){
 
		$query = $this->db->prepare("UPDATE `posts` SET
		`name` = ?,
		`price` = ?,
		`category` = ?,
		`description` = ?
		WHERE `post_id` = ?
		");
		 
		$query->bindValue(1, $name);
		$query->bindValue(2, $price);
		$query->bindValue(3, $category);
		$query->bindValue(4, $description);
		$query->bindValue(5, $post_id);
		try{
		$query->execute();
		}catch(PDOException $e){
		die($e->getMessage());
		}	
	}

	public function getWhere($query) {
		$qresult = $this->db->query($query);
		$results = $qresult->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	// method for performing the comment function
	public function add_comment($id, $post_id, $text)
	{

		$query = $this->db->prepare("INSERT INTO `comments` (`id`, `post_id`, `comment`,`time_added`) VALUES (?, ?, ?, NOW()) ");
		 
		$query->bindValue(1, $id);
		$query->bindValue(2, $post_id);
		$query->bindValue(3, $text);
		
		try{
		$query->execute();
		}catch(PDOException $e){
		die($e->getMessage());
		}		
	}

	// fetch the comments of a specific posts

	public function get_comments($id) {

		$query = $this->db->prepare("SELECT `id`,`commentID`,`comment`,`time_added` FROM `comments` WHERE `post_id`= ?");
		$query->bindValue(1, $id);

		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}

		return $query->fetchAll();

	}

	public function update_comment($id, $post_id, $comment, $commentID){
 
		$query = $this->db->prepare("UPDATE `comments` SET
		`id` = ?,
		`post_id` = ?,
		`comment` = ?,
		`time_added` =  NOW()
		WHERE `commentID` = ?
		");
		 
		$query->bindValue(1, $id);
		$query->bindValue(2, $post_id);
		$query->bindValue(3, $comment);
		$query->bindValue(4, $commentID);
		try{
		$query->execute();
		}catch(PDOException $e){
		die($e->getMessage());
		}	
	}

	public function comment_data($id) {

		$query = $this->db->prepare("SELECT * FROM `comments` WHERE `commentID`= ?");
		$query->bindValue(1, $id);

		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}

		return $query->fetch();

	}
	public function fetch_info_comment($what, $field, $value){
 
		$allowed = array('id', 'post_id', 'comment'); // I have only added few, but you can add more. However do not add 'password' even though the parameters will only be given by you and not the user, in our system.
		if (!in_array($what, $allowed, true) || !in_array($field, $allowed, true)) {
		throw new InvalidArgumentException;
		}else{
		$query = $this->db->prepare("SELECT $what FROM `comments` WHERE $field = ?");
		 
		$query->bindValue(1, $value);
		 
		try{
		 
		$query->execute();
		} catch(PDOException $e){
		 
		die($e->getMessage());
		}
		 
		return $query->fetchColumn();
		}
	}

	public function delete_comment($id)
	{
			$query = $this->db->prepare("DELETE FROM comments WHERE commentID = ?");
			$query->bindValue(1, $id);

			try{

			$query->execute();

			} catch(PDOException $e){

				die($e->getMessage());
			}
	}

	// method for performing the delete function
	public function delete_post($id)
	{
			$query = $this->db->prepare("DELETE FROM posts WHERE post_id = ?");
			$query->bindValue(1, $id);

			try{

			$query->execute();

			} catch(PDOException $e){

				die($e->getMessage());
			}
	}


	public function add_message($id, $post_id,$receiver_id, $text)
	{

		$query = $this->db->prepare("INSERT INTO `messages` (`id`, `post_id`, `receiver_id`,`message`,`time_added`) VALUES (?, ?, ?,?, NOW()) ");
		 
		$query->bindValue(1, $id);
		$query->bindValue(2, $post_id);
		$query->bindValue(3, $receiver_id);
		$query->bindValue(4, $text);
		
		try{
		$query->execute();
		}catch(PDOException $e){
		die($e->getMessage());
		}		
	}


	public function get_message($id, $receiver_id) {

		$query = $this->db->prepare("SELECT `id`,`message`,`time_added` FROM `messages` WHERE `id`= ? AND `receiver_id`= ?");
		$query->bindValue(1, $id);
		$query->bindValue(2, $receiver_id);

		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}

		return $query->fetchAll();

	}
	
	

	public function add_notif($id, $post_id, $convo_user, $text)
	{

		$query = $this->db->prepare("INSERT INTO `notification` (`id`, `post_id`,`convo_user`, `status`,`type`,`time_added`) VALUES (?, ?, ?,? ,?, NOW()) ");
		 
		$query->bindValue(1, $id);
		$query->bindValue(2, $post_id);
		$query->bindValue(3, $convo_user);
		$query->bindValue(4, "unread");
		$query->bindValue(5, $text);		
		
		try{
		$query->execute();
		}catch(PDOException $e){
		die($e->getMessage());
		}		
	}

	public function notif_size($id,$type) {

		$query = $this->db->prepare("SELECT COUNT(*) FROM `notification` WHERE `status` = ? AND `convo_user` = ? AND `type` = ? ");
		$query->bindValue(1, "unread");
		$query->bindValue(2, $id);
		$query->bindValue(3, $type);

		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}

		return $query->fetchColumn();

	}


	public function get_notif($id,$type) {

		$query = $this->db->prepare("SELECT *FROM `notification` WHERE `status` = ? AND `convo_user` = ? AND `type` = ? ORDER BY `notifNo` DESC");
		$query->bindValue(1, "unread");
		$query->bindValue(2, $id);
		$query->bindValue(3, $type);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}

		return $query->fetchAll();

	}

	public function update_notify($id, $post_id, $convo_user, $type, $notifNo)
	{
		$query = $this->db->prepare("UPDATE `notification` SET
		`id` = ?,
		`post_id` = ?,
		`convo_user` = ?,
		`status` = ?,
		`type` = ?,
		`time_added` =  NOW()
		WHERE `notifNo` = ?
		");
		 
		$query->bindValue(1, $id);
		$query->bindValue(2, $post_id);
		$query->bindValue(3, $convo_user);
		$query->bindValue(4, "read");
		$query->bindValue(5, $type);
		$query->bindValue(6, $notifNo);
		try{
		$query->execute();
		}catch(PDOException $e){
		die($e->getMessage());
		}	
	
	}


	public function user_convo($post_id){
 
		$query = $this->db->prepare("SELECT DISTINCT `id` FROM `comments` WHERE `post_id` = ?");
		 
		$query->bindValue(1, $post_id);
		 
		try{
		 
		$query->execute();
		} catch(PDOException $e){
		 
		die($e->getMessage());
		}
		 
		return $query->fetchAll();
	
	}

	public function get_all_notif($id) {

		$query = $this->db->prepare("SELECT *FROM `notification` WHERE `convo_user` = ? ORDER BY `notifNo` DESC");
		$query->bindValue(1, $id);
		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}

		return $query->fetchAll();

	}

		public function post_by_category($category) {

		$query = $this->db->prepare("SELECT * FROM `posts` WHERE `category`= ?");
		$query->bindValue(1, $category);

		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}

		return $query->fetchAll();

	}

	// search for products
	public function search_products($item) {
			
		// SELECT * FROM `posts` WHERE `$search_type` LIKE '$search_query'
		$query = $this->db->prepare("SELECT * FROM `posts` WHERE `name` LIKE '%$item%'");
		$query->bindValue(1, $item);

		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}

		return $query->fetchAll();

	}

	// search for products by category
	public function search_product_by_category($item, $category) {
			
		// SELECT * FROM `posts` WHERE `$search_type` LIKE '$search_query'
		$query = $this->db->prepare("SELECT * FROM `posts` WHERE `name` LIKE ? AND `category` = ?");
		// $query = $this->db->prepare("SELECT ? , ?");
		$item = "%$item%";
		$query->bindValue(1, $item);
		$query->bindValue(2, $category);

		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}

		// var_dump($query);
		return $query->fetchAll();

	}	

	public function get_all_msg($id){
 
		$query = $this->db->prepare("SELECT DISTINCT `id` FROM `messages` WHERE `receiver_id` = ? ORDER BY `message_id` DESC");
		 
		$query->bindValue(1, $id);
		 
		try{
		 
		$query->execute();
		} catch(PDOException $e){
		 
		die($e->getMessage());
		}
		 
		return $query->fetchAll();
	
	}

}