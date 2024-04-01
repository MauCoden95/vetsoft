<?php
require_once 'Config/Helpers.php';

if (!isLogged($_SESSION['user'])) {
    header('Location: http://localhost/VetSoft/User/index');
} else {
    $userType = $_SESSION['user']->user_type;
}




?>

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <section class="w-screen h-screen flex">
        <div class="relative w-1/5 h-full bg-emerald-600 px-5 flex">
            <div class="w-full h-5/6 flex flex-col justify-start">
                <i class="fas fa-globe text-5xl text-white my-10"></i>
                <?php if ($userType == 'Administrador') : ?>
                    <div class="w-full min-h-0">
                        <a class="w-full bg-emerald-800 hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="#"><i class="fas fa-columns"></i> Dashboard</a>
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Veterinary/index"><i class="fas fa-user-md"></i> Veterinarios</a>
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Patient/index"><i class="fas fa-bone"></i> Pacientes</a>
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Owner/index"><i class="fas fa-user"></i> Clientes</a>
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="far fa-calendar"></i> Turnos</a>
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="far fa-user"></i> Usuarios</a>
                    </div>
                    <div class="border-b border-gray-300 my-5"></div>
                    <div class="w-full min-h-0">
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/settings"><i class="fas fa-cog"></i> Mi perfil</a>
                        <a class="w-full bg-red-500 hover:bg-red-950 hover:text-white py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/logout"><i class="fas fa-sign-out-alt mr-1"></i>Cerrar sesión</a>
                    </div>
                <?php else : ?>
                    <div class="w-full min-h-0">
                        <a class="w-full bg-emerald-800 hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="#"><i class="fas fa-columns"></i> Dashboard</a>
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Patient/index"><i class="fas fa-bone"></i> Pacientes</a>
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Owner/index"><i class="fas fa-user"></i> Clientes</a>
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="far fa-calendar"></i> Turnos</a>
                    </div>
                    <div class="border-b border-gray-300 my-5"></div>
                    <div class="w-full min-h-0">
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/settings"><i class="fas fa-cog"></i> Mi perfil</a>
                        <a class="w-full bg-red-500 hover:bg-red-950 hover:text-white py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/logout"><i class="fas fa-sign-out-alt mr-1"></i>Cerrar sesión</a>
                    </div>
                <?php endif; ?>
            </div>


        </div>

        <div class="w-4/5 h-full">
            <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
                <h1 class="text-4xl">Dashboard</h1>
                <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
            </div>

            <div class="w-11/12 h-52 m-auto py-10  flex items-center justify-between">
                <div class="relative overflow-hidden w-52 h-28 rounded-md bg-emerald-400">
                    <h2 class="text-lg text-center mt-3">Veterinarios</h2>
                    <h2 class="absolute -bottom-2 -left-3 text-7xl text-emerald-800"><i class="fas fa-user-md"></i></h2>
                    <h3 class="absolute bottom-3 right-3 text-5xl"><?php print_r($veterinaries_count->cantidad_de_registros); ?></h3>
                </div>

                <div class="relative overflow-hidden w-52 h-28 rounded-md bg-emerald-400">
                    <h2 class="text-lg text-center mt-3">Pacientes</h2>
                    <h2 class="absolute -bottom-5 text-7xl text-emerald-800"><i class="fas fa-bone"></i></h2>
                    <h3 class="absolute bottom-3 right-3 text-5xl"><?php print_r($patients_count->cantidad_de_registros); ?></h3>
                </div>

                <div class="relative overflow-hidden w-52 h-28 rounded-md bg-emerald-400">
                    <h2 class="text-lg text-center mt-3">Pacientes</h2>
                    <h2 class="absolute -bottom-5 text-7xl text-emerald-800"><i class="fas fa-bone"></i></h2>
                    <h3 class="absolute bottom-3 right-3 text-5xl"><?php print_r($patients_count->cantidad_de_registros); ?></h3>
                </div>

                <div class="relative overflow-hidden w-52 h-28 rounded-md bg-emerald-400">
                    <h2 class="text-lg text-center mt-3">Clientes</h2>
                    <h2 class="absolute -bottom-2 -left-3 text-7xl text-emerald-800"><i class="fas fa-user"></i></h2>
                    <h3 class="absolute bottom-3 right-3 text-5xl"><?php print_r($owners_count->cantidad_de_registros); ?></h3>
                </div>
            </div>
        </div>

    </section>
</body>

</html>