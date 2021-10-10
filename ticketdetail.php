<?php include 'functions.php';
    if(!isset($_SESSION['user'])){
        $_SESSION['success']="You must log in first.";
        header('location: location.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php
    $title="Ticket Detail";
    include './includes/head.php';?>
<body>
<?php include './includes/navbar.php';?>
    <main role="main">
        <div class="row my-4">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="container"><?php
                $user_id= $_SESSION['user']['id'];
                // echo $_GET['tktpnr'];
                $pnr_query=$_GET['tktpnr'];
                $query="SELECT * from ticket where booked_by=$user_id and pnr=$pnr_query order by pnr desc";
                $tickets=mysqli_query($db,$query);
                // $tickets=array();
                if(mysqli_num_rows($tickets)==0){
                    echo '<h1>No Such Ticket booked by this account.</h1>';
                }
                else{
                    $ticket=mysqli_fetch_assoc($tickets);
                    $coach='';
                    if($ticket['coach_type']=='A')$coach="Air Conditioned-AC";
                    else $coach="Sleeper-SL";
                    $query="SELECT * from train_info where train=".$ticket['train_number'];
                    $trains=mysqli_query($db,$query);
                    $train=mysqli_fetch_assoc($trains);
                    // var_dump($train);
                    echo '<div class="card m-2">
                    <div class="card-header">
                      Ticket Details
                    </div>
                    <div class="card-body">
                      
                      <p class="card-text">Date of Journey : '.$ticket['date'].'</p><p class="card-text">Coach Type : '.$coach.'</p>
                      <p class="card-text">Start Time : '.date('H:i',strtotime($train['startTime'])).'</p><p class="card-text">Journey Finishes at : '.date('H:i',strtotime($train['endTime'])).'</p>
                    </div>
                    <div class="card-body">
                      <h6 class="card-title"> Train Number:'.$ticket['train_number'].'</h6>
                      <p class="card-text">Depart From :'.$train['fstation'].'</p><p class="card-text">Arrival at : '.$train['tstation'].'</p>
                    </div>
                  </div>';
                  $query='Select * from passenger where pnr='.$_GET['tktpnr'];
                  $passengers=mysqli_query($db,$query);
                    // var_dump($passengers);
                    echo '<H3 class="text-center">Passenger Details</h3>';
                    echo "<table class='table table-bordered table-striped'>
                    <thead>
                      <tr>
                        <th scope='col'>#</th>
                        <th scope='col'>Name.</th>
                        <th scope='col'>Age</th>
                        <th scope='col'>Gender</th>
                        <th scope='col'> Seat Number </th>
                        <th scope='col'> Coach Number </th>
                        <th scope='col'> Seat Type </th>
                      </tr>
                    </thead> <tbody>";
                for($i=1;$i<=mysqli_num_rows($passengers);$i++)
                {
                    $passenger=mysqli_fetch_assoc($passengers);
                    echo "<tr><th scope='row'>".$i."</th>";
                    echo "<td>".$passenger["p_name"]."</td>"."<td>".$passenger['p_age']."</td><td>".$passenger["p_gender"]."</td>";
                    echo "<td>".$passenger['seat_number']."</td>";
                    echo "<td>".$passenger['coach_number']."</td>";
                    echo "<td>".$passenger['seat_type']."</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
                
                }
                ?></div>
            </div>
        </div>
    </main>
    <?php include "./includes/footer.php";?>
</body>
</html>