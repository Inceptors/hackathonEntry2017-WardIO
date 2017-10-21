<?php

require_once './connection.php';

$un = $_POST['username'];
$pw = sha1($_POST['password']);

$sql = "SELECT * FROM users";

if ($result = mysqli_query($conn, $sql)) {

  while ($row = mysqli_fetch_assoc($result)) {
    extract($row);

    if (($un == $username) && ($pw == $password)) {
      // Login success
      session_start();

      $_SESSION['username'] = $username;
      $_SESSION['role'] = $role;

      header('Location: ./dashboard.php');

    } else {
      // Login failed
      header('Location: ./login.php');
    }
  }
}
