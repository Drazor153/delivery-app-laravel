<?php session_start();
if($_POST){
    include("conexion.php");
    $email = $_POST["email"];
    $password = $_POST["password"];
    $admin = isset($_POST["admin"]) ? 1 : 0;
    $hpass = hash('sha256', $password);
    $objConexion = new conexion();
    switch ($admin) {
        case true:
            $sql = "SELECT * FROM `admin` WHERE `email` = '$email'";
            $resultado = $objConexion->consultar($sql);
            if(!empty($resultado)){
                foreach($resultado as $admin){
                    if($admin["password"] == $hpass){
                        $_SESSION["email"] = $email;
                        $_SESSION["admin"] = true;
                        $_SESSION["nombre"] = $admin["nombre"];
                        $_SESSION["apellido"] = " ";
                        echo "<script>alert('Bienvenido administrador'), window.location.href='./'</script>";
                    }
                }
            }
            break;
        case false:
            $sql = "SELECT * FROM `usuario` WHERE `email` = '$email'";
            $resultado = $objConexion->consultar($sql);
            if(!empty($resultado)){
                foreach($resultado as $usuario){
                    if($usuario["password"] == $hpass){
                        $_SESSION["email"] = $email;
                        $_SESSION["admin"] = false;
                        $_SESSION["nombre"] = $usuario["nombre"];
                        $_SESSION["apellido"] = $usuario["apellido"];
                        $_SESSION["rut"] = $usuario["rut"];
                        $_SESSION["telefono"] = $usuario["telefono"];
                        $_SESSION["direccion"] = $usuario["direccion"];
                        $_SESSION["saldo"] = $usuario["saldo"];
                        $_SESSION["carro_activo"] = $usuario["carro_activo"];
                        echo "<script>alert('Bienvenido'), window.location.href='./'</script>";
                    }
                }
            }
            break;
        default:
            break;
    }
    echo "<script>alert('ERROR No se han encontrado coincidencias')</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <?php include "header.php"?>
    <!-- h1 es el titulo central de la pagina-->
    <h1 class="text-center"> Bienvenidos a MarketFreak </h1>
    <div class="container text-center" style="max-width:300px;">
        <form action="login.php" method="post" class="row g-2 mb-3">
            <div class="col-12 form-floating mb-3" style="color: black;">
                <input type="email"class="form-control" id="email_input" name="email"  placeholder="Correo" maxlength="45">
                <label for="email_input">Correo</label>
            </div>
            <div class="col-12 form-floating mb-3" style="color: black;">
                <input type="password" class="form-control" id="pass1_input" name="password" placeholder="Mínimo 5 caracteres" id="id_password">
                <label for="pass1_input">Contraseña</label>
            </div>
            <div class="col-12">
                <div class="form-check form-switch text-start">
                    <!-- Switch -->
                    <input type="checkbox" class="form-check-input" name="admin" id="admin_check" role="switch">
                    <label for="admin_check" class="form-check-label">Administrador</label>
                    <!-- <label class="switch">
                        <input type="checkbox" name="admin" class="form-check-input"/>
                        <span class="slider round"></span>
                    </label>
                    <label for="admin" class="form-check-label">¿Eres administrador?</label> -->
                </div>
            </div>
            <div class="col-12">
                <input type="submit" value="Iniciar sesión" class="btn btn-primary">
            </div>
        </form>
        <div class="row g-2">
            <div class="col-12">
                <label for="registro">¿Eres nuevo?</label>
                <a href="register.php" class="btn btn-primary">Registrarse</a>
            </div>
        </div>
    </div>
    

</body> 
<html>