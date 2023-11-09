<?php session_start();
if ($_POST) {
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    if (strlen($password) >= 5) {
        $hpass = hash('sha256', $password);
        $hpass2 = hash('sha256', $password2);
        if($hpass == $hpass2){
            include("conexion.php");
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $rut = $_POST['rut'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];

            $objConexion = new conexion();
            $sql = "INSERT INTO `usuario`(`email`, `nombre`, `apellido`, `telefono`, `direccion`, `rut`, `password`) 
            VALUES ('$email','$nombre','$apellido','$telefono','$direccion','$rut','$hpass')";

            $sql_cart = "INSERT INTO `carro`(`email_usuario`) 
            VALUES ('$email')";

            $objConexion->ejecutar($sql);
            $carro_activo = $objConexion->ejecutar($sql_cart);

            $up = "UPDATE `usuario` SET `carro_activo`='$carro_activo' WHERE `email` = '$email'";
            $objConexion->ejecutar($up);
            echo "<script>alert('Usuario registrado correctamente'), window.location.href='login.php'</script>";
        }else{
            echo "<script>alert('Las contraseñas no coinciden')</script>";
        }
    }else{
        echo "<script>alert('La contraseña debe tener al menos 5 caracteres')</script>";
    }
}    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
    <?php include("header.php");?>
    <section>
    <h1 class="text-center">Registrar nuevo usuario</h1>
        <div class="container text-center" style="max-width:650px;">
        <form action="register.php" method="post" class="row g-2" style="color: black;">
            <div class="col-12 col-sm-6 form-floating mb-3">
                <input type="text" class="form-control" id="name_input" name="nombre" placeholder="Nombre" maxlength="25" required>
                <label for="name_input">Nombre</label>
            </div>
            <div class="col-12 col-sm-6 form-floating mb-3">
                <input type="text" class="form-control" id="last_name_input" name="apellido" placeholder="Apellido" maxlength="25" required>
                <label for="last_name_input">Apellido</label>
            </div>
            <div class="col-12 col-sm-6 form-floating mb-3">
                <input type="text" class="form-control" id="rut_input" name="rut" placeholder="Rut sin puntos ni guión" maxlength="10" required >
                <label for="rut_input">Rut</label>
            </div>
            <div class="col-12 col-sm-6 form-floating mb-3">
                <input type="text"class="form-control" id="celnum_input" name="telefono" placeholder="Teléfono (8 dígitos)" maxlength="8" required >
                <label for="celnum_input">Teléfono</label>
            </div>
            <div class="col-12 form-floating mb-3">
                <input type="text"class="form-control" id="address_input" name="direccion"  placeholder="Dirección" maxlength="45" required>
                <label for="address_input">Dirección</label>
            </div>
            <div class="col-12 form-floating mb-3">
                <input type="email"class="form-control" id="email_input" name="email"  placeholder="Correo" maxlength="45" required>
                <label for="email_input">Correo</label>
            </div>
            <div class="col-12 form-floating mb-3">
                <input type="password" class="form-control" id="pass1_input" name="password" placeholder="Mínimo 5 caracteres" id="id_password" required>
                <label for="pass1_input">Contraseña</label>
            </div>
            <div class="col-12 form-floating mb-3">
                <input type="password" class="form-control" id="pass2_input" name="password2" placeholder="Reingrese su contraseña" id="id_password2" required>
                <label for="pass2_input">Confirmar contraseña</label>
            </div>
            <div class="col text-center">
                <input type="submit" value="Registrarse" class="btn btn-primary">
            </div>
        </form>
        </div>
    </section>
</body>
</html>