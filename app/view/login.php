
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Language" content="en" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Help A2 - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="GO SMART GROUP Chatbot.">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no" />
     
    <link rel="icon" type="image/png" href="../../assets/icon/icon-192x192.png" sizes="16x16">
    <link rel="icon" type="image/png" href="../../assets/icon/icon-192x192.png" sizes="32x32">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <!--img  src="../../assets/images/logo-go.png" alt="" width="200" height="150"-->
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Welcome back,<br>
                Please sign in to your account below.</p>

               <form id="formlogin">
                    <div class="input-group mb-3">
                        <input name="ingUsuario" id="ingUsuario" autocomplete="off" placeholder="Email here..." type="email" class="form-control" required/>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="ingPassword" id="ingPassword" autocomplete="off" placeholder="Password here..." type="password" class="form-control" required/>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary btn-block" id="m_login_signin_submit">Login</button>
                        </div>
                      <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Others -->
    <script src="../../assets/plugins/sweetalert2/sweetalert2@10.js"></script>
    <script src="../../assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../assets/scripts/adminlte.min.js"></script>
    <script src="../../assets/scripts/function.js"></script>
    <script src="../controllers/login.js"></script>

</body>
</html>
