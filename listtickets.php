<?php include 'functions.php';
    if(!isset($_SESSION['user'])){
        $_SESSION['success']="You must log in first.";
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php
    $title="List Tickets";
    include './includes/head.php';?>
<body>
<?php include './includes/navbar.php';?>
    <main role="main">
        <div class="row my-4">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="container"><?php
                $user_id= $_SESSION['user']['id'];
                $query="SELECT * from ticket where booked_by=$user_id order by pnr desc";
                $tickets=mysqli_query($db,$query);
                // $tickets=array();
                if(mysqli_num_rows($tickets)==0){
                    echo '<h1>No tickets booked so far!!</h1>';
                }
                else{
                    echo '<H2 class="text-center"> Tickets Booked by You: </H2>';
                    echo "<table class='table table-bordered table-striped'>
                    <thead>
                      <tr>
                        <th scope='col'>PNR</th>
                        <th scope='col'>Train No.</th>
                        <th scope='col'>Date of Journey</th>
                        <th scope='col'>Number of passengers</th>
                        <th scope='col'> Details </th>
                        <th scope='col'> Booked On </th>
                      </tr>
                    </thead> <tbody>";
                foreach($tickets as $ticket)
                {
                    echo "<tr><th scope='row'>".$ticket['pnr']."</th>";
                    echo "<td>".$ticket["train_number"]."</td>"."<td>".$ticket["date"]."</td><td>".$ticket["num_passengers"]."</td>";
                    echo "<td><a class='btn btn-outline-dark btn-sm' href='ticketdetail.php?tktpnr=".$ticket['pnr']."'> View </a></td>";
                    echo '<td>'.date('d-m-Y H:i',strtotime($ticket['booked_on'])).'</td>';
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