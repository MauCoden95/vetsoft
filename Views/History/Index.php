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



                ?>
                    <tr>
                        <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $pat->id; ?></td>
                        <td class="w-4/12 px-3 bg-gray-100 border border-black text-justify py-2"><?= $pat->history; ?></td>
                        <td class="w-1/12 px-3 bg-gray-100 border border-black text-center py-2"><?= $pat->date; ?></td>
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



</section>
</body>

</html>