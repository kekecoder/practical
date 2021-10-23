<!doctype html>
<html lang="en">
  <head>
    <title>Template for an interactiv we page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
  </head>
  <body>
    <div class="container-fluid" style="margin-top:30px">
      <!-- Header Section -->
      <header class="jumbotron text-center row" style="margin-bottom:2px; background:linear-gradient(white, #0073e6);padding:20px;">
        <?php include 'login-header.php';?>
      </header>
      <!-- Body Section -->
      <div class="row" style="padding-left:0px;">
        <nav class="col-sm-2">
          <ul class="nav nav-pills flex-column">
            <?php include 'nav.php';?>
          </ul>
        </nav>
        <!-- Validate Input -->
        <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'process-login.php';
}
?>
        <!-- Center Column -->
        <div class="col-sm-8">
          <h2 class="text-center">Login</h2>
            <form action="login.php" method="POST" name="loginform" id="loginform">
                <div class="form-group row">
                    <div class="col-sm-8">
                    <label for="email" class="col-sm-4 col-fom-label">Email Address:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" maxlength="30" required value="<?php if (isset($_POST['email'])) {
    echo $_POST['email'];
}
?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8">
                        <label for="password" class="col-sm-4 col-fom-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" minlength="8" maxlength="12" required>
                        <span>Between 8 and 12 characters</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="submit" value="Login" id="submit" name="submit" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
        <!-- Right-side column content -->
        <aside class="col-sm-2">
          <?php include 'info-col.php';?>
        </aside>
      </div>
      <!-- footer content section -->
      <footer class="jumbotron text-center row" style="padding-bottom:1px; padding-top:8px;">
        <?php include 'footer.php';?>
      </footer>
    </div>
    <script src="js/verify.js"></script>
  </body>
</html>