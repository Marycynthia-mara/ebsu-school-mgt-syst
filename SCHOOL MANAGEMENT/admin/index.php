<?php 
require_once 'inc/config.inc.php';

if (isset($_SESSION['user_id'])) {
    redirect_to("dashboard.php");
}

if (isset($_POST['SignIn'])) {
        $result = login_user($_POST);

    if ($result === true) {
        redirect_to('dashboard.php');
    }else {
        $errors = $result;
            foreach ($errors as $error) {
                // echo "$error" . "<br>"; 
            }} }?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Slim">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/slim/img/slim-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/slim">
    <meta property="og:title" content="Slim">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Sign Up</title>

    <!-- Vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <!-- Slim CSS -->
    <link rel="stylesheet" href="css/slim.css">

  </head>
  <body>

    <div class="signin-wrapper">

      <div class="signin-box">
        <h2 class="slim-logo"><a href="index.php">EBSU Login<span>.</span></a></h2>
        <h2 class="signin-title-primary">Welcome back!</h2>
        <h3 class="signin-title-secondary">Sign in to continue.</h3>

       <form action="#" method="post">
<div class="form-group ">
    <input type="text" name="user_logger" placeholder="Reg No / Username" value="<?php if (isset($user_logger)) {
                    echo $user_logger;
                } ?>" class="form-control";
            >
</div>

<div class="form-group "> 
    <input type="password" name="user_password" placeholder="Password" value="<?php if (isset($user_password)) {
                    echo $user_password;
                } ?>" class="form-control">
</div>
    <div class="input-group mb-3 mul-input" >
        <div class="input-group-prepend" >
            <label class="input-group-text" for="users_category_signin">Select category</label>
        </div>
        <select class="custom-select <?php if (isset($errors['login_category'])) {
                echo "error";
            } ?>" id="users_category_signin" name="login_category" value="<?php if (isset($login_category)) {
                    echo $login_category;
                } ?>">
            <option disabled="" selected="">choose...</option>
            <option value="student">Student</option>
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <div class="tp">
        <button class="btn btn-primary btn-block btn-signin" value="Sign In" id="SignIn" type="submit" name="SignIn">Sign In</button>
    </div>

    <?php 
        if (isset($errors)) { 
            foreach ($errors as $error) {  ?>

            <div class="form-group alert alert-danger noti-bar"> <?php echo $error; ?></div>
            
        <?php } } ?>
</form>
        <!-- <p class="mg-b-0">Don't have an account? <a href="signup.php">Sign Up</a></p> -->
      </div><!-- signin-box -->

    </div><!-- signin-wrapper -->

    <script src="lib/jquery/js/jquery.js"></script>
    <script src="lib/popper.js/js/popper.js"></script>
    <script src="lib/bootstrap/js/bootstrap.js"></script>

    <script src="js/slim.js"></script>

  </body>
</html>
