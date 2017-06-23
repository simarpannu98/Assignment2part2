<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ?></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">

</head>
<body>

<nav class="nav navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="default.php" class="navbar-brand">Home</a></li>


        <?php

        //Step 1 - connect to the DB
        $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200359541',
            'gc200359541', 'wl3tDZWsQf');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Step 2 - create a SQL command
        $sql = "SELECT * FROM pages";
        //prepare and execute the SQL command
        $cmd = $conn->prepare($sql);
        $cmd->execute();
        //store the results in a variable
        $webs = $cmd->fetchAll();
        //close the DB connection
        $conn=null;

        foreach($webs as $web) {

            echo '<li><a href="tablespage.php?pageID='.$web['pageID'].'" >'.$web['heading'].'</a></li>';


        }
        session_start();



        if (empty($_SESSION['email']))
        {
            echo '<li><a href="Admins.php">View Admins</a></li>
                  <li><a href="registration.php">registration</a></li>
                  <li><a href="login.php">Login</a></li>';
        }


        else
        {
            echo '<li><a href="Admins.php">Edit Or Delete Admins</a></li>
                  <li><a href="newpage.php">Create a new Page</a></li> 
                  <li><a href="registration.php">Register For New Admin</a></li>
                  <li><a href="logout.php">Logout</a></li>';
        }
        ?>
    </ul>
</nav>