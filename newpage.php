<?php
$pageTitle='Registration';
require_once('header.php');
?>
<main class="container">
    <h1>Create a new page</h1>
<form  method="post" action="newpageregister.php">
        <fieldset class="form-group">
            <label for="heading" class="col-sm-2">Heading: </label>
            <input name="heading" id="heading" required type="heading" required placeholder="Choose your heading">
        </fieldset>


    <fieldset class="form-group">
        <label for="content" class="col-sm-2">Content: </label>
        <textarea name="content" id="content" type="content" rows="8" cols = "90" required placeholder="Write your content"/></textarea>
    </fieldset>
    <input name="pageID" id="pageID" value="<?php echo $pageID ?>" type="hidden"/>
        <button class="col-sm-offset-2 btn btn-success btnRegister">Add a new page</button>
    </form>
</main>

