<?php session_start();
include "conexion.php";
if($_POST){
    if(is_uploaded_file($_FILES["imagen"]["tmp_name"])){
        $nombre = $_POST["nombre_producto"];
        $codigo = $_POST["codigo"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];
        $stock = $_POST["stock"];

        $imagen = $_FILES["imagen"]["name"];
        $dest = __DIR__."/images/".$imagen;

        $objConexion = new conexion();
        $sql = "INSERT INTO `producto`(`codigo`, `nombre`, `precio`, `imagen`, `descripcion`, `stock`)
                VALUES ('$codigo','$nombre','$precio','$imagen','$descripcion','$stock')";
        $objConexion->ejecutar($sql);

        if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $dest)){
            echo "<script>alert('Catálogo actualizado!'); window.location.href='gestion_catalogo.php'</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="styles/form-style.css">
    <title>Agregar producto</title>
    <?php include("header.php");?>
    <div class="container text-center" style="max-width:650px;">
        <h1>Agregar nuevo producto</h1>
        <form action="add_producto.php" method="post" enctype="multipart/form-data" class="row g-2" style="color:black;">
            <div class="col-md-6 mb-3 input-group">
                <label class="input-group-text" for="inp-imagen">Imagen del producto</label>
                <input type="file" class="form-control" id="inp-imagen" name="imagen" required>
            </div>
            <div class="col-md-6 input-group mb-3">
                <span class="input-group-text">Código de producto</span>
                <input type="text" class="form-control" name="codigo" placeholder="Código de producto" maxlength="10" required>
            </div>
            <div class="col-md-6 input-group mb-3">
                <span class="input-group-text">Nombre del producto</span>
                <input type="text" class="form-control" name="nombre_producto" placeholder="Nombre del producto" maxlength="45" required>
            </div>
            <div class="col-md-6 input-group mb-3">
                <span class="input-group-text">Precio</span>
                <input type="number" class="form-control" name="precio" placeholder="Precio del producto" required>
            </div>
            <div class="col-md-6 input-group mb-3">
                <span class="input-group-text">Descripción</span>
                <textarea type="text" class="form-control" name="descripcion" rows="9" maxlength="500" required></textarea>
            </div>
            <div class="col-md-6 input-group mb-3">
                <span class="input-group-text">Stock disponible</span>
                <input type="number" class="form-control" name="stock" placeholder="Stock disponible" required>
            </div>
            <div class="col-12">
                <input class="btn btn-primary" type="submit" value="Agregar nuevo producto">
            </div>
        </form>
    </div>
</body>
</html>