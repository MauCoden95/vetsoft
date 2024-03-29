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
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Veterinary/index"><i class="fas fa-user-md"></i> Veterinarios</a>
                    <a class="w-full bg-emerald-800 hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="fas fa-bone"></i> Pacientes</a>
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Owner/index"><i class="fas fa-user"></i> Clientes</a>
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="far fa-calendar"></i> Turnos</a>
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="far fa-user"></i> Usuarios</a>
                </div>
                <div class="border-b border-gray-300 my-5"></div>
                <div class="w-full min-h-0">
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/settings"><i class="fas fa-cog"></i> Mi perfil</a>
                    <a class="w-full bg-red-500 hover:bg-red-950 hover:text-white py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/logout"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
                </div>
            </div>


        </div>

        <div class="w-4/5 h-full overflow-y-scroll">
            <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
                <h1 class="text-4xl">Pacientes</h1>
                <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
            </div>



            <form class="relative w-5/6 min-h-0 m-auto my-6" action="http://localhost/VetSoft/Patient/update/<?php echo $id ?>" method="post">
                <a class="text-xl" href="http://localhost/VetSoft/Patient/index"><i class="fas fa-arrow-left"></i> Volver</a>
                <h2 class="w-full text-center text-3xl mb-6">Editar paciente <i class="fas fa-pencil"></i></h2>
                <?php if (isset($_SESSION['update_pat']) && $_SESSION['update_pat']) : ?>
                    <span class="block w-full m-auto text-center p-3 bg-green-600 border-4 border-green-900 text-white rounded-md mb-5">Paciente actualizado con exito</span>
                <?php elseif (isset($_SESSION['update_pat']) && !$_SESSION['update_pat']) : ?>
                    <span class="block w-full m-auto text-center p-3 bg-red-600 border-4 border-red-900 text-white rounded-md mb-5">Error al actualizar, revise los campos</span>
                <?php endif; ?>

             
                <?php while ($pat = $data->fetch_object()) : ?>
                    <div class="w-full min-h-0 grid grid-cols-2 grid-rows-3 gap-4">
                        <select class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" id="owner_id" name="owner_id">
                            <option value="">--Dueño--</option>
                            <?php while ($own = $owners->fetch_object()) : ?>
                                <option value="<?= $own->id; ?>"><?= $own->name; ?></option>
                            <?php endwhile; ?>
                        </select>
                        <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($pat->name); ?>" type="text" name="name">
                        <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($pat->animal); ?>" type="text" name="animal">
                        <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($pat->breed); ?>" type="text" name="breed">
                        <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($pat->birth); ?>" type="date" name="birth">
                        <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($pat->gender); ?>" type="text" name="gender">
                        <input class="col-span-2 cursor-pointer block w-full m-auto bg-emerald-600 hover:bg-emerald-800 px-2 py-3 my-3" value="Editar" type="submit">
                    </div>
                <?php endwhile; ?>

            </form>


        </div>



    </section>
</body>

</html>