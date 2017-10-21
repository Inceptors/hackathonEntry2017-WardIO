<?php

session_start();

if (!isset($_SESSION['username'])) {
  header('Location: ./login.php');
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php

    $title = 'Dashboard';
    include './partials/head.php';

    ?>
  </head>
  <body>

    <?php include './partials/nav.php'; ?>

    <div class="container">
      <div class="row">
        <div class="col-xs-12 text-center">
          <h1>Dashboard</h1>
        </div>
      </div>
    </div>

    <!-- Imports jQuery API -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </body>
</html>
