<?php session_start();
    if (!isset($_SESSION["session"])) {
        header('Location:../../app/view/login.php');
    }
    
    $path = $_SERVER['PHP_SELF'];
    $path = basename($path);
    $ruta = str_replace('.php', '', $path);
    $vista = str_replace('_', ' ', $ruta);
    
    //  if (!isset($_SESSION['session']) or $_SESSION['session'] != true) {
    //     header('Location:../view/login.php');
    // }
    
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Help A2</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <meta name="description" content="GO SMART GROUP Chatbot.">
        <meta name="msapplication-tap-highlight" content="no">
         
        <link rel="icon" type="image/png" href="../../assets/icon/icon-192x192.png" sizes="16x16">
        <link rel="icon" type="image/png" href="../../assets/icon/icon-192x192.png" sizes="32x32">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="../../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <!-- summernote -->
        <link rel="stylesheet" href="../../assets/plugins/summernote/summernote-bs4.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="../../assets/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="../../assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
        <link rel="stylesheet" href="../../assets/css/main.css">
        <link rel="stylesheet" href="../../assets/css/nprogress.css" type="text/css"/>
        <style type="text/css">
            a:hover {
                cursor:pointer;
            }
        </style>
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <!--li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="#" class="dropdown-item">
                                
                                <div class="media">
                                    <img src="../../assets/images/avatars/2.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">Call me whenever you can...</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                 
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                
                                <div class="media">
                                    <img src="../../assets/images/avatars/1.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">I got your message bro</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                 
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                 
                                <div class="media">
                                    <img src="../../assets/images/avatars/2.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                 
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li-->
                    <!-- Notifications Dropdown Menu -->
                    <!--li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge numberNotifications">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header numberNotifications">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                            <i class="fas fa-shopping-cart mr-2"></i> <span id="span_payment_new"><?php echo $_SESSION['notification']['payment_new']; ?></span> new payment
                            <span class="float-right text-muted text-sm span_date_payment">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> <span id="span_suscriber_new"><?php echo $_SESSION['notification']['suscriber_new']; ?></span> new suscriber
                            <span class="float-right text-muted text-sm span_date_suscriber">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                            <i class="fas fa-ticket-alt mr-2"></i> <span id="span_support_new"><?php echo $_SESSION['notification']['support_new']; ?></span> new support
                            <span class="float-right text-muted text-sm span_date_support">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li-->
                </ul>
            </nav>
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index.php" class="brand-link">
                <!--img src="../../assets/images/logo-go.png"
                    alt="Go SmarChat"
                    class="brand-image"
                    style="opacity: .8" -->
                <span class="brand-text font-weight-light">Support</span>
                </a>
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="../../assets/images/avatars/2.jpg" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"><?php echo $_SESSION['users_name'] ?></a>
                            <button type="button" class="lang btn btn-outline-primary btn-xs" key="logout" onclick="logout()">Logout</button>
                        </div>
                    </div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <?php include '../../common/vertical-nav-menu.php'; ?>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" id="container">
                
            </div>
            
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <?php include '../../common/app-footer.php'; ?>
            </footer>
        </div>

        <div class="container" id="container_modal"></div> 

        <!-- ./wrapper -->
        <!-- jQuery -->
        <script src="../../assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Moment JS-->
        <script src="../../assets/plugins/moment/moment.min.js"></script>
        <!-- Select2 -->
        <script src="../../assets/plugins/select2/js/select2.full.min.js"></script>
        <!-- DataTables -->
        <script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <!-- jquery-validation -->
        <script src="../../assets/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../../assets/plugins/jquery-validation/additional-methods.min.js"></script>        
        <!-- Sweetalert -->
        <script src="../../assets/plugins/sweetalert2/sweetalert2@10.js"></script>
        <!-- AdminLTE App -->
        <script src="../../assets/scripts/adminlte.min.js"></script>
        <script src="../../assets/scripts/function.js"></script>
        <script src="../../assets/scripts/nprogress.js"></script>

        <!-- Summernote -->
        <script src="../../assets/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../assets/scripts/demo.js"></script>

        <!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->
        <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-messaging.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.7.0/firebase-auth.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-storage.js"></script>

        <script>
            const channel = new BroadcastChannel("sw-messages");
            channel.addEventListener("message", (event) => {
                onMessage(event.data);
            });

            setTimeout(function () {
                var config = {
                    apiKey: "AIzaSyAx0iAIQBSHygFVaYPFOXwZWMqQjAmvNr4",
                    authDomain: "pushtest2022-86f10.firebaseapp.com",
                    projectId: "pushtest2022-86f10",
                    storageBucket: "pushtest2022-86f10.appspot.com",
                    messagingSenderId: "765776242803",
                    appId: "1:765776242803:web:9ea33526c53ebe4f04a206",
                    measurementId: "G-WDFD2ZWK3K"
                };
                if (!firebase.apps.length) {
                    //verifica si ya esta cargada app para evitar error por duplicacion
                    firebase.initializeApp(config);
                }
                /*var email = "gosmartchat@gmail.com";
                var password = "chatpass*";
                firebase
                    .auth()
                    .signInWithEmailAndPassword(email, password)
                    .catch(function (error) {
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    });*/

                messaging = firebase.messaging();

                if (Notification.permission === "granted") {
                    messaging.getToken().then((currentToken) => {
                        if (currentToken) {
                            console.log(currentToken)
                            ///enviar post a la bd para verificar si ya existe este token, si no existe se debe registrar
                        }
                    }).catch((err) => {
                        console.log('An error occurred while retrieving token. ', err);
                        // ...
                    });
                } else {
                    messaging.requestPermission().then(function () {
                        console.log("Notification permission granted.");
                        return messaging.getToken();
                    }).then(function (token) {
                        console.log("requestPermission");
                        console.log("token is : " + token);
                        $.post("../model/notification_model.php",{method: "saveTokenPushNotification",tokenfirebase: token},
                            function (response) {
                            //console.log("setToken : " + response);
                            },
                        "json"
                        ).fail(function (error) {
                            console.log("FAIL setToken");
                        });
                    })
                    .catch(function (err) {
                        console.log("Unable to get permission to notify.", err);
                    });
                }

                messaging.onMessage(function (payload) {
                    onMessage(payload);
                });
            }, 1000);

        function onMessage(payload) {
            var data = payload.data;
            var icon = "";
            console.log("function onMessage" + payload)
            if (Notification.permission === "granted") {     
                console.log("llego con permiso")       

            }else{
                console.log("llego sin permiso")
            }

        }         
        </script>

    </body>
</html>

