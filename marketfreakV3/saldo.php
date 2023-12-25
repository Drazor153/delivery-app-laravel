<?php session_start();
if($_POST){
    $saldo_tmp = $_POST["monto"];
    if($saldo_tmp != 0){
        include "conexion.php";
        $objConexion = new conexion();
        // Obtener saldo actual
        $email = $_SESSION["email"];
        $radioValue = $_POST["gridRadios"];
        $res = $objConexion->consultar("SELECT `saldo` FROM `usuario` WHERE `email`='$email'");
        $saldo_nuevo = $res[0]["saldo"] + $saldo_tmp;
        $sql_saldo = "UPDATE `usuario` SET `saldo`='$saldo_nuevo' WHERE `email`='$email'";
        $objConexion->ejecutar($sql_saldo);
        $_SESSION["saldo"] = $saldo_nuevo;
        $str_saldo = number_format($saldo_nuevo, 0, ",", ".");
        echo "<script>alert('Confirmacion de $radioValue recibida con éxito! Su nuevo saldo es de $$str_saldo');window.location.href='catalogo.php'</script>";
    }else{
        echo "<script>alert('Debe ingresar el monto a recargar');window.location.href='saldo.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi saldo</title>
    <?php include "header.php";?>
    <h1 class="text-center">Mi saldo</h1>
    <div class="container" style="width: 550px;">
        <form action="saldo.php" method="post">
            <div class="row my-3 g-3">
                <label class="col-sm-4 col-form-control" for="monto">Monto a recargar</label>
                <div class="col-sm-8 mb-3">
                    <input type="number" class="form-control" id="monto" placeholder="Monto a recargar" name="monto" min="10000" max="999999">
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-12 col-sm-4 col-form-label pt-0">Método de carga</legend>
                    <div class="col-12 col-sm-8">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="WebPay" checked>
                            <label class="form-check-label" for="gridRadios1">WebPay</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="PayPal">
                            <label class="form-check-label" for="gridRadios2">PayPal</label>
                        </div>
                    </div>
                </fieldset>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Proceder a recarga</button>
                </div>
            </div>
        </form>
    </div>
        
    
</body>
</html>