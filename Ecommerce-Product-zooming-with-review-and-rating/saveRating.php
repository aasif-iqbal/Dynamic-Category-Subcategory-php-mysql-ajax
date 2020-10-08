<?php require_once "database_connection.php";?>

<?php

if (!empty($_POST['rating']) && !empty($_POST['product_id'])) {

	$product_id = $_POST['product_id'];
	$user_id = 1234567;

	$insertRating = "INSERT INTO tbl_product_rating (product_id, user_id, ratingNumber, title, comments, created_at, modified_at) VALUES ('" . $product_id . "', '" . $user_id . "', '" . $_POST['rating'] . "', '" . $_POST['title'] . "', '" . $_POST["comment"] . "', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "')";

	mysqli_query($connection, $insertRating) or die("database error: " . mysqli_error($connection));
	echo "rating saved!";
}
?>