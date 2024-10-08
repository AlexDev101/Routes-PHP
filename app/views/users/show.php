<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Usuario <?= $user['name'] ?></title>
    </head>
    <body>
        <a href="/users">Volver</a>
        <h1>Información de Usuario</h1>
        <a href="/users/<?= $user['id'] ?>/edit">Editar Usuario</a>
        <div>
            <p>ID: <?= $user['id']?></p>
            <p>Nombre: <?= $user['name']?></p>
            <p>Teléfono: <?= $user['phone']?></p>
            <p>Email: <?= $user['email']?></p>
        </div>
        <form action="/users/<?= $user['id'] ?>/delete" method="post">
            <button type="submit">Eliminar</button>
        </form>
    </body>
</html>