<?php include './functions.php';
    if(!isAdmin()){
        $_SESSION['success']="Ssh! Log In as Admin to access that page.";
        header('location: ./index.php');
    }
    
    if(isset($_POST['Register_Train'])){
        register_train();
    }
    function register_train(){
        global $errors, $db;
        $train_no = e($_POST['train']);
        $src = e($_POST['source']);
        $dest = e($_POST['dest']);
        $startTime = e($_POST['startTime']);
        $endTime =e($_POST['endTime']);
        if (empty($train_no)) { 
            array_push($errors, "Train Number is required"); 
        }
        if (empty($src)) { 
            array_push($errors, "Source station is required"); 
        }
        if (empty($dest)) { 
            array_push($errors, "Destination station is required"); 
        }
        if (empty($startTime)) { 
            array_push($errors, "Start Time is Required"); 
        }
        if(empty($endTime)){
            array_push($errors,"End Time is required");
        }
        if(count($errors)==0){
            $insert_query = "INSERT INTO train_info
                     VALUES ('$train_no', '$src', '$dest' , '$startTime','$endTime')";
            if(!mysqli_query($db, $insert_query)){
                print_r($db->error);
                $_SESSION['primary_key_error'] = "Train $train_no Already Exists.";
            }
            else{
                $_SESSION['train_insert_success']  = "Train Number $train_no registered Succesfully!.";
            }
            // header('location: ./admin.php');	
        }
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
                <h4 class="card-title mt-3 text-center">Release a Train</h4>
                <div class="d-flex justify-content-center my-2"><?php
                        if(isset($_SESSION['primary_key_error'])){
                            echo '<div class="alert alert-danger">';
                            echo $_SESSION['primary_key_error'];
                            echo "</div>";
                            unset($_SESSION['primary_key_error']);
                        }

                        if(isset($_SESSION['train_insert_success'])){
                        echo '<div class="alert alert-success">';
                        echo $_SESSION['train_insert_success'];
                        echo "</div>";
                        unset($_SESSION['train_insert_success']);
                    }        ?></div>
                <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
                <?php display_errors();?>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-train"></i> </span>
                        </div>
                        <input name="train" class="form-control" placeholder="Train No." type="number" min=0 title="Enter Train Number" required>
                        <!-- <a href="#" title="This is a title.">Mouseover me</a> -->
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-play"></i> </span>
                        </div>
                        <input name="source" class="form-control" placeholder="Source Station" type="text" title="Source Station" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-ban"></i> </span>
                        </div>
                        <input name="dest" class="form-control" placeholder="Destination Station" type="text" title="Destination Station" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-clock-o"></i> </span>
                        </div>
                        <input name="startTime" class="form-control" placeholder="Start Time" type="time" title="Enter Start Time from Dep Station" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-clock-o"></i></span>
                        </div>
                        <input name="endTime" class="form-control" placeholder="End Time" type="time" title="Enter Arrival Time for Arr Station" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block" name="Register_Train">Register Train</button>
                    </div>
                </form>
            </article>
        </div> 
    </div> 
    <?php $_POST;?>
    <div class="container">
        <?php include './includes/footer.php'; ?>
    </div>
    
  </body>
</html>