<?php include("./functions.php");
    if(isset($_SESSION['user'])) header('location: ./index.php');
?>
<!doctype html>
<html lang="en">
    <?php
        $title = "Register";
        include('./includes/head.php');
    ?>
  <body>
    <?php
        include('./includes/navbar.php');
    ?>

<div class="container mt-1">

<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">Create Account</h4>
	<form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
    <?php display_errors();?>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="username" class="form-control" placeholder="Name" type="text">
        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
            </div>
            <input name="email" class="form-control" placeholder="Email address" type="email">
        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
            </div>
            <!-- <select class="custom-select" style="max-width: 75px;">
                <option selected="">+91</option>
                <option value="1">+921</option>
                <option value="2">+971</option>
                <option value="3">+1</option>
            </select> -->
            <input name="number" class="form-control" placeholder="Phone number" type="text">
        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input name="password" class="form-control" placeholder="Create password" type="password">
        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input name="confirm_password" class="form-control" placeholder="Repeat password" type="password">
        </div> <!-- form-group// -->                                      
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="Register"> Create Account  </button>
        </div> <!-- form-group// -->      
        <p class="text-center">Have an account? <a href="./login.php">Log In</a> </p>                                                                 
    </form>
</article>
</div> <!-- card.// -->

</div> 

<!--container end.//-->
    <?php include './includes/footer.php'?>

</body>
</html>