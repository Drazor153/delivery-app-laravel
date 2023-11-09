<?php 
// Agregar nuevo producto al carro de un usuario
if(!$_GET){
    echo "<script>alert('Acceso invalido');window.location.href='index.php'</script>";
    die();
}
session_start();
if(!isset($_SESSION["email"])){
    echo "<script>alert('Debe iniciar sesión');window.location.href='login.php'</script>";
    die();
}
include "conexion.php";
$objConexion = new conexion();
$email = $_SESSION["email"];
$codigo = $_GET["codigo"];
$precio = $_GET["precio"];
$carro_activo = $_SESSION["carro_activo"];
// Obtener precio total del carro activo del usuario
$sql_carro = "SELECT `precio_total` FROM `carro` WHERE `id_carro` = '$carro_activo'";
$resultado = $objConexion->consultar($sql_carro);
$total_bf = $resultado[0]["precio_total"]; 
// Verificar si ya existe una linea con el codigo 
$sql_linea = "SELECT `cantidad` FROM `linea_producto` WHERE `id_carro` = '$carro_activo' AND `codigo_producto` = '$codigo'";
$resultado = $objConexion->consultar($sql_linea);
if(empty($resultado)){
    // Ingresar nueva linea al carro
    $sql = "INSERT INTO `linea_producto`(`id_carro`, `codigo_producto`, `cantidad`, `precio_linea`) VALUES ('$carro_activo','$codigo','1','$precio')";
    $objConexion->ejecutar($sql);
    $precio_tmp = $precio;
}else{
    // Actualizar linea
    $tmp_cant = $resultado[0]["cantidad"] + 1;
    $tmp_prec_li = $tmp_cant*$precio;
    $sql = "UPDATE `linea_producto` SET `cantidad` = '$tmp_cant', `precio_linea` = '$tmp_prec_li' WHERE `id_carro` = '$carro_activo' AND `codigo_producto` = '$codigo'";  
    $objConexion->ejecutar($sql);
    $precio_tmp = $precio;
}
// Actualizar precio total del carro activo
$total_af = $total_bf + $precio_tmp;
$update = "UPDATE `carro` SET `precio_total`='$total_af' WHERE `id_carro` = '$carro_activo'";
$objConexion->ejecutar($update);
echo "<script>window.location.href='carro.php'</script>";
?>