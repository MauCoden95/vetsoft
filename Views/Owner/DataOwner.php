<?php
require_once 'Config/Helpers.php';

if (!isLogged($_SESSION['user'])) {
    header('Location: http://localhost/VetSoft/User/index');
}else{
    $userType = $_SESSION['user']->user_type;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php base_url ?>/Assets/css/Styles.css">

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

    <script src="<?= base_url ?>/Main.js" defer></script>
    <title>Document</title>
</head>

<body>
    <section class="relative w-screen h-screen flex">
        <div class="relative w-1/5 h-full bg-emerald-600 px-5 flex">
            <div class="w-full h-5/6 flex flex-col justify-start">
                <i class="fas fa-globe text-5xl text-white my-10"></i>
                <?php if($userType == 'Administrador') : ?>
                    <div class="w-full min-h-0">
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/dashboard"><i class="fas fa-columns"></i> Dashboard</a>
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Veterinary/index"><i class="fas fa-user-md"></i> Veterinarios</a>
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Patient/index"><i class="fas fa-bone"></i> Pacientes</a>
                        <a class="w-full bg-emerald-800 hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Owner/index"><i class="fas fa-user"></i> Clientes</a>
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="far fa-calendar"></i> Turnos</a>
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="far fa-user"></i> Usuarios</a>
                    </div>
                    <div class="border-b border-gray-300 my-5"></div>
                    <div class="w-full min-h-0">
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/settings"><i class="fas fa-cog"></i> Mi perfil</a>
                        <a class="w-full bg-red-500 hover:bg-red-950 hover:text-white py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/logout"><i class="fas fa-sign-out-alt mr-1"></i>Cerrar sesión</a>
                    </div>
                <?php else: ?>
                    <div class="w-full min-h-0">
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/dashboard"><i class="fas fa-columns"></i> Dashboard</a>
                        <a class="w-full bg-emerald-800 hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Patient/index"><i class="fas fa-bone"></i> Pacientes</a>
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

        <div class="w-4/5 h-full overflow-y-scroll">
            <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
                <h1 class="text-4xl">Clientes</h1>
                <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
            </div>
            <div class="relative w-full min-h-[100px]">
                <a class="absolute left-5 text-xl" href="http://localhost/VetSoft/Patient/index"><i class="fas fa-arrow-left"></i> Volver</a>
                <table class="w-3/6 mt-12 divide-y divide-gray-200 m-auto">
                    <?php while ($obj = $dataOwner->fetch_object()) : ?>
                        <tr class="w-3/5">
                            <th class="w-1/3  bg-emerald-300 border border-gray-600 py-2">#</th>
                            <td class="w-1/3 text-center border bg-white border-gray-600 py-2"><?php echo $obj->id; ?></td>
                        </tr>
                        <tr>
                            <th class="w-1/3  bg-emerald-300 border border-gray-600 py-2">Nombre</th>
                            <td class="w-1/3 text-center py-2 bg-white border border-gray-600"><?php echo $obj->name; ?></td>
                        </tr>
                        <tr>
                            <th class="w-1/3  bg-emerald-300 border border-gray-600 py-2">Dni</th>
                            <td class="w-1/3 text-center py-2 bg-white border border-gray-600"><?php echo $obj->dni; ?></td>
                        </tr>
                        <tr>
                            <th class="w-1/3  bg-emerald-300 border border-gray-600 py-2">Teléfono</th>
                            <td class="w-1/3 text-center py-2 bg-white border border-gray-600"><?php echo $obj->phone; ?></td>
                        </tr>
                        <tr>
                            <th class="w-1/3  bg-emerald-300 border border-gray-600 py-2">Teléfono2</th>
                            <td class="w-1/3 text-center py-2 bg-white border border-gray-600"><?php echo $obj->phone2; ?></td>
                        </tr>
                        <tr>
                            <th class="w-1/3  bg-emerald-300 border border-gray-600 py-2">Correo Electrónico</th>
                            <td class="w-1/3 text-center py-2 bg-white border border-gray-600"><?php echo $obj->mail; ?></td>
                        </tr>
                        <tr>
                            <th class="w-1/3  bg-emerald-300 border border-gray-600 py-2">Dirección</th>
                            <td class="w-1/3 text-center py-2 bg-white border border-gray-600"><?php echo $obj->address; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>





        </div>



    </section>
</body>

</html>