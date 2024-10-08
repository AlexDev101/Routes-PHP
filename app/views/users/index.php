<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-2">Listado de Usuarios</h1>
        <form action="/users" class="flex">

                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                    <input type="text" name="search" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="janesmith">
                </div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buscar</button>

        </form>
        <a href="/users/create">Crear Usuario</a>
        <ul class="list-disc list-inside">
            <?php foreach($users as $user): ?>
                <li>
                    <a href="/users/<?= $user['id']?>">
                        <?= $user['name'] ?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
        <?php 
        
            $paginate = 'users';
            
            // require_once "../app/views/assets/pagination.php"
        
        ?>
    </div>

</body>
</html>