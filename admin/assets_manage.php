<?php   
      include "inc/header.php";
      include "inc/topmenubar.php";
      include "inc/leftmenubar.php";
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Assets Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Assets Management</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-6">
            <!-- Edit  New Asset start -->
            <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit New Assets</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
               <?php  
               if(isset($_GET['edit_id'])){
                $asset_id = (int) $_GET['edit_id'];
                $query = "SELECT * FROM assets WHERE asset_id = $asset_id";
                $result = mysqli_query($connect, $query);

                $asset = mysqli_fetch_assoc($result);
                ?>
                 <!-- Step 3: Pre-filled Edit Form -->
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Asset Title</label>
                    <input type="text" name="asset_title" class="form-control" value="<?= htmlspecialchars($asset['asset_title']) ?>" required>
                  </div>

                  <div class="form-group">
                    <label>Asset Type</label>
                    <select name="asset_type" class="form-control" required>
                      <option value="1" <?= $asset['asset_type'] == 1 ? 'selected' : '' ?>>Apartment</option>
                      <option value="2" <?= $asset['asset_type'] == 2 ? 'selected' : '' ?>>Villa</option>
                      <option value="3" <?= $asset['asset_type'] == 3 ? 'selected' : '' ?>>Penthouse</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" step="0.01" name="asset_price" class="form-control" value="<?= $asset['asset_price'] ?>" required>
                  </div>

                  <div class="form-group">
                    <label>Bedrooms</label>
                    <input type="number" name="asset_bedroom" class="form-control" value="<?= $asset['asset_bedroom'] ?>">
                  </div>

                  <div class="form-group">
                    <label>Bathrooms</label>
                    <input type="number" name="asset_bathroom" class="form-control" value="<?= $asset['asset_bathroom'] ?>">
                  </div>

                  <div class="form-group">
                    <label>Floor</label>
                    <input type="number" name="asset_floor" class="form-control" value="<?= $asset['asset_floor'] ?>">
                  </div>

                  <div class="form-group">
                    <label>Area</label>
                    <input type="text" name="asset_area" class="form-control" value="<?= htmlspecialchars($asset['asset_area']) ?>">
                  </div>

                  <div class="form-group">
                    <label>Parking</label>
                    <input type="text" name="asset_praking" class="form-control" value="<?= htmlspecialchars($asset['asset_praking']) ?>">
                  </div>

                  <div class="form-group">
                    <label>Current Images:</label><br>
                    <?php
                    $imgs = explode(",", $asset['asset_images']);
                    foreach ($imgs as $img) {
                        echo '<img src="' . $img . '" width="80" height="60" style="margin: 5px; object-fit: cover;">';
                    }
                    ?>
                  </div>

                  <div class="form-group">
                    <label>Upload New Images (optional)</label>
                    <input type="file" name="asset_images[]" class="form-control" multiple>
                  </div>

                  <button type="submit" name="update_asset" class="btn btn-success">Update Asset</button>
                </form>
                <?php
               }
                
               ?>

                
                 <?php 

                 
                // Step 2: Handle Form Submission
                if (isset($_POST['update_asset'])) {
                    $asset_title = mysqli_real_escape_string($connect, $_POST['asset_title']);
                    $asset_type = (int) $_POST['asset_type'];
                    $asset_price = (float) $_POST['asset_price'];
                    $asset_bedroom = (int) $_POST['asset_bedroom'];
                    $asset_bathroom = (int) $_POST['asset_bathroom'];
                    $asset_floor = (int) $_POST['asset_floor'];
                    $asset_area = mysqli_real_escape_string($connect, $_POST['asset_area']);
                    $asset_praking = mysqli_real_escape_string($connect, $_POST['asset_praking']);

                    // Optional: handle new image uploads
                    $new_images = [];
                    if (!empty($_FILES['asset_images']['name'][0])) {
                        $upload_dir = "uploads/";
                        foreach ($_FILES['asset_images']['tmp_name'] as $key => $tmp_name) {
                            $image_name = time() . "_" . basename($_FILES['asset_images']['name'][$key]);
                            $target_file = $upload_dir . $image_name;
                            if (move_uploaded_file($tmp_name, $target_file)) {
                                $new_images[] = $target_file;
                            }
                        }
                    }

                    // Use new images if uploaded, else keep existing
                    $asset_images = count($new_images) > 0 ? implode(",", $new_images) : $asset['asset_images'];

                    // Update query
                    $sql = "UPDATE assets SET
                                asset_type = '$asset_type',
                                asset_title = '$asset_title',
                                asset_price = '$asset_price',
                                asset_bedroom = '$asset_bedroom',
                                asset_area = '$asset_area',
                                asset_bathroom = '$asset_bathroom',
                                asset_floor = '$asset_floor',
                                asset_praking = '$asset_praking',
                                asset_images = '$asset_images',
                                asset_updated_at = NOW()
                            WHERE asset_id = $asset_id";

                    if (mysqli_query($connect, $sql)) {
                        echo "Asset updated successfully.";
                        header("Location: assets_manage.php"); // redirect to list (optional)
                    } else {
                        echo "Error updating asset: " . mysqli_error($connect);
                    }
                }
                ?>
            </div>
            <!-- /.card-body -->
           </div>
            <!-- edit New Asset end -->
            <!-- Add New Asset start -->
            <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add New Assets</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
               <form action="" method="POST" enctype="multipart/form-data">
                  <!-- Asset Title -->
                  <div class="form-group">
                    <label for="assetTitle">Asset Title</label>
                    <input type="text" name="asset_title" id="assetTitle" class="form-control" required>
                  </div>

                  <!-- Asset Type -->
                  <div class="form-group">
                    <label for="assetType">Asset Type</label>
                    <select name="asset_type" id="assetType" class="form-control" required>
                      <option value="" disabled selected>Select Type</option>
                      <option value="1">Apartment</option>
                      <option value="2">Villa</option>
                      <option value="3">Penthouse</option>
                    </select>
                  </div>

                  <!-- Asset Price -->
                  <div class="form-group">
                    <label for="assetPrice">Price</label>
                    <input type="number" step="0.01" name="asset_price" id="assetPrice" class="form-control" required>
                  </div>

                  <!-- Bedrooms -->
                  <div class="form-group">
                    <label for="assetBedroom">Bedrooms</label>
                    <input type="number" name="asset_bedroom" id="assetBedroom" class="form-control">
                  </div>

                  <!-- Bathrooms -->
                  <div class="form-group">
                    <label for="assetBathroom">Bathrooms</label>
                    <input type="number" name="asset_bathroom" id="assetBathroom" class="form-control">
                  </div>

                  <!-- Floor -->
                  <div class="form-group">
                    <label for="assetFloor">Floor</label>
                    <input type="number" name="asset_floor" id="assetFloor" class="form-control">
                  </div>

                  <!-- Area -->
                  <div class="form-group">
                    <label for="assetArea">Area (e.g., 1200 sqft)</label>
                    <input type="text" name="asset_area" id="assetArea" class="form-control">
                  </div>

                  <!-- Parking -->
                  <div class="form-group">
                    <label for="assetParking">Parking</label>
                    <input type="text" name="asset_praking" id="assetParking" class="form-control">
                  </div>

                  <!-- Asset Images -->
                  <div class="form-group">
                    <label for="assetImages">Upload Images</label>
                    <input type="file" name="asset_images[]" id="assetImages" class="form-control" multiple>
                  </div>

                  <!-- Submit Button -->
                  <button type="submit" class="btn btn-primary" name="add_assets">Submit</button>
                </form>

                <!-- adding assets to database start -->
                 <?php 
                  if (isset($_POST['add_assets'])) {

                      // Collect form data
                      $asset_title = mysqli_real_escape_string($connect, $_POST['asset_title']);
                      $asset_type = (int) $_POST['asset_type'];
                      $asset_price = (float) $_POST['asset_price'];
                      $asset_bedroom = isset($_POST['asset_bedroom']) ? (int) $_POST['asset_bedroom'] : 0;
                      $asset_bathroom = isset($_POST['asset_bathroom']) ? (int) $_POST['asset_bathroom'] : 0;
                      $asset_floor = isset($_POST['asset_floor']) ? (int) $_POST['asset_floor'] : 0;
                      $asset_area = mysqli_real_escape_string($connect, $_POST['asset_area']);
                      $asset_praking = mysqli_real_escape_string($connect, $_POST['asset_praking']);

                      // Handle image uploads
                      $asset_images = [];
                      if (!empty($_FILES['asset_images']['name'][0])) {
                          $upload_dir = "dist/img/uploads/";
                          foreach ($_FILES['asset_images']['tmp_name'] as $key => $tmp_name) {
                              $image_name = time() . "_" . basename($_FILES['asset_images']['name'][$key]);
                              $target_file = $upload_dir . $image_name;
                              if (move_uploaded_file($tmp_name, $target_file)) {
                                  $asset_images[] = $target_file;
                              }
                          }
                      }

                      // Convert images to comma-separated string
                      $asset_images_str = implode(",", $asset_images);

                      // SQL Insert Query
                      $sql = "INSERT INTO assets (
                                  asset_type, asset_title, asset_price, asset_bedroom, asset_area,
                                  asset_bathroom, asset_floor, asset_praking, asset_images, asset_created_at, asset_updated_at
                              ) VALUES (
                                  '$asset_type', '$asset_title', '$asset_price', '$asset_bedroom', '$asset_area',
                                  '$asset_bathroom', '$asset_floor', '$asset_praking', '$asset_images_str', NOW(), NOW()
                              )";

                      if (mysqli_query($connect, $sql)) {
                          header("Location: assets_manage.php");
                      } else {
                          echo "Error: " . mysqli_error($connect);
                      }
                  }

                ?>
                <!-- adding assets to database end -->


              
            </div>
            <!-- /.card-body -->
           </div>
            <!-- Add New Asset end -->

          </div>
          <div class="col-md-6">
             <?php

              // Fetch assets
              $query = "SELECT asset_id, asset_type, asset_price, asset_images FROM assets ORDER BY asset_id DESC";
              $result = mysqli_query($connect, $query);
              ?>

              <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                      <!-- Display First Image -->
                      <td>
                        <?php
                          $images = explode(",", $row['asset_images']);
                          $first_image = !empty($images[0]) ? $images[0] : 'photo1.png';
                        ?>
                        <img src="<?= $first_image ?>" alt="Asset Image" width="80" height="60" style="object-fit: cover;">
                      </td>

                      <!-- Display Asset Type -->
                      <td>
                        <?php
                          $types = [1 => 'Apartment', 2 => 'Villa', 3 => 'Penthouse'];
                          echo $types[$row['asset_type']] ?? 'Unknown';
                        ?>
                      </td>

                      <!-- Display Price -->
                      <td>$<?= number_format($row['asset_price'], 2) ?></td>

                      <!-- Edit/Delete Actions -->
                      <td>
                        <a href="assets_manage.php?edit_id=<?= $row['asset_id'] ?>" class="badge badge-warning">Edit</a>
                        <a href="assets_manage.php" data-toggle="modal" data-target="#delete_asset_modal<?php echo $row['asset_id'];  ?>" class="badge badge-danger">Delete</a>
                      </td>
                      <!-- delete asset modal start -->
                      <div class="modal fade" id="delete_asset_modal<?php echo $row['asset_id'];  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this Asset? </h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <a type="button" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                              <a  href="assets_manage.php?delete=<?php echo $row['asset_id'];  ?>" class="btn btn-primary" >Confirm</a>
                            </div>                           
                          </div>
                        </div>
                      </div>
                      <!-- delete asset modal end  -->
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>

              <!-- delete asset php code start -->
               <?php 
               if(isset($_GET['delete'])){
                $asset_delete_id = $_GET['delete'];

                $asset_delete_query = "DELETE FROM assets WHERE asset_id='$asset_delete_id'";

                $asset_delete_connect = mysqli_query($connect,$asset_delete_query);

                if($asset_delete_connect){
                  header("Location: assets_manage.php");
                }else{
                  die("DELETE FAILED". mysqli_error($connect));
                }
               }
               ?>
              <!-- delete asset php code end -->


          </div>
        </div>
      </div>
    </section>

   </div>
  <!-- Content Wrapper. Contains page content end  -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<!-- footer path included -->
<?php 
         
      include "inc/footer.php";

?>