<?php
session_start();
if (!isset($_SESSION['user_level']) || ($_SESSION['user_level']) != 1) {
    header("Location: login.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Admin page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
  </head>
  <body>
    <div class="container-fluid" style="margin-top:30px">
      <!-- Header Section -->
      <header class="jumbotron text-center row" style="margin-bottom:2px; background:linear-gradient(white, #0073e6);padding:20px;">
        <?php include 'admin-header.php';?>
      </header>
      <!-- Body Section -->
      <div class="row" style="padding-left:0px;">
        <nav class="col-sm-2">
          <ul class="nav nav-pills flex-column">
            <?php include 'nav.php';?>
          </ul>
        </nav>
        <!-- Center Column -->
        <div class="col-sm-8">
            <h2 class="text-center">This is an Administartive Page</h2>
            <?php if (isset($_SESSION['first_name'])) {
    echo "{$_SESSION['first_name']}";
}?>
            <h3>You have permission to:</h3>
            <p>Edit and Delete records</p>
            <p>Use the view members button to page throug all the members</p>
            <p>Use the search button to search for a particular member</p>
            <p>Use the New password button to change your password</p>
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
  </body>
</html>