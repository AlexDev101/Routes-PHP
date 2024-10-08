<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuarios</title>
</head>
<body> 
    <h1>Actualizar Usuario</h1>
    <form action="/users/<?= $user['id'] ?>" method="post">
        <div>
            <label for="name">Nombre</label>
            <input value="<?= $user['name'] ?>" type="text" name="name" id="name">
        </div>
        <div>
            <label for="phone">Teléfono</label>
            <input value="<?= $user['phone'] ?>" type="text" name="phone" id="phone">
        </div>
        <div>
            <label for="email">Email</label>
            <input value="<?= $user['email'] ?>" type="email" name="email" id="email">
        </div>
        <div>
            <label for="password">Contraseña</label>
            <input value="<?= $user['password'] ?>" type="password" name="password" id="password">
        </div>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>