<?php
$email = $_POST['email'];
$password = $_POST['password'];

//Step 1 - connect to the DB
$conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200359541',
    'gc200359541', 'wl3tDZWsQf');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Step 2 - build the sql command
$sql = "SELECT * FROM tbl_data WHERE email = :email";

//Step 3 - bind the parameters and execute
$cmd = $conn->prepare($sql);
$cmd->bindParam(':email',$email,PDO::PARAM_STR, 120);
$cmd->execute();
$data = $cmd->fetch();

//step 4 - validate the user
if (password_verify($password, $data['password'])){
    //excellent we have a valid password
    session_start();
    $_SESSION['email']  = $data['email'];
    $_SESSION['userName'] = $data['userName'];
    header('location:default.php');
}
else{
    header('location:login.php?invalid=true');
    exit();
}

//step 5 - disconnect from the db
$conn=null;
?>