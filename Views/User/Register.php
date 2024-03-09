<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--Tailwind CSS-->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
        theme: {
            extend: {
            colors: {
                clifford: '#da373d',
            }
            }
        }
        }
    </script>
    <title>Document</title>
</head>
<body class="w-screen h-screen bg-emerald-600 flex items-center justify-center">
    <form class="flex flex-col" action="http://localhost/VetSoft/User/add" method="post">
        <input class="mb-5 py-3 px-5" type="number" name="role_id" placeholder="Rol id">
        <input class="mb-5 py-3 px-5" type="text" name="name" placeholder="Nombre">
        <input class="mb-5 py-3 px-5" type="number" name="phone" placeholder="Telefono">
        <input class="mb-5 py-3 px-5" type="email" name="mail" placeholder="Email">
        <input class="mb-5 py-3 px-5" type="password" name="password" placeholder="Contraseña">
        <input class="cursor-pointer mb-5 py-3 px-5 bg-white" type="submit" value="Enviar">
    </form>
</body>
</html>