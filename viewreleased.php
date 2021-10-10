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
            <article class="card-body mx-auto" style="width: 400px;">
                <h4 class="card-title mt-3 text-center">View Trains</h4>
                <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
                <?php display_errors();?>
                    
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
                        </div>
                        <input name="date" class="form-control" placeholder="Date of Journey" type="date" title="Enter Release Date" value=<?php if(isset($_POST['date'])) echo $_POST['date'];?> required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block" name="view_trains">View</button>
                    </div>
                </form>
            </article>
        </div> 
    </div> 
    <div class="container mt-4">
        <div class="card bg-light" >
            <article class="card-body mx-auto" style="width : 800px;">
            <?php 
                if($_SERVER['REQUEST_METHOD']=="POST"){
                    // global $db;
                    $date = e($_POST['date']);
                    
                    $query = "select * from train where date=date('$date');";
                    $trains= mysqli_query($db,$query);
                    if(mysqli_num_rows($trains)==0){
                        echo "<H2 class='text-center'> No Trains Available for $date</H2>";
                    }
                    else{
                        echo "<table class='table table-bordered table-striped m-2'>
                        <thead>
                        <tr>
                            <th scope='col'>#</th>
                            <th scope='col'>Train No.</th>
                            <th scope='col'># of AC</th>
                            <th scope='col'># of Sleeper</th>
                        </tr>
                        </thead> <tbody>";
                        for($i=1;$i<=mysqli_num_rows($trains);$i++)
                        {
                            $train=mysqli_fetch_assoc($trains);
                            echo "<tr><th scope='row'>".$i."</th>";
                            echo "<td>".$train["train"]."</td>"."<td>".$train["ac"]."</td><td>".$train["sleeper"]."</td>";
                            echo "</tr>";
                        }
                        echo "</tbody></table>";
                    }
                }
            ?>
            </article>
        </div> 
    </div> 
    
    <div class="container">
        <?php include './includes/footer.php'; ?>
    </div>
    
  </body>
</html>