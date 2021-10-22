<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container-fluid" style="margin-top: 30px;">
        <!-- Header Section -->
        <header class="jumbotron text-center row col-sm-14" style="margin-bottom: 2px; background: linear-gradient(white, #0073e6); padding: 20px">
            <?php include 'header.php';?>
        </header>
        <!-- body section -->
        <div class="row" style="padding-left: 0;">
            <!-- left-side column -->
            <nav class="col-sm-2">
                <ul class="nav nav-pills flex-column">
                    <?php include 'nav.php';?>
                </ul>
            </nav>
            <!-- validate Input -->
            <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'process-change-password.php';
}
?>
            <!-- center column -->
            <div class="col-sm-8">
                <h2 class="h2 text-center">Change Password</h2>
                <form action="change-password.php" method="post" name="regform" id="regform" onsubmit="return checked">
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label for="email" class="col-sm-4 col-form-label">E-mail:</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php if (isset($_POST['email'])) {
    echo $_POST['email'];
}
?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label for="password" class="col-sm-4 col-form-label">Old Password:</label>
                            <input type="password" id="password" name="password" minlength="6" maxlength="12" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label for="password1" class="col-sm-4 col-form-label">New Password:</label>
                            <input type="password" id="password1" name="password1" minlength="6" maxlength="12" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label for="password2" class="col-sm-4 col-form-label">Confirm Password:</label>
                            <input type="password" id="password2" name="password2" minlength="6" maxlength="12" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="submit" id="submit" name="submit" value="Change Password" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
            <!-- Right column section -->
            <?php
if (isset($errorstring)) {
    echo '<footer class="jumbotron text-center col-sm-12" style="paadding-bottom: 1px; padding-top: 8px";>';
}

include 'footer.php';
?>
            </footer>
        </div>
    </div>
    <script src="verify.js"></script>
</body>
</html>