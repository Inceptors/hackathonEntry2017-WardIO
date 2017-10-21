<!DOCTYPE html>
<html lang="en">
  <head>
    <?php

    $title = 'Create New Account';
    include './partials/head.php';

    ?>
  </head>
  <body>

    <?php include './partials/nav.php'; ?>

    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <form class="form-group" action="./new_user.php" method="POST">
            <label for="username">Username</label>
            <input class="form-control" type="text" name="username" value="">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" value="">
            <label for="password">Confirm Password</label>
            <input class="form-control" type="password" name="confirmPassword" value="">
            <br>
            <button class="btn btn-primary form-control"type="submit" name="login"><i class="fa fa-fw fa-user-plus"></i> Create Account</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Imports jQuery API -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </body>
</html>
