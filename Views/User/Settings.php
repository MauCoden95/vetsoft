        <?php include 'Views/Layout/Menu.php'; ?>
        <div class="w-4/5 h-full overflow-y-scroll">
            <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
                <h1 class="text-4xl">Cambiar contraseña</h1>
                <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
            </div>


            <form class="w-4/6 h-72 m-auto mt-20" action="<?= base_url ?>User/change" method="post">
                <?php if (isset($_SESSION['change_success'])) :  ?>
                    <span class="block w-4/5 m-auto text-center p-1 bg-green-600 border-4 border-green-900 text-white rounded-md mb-5"><?php print_r($_SESSION['change_success']); ?></span>
                <?php elseif (isset($_SESSION['change_failed'])) :  ?>
                    <span class="block w-4/5 m-auto text-center p-1 bg-red-600 border-4 border-red-900 text-white rounded-md mb-5"><?php print_r($_SESSION['change_failed']); ?></span>
                <?php endif; ?>
                <input class="block w-4/5 p-2 m-auto mt-5 bg-gray-100 border-b-2 border-green-500" type="password" name="pw1" placeholder="Ingrese contraseña...">
                <input class="block w-4/5 p-2 m-auto mt-5 bg-gray-100 border-b-2 border-green-500" type="password" name="pw2" placeholder="Confirme contraseña...">
                <input class="cursor-pointer block w-4/5 p-2 m-auto mt-14 bg-green-400 hover:bg-green-600" type="submit" value="Cambiar">
            </form>


        </div>


    </section>
</body>

</html>