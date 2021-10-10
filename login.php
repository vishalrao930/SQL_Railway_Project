<?php include 'functions.php';
    if(isset($_SESSION['user'])) header('location: ./index.php');
?>
<!doctype html>
<html lang="en">
    <?php
        $title = "Login";
        include('./includes/head.php');
    ?>
  <body>
    <?php
        include('./includes/navbar.php');
    ?>
    <div class="container mt-1">
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Log In to your Account</h4>
                <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
                    <?php display_errors();?>
                    <div class="d-flex justify-content-center my-2"><?php
                        if(isset($_SESSION['success'])){
                        echo '<div class="alert alert-success">';
                        echo $_SESSION['success'];
                        echo "</div>";
                        unset($_SESSION['success']);
                    }        ?></div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="email" class="form-control" placeholder="Email address" type="email">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input name="password" class="form-control" placeholder="Password" type="password">
                    </div> <!-- form-group// -->                                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="LogIn">Log In</button> 
                    </div> <!-- form-group// -->      
                    <p class="text-center">Need an account? <a href="./register.php">Register</a> </p>                                                                 
                </form>
            </article>
        </div> 
    </div> 
  

</body>
</html>