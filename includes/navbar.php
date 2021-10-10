
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Eyaatri</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="search.php">Search Trains</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="listtickets.php">View Booked Tickets</a>
        </li>
        </ul>
        <div>
            <?php
            if(!isset($_SESSION['user']))
            echo '<a class="btn btn-outline-success m-1" href="login.php">Login</a><a class="m-1 btn btn-outline-success" href="register.php">Register</a>';
            else echo '<a class="btn btn-outline-success" href="index.php?logout=1" > Logout </a>'
            ?>
        </div>
        
    </div>
</nav>

