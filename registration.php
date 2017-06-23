<?php
$pageTitle='Registration';
require_once('header.php');
?>

<?php
if (!empty($_GET['email']))
    $email = $_GET['email'];
else
    $email = null;
$username = null;
$password = null;
$confirm = null;


if (!empty($email))
{
   //connect to database
    $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200359541',
        'gc200359541', 'wl3tDZWsQf');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //create sql command
    $sql = "SELECT * FROM tbl_data WHERE email = :email";
    //prepare and execute sql
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':email', $email, PDO::PARAM_STR, 120);
    $cmd->execute();
    $data = $cmd->fetch();
    //close connection
    $conn = null;
    $email  = $data['email'];
    $username = $data['username'];


}
?>
    <main class="container">
        <h1>Admin Registration</h1>
        <?php
        if (!empty($_GET['errorMessage']))
            echo '<div class="alert alert-danger" id="message">Email address already exists</div>';
        else
            echo '<div class="alert alert-info" id="message">Please create your account</div>';
        ?>
        <form method="post" action="save-registration.php">
            <fieldset class="form-group">
                <label for="email" class="col-sm-2">Email: *</label>
                <input name="email" id="email" value="<?php echo $email?>"  required type="email"  placeholder="email@email.com">
            </fieldset>
            <fieldset class="form-group">
                <label for="username" class="col-sm-2">User Name: </label>
                <input name="username" id="username" value="<?php echo $username?>" placeholder="your name"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="password" class="col-sm-2">Password:*</label>
                <input name="password" id="password" required type="password" placeholder="Password"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="confirm" class="col-sm-2">Confirm Password:*</label>
                <input name="confirm" id="confirm" required type="password" placeholder=" Confirm Password"/>
            </fieldset>
            <input name="Email" id="Email" value="<?php echo $email ?>" type="hidden"/>
            <button class="col-sm-offset-2 btn btn-success btnRegister">Register</button>
        </form>
    </main>

<?php
require_once ('footer.php');
?>