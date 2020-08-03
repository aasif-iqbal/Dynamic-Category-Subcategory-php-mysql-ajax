<?php 
include("database_connection.php");
include("functions.php");
?>

<!-- CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="script.js" type="text/javascript"></script>


<style type="text/css">
  .dropdown:hover .dropdown-menu {
    display: block;
    margin-top: 0; 
 }
  #message{
    /*1em=16px*/
    font-size: 1.5em; 
    border-radius: 5px; 
 }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Logo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      

      <!-- Dropdown -->
      <?php 
      $parent_query = "SELECT * FROM `tbl_categories` WHERE parent_category_id = 0";
      confirmation($parent_query);
      //exit($query);
  
      $parent_result = mysqli_query($connection, $parent_query) or die( mysqli_error($connection));

      while($parent = mysqli_fetch_assoc($parent_result)){ ?>
        <li class="nav-item dropdown" style="padding-left: 10px;">

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <!-- Dropdown menu title -->   
          <?php $parent_id = $parent['category_id'];?>
          <?php echo $parent['category_name'];?>
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <!-- menu items -->
          <?php  
          $dropdown_query = "SELECT * FROM `tbl_categories` WHERE parent_category_id = '$parent_id'";
          confirmation($dropdown_query);
          $child_query = mysqli_query($connection, $dropdown_query) or die( mysqli_error($connection));?>
          <?php while ( $child = mysqli_fetch_assoc($child_query)) { ?>
              <a class="dropdown-item" href="#"><?php echo $child['category_name']; ?></a>    
          <?php }//end-of-while?>
        </div>
      </li>
      <?php }//end-of-while?>      
    </ul>

    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Search" aria-label="Search">

      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><svg width="1em" height="1.2em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
      <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
      </svg>
      </button>
    </form>
  </div>
</nav>
