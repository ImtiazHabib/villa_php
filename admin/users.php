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
            <h1 class="m-0">All Users information's</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- php code start here  -->
    <?php 
     $do = isset($_GET['do'])? $_GET['do'] : "Manage";

     if($do == "Manage"){
      // Manage Code start here
      ?>
         <!-- All user information table start here  -->
                <section class="content">
                  <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                      <div class="col-12">
                        <div class="card card-success">
                          <div class="card-header">
                            <h3 class="card-title">Users Information</h3>
                          </div>
                          <div class="card-body">
                              <table class="table .table-striped .table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">#SL</th>
                                    <th scope="col">Avater</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <!-- reading data from db for all user information php start here   -->
                                   <?php 
                                        
                                        $all_user_data_query = "SELECT * FROM users";

                                        $all_user_data = mysqli_query($connect,$all_user_data_query);
                                        
                                        $i=0;
                                        while($row = mysqli_fetch_assoc($all_user_data))
                                        {
                                          $user_id        = $row['user_id'];
                                          $user_name      = $row['user_name'];
                                          $user_password  = $row['user_password'];
                                          $user_email     = $row['user_email'];
                                          $user_phone     = $row['user_phone'];
                                          $user_address   = $row['user_address'];
                                          $user_role      = $row['user_role'];
                                          $user_profile_pic     = $row['user_profile_pic'];
                                          $i++;
                                          ?>

                                          <tr>
                                            <th scope="row"><?php  echo $i; ?></th>
                                            <td>
                                              <?php 

                                                   if(empty($user_profile_pic))
                                                   {
                                                    ?>

                                                     <img src="dist/img/users/default.png" width="30" >

                                                    <?php
                                                   }
                                                   else
                                                   {
                                                    ?>
                                                     <img src="dist/img/users/<?php echo $user_profile_pic; ?>" width="30" >
                                                    <?php
                                                   }
                                              ?>

                                            </td>
                                            <td><?php  echo $user_name; ?></td>
                                            <td><?php  echo $user_email; ?></td>
                                            <td>

                                                    <?php

                                                         if(empty($user_phone))
                                                         {
                                                         ?>

                                                            <span>Empty</span>

                                                          <?php
                                                         }
                                                         else
                                                         {
                                                          ?>
                                                              
                                                              <span><?php  echo $user_phone; ?></span> 

                                                        <?php
                                                         } 
                                                    ?>



                                              </td>

                                            <td>

                                                    <?php

                                                         if(empty($user_address))
                                                         {
                                                         ?>

                                                            <span>Empty</span>

                                                          <?php
                                                         }
                                                         else
                                                         {
                                                          ?>
                                                              
                                                              <span><?php  echo $user_address; ?></span> 

                                                        <?php
                                                         } 
                                                    ?>
                                                


                                              </td>
                                            <td>
                                               <?php

                                               if($user_role ==1)
                                               {
                                                ?>

                                                <span class="badge badge-success">Admin</span>

                                                <?php
                                               }
                                               else if($user_role ==2)
                                               {
                                                ?>
                                                
                                                <span class="badge badge-warning">Users</span>

                                                <?php
                                               }
                                               ?>
                                            </td>

                                            <td> 
                                              <div class="btn-group">
                                                <a href="users.php?do=Edit&edit_id=<?php echo $user_id; ?>">
                                                  <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="users.php" data-toggle="modal" data-target="#delete_user_modal<?php echo $user_id;  ?>" >
                                                  <i class="fas fa-trash"></i>
                                                </a>

                                                <!-- delete user modal start -->
                            <div class="modal fade" id="delete_user_modal<?php echo $user_id;  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this User? </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <a type="button" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                                    <a  href="users.php?do=Delete&delete_id=<?php echo $user_id;  ?>" class="btn btn-primary" >Confirm</a>
                                  </div>                           
                                </div>
                              </div>
                            </div>
                            <!-- delete user  modal end  -->
                                              </div>
                                            </td>
                                          </tr>


                                      <?php                                    
                                        }
                                   ?>
                                  <!-- reading data from db for all user information php end here  -->                         
                                </tbody>
                              </table>                      
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <a href="users.php?do=Add" class="btn btn-primary btn-block">Add New User</a>
                      </div>
                    </div>
                  </div>
                </section>
              <!-- All user information table end  here  -->
               <?php
      // Manage Code end here
     }elseif($do == "Add"){
      // Add Code start here
      ?>
      <!--  // add user form start -->
               <section class="content">
                  <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                      <div class="col-12">
                        <div class="card card-success">
                          <div class="card-header">
                            <h3 class="card-title">Register New User</h3>
                          </div>
                          <div class="card-body">
                            <form action="users.php?do=Insert" method="POST" enctype="multipart/form-data">

                              <div class="row">
                               <div class="col-sm-6">

                                  <div class="form-group">
                                    <label for="Fullname">Name</label>
                                    <input type="text" name="user_name" class="form-control" id="Fullname" required="required" >
                                  </div>


                                  <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" name="user_email" class="form-control" id="Email" >
                                  </div>

                                  <div class="form-group">
                                    <label for="Phone">Phone</label>
                                    <input type="text" name="user_phone" class="form-control" id="Phone" >
                                  </div>
                              </div> 

                              <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="Password">Password</label>
                                        <input type="password" name="user_password" class="form-control" id="Password" required="required" >
                                    </div>

                                    <div class="form-group">
                                        <label for="Re-Password">Retype Password</label>
                                        <input type="password" name="user_password_retyped" class="form-control" id="Re-Password"  required="required" >
                                    </div>

                                    <div class="form-group">
                                      <label for="Address">Address</label>
                                      <input type="text" name="user_address" class="form-control" id="Address" >
                                    </div>

                                  <div class="form-group">
                                     <label for="Role">Role</label>
                                        <select  name="user_role" class="form-control" id="Role">
                                          <option value="0" selected="selected" >Please select User Role</option>
                                          <option value="1">Admin</option>
                                          <option value="2">User</option>
                                           
                                        </select>
                                  </div>

                                  <div class="form-group">
                                    <label for="">Profile Picture</label>
                                    <input type="file" name="user_profile_pic" class="form-control-file">
                                  </div>

                                  <div class="form-group">
                                    <input type="submit" name="register" class="btn btn-primary" value="Submit">
                                  </div>

                                
                              </div>

                              </div>                      
                            </form>
                          </div> 
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              <!-- // add user form end  -->
      <?php
      // Add Code end here
     }elseif($do == "Insert"){
      // Insert Code start here
        if(isset($_POST['register']))
              {
                $user_name      = $_POST['user_name'];
                $user_email     = $_POST['user_email'];
                $user_phone     = $_POST['user_phone'];
                $user_address   = $_POST['user_address'];
                $user_role      = $_POST['user_role'];


                $user_password  = $_POST['user_password'];
                $user_password_retyped  = $_POST['user_password_retyped'];

                //store image with image name
                $image       = $_FILES['user_profile_pic']['name'];

                //name of temp file where image is temporary stored
                  $image_tmp = $_FILES['user_profile_pic']['tmp_name'];

               

                if($user_password == $user_password_retyped)
                {
                  $hasspassword = sha1($user_password);

                  $imageRandom = rand(0, 9999999);

                   $image_name = $imageRandom.$image;

                   //move image to destination file
                   move_uploaded_file($image_tmp,"dist/img/users/" . $image_name);

                  $insert_user_query = "INSERT INTO users (user_name,user_password,user_email,user_phone,user_address,user_role,user_profile_pic) VALUES ('$user_name','$hasspassword','$user_email','$user_phone','$user_address','$user_role','$image_name')";

                  $insert_user_data = mysqli_query($connect,$insert_user_query);

                  if($insert_user_data)
                  {
                    header("Location: users.php?do=Manage");
                  }
                  else{
                    
                    die("Insertion falied " . mysqli_error($connect));
                  }
                }

              }
      // Insert Code end here
     }elseif($do == "Edit"){
      // Edit Code start here
       $edit_user_id = $_GET['edit_id'];

              $edit_user_id_query = "SELECT * FROM users WHERE user_id='$edit_user_id'";

              $edit_user_id_data = mysqli_query($connect,$edit_user_id_query);


              while($row = mysqli_fetch_array($edit_user_id_data))
              {          
                 $user_name      = $row['user_name'];
                 $user_password  = $row['user_password'];
                  $user_email     = $row['user_email'];
                 $user_phone     = $row['user_phone'];
                   $user_address   = $row['user_address'];
                   $user_role      = $row['user_role'];
                   $user_profile_pic     = $row['user_profile_pic'];

                   ?>

                   <!-- edit user form  start here  -->
                   <section class="content">
                  <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                      <div class="col-12">
                        <div class="card card-success">
                          <div class="card-header">
                            <h3 class="card-title">Edit User Information</h3>
                          </div>
                          <div class="card-body">
                            <form action="users.php?do=Update" method="POST" enctype="multipart/form-data">

                              <div class="row">
                               <div class="col-sm-6">

                                  <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input type="text" name="user_name" class="form-control" id="Username" value="<?php echo $user_name ?>"  >
                                  </div>

                                  <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" name="user_email" class="form-control" id="Email" value="<?php echo $user_email ?>" >
                                  </div>

                                  <div class="form-group">
                                    <label for="Phone">Phone</label>
                                    <input type="text" name="user_phone" class="form-control" id="Phone" value="<?php echo $user_phone ?>" >
                                  </div>
                              </div> 

                              <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="Password">Password</label>
                                        <input type="password" name="user_password" class="form-control" id="Password"   placeholder="*********">
                                    </div>

                                    <div class="form-group">
                                        <label for="Re-Password">Retype Password</label>
                                        <input type="password" name="user_password_retyped" class="form-control" id="Re-Password"     placeholder="********" >
                                    </div>

                                    <div class="form-group">
                                      <label for="Address">Address</label>
                                      <input type="text" name="user_address" class="form-control" id="Address" value="<?php echo $user_address ?>" >
                                    </div>

                                  <div class="form-group">
                                     <label for="Role">Role</label>
                                        <select  name="user_role" class="form-control" id="Role">
                                          <option value="1" <?php if($user_role == 1){ echo "selected"; } ?> >Admin</option>
                                          <option value="2"  <?php if($user_role == 2){ echo "selected"; } ?> >User</option>
                                           
                                        </select>
                                  </div>

                                  <div class="form-group">

                                    <!-- check user has image or not  -->
                                    <?php 

                                    if(!empty($user_profile_pic))
                                    {
                                      ?>

                                      <img src="dist/img/users/<?php echo $user_profile_pic ?>" width="80" alt="">

                                      <?php
                                    }
                                    else{
                                      ?>

                                      <img src="dist/img/users/avatar.png"  width="80" alt="">
                                       
                                      <?php
                                    }

                                    ?>
                                    </br>
                                    <label for="">Profile Picture</label>
                                    <input type="file" name="user_profile_pic" class="form-control-file">
                                  </div>

                                  <div class="form-group">
                                    <!-- hidden input for update id  -->
                                    <input type="hidden" name="update" value="<?php echo $edit_user_id ?>" >
                                    <input type="submit" name="save" class="btn btn-primary" value="Update">
                                  </div>

                                
                              </div>

                              </div>                      
                            </form>
                          </div> 
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                   <!-- edit user form end here  -->
       <?php
              }


      // Edit Code end here
     }elseif($do == "Update"){
      // Update Code start here
       if($_POST['update'])
               {
                  $update_user_id = $_POST['update'];
                $user_name      = $_POST['user_name'];
                $user_email     = $_POST['user_email'];
                $user_phone     = $_POST['user_phone'];
                $user_address   = $_POST['user_address'];
                $user_role      = $_POST['user_role'];


                $user_password  = $_POST['user_password'];
                $user_password_retyped  = $_POST['user_password_retyped'];

                //store image with image name
                $image       = $_FILES['user_profile_pic']['name'];

                //name of temp file where image is temporary stored
                  $image_tmp = $_FILES['user_profile_pic']['tmp_name'];

                  // if password change
                  if(!empty($user_password))
                  {
                    if($user_password == $user_password_retyped)
                    {
                      // encryption
                      $hasspassword = sha1($user_password);

                      // update password sql
                      $update_user_password_query = "UPDATE users SET user_password = '$hasspassword' WHERE user_id='$update_user_id'";

                      $update_user_password = mysqli_query($connect,$update_user_password_query);

                      if($update_user_password)
                      {
                        header("Location: users.php?do=Manage");
                      }
                      else{

                        die("update User Password failed " . mysqli_error($connect));
                      }

                    }
                  }

                  // if image changes 

                  if(!empty($image))
                  {
                    // remove old image start
                    $remove_image_query ="SELECT * FROM users WHERE user_id='$update_user_id'";
                      $remove_image_data = mysqli_query($connect,$remove_image_query);
                       while($row = mysqli_fetch_assoc($remove_image_data))
                              {
                                   $remove_image = $row['user_profile_pic'];
                                    unlink("dist/img/users/" .$remove_image);
                             }
                     // remove old image end 
                    
                    $image_random_number = rand(0,9999999);

                    $image_file = $image_random_number.$image;

                    move_uploaded_file($image_tmp,"dist/img/users/".$image_file);

                    $update_image_query = "UPDATE users SET user_name='$user_name', user_password='$user_password',  user_email='$user_email', user_phone='$user_phone', user_address='$user_address', user_role='$user_role', user_profile_pic='$image_file' WHERE user_id='$update_user_id'";

                    $update_image = mysqli_query($connect,$update_image_query);
                    
                     if($update_image)
                      {
                        header("Location: users.php?do=Manage");
                      }
                      else{

                        die("update User Password failed " . mysqli_error($connect));
                      }

                  }
                  else{
                       
                       $update_user_query = "UPDATE users SET user_name='$user_name',  user_email='$user_email', user_phone='$user_phone', user_address='$user_address', user_role='$user_role'  WHERE user_id='$update_user_id'";

                    $update_user = mysqli_query($connect,$update_user_query);
                    
                     if($update_user)
                      {
                        header("Location: users.php?do=Manage");
                      }
                      else{

                        die("update User Password failed " . mysqli_error($connect));
                      }

                  }


               }
      // Update Code end here
     }elseif($do == "Delete"){
      // Delete Code start here
         $user_delete_id = $_GET['delete_id'];
         
         $user_delete_sql= "DELETE FROM users WHERE user_id='$user_delete_id'";

         $user_delete_query = mysqli_query($connect,$user_delete_sql);

         if($user_delete_query){
          header("Location: users.php?do=Manage");
         }else{
           die("update User delete failed " . mysqli_error($connect));
         }

      // Delete Code end here
     }
    ?>
    <!-- php code end here  -->


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">

          </div>
        </div>
      </div>
    </section>
    <!-- Main content  end -->


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