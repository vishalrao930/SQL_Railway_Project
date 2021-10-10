<?php include "./functions.php";?>
<!doctype html>
<html lang="en">

  <?php
    $title = "Home Page";
    include('./includes/head.php');
    ?>
  <body>
    <!-- Navigation Bar -->
    <?php
        include('./includes/navbar.php');
    ?>
    
    <main role="main">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="images/1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="images/2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="images/3.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="d-flex justify-content-center my-2"><?php
            if(isset($_SESSION['success'])){
            echo '<div class="alert alert-success">';
            echo $_SESSION['success'];
            echo "</div>";
            unset($_SESSION['success']);
        }
        
        ?></div>
    <div class="container my-4">
    <!-- Example row of columns -->
        <div class="row">
        <div class="col-md-4">
            <h2>Book Tickets</h2>
            <p>Select from the pool of available trains and book your tickets for the next journey. </p>
            <p><a class="btn btn-secondary" href="booktrain.php" role="button">Book Ticket &raquo;</a></p>
        </div>
        <div class="col-md-4">
        <?php
            if(isAdmin())
            echo '
                <h2>Admin</h2>
                <p>Visit here to view the functions related to administrative actions.</p>
                <p><a class="btn btn-secondary" href="admin.php" role="button">Admin Panel &raquo;</a></p>
                ';
        ?>
        </div>
        <div class="col-md-4">
            <h2>Ticket Details</h2>
            <p>View the details of the tickets. </p>
            <p><a class="btn btn-secondary" href="listtickets.php" role="button">Ticket Details &raquo;</a></p>
        </div>
        
        </div>

        <hr>

    </div> 
    </main>
    <?php include './includes/footer.php'?>

   

    
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    

  </body>
</html>