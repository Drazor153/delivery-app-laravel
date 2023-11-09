<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi carrito</title>
    <?php include "header.php";
    include "conexion.php";
    $objConexion = new conexion();
    // Asignar id del carro activo del usuario y su atributo precio_total
    $carro_activo = $_SESSION["carro_activo"];
    $sql_carro = "SELECT `precio_total` FROM `carro` WHERE `id_carro` = '$carro_activo'";
    $resultado = $objConexion->consultar($sql_carro);
    $total = $resultado[0]["precio_total"];

    // Listar los productos dentro del pedido
    $sql_lineas = "SELECT `codigo_producto`, `cantidad`, `precio_linea` FROM `linea_producto` WHERE `id_carro` = '$carro_activo'";
    $resultado = $objConexion->consultar($sql_lineas);
    if(empty($resultado)){
        echo "<script>alert('Carrito vacio'), window.location.href='catalogo.php'</script>";
        die();
    }
    ?>
    <div class="container text-center">
        <h1>CARRO</h1>
        <table class="table table-light table-striped">
            <thead>
                <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Cantidad pedida</th>
                    <th scope="col">Precio parcial</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                $item = 1;
                foreach($resultado as $linea) {
                    $codigo = $linea["codigo_producto"];
                    $res = $objConexion->consultar("SELECT `imagen` FROM `producto` WHERE `codigo` = '$codigo'");
                    $imagen = $res[0]["imagen"];
                    $cantidad = $linea["cantidad"];
                    $precio_linea = $linea["precio_linea"];
                    ?>
                <tr>
                    <th scope="row"><?php echo $item;?></th>
                    <td>
                        <a href=<?php echo "producto.php?codigo=".$codigo;?>>
                        <img src=<?php echo "images/".$imagen;?> alt="imagen de producto" style="height:200px; object-fit: cover">
                        </a>
                    </td>
                    <td><?php echo $cantidad;?></td>
                    <td><?php echo number_format($precio_linea, 0, ",", ".");?></td>
                </tr>
                <?php
                $item++; }?>
                <tr>
                    <th colspan=3>Precio total:</th>
                    <td><?php echo number_format($total, 0, ",", ".");?></td>
                </tr>
            </tbody>
        </table>
        <a href=<?php echo "proceso_compra.php?total=".$total;?> class="btn btn-primary">Confirmar compra</a>
    </div>
</body>
</html>