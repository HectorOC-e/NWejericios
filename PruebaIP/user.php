<?php
require_once 'userDao.php';

function redirectTo($msg, $url)
{
    echo '<script> alert("' . $msg . '"); window.location.assign("' . $url . '"); </script>';
    die();
}

$catModel = new Users();

$mode = 'DSP';
$id = 0;
$email = "";
$password = "";
$estado = "ACT";
$nombre = "";
$avatar = "";
$fchIngreso = "";
$readOnly = "";

$arrModeDesc = array(
    "INS" => "Agregar Nuevo Usuario",
    "UPD" => "Actualizar %s",
    "DEL" => "Eliminar %s",
    "DSP" => "Detalles de %s",
);

if (isset($_GET["mode"])) {
    $mode = $_GET["mode"];
}
if (isset($_GET["ID"])) {
    $id = intval($_GET["ID"]);
}

if (!isset($arrModeDesc[$mode])) {
    error_log("No se reconoce el modo en el que entro al formulario, modo: $mode");
    header("Location: users.php");
    die();
}
if ($mode !== "INS") {
    $arrUsers = $catModel->getById($id);
    $email = $arrUsers["nombre"];
    $estado = $arrUsers["estado"];
    $password = $arrUsers["password"];
    $nombre = $arrUsers["nombre"];
    $avatar = $arrUsers["avatar"];
    $fchIngreso = $arrUsers["fchIngreso"];
    $modeDesc = sprintf($arrModeDesc[$mode], $avatar);
} else {
    $modeDesc = $arrModeDesc[$mode];
}

if ($mode === 'DEL' || $mode === 'DSP') {
    $readOnly = "readonly disabled";
}

if (isset($_POST["btnConfirmar"])) {
    $mode = $_POST["mode"];
    $id = intval($_POST["id"]);
    $avatar = $_POST["avatar"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $fchIngreso = $_POST["fchIngreso"];
    $estado = $_POST["estado"];

    switch ($mode) {
    case 'INS':
        $catModel->insert(
            $email,
            $estado,
            $password,
            $nombre,
            $avatar,
            $fchIngreso
        );
        redirectTo("Usuario Registrado.", "users.php");
        break;
    case 'UPD':
        $catModel->update(
            $email,
            $estado,
            $password,
            $nombre,
            $avatar,
            $fchIngreso,
            $id
        );
        redirectTo("Usuario Actualizado.", "users.php");
        break;
    case 'DEL':
        $catModel->delete(
            $id
        );
        redirectTo("Usuario Eliminado.", "users.php");
        break;
    default:
        break;
    }
}


?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Usuario</title>
</head>

<body>
    <div class="container">
    <h1><?php echo $modeDesc; ?></h1>
        <form action="user.php?mode=<?php echo $mode; ?>&ID=<?php echo $id; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="mode" value="<?php echo $mode; ?>">
            <label for="avatar">Avatar</label>
            <input <?php echo $readOnly; ?> type="text" name="avatar" id="avatar" value="<?php echo $avatar; ?>">
            <label for="nombre">Nombre</label>
            <input <?php echo $readOnly; ?> type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
            <label for="email">Email</label>
            <input <?php echo $readOnly; ?> type="email" name="email" id="email" value="<?php echo $email; ?>">
            <label for="password">password</label>
            <input <?php echo $readOnly; ?> type="text" name="password" id="password" value="<?php echo $password; ?>">
            <label for="fchIngreso">Fecha Ingreso</label>
            <input <?php echo $readOnly; ?> type="text" name="fchIngreso" id="fchIngreso" value="<?php echo $fchIngreso; ?>">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" <?php echo $readOnly; ?>>
                <option value="ACT" <?php echo ($estado === "ACT") ? "selected" : ""; ?>>Activo</option>
                <option value="INA" <?php echo ($estado === "INA") ? "selected" : ""; ?>>Inactivo</option>
            </select>
            <br>
            <?php if ($mode !== 'DSP') { ?>
                <button type="submit" name="btnConfirmar" class="btn">Confirmar</button>
            <?php } ?>
            <a href="users.php" class="btn">Regresar a usuarios</a>
    </div>
    </form>
</body>

</html>