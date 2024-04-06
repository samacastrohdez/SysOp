<?php include('./include/headempleado.php'); 

    session_start();
    require "conexion.php";


    if(!isset ($_SESSION['id'])){
        header("Location: index.php");
    }
    $id = $_SESSION['id'];
    $nombre = $_SESSION['nombre'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    if ($tipo_usuario == 1) {
        $where = '' ;
    }else if($tipo_usuario == 2 ){

        $where = 'id=$id' ;
    }

    $sql = "SELECT * FROM empleados $where";

    $resultado =  $mysqli->query($sql);




?>

<?php include('./include/body.php'); ?>
    <div id="wrapper">
    <?php include('./include/sider.php'); ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
            <?php include('./include/navar.php'); ?>

                
                <!-- tabla -->
                <?php if($tipo_usuario == 2): ?>
                    <div class="container-fluid">
                        <center>

                            <h1>Bienvenido al equipo <?php echo $nombre;?></h1>
                            <img src="imegen.png" alt="Descripción de la imagen">
                        </center>
                    </div>
                <?php endif; ?> 
                <?php if($tipo_usuario == 1): ?> <!-- Corrige la estructura de la condición -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>
                            <div class="dropdown">
                                <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="modal" data-target="#userModal">
                                    <i class="fas fa-users"></i>
                                    Agregar Usuario
                                </button>
                            </div>
                        </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Rol</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $resultado->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?php echo $row['nombre']?></td>
                                                    <td><?php echo $row['correo']?></td>
                                                    <td>
                                                    <?php 
                                                        if ($row['tipo_usuario'] == 1) {
                                                            echo 'Administrador';
                                                        } else if ($row['tipo_usuario'] == 2) {
                                                            echo 'Empleado';
                                                        } else {
                                                            echo 'Otro';
                                                        }
                                                    ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Empleado</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="guardar_empleado.php" method="POST">
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control bg-light border-0 small" placeholder="Nombre" name="nombre" required >
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control bg-light border-0 small" placeholder="Teléfono" name="telefono"  maxlength="10"required >
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <input type="email" class="form-control bg-light border-0 small" placeholder="Correo electrónico" name="correo" required >
                                            </div>
                                            <div class="col-md-6">
                                                <input type="password" class="form-control bg-light border-0 small" placeholder="password" name="password" required >
                                            </div>
                                        </div>
                                        <div class="row mt-3" >
                                            <div class="col-md-6">
                                                <input type="date" class="form-control bg-light border-0 small" placeholder="fecha de nacimiento"  name="fecha_nacimiento"  required>                     
                                            </div>
                                            <div class="col-md-6">
                                                <select name="tipo_usuario" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="" disabled selected>Tipo de usuario</option>
                                                    <option value="1">Administrador</option>
                                                    <option value="2">Empleado</option>
                                                </select> 
                                            </div>  
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-danger" href="bienvenido.php">Cerrar</a>
                                            <input class="btn btn-primary" type="submit" value="Guardar">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?> 


            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Prueba  2024</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Esta seguro de cerrar sesion</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="logout.php">Cerrar sesion</a>
                </div>
            </div>
        </div>
    </div>

   
