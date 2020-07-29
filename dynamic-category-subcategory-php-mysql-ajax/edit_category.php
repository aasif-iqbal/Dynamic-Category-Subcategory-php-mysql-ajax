<?php 
include("navigation_bar.php");

global $connection;

	if (isset($_GET['edit']) && !empty($_GET['edit'])) {
	 	$edit_id= (int)$_GET['edit'];
	 	$edit_query = "SELECT * FROM tbl_categories WHERE category_id=$edit_id";
	 	confirmation($edit_query);
		$result = mysqli_query($connection, $edit_query) or die( mysqli_error($connection));	 	
	 	// exit($edit_query);
	 	$edit_category  = mysqli_fetch_assoc($result);
	 	$category_value = $edit_category['category_name'];
	 	$parent_value   = $edit_category['parent_category_id'];
	 	//echo($parent_value);
	 	//echo(implode($edit_category, " <br/>"));die();
		 update_category();	 	
	 }
?>
<div id="layoutSidenav_content">
    <main>
      <div class="container">
        <h1 class="mt-4">Edit Categories</h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item active">Edit Categories</li>
        </ol>
 
          <div class="row">
          
              <div class="col-md-4">
                  <form class="form" method="POST" action="">
                <div class="form-group">
                  <label for="add_categories">Edit Categories</label>
                  <select id="parent_category_id" name="parent_category_id" class="form-control">
                    <!-- <option value="0">Add--at--parent</option> -->
                    <option value="0"<? (($parent_value == 0)?' selected="selected"':''); ?>>Add--at-- Parent</option>

                    <?php 
                    $cat_query= "SELECT * FROM `tbl_categories` WHERE parent_category_id=0";
                    confirmation($cat_query);
                    $result = mysqli_query($connection, $cat_query) or die(mysqli_error($connection));
                    ?>
                    <?php foreach ($result as $parent) {?>

                      <option value="<?= $parent['category_id'];?>"
                        <?= (($parent_value == $parent['category_id'])?' selected="selected"':'');?> >
                        <?= $parent['category_name'];?>
                      </option>

                    <? } //end-of-foreach?>
                  </select>
                </div>
			
                <input class="form-control" type="text" name="category_name" placeholder="category name"  id="category_name" value="<?= $category_value;?>" />
                <br>
                <button type="submit" name="edit" id="edit" 
                class="btn btn-outline-info btn-md btn-block">Update Categories</button>
              </form>
              </div>
          </div>
      </div>
  </main>
</div>