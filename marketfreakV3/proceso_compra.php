<?php
if ($_GET) {
    session_start();
    include "conexion.php";
    $objConexion = new conexion();
    $total = $_GET["total"];
    $email = $_SESSION["email"];
    $res = $objConexion->consultar("SELECT `saldo` FROM `usuario` WHERE `email` = '$email'");
    $saldo = $res[0]["saldo"];
    $dif = $saldo - $total;
    // Verificar si se tiene saldo suficiente para realizar la compra
    if($dif < 0){
        echo "<script>alert('Saldo insuficiente'), window.location.href='carro.php'</script>";
        die();
    }
    // Definir fecha de compra
    date_default_timezone_set("America/Santiago");
    $fecha = date("d/m/Y H:i");
    // Cerrar carro pagado y crear un nuevo carro
    $close_carro = "UPDATE `carro` SET `fecha_pago`='$fecha', `estado_delivery`='Pendiente' WHERE `email_usuario`='$email' AND `id_carro` = ".$_SESSION['carro_activo'];
    $new_carro = "INSERT INTO `carro`(`email_usuario`) VALUES ('$email')";
    $objConexion->ejecutar($close_carro);
    $new_id = $objConexion->ejecutar($new_carro);
    // Actualzar saldo y carro activo del usuario
    $update_user = "UPDATE `usuario` SET `saldo`='$dif', `carro_activo`='$new_id' WHERE `email`='$email'";
    $objConexion->ejecutar($update_user);
    $_SESSION["carro_activo"] = $new_id;
    $_SESSION["saldo"] = $dif;
    echo "<script>alert('Compra realizada con éxito'), window.location.href='index.php'</script>";
}
echo "<script>alert('Acceso invalido'), window.location.href='index.php'</script>";
die();
?>