<?php include './functions.php';
    if(!isAdmin()){
        $_SESSION['success']="Ssh! Log In as Admin to access that page.";
        header('location: ./index.php');
    }
    
?>
<!doctype html>
<html lang="en">

  <?php
    $title = "Home Page";
    include('./includes/head.php');
    ?>
  <body>
    <!-- Navigation Bar -->
    <?php include('./includes/navbar.php'); ?>

    <div class="container mt-4">
        <div class="card bg-light">
            <article class="card-body mx-auto" style="width: 600px ;">
                <h4 class="card-title mt-3 text-center">Admin Actions</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">View Released Trains</h5>
                            <p class="card-text">Visit Here if you want to view the trains released into the system.</p>
                            <a href="viewreleased.php" class="btn btn-primary">View Trains</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Release a train</h5>
                            <p class="card-text">Visit here if you want to release a new train into the system.</p>
                            <a href="releasetrain.php" class="btn btn-primary">Release a Train</a>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-6">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">View Available Trains</h5>
                            <p class="card-text">Visit Here if you want to view available trains.</p>
                            <a href="admin_view_avbl.php" class="btn btn-primary">View Trains</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Register a new train</h5>
                            <p class="card-text">Visit here if you want to register a new train into the system.</p>
                            <a href="registertrain.php" class="btn btn-primary">Register a Train</a>
                        </div>
                        </div>
                    </div>
                </div>
                    
            </article>
        </div> 
    </div> 
   
    <div class="container">
        <?php include './includes/footer.php'; ?>
    </div>
    
  </body>
</html>