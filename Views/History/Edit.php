<?php include 'Views/Layout/Menu.php'; ?>

<div class="w-4/5 h-full overflow-y-scroll">
    <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
        <h1 class="text-4xl">Histora clínica</h1>
        <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
    </div>

 

    <form class="relative w-5/6 min-h-0 m-auto my-6" action="http://localhost/VetSoft/History/update/<?php echo $id ?>" method="post">
        <a class="text-xl" href="http://localhost/VetSoft/History/index/<?php echo $_SESSION['id'] ?>"><i class="fas fa-arrow-left"></i> Volver</a>
        <h2 class="w-full text-center text-3xl mb-6">Editar registro <i class="fas fa-pencil"></i></h2>
        
        <?php
        if (isset($_SESSION['update_hist']) && $_SESSION['update_hist'] == true) {
            $res = $_SESSION['update_hist']; ?>
            <script>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Exito!!!",
                    html: "<p style='font-size: 18px;'>Se actualizó el registro de manera correcta</p>",
                    timer: 5000,
                    showConfirmButton: true,
                    confirmButtonText: "OK",
                });
            </script>
        <?php
            unset($_SESSION['update_hist']);}
        ?>
        <?php
            if (isset($_SESSION['update_hist_failed'])) { ?>
                <script>
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Error",
                        timer: 3000,
                        text: "<?php echo $_SESSION['update_hist_failed'] ?>"
                    });
                </script>

            <?php
            }
            unset($_SESSION['update_hist_failed']);
            ?>
     
     
            <div class="w-full min-h-0 grid grid-cols-2 grid-rows-4 gap-4">
                <textarea class="w-full row-span-3 col-span-2 m-auto my-3 py-3 px-5 border-b-2 border-emerald-500 bg-gray-100" value="<?php print_r($data->history); ?>" name="history" placeholder="Historia clínica..."></textarea>
                <button class="w-full text-2xl duration-300 col-span-2 cursor-pointer m-auto my-3 py-3 px-5 bg-emerald-500 hover:bg-emerald-800" type="submit">Guardar <i class="fas fa-save"></i></button>
            </div>
        

    </form>


</div>



</section>
</body>

</html>