<?php
include_once 'config/config.php';
include_once 'libraries/Database.php';
include_once 'helpers/Helper.php';
include_once 'helpers/Notify.php';
include_once 'classes/Admin.php';

$db     = new Database();
$helper = new Helper();

$admin  = new Admin();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <style>
        .login-box, .register-box {
            width: 400px;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="" class="h1"><b>Admin</b>Login</a>
        </div>
        <div class="card-body">

            <?php
            if (isset($_POST['login'])){

                $email    = $helper->validate($_POST['email']);
                $password = $helper->validate($_POST['password']);

                if (empty($email)){
                    $error['email'] ="Email field is required";
                }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $error['email'] ="Invalid Email";
                }else{
                    $data['email'] =$email;
                }

                if (empty($password)) {
                    $error['password'] = "Password field is required";
                }
                else{
                    $data['password'] =$password;
                }

                if (empty($error['email']) && empty($error['password'])){

                 $login =   $admin->login($data);
                 if ($login){
                     echo $login;
                 }
                }

            }
            ?>

            <form action="" method="post">
                <div class="input-group">
                    <input type="text" name="email" class="form-control" value="<?php echo  $data['email'] ??''; ?>" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger d-block mb-3">
                    <?php
                    echo  $error['email']??'';
                    ?>
                </span>

                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <span class="text-danger d-block mb-3">
                    <?php
                    echo  $error['password']??'';
                    ?>
                </span>
                <div class="form-group mb-4 mt-4">
                    <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                </div>
            </form>



            <!--      <p class="mb-1">-->
            <!--        <a href="forgot-password.html">I forgot my password</a>-->
            <!--      </p>-->

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
