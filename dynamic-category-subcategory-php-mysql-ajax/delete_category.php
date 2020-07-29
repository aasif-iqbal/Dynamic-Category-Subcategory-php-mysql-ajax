<?php
include("database_connection.php");
include("functions.php");

 #delete category
 if (isset($_GET['delete']) && !empty($_GET['delete'])) {
 	
 	$delete_id = (int)$_GET['delete'];

	if ($parent_id == 0) {		
		$delete_parent_query = query("DELETE FROM `tbl_categories` WHERE parent_category_id = $delete_id");
		confirmation($delete_parent_query);	
	}

 	$delete_child_query = query("DELETE FROM `tbl_categories` WHERE category_id = $delete_id");
 	confirmation($delete_child_query);
	
 	set_msg("Category Deleted");
 	header("Location:index.php");
 }
?>