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
            <?php include 'password-header.php';?>
        </header>
        <!-- Body Section -->
        <div class="row" style="padding-left:0px;">
            <nav class="col-sm-2">
                <ul class="nav nav-pills flex-column">
                    <?php include 'nav.php';?>
                </ul>
            </nav>
            <!-- validating user input -->
            <?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require 'process-change-password.php';
}
?>
            <!-- Center Column -->
            <div class="col-sm-8">
                <h2 class="text-center">Change Password</h2>
                <form action="change-password.php" method="post" name="regform" id="regform" onsubmit="return checked();">
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">E-mail:</label>
                        <div class="col-sm-8">
                        <input type="email" name="email" id="email" placeholder="E-mail" required class="form-control" value="<?php if (isset($_POST['email'])) {
    echo $_POST['email'];
}
?>">
                        </div>
                    </div>
                   <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Current Password:</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" id="password" placeholder="Password" minlength="8" maxlength="12" class="form-control" required>
                        </div>
                   </div>
                   <div class="form-group row">
                        <label for="password1" class="col-sm-4 col-form-label">New Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password1" id="password1" placeholder="Password" minlength="8" maxlength="12" class="form-control" required>
                        </div>
                   </div>
                   <div class="form-group row">
                        <label for="password2" class="col-sm-4 col-form-label">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password2" id="password2" placeholder="Password" minlength="8" maxlength="12" class="form-control" required>
                        </div>
                   </div>
                   <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="submit" value="Change Password" name="submit" class="btn btn-primary">
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
        <footer class="jumbotron text-center row" style="padding-bottom:1px; padding-top:8px;"> <?php
if (!isset($errorstring)) {
    echo '<aside class="col-sm-2>';
    include 'info-col.php';
    echo '</aside>';
    echo '</div>';
    echo '<footer class="jumbotron text-center row col-sm-14"
                    style="padding-bottom:1px; padding-top:8px">';
} else {
    echo '<footer class="jumbotron text-center row col-sm-12"
                    style="padding-bottom:1px; padding-top:8px">';
}
include 'footer.php';
?>
        </footer>
        <script src="js/verify.js"></script>
    </div>
</body>

</html>