<?php

require_once 'userDao.php';
$catModel = new Users;
$catModel->setup();
$users = $catModel->getAll();
?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <title>usuarios</title>
</head>

<body>

    <div class="container">
        <h1>USUARIOS</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>nombre</th>
                    <th>Email</th>
                    <th>password</th>
                    <th>Fecha Ingreso</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user["id"] ?></td>
                        <td><?php echo $user["avatar"] ?></td>
                        <td><?php echo $user["nombre"] ?></td>
                        <td><?php echo $user["email"] ?></td>
                        <td><?php echo $user["password"] ?></td>
                        <td><?php echo $user["fchIngreso"] ?></td>
                        <td><?php echo $user["estado"] ?></td>
                        <td>
                            <a href="user.php?mode=UPD&ID=<?php echo $user["id"] ?>">Editar</a><br>
                            <a href="user.php?mode=DSP&ID=<?php echo $user["id"] ?>">Ver</a><br>
                            <a href="user.php?mode=DEL&ID=<?php echo $user["id"] ?>">Eliminar</a>
                        </td>
                    </tr>
            <?php } ?>
            </tbody>
        </table>
        <a href="user.php?mode=INS"" class=" btn">Agregar usuarios</a>
    </div>
</body>

</html>