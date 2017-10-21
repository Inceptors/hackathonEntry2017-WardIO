<?php

require_once './connection.php';

$un = $_POST['username'];
$pw = sha1($_POST['password']);
$cpw = sha1($_POST['confirmPassword']);

$sql = "SELECT username FROM users WHERE username = '$un'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {

  if ($pw === $cpw) {
    $sql = "INSERT INTO users (username, password, role) VALUES ('$un', '$pw', 'user')";
    mysqli_query($conn, $sql);
    header('Location: ./login.php');
  }

} else {
  header('Location: ./create.php');
}
