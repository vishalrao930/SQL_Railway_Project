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
        <div class="card bg-light" >
            <article class="card-body mx-auto" style="width : 800px;">
            <?php 
                    
                $query = "select * from train_info;";
                $trains= mysqli_query($db,$query);
                if(mysqli_num_rows($trains)==0){
                    echo "<H2 class='text-center'> No Trains Available</H2>";
                }
                else{
                    echo "<H2 class='text-center'> Trains Available </H2>";
                    echo "<table class='table table-bordered table-striped m-2'>
                    <thead>
                    <tr>
                        <th scope='col'>#</th>
                        <th scope='col'>Train No.</th>
                        <th scope='col'>Source</th>
                        <th scope='col'>Destination</th>
                        <th scope='col'>Dep. Time</th>
                        <th scope='col'>Arr. Time</th>
                    </tr>
                    </thead> <tbody>";
                    for($i=1;$i<=mysqli_num_rows($trains);$i++)
                    {
                        $train=mysqli_fetch_assoc($trains);
                        
                        echo "<tr><th scope='row'>".$i."</th>";
                        echo "<td>".$train["train"]."</td>"."<td>".$train["fstation"]."</td><td>".$train["tstation"]."</td><td>".date("H:i",strtotime($train["startTime"]))."</td><td>".date("H:i",strtotime($train["endTime"]))."</td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
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