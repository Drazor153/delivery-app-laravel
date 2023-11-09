<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
    <?php include "header.php"?>
    <div class="container-fluid text-center">
        <h1>Catálogo</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-4 vw-100">
            <?php 
                include "conexion.php";
                $objConexion = new conexion();
                $resultado = $objConexion->consultar("SELECT * FROM producto");
                foreach ($resultado as $producto) { 
                    if($producto["activo"]){
                        $nombre_producto = $producto["nombre"];
                        $precio = $producto["precio"];
                        $codigo = $producto["codigo"];
                        $imagen = $producto["imagen"];
                        $precio = $producto["precio"];                
            ?>
            <div class="col">
                <div class="card text-center h-100 m-auto" style="width: 18rem; color:black;">
                    <img class="card-img-top border border-2 rounded-3" src=<?php echo "images/".$imagen?> alt="imagen producto" style="height:300px; object-fit: cover">
                    <div class="card-body">
                        <h5><?php echo $nombre_producto?></h5>
                        <p><?php echo "Precio: $".number_format($precio, 0, ",", ".")?></p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-secondary card-link" href=<?php echo "producto.php?codigo=".$codigo?>>Detalles</a>
                        <a class="btn btn-secondary card-link" href=<?php echo "add_linea.php?codigo=$codigo"."&precio=$precio";?>>Agregar a carrito</a>
                    </div>
                </div>
            </div>
            <?php }} ?>
        </div>  
    </div>
</body>
</html>