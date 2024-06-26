        <?php include 'Views/Layout/Menu.php'; ?>

        <div class="w-4/5 h-full overflow-y-scroll">
            <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
                <h1 class="text-4xl">Clientes</h1>
                <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
            </div>

            <form class="relative w-11/12 min-h-0 m-auto my-12" action="http://localhost/VetSoft/Owner/update/<?php echo $id ?>" method="post">
                <a class="text-xl" href="http://localhost/VetSoft/Owner/index"><i class="fas fa-arrow-left"></i> Volver</a>
                <h2 class="w-full text-center text-3xl mb-6">Editar Cliente <i class="fas fa-pencil"></i></h2>
                <?php
                if (isset($_SESSION['update_own']) && $_SESSION['update_own'] == true) {
                    $res = $_SESSION['update_own']; ?>
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Exito!!!",
                            html: "<p style='font-size: 18px;'>Se actualizó el cliente de manera correcta</p>",
                            timer: 5000,
                            showConfirmButton: true,
                            confirmButtonText: "OK",
                        });
                    </script>
                <?php
                    unset($_SESSION['update_own']);}
                ?>
                 <?php
                    if (isset($_SESSION['update_own_failed'])) { ?>
                        <script>
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: "Error",
                                timer: 3000,
                                text: "<?php echo $_SESSION['update_own_failed'] ?>"
                            });
                        </script>

                    <?php
                    }
                    unset($_SESSION['update_own_failed']);
                    ?>
                <?php while ($own = $data->fetch_object()) : ?>
                    <div class="w-full min-h-0 grid grid-cols-2 grid-rows-3 gap-4">
                        <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($own->name); ?>" type="text" name="name">
                        <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($own->dni); ?>" type="number" name="dni">
                        <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($own->phone); ?>" type="number" name="phone">
                        <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($own->phone2); ?>" type="number" name="phone2">
                        <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($own->mail); ?>" type="email" name="mail">
                        <input class="block w-full border-b-2 m-auto border-emerald-600 bg-gray-100 px-2 py-3 my-3" value="<?php print_r($own->address); ?>" type="text" name="address">
                        <input class="col-span-2 cursor-pointer block w-full m-auto bg-emerald-600 hover:bg-emerald-800 px-2 py-3 my-3" value="Editar" type="submit">
                    </div>
                <?php endwhile; ?>

            </form>





        </div>



        </section>
        </body>

        </html>