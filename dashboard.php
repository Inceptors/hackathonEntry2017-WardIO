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
          <h1>Pulse Rate</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 text-center">
          <div class="ct-chart1 ct-perfect-fourth"></div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-xs-12 text-center">
          <h1>Temperature</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 text-center">
          <div class="ct-chart2 ct-perfect-fourth"></div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-xs-12 text-center">
          <h1>Vibrations</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 text-center">
          <div class="ct-chart3 ct-perfect-fourth"></div>
        </div>
      </div>
    </div>

    <!-- Imports jQuery API -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="js/master.js" type="text/javascript"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $.post("./fetch.php",
        function(data) {
          var payload = data;
          console.log(payload);
        })
      });
    </script>

  </body>
</html>
