<?php include 'Views/Layout/Menu.php'; ?>

<div class="w-4/5 h-full overflow-y-scroll">
    <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
        <h1 class="text-4xl">Turnos</h1>
        <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
    </div>

    <form class="relative w-11/12 min-h-0 m-auto my-12" action="http://localhost/VetSoft/Turn/update/<?php print_r($data->id); ?>" method="post">
        <a class="text-xl" href="http://localhost/VetSoft/Turn/index"><i class="fas fa-arrow-left"></i> Volver</a>
        <h2 class="w-full text-center text-3xl mb-6">Editar turno <i class="fas fa-calendar"></i></h2>
        <?php
        if (isset($_SESSION['update_turn']) && $_SESSION['update_turn'] == true) {
            $res = $_SESSION['update_turn']; ?>
            <script>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Exito!!!",
                    html: "<p style='font-size: 18px;'>Se actualizó el turno de manera correcta</p>",
                    timer: 5000,
                    showConfirmButton: true,
                    confirmButtonText: "OK",
                });
            </script>
        <?php
        }
        unset($_SESSION['update_turn'])
        ?>
        <?php
        if (isset($_SESSION['update_turn_failed'])) { ?>
            <script>
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error",
                    timer: 3000,
                    text: "<?php echo $_SESSION['update_turn_failed'] ?>"
                });
            </script>

        <?php
        }
        unset($_SESSION['update_turn_failed']);
        ?>


        <div class="w-full min-h-0 grid grid-cols-2 grid-rows-2 gap-4">
            <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($data->date); ?>" type="date" name="date">
            <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($data->hour); ?>" type="time" name="hour">
            <select class="block w-full border-b-2 m-auto border-emerald-500 bg-gray-100 py-2 px-5 my-3" name="appointment">
                <option value="<?php print_r($data->hour); ?>" selected><?php print_r($data->appointment); ?></option>
                <option value="Chequeo general">Chequeo general</option>
                <option value="Radiografía">Radiografía</option>
                <option value="Ecografía">Ecografía</option>
                <option value="Análisis de sangre">Análisis de sangre</option>
                <option value="Análisis de orina">Análisis de orina</option>
                <option value="Endoscopia">Endoscopia</option>
                <option value="Biopsia">Biopsia</option>
                <option value="Tomografía computarizada (CT)">Tomografía computarizada (CT)</option>
                <option value="Resonancia magnética (MRI)">Resonancia magnética (MRI)</option>
                <option value="Eutanasia">Eutanasia</option>
            </select>
            <input class="cursor-pointer block w-full m-auto bg-emerald-600 hover:bg-emerald-800 px-2 py-3 my-3" value="Editar" type="submit">
        </div>

    </form>





</div>


</section>
</body>

</html>