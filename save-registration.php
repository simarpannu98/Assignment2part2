<?php
$pageTitle='Home Page';
require_once('header.php');
?>

<?php
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$username = $_POST['username'];
$Email = $_POST['Email'];
$ok = true;
//check if the passwords match
if ($password != $confirm)
{
    echo '<div class="alert alert-danger" id="message">The passwords do not match</div>';

    $ok = false;
}
if (strlen($password) < 8)
{
    echo '<div class="alert alert-danger" id="message">The password is too short, must be 8 or more characters</div>';
    $ok = false;
}
if (empty($email))
{
    echo '<div class="alert alert-danger" id="message">You must enter an email address </div>';
    $ok = false;
}
//if the email and password are ok
if ($ok)
{
    //connect to the DB and setup the new user
    //Step 1 - connect to the DB
    $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200359541',
        'gc200359541', 'wl3tDZWsQf');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Step 2 - create the SQL command


     if (!empty($Email)){
        $sql = "UPDATE tbl_data
                   SET username = :username,
                       password = :password
                       
                   WHERE email = :email";
    }

   else {


        $sql = "INSERT INTO tbl_data VALUES (:email, :username, :password)";
    }
    //Step 2.5 - hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //Step 3 - prepare and execute the SQL
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':email', $email, PDO::PARAM_STR, 120);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
    try{
        $cmd->execute();
    }
    catch (Exception $e)
    {
        if (strpos($e->getMessage(), 'Integrity constraint violation: 1062') == true){
            header('location:registration.php?errorMessage=email-already-exists');
            $conn=null;
            exit();
        }
    }
    //Step 4 - disconnect from the DB
    $conn = null;
    //Step 5 - redirect to the login page
    header('location:Admins.php');
}
?>

<?php
require_once ('footer.php');
?>
