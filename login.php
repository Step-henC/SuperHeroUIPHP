<?php
session_start();
include "db_conn.php";

if(isset($_POST['uname']) && isset($_POST['password'])) {

function validate($data) {
    $data = trim($data); //strip whitespace
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$uname = validate($_POST['uname']);
$pass = validate($_POST['password']);

}

if(empty($uname)) {
    header("Location start.php?error=User Name is required");
    exit();
}
if(empty($pass)) {
    header("Location start.php?error=Pasword is required");
    exit();
}

$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

$result = mysqli_query($connection, $sql);

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['user_name'] === $uname && $row['password'] === $pass) {
        echo "Logged In";
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['id'] = $row['id'];
        header("Location: index.php");
        exit();
    } 
    else {
        header("Location: start.php?error=Incorrect User Name or Password");
        exit();
    }

}
else {
    header("Location: index.php");
    exit();
}

?>
