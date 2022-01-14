<!doctype html>
<?php

  // SQL Connection
  $ser = "localhost";
  $conn = mysqli_connect($ser,"root","","res");
  $cat = mysqli_query($conn,"SELECT * FROM catagory");
  $area = mysqli_query($conn,"SELECT * FROM area");
  $tagss = mysqli_query($conn,"SELECT * FROM tags");
  $catagory_id = "";

  //checking catagory filter with not null
  if(array_key_exists('catagoryid',$_GET)){
    $catagory_id = $_GET['catagoryid'];
  }

  //checking area filter with not null
  $area_id = "";
  if(array_key_exists('areaid',$_GET)){
    $area_id = $_GET['areaid'];
  }

  //checking area filter with not null
  $tag_id = [];
  if(array_key_exists('tagid',$_GET)){
    $tag_id = $_GET['tagid'];
  }

  //checking search filter with not null
  $search = "";
  if(array_key_exists('searched',$_GET)){
    $search = $_GET['searched'];
  }
  
  //Joining the tables  with LEFT JOIN resataurant table, catagory table, area table for listing all restaurants below
  $restaurantQuery = "SELECT r.id as id, r.name as restaurant, c.catagory as catagory, a.area as area FROM reslist as r LEFT JOIN catagory as c ON c.id=r.cat_id LEFT JOIN area as a ON a.id = r.area_id WHERE 1";

  //catagory filter - concatinating the condition with above query to filter catagory wise filter
  if($catagory_id != ""){
    $restaurantQuery.=" AND r.cat_id = '$catagory_id'";
  }

  //area filter - concatinating the condition with above query to filter area wise filter
  if($area_id != ""){
    $restaurantQuery.=" AND r.area_id = '$area_id'";
  }

  //search filter - concatinating the condition with above query to filter search wise filter
  if($search != ""){
    $restaurantQuery.=" AND (r.name LIKE '%$search%'  OR c.catagory LIKE '%$search%' OR a.area LIKE '%$search%')";
  }
  
  //tags filter - concatinating the condition with above query to filter tags wise filter, Tags getting an array 
  if(count($tag_id)>0){
    $temp = "";
    //using for each loop for taking tagsid's to string like 1,3,4 - spicy,veg,non-veg
    foreach($tag_id as $t){
      $temp.=$t.',';
    }
    
    $temp = substr($temp,0,-1);
    //filtering the restaurants with tag ids in tag_res table
    $filter_tag = mysqli_query($conn,"SELECT * FROM tag_res WHERE tag_id IN ($temp)");
    $temp1 = "";
    while($r = mysqli_fetch_assoc($filter_tag)){
      $temp1.=$r['res_id'].',';  
    }
    $temp1 = substr($temp1,0,-1);
    $restaurantQuery.=" AND r.id IN ($temp1)";
  }
    $restaurants = mysqli_query($conn,$restaurantQuery);
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>F-O-F</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/offcanvas/">

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    

<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
    <img class="mr-3" src="assets/brand/bootstrap-outline.svg" alt="" width="48" height="48">
    <div class="lh-100">
      <h6 class="mb-0 text-white lh-100">Botato</h6>
      <small>Since 2022</small>
    </div>
  </div>

  <div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Filters <label for="exampleInputPassword1"><---- Here for Filters</label>
          </button>
        </h5>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          
          <form method = "GET">
            <div class = "row"><div class = "col-md-12"><label for="exampleInputEmail1">Search</label><input type = "text" class = "form-control" name = "searched" value ="<?=$search?>" ></div></div>
            <div class = "row">
              <div class = "col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Catagory</label>
                  <select class="form-control" aria-label="Default select example" name = "catagoryid">
                    <option value = "">select category</option>
                    <?php while($row = mysqli_fetch_assoc($cat)):?>
                    <?php $temp = ($row['id']==$catagory_id)?"selected":"";?>
                      <option value = "<?php echo $row['id']; ?>" <?=$temp?>><?php echo $row['catagory'];?></option>
                    <?php endwhile;?>
                    </select>
                  <small id="emailHelp" class="form-text text-muted">We'll share you.</small>
                </div>    
              </div>
              <div class = "col-md-6">
                <div class="form-group">
                  <label for="exampleInputPassword1">Area</label>
                  
                  <select class="form-control" aria-label="Default select example" name = "areaid">
                    <option value = "">select area</option>
                    <?php while($row = mysqli_fetch_assoc($area)):?>
                      <?php $temp = ($row['id']==$area_id)?"selected": "";?>
                      <option value = "<?php echo $row['id']; ?>" <?=$temp?>><?php echo $row['area'];?></option>
                    <?php endwhile;?>
                    </select>
                  <small id="emailHelp" class="form-text text-muted">We'll share you.</small>

                </div>    
              </div>
              <div class = "col-md-6">
              <label for="exampleInputPassword1">Tags</label>
                <div class="form-group form-check">
                <?php while($row = mysqli_fetch_assoc($tagss)):?>
                  <?php $temp = (in_array($row['id'], $tag_id))?"checked":""?>
                  <div class = "col-md-12">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" name = "tagid[]" value = "<?php echo $row['id']?>" <?=$temp;?>>
                  <label class="form-check-label" for="exampleCheck1"><?php echo $row['tags']?></label>
                </div>
               <?php endwhile;?>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Restaurants</h6>
    <?php if($restaurants):?>
    <?php while($row = mysqli_fetch_assoc($restaurants)):?>
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark"><?= $row['restaurant']?></strong>
          <a href="#"><?= $row['area']?></a>
        </div>
        <span class="d-block"><?= $row['catagory']?></span>
        
        
        <?php 
        $tag_query = "SELECT t.tags as tag FROM tag_res as tr LEFT JOIN tags as t ON t.id = tr.tag_id WHERE tr.res_id = '$row[id]' ";
        $restaurant_tags = mysqli_query($conn,$tag_query); 
        $print_tags = "";
        if($restaurant_tags){
          while($row_tag = mysqli_fetch_assoc($restaurant_tags)){
            $print_tags.=$row_tag['tag'].', ';
          }
        }
        ?>
        <span class="d-block"><?= substr($print_tags,0,-2);?></span>
      </div>
      
    </div>
    <?php endwhile;?>
  <?php endif?>
    <small class="d-block text-right mt-3">
      <a href="index.php">All suggestions</a>
    </small>
  <!-- </div> -->
  <div class = "container">
  <ul class = "pagination">
    <li class = "page-item active"><a class = "page-link" href = "index.php">1</a></li>
    <li class = "page-item"><a class = "page-link" href = "#">2</a></li>
    <li class = "page-item"><a class = "page-link" href = "#">3</a></li>
  </ul>
  </div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="assets/dist/js/bootstrap.bundle.js"></script>
        <script src="offcanvas.js"></script></body>
</html>
