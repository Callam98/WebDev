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
        $sql = "UPDATE studentresidence SET FirstName='$n', surname='$s', ID='$i', Email='$e',Reseidnce='$r',Phone=$p WHERE id='$id'";
        echo "<pre>\n$sql\n</pre>\n";
        mysqli_query($db,$sql);
        echo 'Updated - <a href="welcome.php">Continue...</a>'; return;
        }
        $id = mysqli_real_escape_string($link,$_GET['id']);
        $result = mysqli_query($link,"SELECT FirstName, Surname, ID, Email,Residence,Phone FROM studentresidence WHERE id='$id'");
        $row = mysqli_fetch_row($result);
        $n = htmlentities($row[1]);
        $s = htmlentities($row[2]);
        $i = htmlentities($row[3]);
        $e = htmlentities($row[4]);
        $r = htmlentities($row[5]);
        $p = htmlentities($row[6]);
        $id = htmlentities($row[0]);
        echo <<< _END
        <p>Edit Contact</p>
        <form method="post">
        <p>Name:
        <input type="text" name="FirstName" value="$n"></p>
        <p>LastName:
        <input type="text" name="Surname" value="$s"></p>
        <p>ID:
        <input type="number" name="ID" value="$i"></p>
        <p>Email:
        <input type="text" name="Email" value="$e"></p> 
        <p>Residence:
        <input type="text" name="Residence" value="$r"></p>
        <p>Phone:
        <input type="number" name="Phone" value="$p"></p><input type="hidden" name="id" value="$id">
        <p><input type="submit" value="Update"/>
        <a href="welcome.php">Cancel</a></p>
        </form>
        _END
        ?>
    </body>
</html>