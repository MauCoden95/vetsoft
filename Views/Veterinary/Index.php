<?php
    require_once 'Config/Helpers.php';

    if (!isLogged($_SESSION['user'])) {
        header('Location: http://localhost/VetSoft/User/index');
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
    
    <script src="./Main.js" defer></script>
    <title>Document</title>
</head>

<body>
    <section class="relative w-screen h-screen flex">
        <div class="relative w-1/5 h-full bg-emerald-600 px-5 flex">
            <div class="w-full h-5/6 flex flex-col justify-start">
                <i class="fas fa-globe text-5xl text-white my-10"></i>
                <div class="w-full min-h-0">
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/dashboard"><i class="fas fa-columns"></i> Dashboard</a>
                    <a class="w-full bg-emerald-800 hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Veterinary/index"><i class="fas fa-user-md"></i> Veterinarios</a>
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="fas fa-bone"></i> Pacientes</a>
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="far fa-calendar"></i> Turnos</a>
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="far fa-user"></i> Usuarios</a>
                </div>
                <div class="border-b border-gray-300 my-5"></div>
                <div class="w-full min-h-0">
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="fas fa-cog"></i> Mi perfil</a>
                    <a class="w-full bg-red-500 hover:bg-red-950 hover:text-white py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/logout"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
                </div>
            </div>


        </div>

        <div class="w-4/5 h-full overflow-y-scroll">
            <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
                <h1 class="text-4xl">Veterinarios</h1>
                <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
            </div>
            <div class="relative w-full min-h-[100px]">
                <div class="absolute overflow-hidden top-6 left-10 w-64 h-36 rounded-md bg-emerald-400">
                    <h2 class="text-xl text-center mt-3">Cantidad de veterinarios</h2>
                    <h2 class="absolute -bottom-2 -left-3 text-8xl text-emerald-800"><i class="fas fa-user-md"></i></h2>
                    <h3 class="absolute bottom-5 right-5 text-7xl"><?php print_r($count->cantidad_de_registros); ?></h3>
                </div>

                <button id="add" class="absolute top-6 right-10 rounded-md bg-emerald-400 hover:bg-emerald-600 py-2 px-5 duration-300 text-xl">Agregar <i class="fas fa-plus-circle"></i></button>
            </div>


            <table class="w-11/12 m-auto mt-32 mb-10">
                <thead>
                    <tr class="w-full">
                        <th class="w-1/12 bg-gray-300 py-2 border border-black">#</th>
                        <th class="w-2/12 bg-gray-300 py-2 border border-black">Nombre</th>
                        <th class="w-2/12 bg-gray-300 py-2 border border-black">Dirección</th>
                        <th class="w-1/12 bg-gray-300 py-2 border border-black">Teléfono</th>
                        <th class="w-1/12 bg-gray-300 py-2 border border-black">Teléfono2</th>
                        <th class="w-1/12 bg-gray-300 py-2 border border-black">Licencia</th>
                        <th class="w-1/12 bg-gray-300 py-2 border border-black">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($vet = $veterinaries->fetch_object()) : ?>
                        <tr>
                            <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $vet->id; ?></td>
                            <td class="w-2/12 bg-gray-100 border border-black text-center py-2"><?= $vet->name; ?></td>
                            <td class="w-2/12 bg-gray-100 border border-black text-center py-2"><?= $vet->address; ?></td>
                            <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $vet->phone; ?></td>
                            <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $vet->phone2; ?></td>
                            <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $vet->license; ?></td>
                            <td class="w-1/12 bg-gray-100 border border-black text-center py-2">
                                <a href="http://localhost/VetSoft/Veterinary/edit/<?php echo $vet->id ?>"><i class="text-xl fas fa-pencil-alt text-cyan-500 hover:text-cyan-800 mr-3"></i></a>
                                <a href="http://localhost/VetSoft/Veterinary/delete/<?php echo $vet->id ?>" ><i class="text-xl fas fa-trash text-red-500 hover:text-red-800"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>



        </div>

        <div class="absolute -top-full container_form w-screen h-screen bg-black bg-opacity-80 flex items-center justify-center">
            <i class="cursor-pointer absolute top-5 right-5 text-white hover:text-gray-400 text-6xl fas fa-times-circle"></i>
            <div class="w-2/5 h-96 bg-white rounded-xl">

            </div>
        </div>

    </section>
</body>

</html>