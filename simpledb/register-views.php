<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Register Users</title>
  <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
  <div class="container-fluid" style="margin-top: 30px;">
    <!-- Header Section -->
    <header class="jumbotron text-center row" style="margin-bottom: 2px; background: linear-gradient(white, #0073e6); padding: 20px;">
      <?php include 'header.php'?>
    </header>
    <!-- Body Section -->
    <div class="row" style="padding-left: 0px">
      <!-- left-side column Menu Section -->
      <nav class="col-md-2">
        <ul class="nav nav-pills flex-column">
          <?php include 'nav.php';?>
        </ul>
      </nav>
      <!-- Center Content Section -->
      <div class="col-md-8">
        <h2 class="text-center mb-3">These are the registered users</h2>
        <?php
try {
    // coonect to the database
    require "mysqli_connect.php";
    // Query the database to retrieve records
    $query = "SELECT CONCAT(last_name, ' ', first_name) AS name, ";
    $query .= "DATE_FORMAT(registration_date, '%M %d %Y') AS ";
    $query .= "regdat FROM users ORDER BY registration_date ASC";
    $result = mysqli_query($dbcon, $query);
    if ($result) {
        echo '<table class="table table-striped">
                                      <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date Registered</th>
                                      </tr>';
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr><td>' . $row['name'] . ' </td><td>' . $row['regdat'] . '</td></tr>';}
        echo '</table>';
        mysqli_free_result($result);
    } else {
        echo '<p class="error">
                                      The current users could not be retrieved, we apologized for any inconviniences at this time.
                                    </p>';
        // Debug code
        // echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
        exit;
    }
    mysqli_close($dbcon);
} catch (Exception $e) {
    print "An Exception occurred. Message " . $e->getMessage();
    print "The system is busy, try again later";
} catch (Error $e) {
    print "An Exception occurred. Message " . $e->getMessage();
    print "The system is busy, try again later";
}
?>
      </div>
      <!-- Right-side Column Content Section -->
      <aside class="col-md-2">
        <?php include 'info-col.php';?>
      </aside>
    </div>
    <!-- Footer Content Section -->
    <footer class="jumbotron text-center row" style="padding-bottom: 1px; padding-top: 8px;">
      <?php include 'footer.php';?>
    </footer>
  </div>
</body>
</html>