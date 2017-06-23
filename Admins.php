<?php
$pageTitle=' Page';
require_once('header.php');
?>

<main class="container">
    <h1>LIST OF ADMINS</h1>
    <?php

    //validate if the user is active
    if (!empty($_SESSION['email']))
        echo '<a href="registration.php">Add a new Admin</a>';
    ?>

<?php
//Step 1 - connect to the DB
$conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200359541',
    'gc200359541', 'wl3tDZWsQf');
//Step 2 - create a SQL command
$sql = "SELECT * FROM tbl_data";
//prepare and execute the SQL command
$cmd = $conn->prepare($sql);
$cmd->execute();
//store the results in a variable
$data = $cmd->fetchAll();
//close the DB connection
$conn=null;

echo '<table class="table table-striped table-hover"><tr>
                        <th>Username</th>
                        <th>Email</th>';

if (!empty($_SESSION['email'])){
            echo '<th>Edit</th>
                  <th>Delete</th></tr>';
}
foreach($data as $datas)
{
    echo '<tr><td>'.$datas['email'].'</td>
              <td>'.$datas['username'].'</td>';
    if (!empty($_SESSION['email'])){
        echo '<td><a href="registration.php?email='.$datas['email'].'"
                                class="btn btn-primary">Edit</a></td>
                      <td><a href="deleteAdmin.php?email='.$datas['email'].'" 
                                class="btn btn-danger confirmation">Delete</a></td></tr>';
    }


}

?>

    <?php
    require_once ('footer.php');
    ?>



