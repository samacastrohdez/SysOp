<?php
    include('./include/head.php');
    require "conexion.php";
    session_start();

    if ($_POST) {
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        $sql = "SELECT id, password, tipo_usuario, nombre FROM usuarios WHERE correo = '$correo'";
        $resultado = $mysqli->query($sql);
        $num = $resultado->num_rows;
        
        if ($num > 0) {
            $row = $resultado->fetch_assoc();
            $password_bd = $row['password'];
            $pass_c = sha1($password);

            if ($password_bd == $pass_c) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['tipo_usuario'] = $row['tipo_usuario'];

                header("Location: bienvenido.php");
                exit();
            } else {
                echo '<div class="alert alert-danger" role="alert">
                        La contraseña no coincide.
                    </div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    El usuario no existe.
                </div>';
        }
    }
?>

<br>
<br>
<br>
<body class="bg-gradient-primary justify-content-center" >
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido</h1>
                                    </div>
                                    <form class="user" method="POST" action = "<?php echo $_SERVER['PHP_SELF'] ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="correo"
                                                id="i_correo" placeholder="Correo electronico.." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password"
                                                id="i_password" placeholder="Contraseña" required> 
                                        </div>
                                        
                                        <button type="submit "class="btn btn-primary btn-user btn-block">
                                            Entrar
                                        </button>
                                        <hr>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<br/>
