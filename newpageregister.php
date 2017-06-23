<?php
$pageTitle='Home Page';
require_once('header.php');
?>

<?php
$pageID = $_POST['pageID'];
$heading = $_POST['heading'];
$content = $_POST['content'];


    //Step 1 - connect to the DB
    $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200359541', 'gc200359541', 'wl3tDZWsQf');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Step 2 - create the SQL command
    $sql = "INSERT INTO pages(heading, content) VALUES (:heading, :content)";

//Step 3 - prepare and execute the SQL
$cmd = $conn->prepare($sql);

$cmd->bindParam(':heading', $heading, PDO::PARAM_STR, 120);
$cmd->bindParam(':content', $content, PDO::PARAM_STR, 100);


$cmd->execute();
//Step 4 - disconnect from the DB
$conn = null;

?>

<?php
require_once ('footer.php');
?>
