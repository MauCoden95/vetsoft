<?php
include 'Views/Layout/Menu.php';
$result = new stdClass();
$count = $result->{'count(*)'} = 4;
?>

<div class="w-4/5 h-full overflow-y-scroll">
    <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
        <h1 class="text-4xl">Usuarios</h1>
        <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
    </div>
    <div class="relative w-full min-h-[100px]">
        <div class="absolute overflow-hidden top-6 left-10 w-64 h-36 rounded-md bg-emerald-400">
            <h2 class="text-xl text-center mt-3">Cantidad de usuarios</h2>
            <h2 class="absolute -bottom-2 -left-3 text-8xl text-emerald-800"><i class="fas fa-user"></i></h2>
            <h3 class="absolute bottom-5 right-5 text-7xl"><?php print_r($users_count->cantidad_de_registros); ?></h3>
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
                <th class="w-2/12 bg-emerald-300 py-2 border border-black">Nombre</th>
                <th class="w-2/12 bg-emerald-300 py-2 border border-black">Rol</th>
                <th class="w-2/12 bg-emerald-300 py-2 border border-black">Email</th>
                <th class="w-1/12 bg-emerald-300 py-2 border border-black">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $list->fetch_object()) : ?>
                <tr>
                    <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $user->id; ?></td>
                    <td class="w-2/12 bg-gray-100 border border-black text-center py-2"><?= $user->name; ?></td>
                    <td class="w-2/12 bg-gray-100 border border-black text-center py-2"><?= $user->role; ?></td>
                    <td class="w-2/12 bg-gray-100 border border-black text-center py-2"><?= $user->email; ?></td>
                    <td class="w-1/12 bg-gray-100 border border-black text-center py-2">
                        <a href="http://localhost/VetSoft/Veterinary/edit/<?php echo $user->id ?>" title="Editar"><i class="text-xl fas fa-pencil-alt text-cyan-500 hover:text-cyan-800 mr-5"></i></a>
                        <button class="delete_user" data-id="<?= $user->id; ?>"><i class="text-xl fas fa-trash text-red-500 hover:text-red-800"></i></button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>




</div>

<div class="absolute hidden duration-400 top-0 left-0 container_form w-screen h-screen bg-black bg-opacity-80 flex items-center justify-center">
    <i id="hidden" class="cursor-pointer absolute top-5 right-5 duration-300 text-white hover:text-gray-400 text-6xl fas fa-times-circle"></i>
    <div class="w-3/5 h-auto py-2 px-5 bg-white rounded-md">
        <form class="w-full min-h-0 flex flex-col" action="http://localhost/VetSoft/User/save" method="post" autocomplete="off">
            <h2 class="text-center text-3xl my-3">Agregar usuario <i class="fas fa-user"></i></h2>
            <?php
            if (isset($_SESSION['save_user']) && $_SESSION['save_user'] == true) { ?>
                <script>
                    localStorage.setItem("state_owner", false);
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Exito!!!",
                        html: "<p style='font-size: 18px;'>Se creó el usuario de manera correcta</p>",
                        timer: 5000,
                        showConfirmButton: true,
                        confirmButtonText: "OK",
                    });
                </script>
            <?php
            }
            unset($_SESSION['save_user']);
            ?>
            <?php
            if (isset($_SESSION['save_user_failed'])) { ?>
                <script>
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Error",
                        timer: 3000,
                        text: "<?php echo $_SESSION['save_user_failed'] ?>"
                    });
                </script>

            <?php
            }
            unset($_SESSION['save_user_failed']);
            ?>

            <div class="w-full h-full grid grid-cols-2 grid-rows-2 gap-2">
                <select class="w-full m-auto my-3 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" id="gender" name="role_id">
                    <option value="">--Rol de usuario--</option>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>
                </select>
                <input class="w-full m-auto my-3 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" type="text" name="name" placeholder="Nombre...">
                <input class="w-full m-auto my-3 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" type="email" name="mail" placeholder="Correo electrónico...">
                <button class="cursor-pointer text-xl w-full m-auto my-3 py-3 px-5 bg-emerald-500 hover:bg-emerald-800 duration-300">Guardar <i class="fas fa-save"></i></button>
            </div>
        </form>
    </div>
</div>

</section>
</body>

</html>