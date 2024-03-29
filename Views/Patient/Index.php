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

    <script src="<?= base_url ?>/Main.js" defer></script>
    <title>Document</title>
</head>

<body>
    <section class="relative w-screen h-screen flex">
        <div class="relative w-1/5 h-full bg-emerald-600 px-5 flex">
            <div class="w-full h-5/6 flex flex-col justify-start">
                <i class="fas fa-globe text-5xl text-white my-10"></i>
                <div class="w-full min-h-0">
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="#"><i class="fas fa-columns"></i> Dashboard</a>
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Veterinary/index"><i class="fas fa-user-md"></i> Veterinarios</a>
                    <a class="w-full bg-emerald-800 hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Patient/index"><i class="fas fa-bone"></i> Pacientes</a>
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Owner/index"><i class="fas fa-user"></i> Clientes</a>
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="far fa-calendar"></i> Turnos</a>
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="far fa-user"></i> Usuarios</a>
                </div>
                <div class="border-b border-gray-300 my-5"></div>
                <div class="w-full min-h-0">
                    <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/settings"><i class="fas fa-cog"></i> Mi perfil</a>
                    <a class="w-full bg-red-500 hover:bg-red-950 hover:text-white py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/logout"><i class="fas fa-sign-out-alt mr-1"></i>Cerrar sesión</a>
                </div>
            </div>


        </div>

        <div class="w-4/5 h-full overflow-y-scroll">
            <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
                <h1 class="text-4xl">Pacientes</h1>
                <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
            </div>
            <div class="relative w-full min-h-[100px]">
                <div class="absolute overflow-hidden top-6 left-10 w-64 h-36 rounded-md bg-emerald-400">
                    <h2 class="text-xl text-center mt-3">Cantidad de pacientes</h2>
                    <h2 class="absolute -bottom-5 text-8xl text-emerald-800"><i class="fas fa-bone"></i></h2>
                    <h3 class="absolute bottom-5 right-5 text-7xl"><?php print_r($count->cantidad_de_registros); ?></h3>
                </div>

                <button id="add" class="absolute top-6 right-10 rounded-md bg-emerald-400 hover:bg-emerald-600 py-2 px-5 duration-300 text-xl">Agregar <i class="fas fa-plus-circle"></i></button>
            </div>

            <div class="w-11/12 m-auto mt-32">
                <h4 class="text-2xl"><i class="fas fa-search"></i> Buscar</h4>
                <input id="searchInput" class="w-full bg-gray-50 py-3 px-2  border-b-2 border-gray-300 outline-none mt-5" type="text" placeholder="Buscar por nombre...">
            </div>

            <table id="dataTable" class="w-11/12 m-auto mt-8 mb-10">
                <thead>
                    <tr class="w-full">
                        <th class="w-1/12 bg-emerald-300 py-2 border border-black">#</th>
                        <th class="w-1/12 bg-emerald-300 py-2 border border-black">Nombre</th>
                        <th class="w-1/12 bg-emerald-300 py-2 border border-black">Animal</th>
                        <th class="w-1/12 bg-emerald-300 py-2 border border-black">Raza</th>
                        <th class="w-1/12 bg-emerald-300 py-2 border border-black">Edad</th>
                        <th class="w-1/12 bg-emerald-300 py-2 border border-black">Sexo</th>
                        <th class="w-1/12 bg-emerald-300 py-2 border border-black">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $currentDate = new DateTime();
                    while ($pat = $patients->fetch_object()) :

                        $birthDate = new DateTime($pat->birth);
                        $age = $birthDate->diff($currentDate);
                        $ageYears = $age->y;
                        $ageMonths = $age->m;
                        $ageString = $ageYears . " años";
                        if ($ageMonths > 0) {
                            $ageString .= ", " . $ageMonths . " meses";
                        }

                    ?>
                        <tr>
                            <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $pat->id; ?></td>
                            <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $pat->name; ?></td>
                            <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $pat->animal; ?></td>
                            <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $pat->breed; ?></td>
                            <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $ageString; ?></td>
                            <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $pat->gender; ?></td>
                            <td class="w-1/12 bg-gray-100 border border-black text-center py-2">
                                <a class="text-emerald-500 duration-300 hover:underline" title="Info del dueño" href="http://localhost/VetSoft/Owner/ownerData/<?php echo $pat->owner_id ?>"><i class="text-xl fas fa-book text-blue-500 hover:text-blue-800 mr-5"></i></a>
                                <a href="http://localhost/VetSoft/Owner/edit/<?php echo $pat->id ?>" title="Editar"><i class="text-xl fas fa-pencil-alt text-cyan-500 hover:text-cyan-800 mr-5"></i></a>
                                <a href="http://localhost/VetSoft/Owner/delete/<?php echo $pat->id ?>" title="Eliminar"><i class="text-xl fas fa-trash text-red-500 hover:text-red-800"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>



        </div>

        <div class="absolute hidden duration-400 top-0 left-0 container_form w-screen h-screen bg-black bg-opacity-80 flex items-center justify-center">
            <i id="hidden" class="cursor-pointer absolute top-5 right-5 duration-300 text-white hover:text-gray-400 text-6xl fas fa-times-circle"></i>
            <div class="w-3/5 h-auto py-7 px-5 bg-white rounded-md">
                <form class="w-full min-h-0 flex flex-col" action="http://localhost/VetSoft/Patient/save" method="post" autocomplete="off">
                    <h2 class="text-center text-3xl my-3 mb-10">Agregar paciente <i class="fas fa-bone"></i></h2>
                    <?php if (isset($_SESSION['save_pat']) && $_SESSION['save_pat']) : ?>
                        <span class="block w-full m-auto text-center p-1 bg-green-600 border-4 border-green-900 text-white rounded-md mb-5">Cliente guardado con exito</span>
                    <?php elseif (isset($_SESSION['save_pat']) && !$_SESSION['save_pat']) : ?>
                        <span class="block w-full m-auto text-center p-1 bg-red-600 border-4 border-red-900 text-white rounded-md mb-5">Error al guardar, revise los campos</span>
                    <?php endif; ?>
                    <div class="w-full h-full grid grid-cols-2 grid-rows-4 gap-2">
                        <select id="owner_id" name="owner_id">
                            <option value="">--Dueño--</option>
                            <?php while ($own = $owners->fetch_object()) : ?>
                                <option value="<?= $own->id; ?>"><?= $own->name; ?></option>
                            <?php endwhile; ?>
                        </select>

                        <input class="w-full m-auto my-1 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" type="text" name="name" placeholder="Nombre...">
                        <input class="w-full m-auto my-1 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" type="text" name="animal" placeholder="Animal...">
                        <input class="w-full m-auto my-1 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" type="text" name="breed" placeholder="Raza...">
                        <input class="w-full m-auto my-1 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" type="date" name="birth" placeholder="Nacimiento...">
                        <select id="gender" name="gender">
                            <option value="">--Género--</option>
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                        <input class="col-span-2 cursor-pointer w-full m-auto my-3 py-3 px-5 bg-emerald-500 hover:bg-emerald-800" type="submit" value="Enviar">
                    </div>
                </form>
            </div>
        </div>

    </section>
</body>

</html>