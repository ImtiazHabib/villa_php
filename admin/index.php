
<?php 
 include "inc/auth/header.php";
?>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Villa</b>by Imtiaz</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="POST">
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
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input type="submit" name="login" class="btn btn-primary btn-block" value="Sign In">
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- php login code start -->
       <?php 
        if(isset($_POST['login'])){
          $user_email = mysqli_real_escape_string($connect,$_POST['user_email']);
          $user_password_not_hased = mysqli_real_escape_string($connect,$_POST['user_password']);

          $user_password=sha1($user_password_not_hased);

          $search_sql = "SELECT * FROM users where user_email='$user_email' AND user_password='$user_password'";
          $search_query = mysqli_query($connect,$search_sql);

          while($row=mysqli_fetch_assoc($search_query)){
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['user_name'];
            $user_email_db = $row['user_email'];
            $user_password_db = $row['user_password'];
            $_SESSION['user_profile_pic'] = $row['user_profile_pic'];
            $_SESSION['user_role'] = $row['user_role'];
            $_SESSION['user_status'] = $row['user_status'];

            // checking user is valid or not 
            if($user_email == $user_email_db && $user_password == $user_password_db){
              $_SESSION['user_email'] = $user_email;
              $_SESSION['user_password'] = $user_password;
              header("Location: dashboard.php");
            }else{
              header("Location: index.php");
            }
          }
        }

        ?>
      <!-- php login code end -->
       
      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
<?php 

include "inc/auth/footer.php";

?>
