<?php
$pageTitle='Home Page';
require_once('header.php');
?>

<?php

if (!empty($_GET['pageID']) ) {

    $pageID = $_GET['pageID'];
    //Step 1 - connect to the database
    $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200359541',
        'gc200359541', 'wl3tDZWsQf');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Step 2 - create the SQL statement
    $sql = "select * FROM pages WHERE pageID = :pageID";

    //Step 3 - prepare and execute the sql statement
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':pageID', $pageID, PDO::PARAM_INT);
    $cmd->execute();
    $pags = $cmd->fetch();

    $conn = null;
    $heading = $pags['heading'];
    $content = $pags['content'];

}


?>
<main class="container">
    <section class="jumbotron">
        <h1><?php echo $heading?></h1>
        <p><?php echo $content?> </p>
    </section>
</main>


