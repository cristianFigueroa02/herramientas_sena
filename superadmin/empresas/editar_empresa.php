<?php
require_once("../../bd/database.php");
$db = new Database();
$conectar = $db->conectar();
session_start();

// Validar si la variable de sesión no está establecida
if (!isset($_SESSION['codigo_valido']) || !$_SESSION['codigo_valido']) {
    // Redirigir al usuario a una URL específica si no se cumple la validación
    header("Location: ../index.php");
    exit; // Detener la ejecución del script
}


if (isset($_GET['id'])) {
    // Recupera el ID de la URL
    $id = $_GET['id'];

    $validar = $conectar->prepare("SELECT * FROM empresa WHERE nit = ?");
    $validar->execute([$id]);
    $nit = $validar->fetch();


    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $email = $_POST['gmail'];
        $telefono = $_POST['telefono'];

        // Prepare and execute the update query
        $updateQuery = $conectar->prepare("UPDATE empresa SET nombre_empre = ?, direccion = ?,gmail = ?, telefono = ? WHERE nit = ?");
        $updateQuery->execute([$nombre, $direccion, $email, $telefono, $id]);
        // Redirect to the page displaying the updated data or any other desired location
        header("Location: lista_empresa.php");
        exit();
    }

    // Retrieve existing data for the selected record
    else {
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>limelight</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../../css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../../css/responsive.css">
    <!-- styles usuario -->
    <link rel="stylesheet" href="../../css/styles_usuario.css">
    <!-- fevicon -->
    <link rel="icon" href="../../images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../../css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body class="main-layout in_page">
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="#"><img src="../../images/Sena_Colombia_logo.svg.png" alt="#" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header> <!-- ... (your existing body content) ... -->

    <section class="section">
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <h2>Actualizar Empresa</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="nombre">NIT de la empresa:</label>
                        <input type="text" class="form-control" value="<?php echo $nit['nit']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre de la empresa:</label>
                        <input type="text" class="form-control" value="<?php echo $nit['nombre_empre']; ?>" id="nombre" name="nombre" pattern="[a-zA-Z0-9\s]+" title="El nombre de la empresa solo puede contener letras, números y espacios" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Dirección:</label>
                        <input type="text" class="form-control" value="<?php echo $nit['direccion']; ?>" id="direccion" name="direccion" pattern="[a-zA-Z0-9\s#.']+" title="La dirección puede contener letras, números, espacios, #, . y '" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">E-mail empresa:</label>
                        <input type="email" class="form-control" value="<?php echo $nit['gmail']; ?>" id="gmail" name="gmail" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Numero Telefonico:</label>
                        <input type="text" class="form-control" value="<?php echo $nit['telefono']; ?>" id="telefono" name="telefono" pattern="[0-9]+" title="El teléfono solo puede contener dígitos numéricos" required>
                    </div>
                    <button type="submit" class="btn btn-success" style="margin-top:1rem; margin-left:1.6em;">Actualizar</button>
                    <a href="lista_empresa.php" class="btn btn-danger" style="margin-top:1rem; margin-left:1.6em;">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</section>

    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class=" col-md-3 col-sm-6">
                        <h3>variedad</h3>
                        <p class="variat pad_roght2">Ofrecemos una amplia variedad de herramientas
                            de alta calidad para satisfacer todas tus necesidades de
                            construcción.Tenemos todo lo que necesitas para completar
                            tus proyectos con éxito.
                        </p>
                    </div>
                    <div class=" col-md-3 col-sm-6">
                        <h3>dejanos ayudarte </h3>
                        <p class="variat pad_roght2">Nuestro objetivo es facilitarte el acceso a las herramientas
                            que necesitas para tus proyectos. Con nuestro proceso de préstamo simple y transparente,
                            puedes obtener las herramientas adecuadas sin complicaciones ni demoras.
                        </p>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h3>NUESTRO DISEÑO</h3>
                        <p class="variat">En nuestra empresa, nos esforzamos por ofrecer un diseño intuitivo
                            y fácil de usar en todas nuestras plataformas. Nuestra interfaz está diseñada
                            pensando en la comodidad y la accesibilidad del usuario.
                        </p>
                    </div>
                    <div class="col-md-6 offset-md-6">
                        <form id="hkh" class="bottom_form">
                            <input class="enter" placeholder="" type="text" name="Enter your email">
                            <button class="sub_btn">Prestamos de herramientas</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <p>© 2019 All Rights Reserved. Design by <a href="https://html.design/"> Cristian Figueroa</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>

<!-- ... (your existing script imports) ... -->

<!-- ... (your existing script content) ... -->
</body>

</html>