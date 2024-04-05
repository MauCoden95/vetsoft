        <?php include 'Views/Layout/Menu.php'; ?>

        <div class="w-4/5 h-full overflow-y-scroll">
            <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
                <h1 class="text-4xl">Pacientes</h1>
                <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
            </div>



            <form class="relative w-5/6 min-h-0 m-auto my-6" action="http://localhost/VetSoft/Patient/update/<?php echo $id ?>" method="post">
                <a class="text-xl" href="http://localhost/VetSoft/Patient/index"><i class="fas fa-arrow-left"></i> Volver</a>
                <h2 class="w-full text-center text-3xl mb-6">Editar paciente <i class="fas fa-pencil"></i></h2>
                
                <?php
                if (isset($_SESSION['update_patient']) && $_SESSION['update_patient'] == true) {
                    $res = $_SESSION['update_patient']; ?>
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Exito!!!",
                            html: "<p style='font-size: 18px;'>Se actualizó el paciente de manera correcta</p>",
                            timer: 5000,
                            showConfirmButton: true,
                            confirmButtonText: "OK",
                        });
                    </script>
                <?php
                    unset($_SESSION['update_patient']);}
                ?>
                <?php
                    if (isset($_SESSION['update_patient_failed'])) { ?>
                        <script>
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: "Error",
                                timer: 3000,
                                text: "<?php echo $_SESSION['update_patient_failed'] ?>"
                            });
                        </script>

                    <?php
                    }
                    unset($_SESSION['update_patient_failed']);
                    ?>
             
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