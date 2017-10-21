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
          <div class="well">
            <h1><?php echo 'Patient: ' . $_SESSION['username']; ?></h1>
          </div>
        </div>
      </div>
    </div>

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

    <hr>

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

    <hr>

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

    <script type="text/javascript">
      $(document).ready(function() {
        $.post("./fetch.php",
        function(data) {
          var payload = JSON.parse(data);

          var pulse_rates = {labels: [], series: [[]]};
          var temperatures = {labels: [], series: [[]]};
          var vibrations = {labels: [], series: [[]]};

          payload.forEach(function(value, key) {
            var data = JSON.parse(value);

            var t = new Date(data.payload.timestamp);
            var formatted = t.format('dd.mm.yy hh:MM:ss');
            pulse_rates.labels.push(formatted);

            var t = new Date(data.payload.timestamp);
            var formatted = t.format('dd.mm.yy hh:MM:ss');
            temperatures.labels.push(formatted);

            var t = new Date(data.payload.timestamp);
            var formatted = t.format('dd.mm.yy hh:MM:ss');
            vibrations.labels.push(formatted);

            pulse_rates.series[0].push(data.payload.pulse_rate);
            temperatures.series[0].push(data.payload.temperature);
            vibrations.series[0].push(data.payload.vibrations);

            // console.log(data.payload.pulse_rate);
          });

          console.log(pulse_rates);
          console.log(temperatures);
          console.log(vibrations);

          // We are setting a few options for our chart and override the defaults
          var options = {
            // Don't draw the line chart points
            showPoint: true,
            // Disable line smoothing
            lineSmooth: true,
            // X-Axis specific configuration
            axisX: {
              // We can disable the grid for this axis
              showGrid: true,
              // and also don't show the label
              showLabel: true
            },
            // Y-Axis specific configuration
            axisY: {
              // Lets offset the chart a bit from the labels
              offset: 10,
              // The label interpolation function enables you to modify the values
              // used for the labels on each axis. Here we are converting the
              // values into million pound.
              labelInterpolationFnc: function(value) {
                // return '$' + value + 'm';
                return value;
              }
            }
          };

          // All you need to do is pass your configuration as third parameter to the chart function
          new Chartist.Line('.ct-chart1', pulse_rates, options);
          new Chartist.Line('.ct-chart2', temperatures, options);
          new Chartist.Line('.ct-chart3', vibrations, options);

        })
      });

    </script>

    <!-- Custom JavaScript -->
    <!-- <script src="js/master.js" type="text/javascript"></script> -->

  </body>
</html>
