    <link rel="icon" type="image/x-icon" href="images/logov3.png">
    <link rel="stylesheet" href="styles/theme-style.css">
    <link rel="stylesheet" href="styles/switchStyle.css">
    <link rel="stylesheet" href="styles/switchStyleV2.css">
    <script src="switchTheme.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>	
</head>
<body>
<!-- Encabezado del sitio web, se asignan variables de sesion, modifica barra de navegacion e implemente el cambio automatico de tema -->
<?php
$admin = false;
$logged = false;
$email = "";
if(isset($_SESSION["email"])){
    // Se asignan variables de sesion, se pueden utilizar para cualquier pagina del sitio web si se incluye header.php
    $nombre = $_SESSION["nombre"];
    $apellido = $_SESSION["apellido"];
    $admin = $_SESSION["admin"];
    $email = $_SESSION["email"];
    $logged = true;
    }
?>
<!-- Barra de navegacion que cambia dependiendo de $logged y $admin -->
<header>
    <!-- New navbar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #88c8f7;">
    <div class="container" style="width: auto;">
        <a href="./" class="navbar-brand">
        <img src="images/logo.png" alt="logo" width="50">
        </a>
        <div class="navbar-brand">
            <input type="checkbox" id="toggle" onclick=changeTheme()>
            <label for="toggle" class="button"></label>
        </div>
        <!-- Desplegar navbar en pantallas chicas -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Catalogo -->
                <?php if(!$admin){ ?>
                <li class="nav-item m-auto"><a class="nav-link" href="catalogo.php">Catálogo</a></li> <?php } ?>
                <!-- Gestion de catalogo -->
                <?php if($admin) {?>
                <li class="nav-item m-auto"><a class="nav-link" href="gestion_catalogo.php">Gestionar catalogo</a></li> <?php } ?>
                <li class="nav-item m-auto"><a class="nav-link" href="soporte.php">Soporte</a></li>
                <!-- Buscador -->
                <?php $dir = $admin ? "gestion_catalogo.php":"catalogo.php";?>
                <form action=<?php echo $dir;?> class="d-flex" role="search" method="get">
                    <input type="search" class="form-control me-2" placeholder="Search" aria-label="Search" name="search" max-width="50px">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                </form>
                <!-- Dropdown Administrador -->
                <?php if($admin) {?>
                <li class="nav-item dropdown m-auto">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $nombre?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item btn" href="#">Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item btn" href="logout.php">Cerrar Sesión</a></li>
                    </ul>
                </li>
                <!--Dropdown Usuario (cliente)  -->
                <?php } 
                if($logged and !$admin){
                    $saldo = $_SESSION["saldo"];?>
                <li class="nav-item dropdown m-auto">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $nombre." ".$apellido?>
                    </a>
                    <ul class="dropdown-menu" style="background-color: #88c8f7;">
                        <li><a class="dropdown-item btn" href="#">Mis compras</a></li>
                        <li><a class="dropdown-item btn" href="saldo.php">Mi Saldo</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item btn" href="#">Configuración</a></li>
                        <li><a class="dropdown-item btn" href="logout.php">Cerrar Sesión</a></li>
                    </ul>
                </li>
                <!-- Carrito -->
                <li class="nav-item m-auto"><a class="nav-link" href="carro.php"><?php echo "Carrito"." - "."$".number_format($saldo, 0, ",", ".")?></a></li><?php } ?>
                <!-- Registro/inicio de sesion -->
                <?php if(!$logged){?>
                <li class="nav-item m-auto"><a class="nav-link" href="register.php">Registrar</a></li>
                <li class="nav-item m-auto"><a class="nav-link" href="login.php">Iniciar sesion</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    </nav>
</header>

<!-- Tema automatico de sesion-->
<script>
    function getCookie(cname) {
        let name = cname + "="; 
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
            c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
            }
        }
        return "";
        }
    let bod = document.body
    let theme = getCookie("theme")
    switch (theme) {
        case "dark":
            bod.className = "dark-mode-s"
            document.getElementById("toggle").checked = true
            break;
        case "light":
            bod.className = "light-mode-s"
            document.getElementById("toggle").checked = false
            break;
        default:
            break;
    }
</script>