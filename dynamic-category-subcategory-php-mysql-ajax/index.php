<?php 
  include("database_connection.php");
  include("navigation_bar.php");
  add_categories();
?>
    <div id="layoutSidenav_content">
      <main>
        <div class="container">
          <h1 class="mt-4">Add Categories</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Add Categories</li>
          </ol>
         
            <h3 class="bg-warning text-secondary text-center" id="message"><?php display_msg(); ?></h3>
            
            <div class="row">
            
                <div class="col-md-4">
                    <form class="form" method="POST" action="">
                  <div class="form-group">
                    <label for="add_categories">Add Categories</label>
                    <select class="form-control" id="parent_category_id" name="parent_category_id">
                      <option value="0">Add--at--parent</option>
                      <?php 
                      $cat_query= "SELECT * FROM `tbl_categories` WHERE parent_category_id=0";
                      confirmation($cat_query);
                      $result = mysqli_query($connection, $cat_query) or die(mysqli_error($connection));
                      ?>
                      <?php foreach ($result as $parent) {?>
                        <option value="<?= $parent['category_id'];?>">
                          <?php echo($parent['category_name']);?>
                        </option>

                      <? } //end-of-foreach?>
                    </select>
                  </div>

                  <input class="form-control" type="text" name="category_name" placeholder="category name"  id="category_name" />
                  <br>
                  <button type="submit" name="add_categories" id="add_categories" 
                  class="btn btn-outline-info btn-md btn-block">Add Categories</button>
                </form>
                </div>
              
              <!-- Table -->
              <div class="col-md-8 col-sm-4">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Category Name</th>
                          <th>Parent Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        $fetch_parent_query = "SELECT * FROM `tbl_categories` WHERE parent_category_id=0";
                        confirmation($fetch_parent_query);
                        $parent_query_result = mysqli_query($connection,$fetch_parent_query)or die(mysqli_error($connection));

                        foreach ($parent_query_result as $parent) {

                          $parent_id = (int)$parent['category_id'];

                          $fetch_child_query = "SELECT * FROM `tbl_categories` WHERE parent_category_id = '$parent_id'";
                          confirmation($fetch_child_query);

                          $child_query_result = mysqli_query($connection, $fetch_child_query)or die(mysqli_error($connection));
                          ?>
                          <tr style="background-color: #e9ecef;">
                            <td><?= $parent['category_name'];?></td>
                            <td>Parent</td>
                            <td>
                               <a href="edit_category.php?edit=<?= $parent['category_id'];?>"> 
                              <button class="btn btn-primary" type="submit" data-toggle="tooltip" data-placement="top" title="You Can't Edit Parent Category.To do so,Delete it and Create New Parent category.">
                              
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                              
                              </button>
                            </a>
                              <!-- Delete -->

                              <!-- Button trigger modal -->
                              <a href="delete_category.php?delete=<?= $parent['category_id']; ?>">
                              <button type="submit" class="btn btn-danger remove" data-toggle="modal" data-target="#parent_model">
                                
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                              </button>
                            </a>
                            </td>
                          </tr>

                          <?php foreach($child_query_result as $child){?>
                            <tr>
                              <td><?= $child['category_name'];?></td>
                              <td><?= $parent['category_name'];?></td>
                              <td>
                                <a href="edit_category.php?edit=<?= $child['category_id'];?>"> 
                                <button class="btn btn-primary" type="submit">
                                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                  </svg>
                                </button>
                              </a>
                                <!-- Delete -->

                                <!-- Button trigger modal -->
                                <a href="delete_category.php?delete=<?= $child['category_id']; ?>">
                                <button type="submit" class="btn btn-danger delete_btn remove" data-toggle="modal" data-target="#child_model">
                                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                  </svg>
                                </button>
                              </a>

                              
                              </td>
                            </tr>
                          <?php }; //end-of-foreach?>
                        <?php }; //end-of-foreach?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div><!-- row -->


            <div style="height: 30vh;"></div>
            <div class="card mb-4"><div class="card-body">Here, You Can Add Multiple categories to your E-commerce website.</div></div>
          </div>
        </main>   
    </div>