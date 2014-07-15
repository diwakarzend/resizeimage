<?php # ========================================================================#
   #
   #  Author:    Diwakar upadhyay
   #  Version:	 1.0
   #  Date:      12-Nov-13
   #  Purpose:   Resizes and saves image view
   #  Requires : Requires PHP5, GD library.
   #  Usage Example:
   #                  Click on upload button here
   #
   #
   # ========================================================================#
?>

<html>
<head>
<title> Upload images</title>
<style>
form {
    /* Just to center the form on the page */
    margin: 0 auto;
    width: 400px;
    /* To see the outline of the form */
    padding: 1em;
    border: 1px solid #CCC;
    border-radius: 1em;
}
form div + div {
    margin-top: 1em;
}
label {
    /* To make sure that all label have the same size and are properly align */
    display: inline-block;
    width: 90px;
    text-align: right;
}
.button {
    /* To position the buttons to the same position of the text fields */
    padding-left: 90px; /* same size as the label elements */
}

button {
    /* This extra margin represent roughly the same space as the space
       between the labels and their text fields */
    margin-left: .5em;
}
button {
    /* This extra margin represent roughly the same space as the space
       between the labels and their text fields */
    margin-left: .5em;
}
</style>
</head>
<body>
<form action="upload.php" method="post">
  
    <?php if(!empty($_GET['msg'])){  echo '<span color=green class=msg>Images uploaded successfully ! </span>';     } ?>
    <div class="button">
        <button type="submit" >Upload images</button>
    </div>
</form>
</body>
</html>


