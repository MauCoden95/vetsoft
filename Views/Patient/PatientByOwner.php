<?php include 'Views/Layout/Menu.php'; ?>

<div class="w-4/5 h-full overflow-y-scroll">
    <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
        <h1 class="text-4xl">Pacientes</h1>
        <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
    </div>

    <div class="relative w-full min-h-[100px] flex items-center justify-between">
    <a class="text-xl m-10" href="http://localhost/VetSoft/Owner/index"><i class="fas fa-arrow-left"></i> Volver</a>

        <button id="add" class="absolute top-6 right-10 rounded-md bg-emerald-400 hover:bg-emerald-600 py-2 px-5 duration-300 text-xl">Agregar <i class="fas fa-plus-circle"></i></button>
    </div>

    
    <?php
        $patientCount = $patients->num_rows;
        if($patientCount > 0) :
    ?>
    <table id="dataTable" class="w-11/12 m-auto mt-8 mb-10">
        <thead>
            <tr class="w-full">
                <th class="w-1/12 bg-emerald-300 py-2 border border-black">#</th>
                <th class="w-2/12 bg-emerald-300 py-2 border border-black">Nombre</th>
                <th class="w-1/12 bg-emerald-300 py-2 border border-black">Animal</th>
                <th class="w-1/12 bg-emerald-300 py-2 border border-black">Raza</th>
                <th class="w-2/12 bg-emerald-300 py-2 border border-black">Edad</th>
                <th class="w-1/12 bg-emerald-300 py-2 border border-black">Género</th>
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
                    <td class="w-2/12 bg-gray-100 border border-black text-center py-2"><?= $pat->name; ?></td>
                    <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $pat->animal; ?></td>
                    <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $pat->breed; ?></td>
                    <td class="w-2/12 bg-gray-100 border border-black text-center py-2"><?= $ageString; ?></td>
                    <td class="w-1/12 bg-gray-100 border border-black text-center py-2"><?= $pat->gender; ?></td>
                    <td class="w-1/12 bg-gray-100 border border-black text-center py-2">
                        <a href="http://localhost/VetSoft/Patient/edit/<?php echo $pat->id ?>" title="Editar"><i class="text-xl fas fa-pencil-alt text-cyan-500 hover:text-cyan-800 mr-5"></i></a>
                        <button class="delete_pat" data-id="<?= $pat->id; ?>"><i class="text-xl ml-2 fas fa-trash text-red-500 hover:text-red-800"></i></button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <h2 class="text-center text-3xl">No hay pacientes relacionados a este cliente</h2>
    <?php endif; ?>
    


    
    <div class="absolute hidden duration-400 top-0 left-0 container_form w-screen h-screen bg-black bg-opacity-80 flex items-center justify-center">
            <i id="hidden" class="cursor-pointer absolute top-5 right-5 duration-300 text-white hover:text-gray-400 text-6xl fas fa-times-circle"></i>
            <div class="w-3/5 h-auto py-7 px-5 bg-white rounded-md">
                <?php 
                    $url = explode('/', $_GET['url']);
                    $id = $url[2];
                ?>
                <form id="form" class="w-full min-h-0 flex flex-col" action="/VetSoft/Patient/saveByOwner/<?php echo $id ?>" method="post" autocomplete="off">
                    <h2 class="text-center text-3xl my-3 mb-10">Agregar paciente <i class="fas fa-bone"></i></h2>
                    <?php
                    if (isset($_SESSION['save_pat_own']) && $_SESSION['save_pat_own'] == true) {
                        $res = $_SESSION['save_pat_own']; ?>
                        <script>
                            localStorage.setItem("state_owner", false);
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Exito!!!",
                                html: "<p style='font-size: 18px;'>Se agregó el paciente de manera correcta</p>",
                                timer: 5000,
                                showConfirmButton: true, 
                                confirmButtonText: "OK",
                            });
                        </script>
                    <?php
                        unset($_SESSION['save_pat_own']);
                    } elseif (isset($_SESSION['save_pat_own']) && $_SESSION['save_pat_own'] == false) {
                        $res = $_SESSION['save_pat_own']; ?>
                        <script>
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "Campos inválidos"
                            });
                        </script>
                    <?php }
                    ?>
                    <div class="w-full h-full grid grid-cols-2 grid-rows-3 gap-2">
                        <input class="w-full m-auto my-1 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" type="text" name="name" placeholder="Nombre...">
                        <input class="w-full m-auto my-1 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" type="text" name="animal" placeholder="Animal...">
                        <input class="w-full m-auto my-1 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" type="text" name="breed" placeholder="Raza...">
                        <input class="w-full m-auto my-1 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" type="date" name="birth" placeholder="Nacimiento...">
                        <select class="w-full h-full m-auto py-3 px-5 border-b-2 border-emerald-500 bg-gray-100"  id="gender" name="gender">
                            <option value="">--Género--</option>
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                        <input class="cursor-pointer w-full h-full m-auto py-3 px-5 bg-emerald-500 hover:bg-emerald-800" type="submit" value="Enviar">
                    </div>
                </form>
            </div>
        </div>



</div>



</section>
</body>

</html>