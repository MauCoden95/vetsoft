<?php
require_once 'Config/Helpers.php';

if (isset($_SESSION['user']) && isLogged($_SESSION['user'])) {
    header('Location: http://localhost/VetSoft/User/dashboard');
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>VetSoft</title>
</head>

<body class="w-screen h-screen bg-emerald-600 overflow-hidden">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-4/6 h-96 bg-white rounded-xl flex items-center justify-evenly py-2 px-5">
        <img src="<?= base_url ?>/Assets/Img/Logo.png" class="w-96">

        <form action="<?= base_url ?>User/login" method="post" class="w-2/5" autocomplete="off">
            <h1 class="text-2xl text-center my-3">Login</h1>
            <?php
            if (isset($_SESSION['login']) && $_SESSION['login'] == false) { ?>
                <script>
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Login incorrecto",
                        timer: 3000,
                        text: "Campos vacíos o credenciales incorrectas"
                    });
                </script>
                <?php
                    unset($_SESSION['login']);
                ?>

            <?php }
            ?>
            <input type="text" name="mail" placeholder="Correo electrónico..." class="w-full mt-4 bg-emerald-50 border-b-2 border-emerald-600 focus:outline-none focus:border-emerald-800 p-2">
            <input type="password" name="password" placeholder="Contraseña..." class="w-full mt-7 bg-emerald-50 border-b-2 border-emerald-600 focus:outline-none focus:border-emerald-800 p-2">
            <input type="submit" value="Ingresar" class="cursor-pointer w-full mt-9 bg-emerald-600 hover:bg-emerald-400 p-2">
        </form>
    </div>
</body>

</html>