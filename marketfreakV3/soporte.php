<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte</title>
    <?php include "header.php";?>
    <h1 class="text-center">Enviar ticket de soporte</h1>
    <div class="container text-center" style="max-width:500px;">
        <form action="" method="post">
            <div class="mb-3">
                <label for="inp-asunto" class="form-label">Asunto</label>
                <input type="text" class="form-control" name="asunto" id="inp-asunto">
            </div>
            <div class="mb-3">
                <label for="inp-mensaje" class="form-label">Mensaje</label>
                <textarea name="mensaje" id="inp-mensaje" rows="5" class="form-control"></textarea>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar ticket de soporte">
        </form>
    </div>
</body>
</html>