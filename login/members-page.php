<?php
session_start();
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level']) != 0) {
    header("Location: login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Members page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
  </head>
  <body>
    <div class="container-fluid" style="margin-top:30px">
      <!-- Header Section -->
      <header class="jumbotron text-center row" style="margin-bottom:2px; background:linear-gradient(white, #0073e6);padding:20px;">
        <?php include 'members-header.php';?>
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
          <h2 class="text-center">This is the member's page</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo, repellat veritatis quaerat praesentium temporibus unde, quia alias atque voluptas omnis?<br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta necessitatibus, fuga quod distinctio, recusandae odit ut adipisci ducimus quo. Totam?<br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis voluptatibus cupiditate, commodi voluptate omnis neque totam suscipit cum perferendis laborum.
          </p>

          <p class="h3 text-center">Special offers to members only</p>
          <p class="text-center"><strong>Coding 10.00</strong></p>
          <img src="img/pexels-photo-546819.jpeg" alt="coding" class="mx-auto d-block mb-4">
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