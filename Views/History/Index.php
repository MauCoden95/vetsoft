<?php include 'Views/Layout/Menu.php'; ?>

<div class="w-4/5 h-full overflow-y-scroll">
    <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
        <h1 class="text-4xl">Historia Clínica</h1>
        <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
    </div>

    <div class="relative w-11/12 h-auto m-auto mt-8 flex items-center justify-between">
        <a class="text-xl" href="http://localhost/VetSoft/Patient/index"><i class="fas fa-arrow-left"></i> Volver</a>
        <button id="add" class="rounded-md bg-emerald-400 hover:bg-emerald-600 py-2 px-5 duration-300 text-xl">Agregar <i class="fas fa-plus-circle"></i></button>
    </div>


    <h2 class="text-center text-4xl my-12">Historia clínica de <?php print_r($name_patient->name) ?></h2>

    <?php if ($patient_history->num_rows >= 1) : ?>
        <table id="dataTable" class="w-11/12 m-auto mt-8 mb-10">
            <thead>
                <tr class="w-full">
                    <th class="w-1/12 bg-emerald-300 py-2 border border-black">#</th>
                    <th class="w-4/12 bg-emerald-300 py-2 border border-black">Historia clínica</th>
                    <th class="w-1/12 bg-emerald-300 py-2 border border-black">Fecha</th>
                    <th class="w-1/12 bg-emerald-300 py-2 border border-black">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $currentDate = new DateTime();
                while ($pat = $patient_history->fetch_object()) :
                    $dateFormat = date('d-m-Y', strtotime($pat->date));


                ?>
                    <tr>
                        <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $pat->id; ?></td>
                        <td class="w-4/12 px-3 bg-gray-100 border border-black text-justify py-2"><?= $pat->history; ?></td>
                        <td class="w-1/12 px-3 bg-gray-100 border border-black text-center py-2"><?= $dateFormat; ?></td>
                        <td class="w-1/12 bg-gray-100 border border-black text-center py-2">
                            <a href="http://localhost/VetSoft/History/edit/<?php echo $pat->id ?>" title="Editar"><i class="text-xl fas fa-pencil-alt text-cyan-500 hover:text-cyan-800 mr-8"></i></a>
                            <a href="http://localhost/VetSoft/History/delete/<?php echo $pat->id ?>" title="Eliminar"><i class="text-xl fas fa-trash text-red-500 hover:text-red-800 mr-2"></i></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <h2 class="text-center text-xl my-12">El paciente <?php print_r($name_patient->name) ?> no tiene registro</h2>
    <?php endif; ?>



</div>

<div class="absolute hidden duration-400 top-0 left-0 container_form w-screen h-screen bg-black bg-opacity-80 flex items-center justify-center">
    <i id="hidden" class="cursor-pointer absolute top-5 right-5 duration-300 text-white hover:text-gray-400 text-6xl fas fa-times-circle"></i>
    <div class="w-3/5 min-h-[250px] py-2 px-5 bg-white rounded-md">
        <form class="w-full h-auto flex flex-col" action="http://localhost/VetSoft/History/save/<?php echo $id ?>" method="post" autocomplete="off">
            <h2 class="text-center text-3xl my-3">Agregar registro <i class="fas fa-user-md"></i></h2>
            <?php
            if (isset($_SESSION['save_his']) && $_SESSION['save_his'] == true) { ?>
                <script>
                    localStorage.setItem("state_owner", false);
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Exito!!!",
                        html: "<p style='font-size: 18px;'>Se agregó el registro de manera correcta</p>",
                        timer: 5000,
                        showConfirmButton: true,
                        confirmButtonText: "OK",
                    });
                </script>
            <?php
            }
            unset($_SESSION['save_his']);
            ?>
            <?php
            if (isset($_SESSION['save_his_failed'])) { ?>
                <script>
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Error",
                        timer: 3000,
                        text: "<?php echo $_SESSION['save_his_failed'] ?>"
                    });
                </script>

            <?php
            }
            unset($_SESSION['save_his_failed']);
            ?>

            <div class="w-full h-auto grid grid-cols-2 grid-rows-4 gap-2">
                <textarea class="w-full row-span-3 col-span-2 m-auto my-3 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" name="history" placeholder="Historia clínica..."></textarea>
                <input class="hidden w-full col-span-2 m-auto my-3 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" type="date" name="date" value="<?php echo date('Y-m-d'); ?>">
                <button class="w-full text-2xl duration-300 col-span-2 cursor-pointer m-auto my-3 py-3 px-5 bg-emerald-500 hover:bg-emerald-800" type="submit">Guardar <i class="fas fa-save"></i></button>
            </div>

        </form>
    </div>
</div>

</section>
</body>

</html>