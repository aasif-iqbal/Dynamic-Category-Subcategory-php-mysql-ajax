<?php
	include('database_connection.php');
	
	ob_start();		//ob_start() turns on output buffering.

	if (!isset($_SESSION)) {
  		session_start();
	}
	//session_destroy();

	function query($sql){
		global $connection;
		return mysqli_query($connection, $sql) or die("Error: " . mysqli_error($connection));
	}

	function set_msg($msg){
		
		if(!empty($msg)) {
			$_SESSION['message'] = $msg;
		}else{
			$msg = "";
		}
	}

	function display_msg(){

		if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
			echo($_SESSION['message']);
			unset($_SESSION['message']);
		}
	//UnsetPreviousSession();	
	}

	function UnsetPreviousSession() { 
    
    	 if(isset($_SESSION['message']) && $_SESSION['message'] != ''){
			unset($_SESSION['message']);			
        }
    } 

	function redirect($location){
		header("Location:$location");
	}

	function confirmation($result){

		global $connection;
			if (!$result) {
			die("Query failed:".mysqli_error($connection));
		}
	}

	function escape_string($string){

		global $connection;

		return  mysqli_real_escape_string($connection, $string);

	}

	function fetch_array($result){

		return mysqli_fetch_array($result);    
	}

	function add_categories(){
	
		global $connection;

		if (isset($_POST['add_categories']) || !empty($_POST['add_categories'])) {
		
			$post_parent = '';

		 	$post_parent   = $_POST['parent_category_id'];
			$category_name = isset($_POST['category_name']) ? isset($_POST['category_name']) : '';

			$category_name = escape_string($_POST['category_name']);
			//echo('parent_category_id:'.$post_parent);
			//echo('category_name:'.$category_name);
			//die();

			$query = "SELECT category_name,parent_category_id FROM `tbl_categories` WHERE category_name='$category_name' and parent_category_id = $post_parent";
			confirmation($query);
			$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
			$total = mysqli_num_rows($result);
			//echo($total);die();

			//Below code will help you inserting unique data
			if($total == 0){
			
			if (empty($category_name) || $category_name == " ") {
				set_msg("Category name can not be Empty");

			}else{

			// prepare and bind
			$stmt = mysqli_prepare($connection,"INSERT INTO `tbl_categories` (category_name,parent_category_id) VALUES  (?,?)");

			if ( false===$stmt ) {
			  	die('prepare() failed: ' . htmlspecialchars($mysqli->error));
			}

			$rc = $stmt->bind_param("si", $category_name, $post_parent); 

			if ( false===$rc ) {
	  			die('bind_param() failed: ' . htmlspecialchars($stmt->error));
			}

			$rc = $stmt->execute();
		
			if ( false===$rc ) {
			  	die('execute() failed: ' . htmlspecialchars($stmt->error));
			}
			
			
			confirmation($stmt);

			$stmt->close();

			/*if (mysqli_affected_rows($stmt) == 0) {
				set_msg("No row affected");
			}*/
			
			set_msg("New Category Added");
			redirect("location:index.php"); //stop inserting data in the database when refreshing the page
			exit();
				}
			}//end-of-if
		}
	}

	function update_category(){

		global $connection;
		if (isset($_POST['edit']) && isset($_GET['edit']) || !empty($_POST['edit']) ) {
		
		$edit_id        = (int)$_GET['edit'];
		$category_value = escape_string($_POST['category_name']);
		$parent_value   = escape_string($_POST['parent_category_id']);

		$update_query = "UPDATE `tbl_categories` 
		 						   SET category_name      = '$category_value',
		 						  	   parent_category_id = $parent_value
		 						   WHERE category_id = $edit_id";
		// exit($update_query);
		 confirmation($update_query);
		 $update_result = mysqli_query($connection, $update_query) or die( mysqli_error($connection));
		 set_msg("Category Updated");
		 redirect("index.php");
		 //print_r($update_result);	
		 }	 
	}
?>