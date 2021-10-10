<?php include './functions.php';
    if(!isLoggedIn()){
        $_SESSION['success']="You must log in first";
        header('location: ./login.php');
    }
    if(isset($_POST['Book'])){
        book();
    }
    function Book(){
        global $db,$errors;
        $train=e($_POST['train']);
        $date=e($_POST['date']);
        $date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
        // echo $date;
        $passengers = ($_POST['passengers']);
        $numPas=e($_POST['numPas']);
        $query="SELECT * FROM train WHERE train='$train' and date=date('$date');";
        $rec=mysqli_query($db,$query);
        $coach_type=$_POST['coach_type'];
        if(mysqli_num_rows($rec)==1){
            // echo "Train Found";
            //Insert logic for train addition here by checking available seats
            $user_id=$_SESSION['user']['id'];
            $query="INSERT INTO ticket(booked_by,train_number,date,coach_type,num_passengers) values($user_id,$train,"."'$date','$coach_type',$numPas);";
            if(mysqli_query($db,$query)){
                $details = array();
                $pnr = $db->insert_id;
                foreach ($passengers as $passenger)
                {
                    $i = 0;
                    foreach ($passenger as $x){
                        $details[$i] = $x;
                        $i = $i + 1;
                    }
                    $insertPassenger = "CALL insertPassenger($pnr, '$coach_type', '$details[0]', $details[1], '$details[2]')";
                    // echo $insertPassenger;
                    if(!mysqli_query($db, $insertPassenger)){
                        print_r($db->error);
                        // echo "<script>console.log('$db->error')</script>";
                    }
                }
                header('location: ticketdetail.php?tktpnr='.$pnr);
            }
            else {
                array_push($errors,$db->error);
            }
        }
        else{
            array_push($errors,"No such train found.");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php 
$title='Book Ticket';
include('./includes/head.php');
?>
<body>
    <?php include('./includes/navbar.php');?>
    <div class="container mt-1">
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Book a Ticket</h4>
                <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post" id="bookingForm">
                <?php display_errors();?>
                    
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-train"></i> </span>
                        </div>
                        <input name="train" class="form-control" placeholder="Train No." type="number" min=0 required value=<?php if(isset($_GET['train_no']))echo $_GET['train_no']?>>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
                        </div>
                        <input name="date" class="form-control" placeholder="Date of Journey" type="date" min=<?php echo date('Y-m-d',strtotime('+1 day',strtotime(date('Y-m-d'))));?> max=<?php 
                        echo date('Y-m-d',strtotime('+2 months',strtotime(date('Y-m-d'))));?> required value=<?php if(isset($_GET['doj']))echo $_GET['doj']?>>
                    </div>
                    <div class="form-group input-group">
                        <input type="hidden" name="numPas" id="count" value="1" >
                    </div>
                    <div class="form-group input-group">
                        <label for="CoachType">Coach Type </label>
                        <select name="coach_type" class='form-control mx-2' placeholder="coach_type" id="CoachType">
                            <option value="S">Sleeper-SL</option>
                            <option value="A">Air Conditioned-AC</option>
                        </select>
                    </div>
                    <div class="form-group input-group">
                        <div class="fieldset">
                            <div class="form-row ">
                                <div class="col-5">
                                    <input type="text" class="form-control mb-2"  placeholder="Full Name" name="passengers[0]['name']" required>
                                </div>
                                <div class="col-4">
                                    <input type="number" min=0 class="form-control mb-2" name="passengers[0]['age']" placeholder="Age" required>
                                </div>
                                <div class="col-3">
                                    <select name="passengers[0]['gender']"  class="form-control mb-2" placeholder="Gender">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        <option value="N">Prefer Not Say</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>                          
                    <!-- <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Book!  </button>
                    </div> form-group//       -->
                </form>
                <div class="row m-2">
                    <div class="col">
                    <button class="btn btn-outline-primary btn-block" id="addPass">
                        Add One
                    </button>
                    </div>
                    <div class="col">
                    <button class="btn btn-outline-warning btn-block" id="removePass">
                        Remove Last
                    </button>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" form="bookingForm" formaction=<?php echo $_SERVER['PHP_SELF'];?> formmethod="post" class="btn btn-info btn-block" name="Book">Book!</button>
                </div>
            </article>
        </div> 
    </div> 
    <!-- <?php print_r($_POST);?> -->
    <?php include('./includes/footer.php');?>
<script src="./assets/booking.js"></script>
</body>
</html>