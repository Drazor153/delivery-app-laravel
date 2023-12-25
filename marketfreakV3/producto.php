<!-- Para entrar a esta pagina, se requiere pasar el codigo de producto por el metodo GET -->
<?php
if(!$_GET){
    echo "<script>alert('Acceso invalido'), window.location.href='catalogo.php'</script>";
}
if(!isset($_GET["codigo"])){
    echo "<script>alert('Acceso invalido'), window.location.href='catalogo.php'</script>";
}
session_start();
include("conexion.php");
$objConexion = new conexion();
$codigo = $_GET["codigo"];
$sql = "SELECT * FROM `producto` WHERE codigo = '$codigo'";
$resultado = $objConexion->consultar($sql);
$nombre_producto = $resultado[0]["nombre"];
$precio = $resultado[0]["precio"];
$imagen = $resultado[0]["imagen"];
$descripcion = $resultado[0]["descripcion"];
$stock = $resultado[0]["stock"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <?php include("header.php")?>
    <div class="container text-center my-5">
        <div class="card mb-3" style="color:black;">
            <div class="row g-0">
                <div class="col-md-4 my-auto">
                    <img class="img-fluid rounded-start" src=<?php echo "images/".$imagen?> alt="producto">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $nombre_producto?></h5>
                        <p class="card-text"><?php echo "Precio: $".number_format($precio, 0, ",", ".")?></p>
                        <p class="card-text"><?php echo $descripcion?></p>
                        <p class="card-text"><?php echo "Stock disponible: ".$stock?></p>
                        <a class="btn btn-secondary card-link" href=<?php echo "add_linea.php?codigo=$codigo"."&precio=$precio";?>>Agregar a carrito</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>