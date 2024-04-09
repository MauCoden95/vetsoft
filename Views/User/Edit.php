<?php
include 'Views/Layout/Menu.php';
?>

<div class="w-4/5 h-full overflow-y-scroll">
    <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
        <h1 class="text-4xl">Usuarios</h1>
        <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
    </div>



    <form class="relative w-11/12 min-h-0 m-auto my-12" action="http://localhost/VetSoft/User/update/<?php print_r($data->id); ?>" method="post">
        <a class="text-xl" href="http://localhost/VetSoft/User/users"><i class="fas fa-arrow-left"></i> Volver</a>
        <h2 class="w-full text-center text-3xl mb-6">Editar usuario <i class="fas fa-user"></i></h2>
        <?php
        if (isset($_SESSION['update_user']) && $_SESSION['update_user'] == true) {
            $res = $_SESSION['update_user']; ?>
            <script>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Exito!!!",
                    html: "<p style='font-size: 18px;'>Se actualizó el usuario de manera correcta</p>",
                    timer: 5000,
                    showConfirmButton: true,
                    confirmButtonText: "OK",
                });
            </script>
        <?php
        }
        unset($_SESSION['update_user'])
        ?>
        <?php
        if (isset($_SESSION['update_user_failed'])) { ?>
            <script>
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error",
                    timer: 3000,
                    text: "<?php echo $_SESSION['update_user_failed'] ?>"
                });
            </script>

        <?php
        }
        unset($_SESSION['update_user_failed']);
        ?>


        <div class="w-full h-full grid grid-cols-2 grid-rows-2 gap-2">
            <select class="w-full m-auto my-3 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" id="gender" name="role_id">
                <option value="<?php print_r($data->role_id) ?>"><?php print_r($data->role_name) ?></option>
                <option value="1">Administrador</option>
                <option value="2">Usuario</option>
            </select>
            <input class="w-full m-auto my-3 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" type="text" name="name" value="<?php print_r($data->name) ?>" placeholder="Nombre...">
            <input class="w-full m-auto my-3 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" type="email" name="mail" value="<?php print_r($data->mail) ?>" placeholder="Correo electrónico...">
            <button class="cursor-pointer text-xl w-full m-auto my-3 py-3 px-5 bg-emerald-500 hover:bg-emerald-800 duration-300">Guardar <i class="fas fa-save"></i></button>
        </div>
    </form>







</div>



</section>
</body>

</html>