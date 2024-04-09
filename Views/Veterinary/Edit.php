        <?php include 'Views/Layout/Menu.php'; ?>

        <div class="w-4/5 h-full overflow-y-scroll">
            <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
                <h1 class="text-4xl">Veterinarios</h1>
                <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
            </div>



            <form class="relative w-11/12 min-h-0 m-auto my-12" action="http://localhost/VetSoft/Veterinary/update/<?php echo $id ?>" method="post">
                <a class="text-xl" href="http://localhost/VetSoft/Veterinary/index"><i class="fas fa-arrow-left"></i> Volver</a>
                <h2 class="w-full text-center text-3xl mb-6">Editar veterinario <i class="fas fa-pencil"></i></h2>
                <?php
                if (isset($_SESSION['update_vet']) && $_SESSION['update_vet'] == true) {
                    $res = $_SESSION['update_vet']; ?>
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Exito!!!",
                            html: "<p style='font-size: 18px;'>Se actualizó el veterinario de manera correcta</p>",
                            timer: 5000,
                            showConfirmButton: true,
                            confirmButtonText: "OK",
                        });
                    </script>
                <?php
                }
                ?>
                <?php
                if (isset($_SESSION['update_vet_failed'])) { ?>
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Error",
                            timer: 3000,
                            text: "<?php echo $_SESSION['update_vet_failed'] ?>"
                        });
                    </script>

                <?php
                }
                unset($_SESSION['update_vet_failed']);
                ?>


                <div class="w-full min-h-0 grid grid-cols-2 grid-rows-3 gap-4">
                    <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($data->name); ?>" type="text" name="name">
                    <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($data->specialty); ?>" type="text" name="specialty">
                    <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($data->address); ?>" type="text" name="address">
                    <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($data->phone); ?>" type="number" name="phone">
                    <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($data->phone2); ?>" type="number" name="phone2">
                    <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($data->license); ?>" type="number" name="license">
                    <input class="col-span-2 cursor-pointer block w-full m-auto bg-emerald-600 hover:bg-emerald-800 px-2 py-3 my-3" value="Editar" type="submit">
                </div>

            </form>


        </div>



        </section>
        </body>

        </html>