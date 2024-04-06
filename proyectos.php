<?php include('./include/headempleado.php'); 

    session_start();
    require "conexion.php";


    if(!isset ($_SESSION['id'])){
        header("Location: index.php");
    }
    $id = $_SESSION['id'];
    $nombre = $_SESSION['nombre'];
    $tipo_usuario = $_SESSION['tipo_usuario'];


    $sql = "SELECT * FROM proyectos id";

    $resultado =  $mysqli->query($sql);

?>

<?php include('./include/body.php'); ?>
    <div id="wrapper">
     <?php include('./include/sider.php'); ?>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include('./include/navar.php'); ?>
                <!-- tabla -->
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Lista de Proyectos</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Proyectos realizados</h6>
                            <div class="dropdown">
                                <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="modal" data-target="#proyectModal">
                                    <i class="fas fa-book-open"></i>
                                    Agregar proyecto
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Encargado</th>
                                            <th>Duracion</th>
                                            <th>Cliente</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $resultado->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $row['nombre']; ?></td>
                                                <td><?php echo $row['encargado']; ?></td>
                                                <td><?php echo $row['duracion']; ?></td>
                                                <td><?php echo $row['cliente']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Prueba 2024</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- proyecto Modal-->
    <div class="modal fade" id="proyectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar proyecto</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="guardar_proyecto.php" method="POST">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Nombre" name="nombre" required >
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Encargado" name="encargado" required >
                            </div>
                        </div>
                        <div class="row mt-3" >
                            <div class="col-md-12">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Duración"  name="duracion"  required>                     
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Cliente" name="cliente"  required>
                                    
                                <input type="hidden" name="tipo_usuario" value="<?php echo $tipo_usuario; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger" href="proyectos.php">Cerrar</a>
                            <input class="btn btn-primary" type="submit" value="Guardar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

