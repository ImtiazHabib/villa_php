<?php 
 include "inc/auth/header.php";
?>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Villa</b>by Imtiaz</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="" method="POST">

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="user_name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="user_email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="user_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="user_retype_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input type="submit" class="btn btn-primary btn-block" value="Register" name="register">
          </div>
          <!-- /.col -->
        </div>

      </form>

      <!-- php code for user register start  -->
       <?php 
        if(isset($_POST['register'])){
          $user_name = mysqli_real_escape_string($connect,$_POST['user_name']);
          $user_email = mysqli_real_escape_string($connect,$_POST['user_email']);
          $user_password = mysqli_real_escape_string($connect,$_POST['user_password']);
          $user_password_retyped = mysqli_real_escape_string($connect,$_POST['user_retype_password']);

          if($user_password == $user_password_retyped){
               $hasspassword = sha1($user_password);
               $inset_user_sql = "INSERT into  users (user_name,user_password,user_email) VALUES ('$user_name','$hasspassword','$user_email')";
               $insert_user_data = mysqli_query($connect,$inset_user_sql);

                  if($insert_user_data)
                  {
                    header("Location: index.php");
                  }
                  else{
                    
                    die("Registration falied " . mysqli_error($connect));
                  }
          }else{
            echo "Enter Valid Password";
          }
        }
       ?>
      <!-- php code for user register end  -->
      <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="index.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
<?php 

include "inc/auth/footer.php";

?>
