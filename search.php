<?php include './functions.php';
    if(!isLoggedIn()){
        $_SESSION['success']="You must log in first";
        header('location: ./login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php 
$title='Search Train';
include('./includes/head.php');
?>
<body>
    <?php include './includes/navbar.php';?>
    <div class="container">
        <h1 class="text-center">Search Trains</h1>
        <div class="row m-2" >
            <div class="col-4" >
                
                <div class="container-fluid border border-dark bg-light m-1" style="height:20em;">
                <h3 class="text-center">Journey Details</h3>
                    <form class='m-1' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <?php display_errors();?>
                    
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-play"></i> </span>
                            </div>
                            <input name="src" class="form-control" placeholder="Source" type="text" title="Source Station" required value=<?php if(isset($_POST['src'])) echo $_POST['src'];?> >
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-ban"></i> </span>
                            </div>
                            <input name="dest" class="form-control" placeholder="Destination" type="text" title="Destination Station" required value=<?php if(isset($_POST['dest'])) echo $_POST['dest'];?>>
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
                            </div>
                            <input name="date" class="form-control" placeholder="Date of Journey" type="date" min=<?php echo date('Y-m-d',strtotime('+1 day',strtotime(date('Y-m-d'))));?> max=<?php 
                            echo date('Y-m-d',strtotime('+2 months',strtotime(date('Y-m-d'))));?> required value=<?php if(isset($_POST['date'])) echo $_POST['date'];?>>
                        </div>
                    <input type="submit" class="btn btn-outline-info" value="Submit" name="Search">
                    </form>
                </div>
            </div>
            <div class="col-8">
                <div class="container-fluid bg-light m-1 border border-dark" style="height:40em;overflow-y:scroll;">
                    <?php
                        if(isset($_POST['Search'])){
                            search();
                        }
                        function search(){
                            global $db,$errors;
                            $src=e($_POST['src']);
                            $dest=e($_POST['dest']);
                            $doj=e($_POST['date']);
                            $query="SELECT * from train,train_info where train.train=train_info.train and fstation='$src' and tstation='$dest' and date='$doj'";
                            $trains=mysqli_query($db,$query);
                            if(mysqli_num_rows($trains)==0){
                                echo "<h1 class='text-center'> No Trains Found </h1>";
                            }
                            else{
                                echo "<table class='table table-bordered table-striped m-2'>
                                    <thead>
                                    <tr>
                                        <th scope='col'>Train No.</th>
                                        <th scope='col'>Departs at</th>
                                        <th scope='col'>Arrives at</th>
                                        <th scope='col'> Book </th>
                                    </tr>
                                    </thead> <tbody>";
                                foreach($trains as $train)
                                {
                                    echo "<tr><th scope='row'>".$train['train']."</th>";
                                    echo '<td>'.date('d-m-Y H:i',strtotime($train['startTime'])).'</td>';
                                    echo '<td>'.date('d-m-Y H:i',strtotime($train['endTime'])).'</td>';
                                    echo "<td><a class='btn btn-outline-dark btn-sm' href='booktrain.php?train_no=".$train['train']."&doj=".$doj."'> Book </a></td>";
                                    echo "</tr>";
                                }
                                echo "</tbody></table>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php include('./includes/footer.php');?>
<script src="./assets/booking.js"></script>
</body>
</html>
