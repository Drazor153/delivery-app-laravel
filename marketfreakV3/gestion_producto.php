<!-- Para entrar a esta pagina, se requiere pasar el codigo de producto por el metodo GET -->
<?php
session_start();
include "conexion.php";
$objConexion = new conexion();
$codigo = $_GET["codigo"];
// Cuando se presiona el boton Confirmar cambios, $_POST es verdadero
if($_POST){
    // Guardar los datos obtenidos de los input de form
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    $stock = $_POST["stock"];
    $activo = isset($_POST["activo"]) ? 1 : 0;
    $sql = "UPDATE `producto` SET `nombre`='$nombre',`precio`='$precio',`descripcion`='$descripcion',`stock`='$stock',`activo`='$activo' WHERE `codigo` = '$codigo'";
    // Se verifica si se subio una imagen en el input file para modificar la instruccion SQL y guardar la imagen en archivos locales
    if(is_uploaded_file($_FILES["imagen"]["tmp_name"])){
        $imagen = $_FILES["imagen"]["name"];
        $dest = __DIR__."/images/".$imagen;
        $sql = "UPDATE `producto` SET `nombre`='$nombre',`precio`='$precio',`imagen`='$imagen',`descripcion`='$descripcion',`stock`='$stock',`activo`='$activo' WHERE `codigo` = '$codigo'";
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $dest);
    }
    $objConexion->ejecutar($sql);
    echo "<script>alert('Producto actualizado!'), window.location.href='gestion_catalogo.php'</script>";
    die();
}
if(!$_GET){
    echo "<script>alert('Acceso invalido'), window.location.href='gestion_catalogo.php'</script>";
    die();
}
if(!isset($_GET["codigo"])){
    echo "<script>alert('Acceso invalido'), window.location.href='gestion_catalogo.php'</script>";
    die();
}

$sql = "SELECT * FROM `producto` WHERE codigo = '$codigo'";
$producto = $objConexion->consultar($sql);
$nombre_producto = $producto[0]["nombre"];
$precio = $producto[0]["precio"];
$imagen = $producto[0]["imagen"];
$descripcion = $producto[0]["descripcion"];
$stock = $producto[0]["stock"];
$activo = $producto[0]["activo"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar producto</title>
    <?php include "header.php";?>
    <div class="container">
        <h1 class="text-center">Editar datos</h1>
        <div class="card mb-3" style="color:black;">
            <div class="row g-0">
                <div class="col-md-4 my-auto">
                    <img class="img-fluid rounded-start" src=<?php echo "images/".$imagen?> alt="producto">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <form action="<?php echo "gestion_producto.php?codigo=".$codigo;?>" method="post" enctype="multipart/form-data">
                            <!-- Nombre -->
                            <p class="card-text">
                                <h5>Nombre del producto:</h5>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="text" name="nombre" id="inp-nombre" aria-label="nombre producto" aria-describedby="btn-edit-nombre" value="<?php echo $nombre_producto?>" readonly>
                                    <button class="btn btn-outline-secondary" id="btn-edit-nombre" type="button" onclick="enable('inp-nombre')">Editar</button>
                                </div>
                            </p>
                            <!-- Precio -->
                            <p class="card-text">
                                <h5>Precio:</h5>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="number" name="precio" id="inp-precio" aria-label="precio producto" aria-describedby="btn-edit-precio" value="<?php echo $precio?>" readonly>
                                    <button class="btn btn-outline-secondary" id="btn-edit-precio" type="button" onclick="enable('inp-precio')">Editar</button>
                                </div>
                            </p>
                            <!-- Descripcion -->
                            <p class="card-text">
                                <h5>Descripción:</h5>
                                <div class="input-group mb-3">
                                    <textarea class="form-control" name="descripcion" rows="6" id="inp-desc" aria-label="desc producto" aria-describedby="btn-edit-desc" readonly><?php echo $descripcion?></textarea>
                                    <button class="btn btn-outline-secondary" id="btn-edit-desc" type="button" onclick="enable('inp-desc')">Editar</button>
                                </div>
                            </p>
                            <!-- Stock -->
                            <p class="card-text">
                                <h5>Stock disponible:</h5>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="number" name="stock" id="inp-stock" aria-label="stock producto" aria-describedby="btn-edit-stock" value="<?php echo $stock?>" readonly>
                                    <button class="btn btn-outline-secondary" id="btn-edit-stock" type="button" onclick="enable('inp-stock')">Editar</button>
                                </div>
                            </p>
                            <!-- Imagen -->
                            <p class="card-text">
                                <h5>Imagen:</h5>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="file" id="inp-imagen" name="imagen">
                                    <label class="input-group-text" for="inp-imagen">Cambiar imagen</label>
                                </div>
                            </p> 
                            <!-- Mostrar en catalogo -->
                            <p class="card-text">
                                <h5>Mostrar producto en el catálogo:</h5>
                                <div class="input-group mb-3">
                                    <label class="switch">
                                        <input type="checkbox" name="activo" id="showSh"/>
                                        <span class="slider round"></span>
                                    </label>
                                    <?php echo "<script>document.getElementById('showSh').checked = ".($activo ? "true": "false")."</script>";?>
                                </div>
                            </p>
                            <input class="btn btn-primary" type="submit" value="Confirmar cambios">
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    function enable(arg){
        let input = document.getElementById(arg)
        input.readOnly = false
    }
</script>