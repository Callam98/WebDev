<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<html>
    <body>
        <?php
        require_once "config.php";
        if ( isset($_POST['FirstName']) && isset($_POST['Surname'])
        && isset($_POST['ID']) && isset($_POST['Email']) && isset($_POST['Residence']) && isset($_POST['Phone'])){
        $n = mysqli_real_escape_string($link,$_POST['FirstName']);
        $s = mysqli_real_escape_string($link,$_POST['Surname']);
        $i = mysqli_real_escape_string($link,$_POST['ID']);
        $e = mysqli_real_escape_string($link,$_POST['Email']);
        $r = mysqli_real_escape_string($link,$_POST['Residence']);
        $p = mysqli_real_escape_string($link,$_POST['Phone']);
            
        $sql = "INSERT INTO studentresidence (FirstName, Surname, ID, Email, Residence, Phone) VALUES ('$n', '$s', '$i', '$e', '$r', '$p')";
        echo "<pre>\n$sql\n</pre>\n";
        mysqli_query($link,$sql);
        echo 'Success - <a href="welcome.php">Continue...</a>'; return;
        }
        ?>
        <p>Add A New Contact</p>
        <form method="post">
        <p>First Name:
        <input type="text" name="FirstName"></p>
        <p>Surname:
        <input type="text" name="Surname"></p>
        <p>ID:
        <input type="number" name="ID"></p>
        <p>Email:
        <input type="text" name="Email"></p>
        <p>Residence:
        <input type="text" name="Residence"></p>
        <p>Phone:
        <input type="number" name="Phone"></p>
        <p><input type="submit" value="Add New"/>
        <a href="welcome.php">Cancel</a></p>
        </form>
    </body>
</html>