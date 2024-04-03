        <?php include 'Views/Layout/Menu.php'; ?>
        <div class="w-4/5 h-full overflow-y-scroll">
            <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
                <h1 class="text-4xl">Clientes</h1>
                <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
            </div>
            <div class="relative w-full min-h-[100px]">
                <a class="absolute left-5 text-xl" href="http://localhost/VetSoft/Patient/index"><i class="fas fa-arrow-left"></i> Volver</a>
                <table class="w-3/6 mt-12 divide-y divide-gray-200 m-auto">
                    <?php while ($obj = $dataOwner->fetch_object()) : ?>
                        <tr class="w-3/5">
                            <th class="w-1/3  bg-emerald-300 border border-gray-600 py-2">#</th>
                            <td class="w-1/3 text-center border bg-white border-gray-600 py-2"><?php echo $obj->id; ?></td>
                        </tr>
                        <tr>
                            <th class="w-1/3  bg-emerald-300 border border-gray-600 py-2">Nombre</th>
                            <td class="w-1/3 text-center py-2 bg-white border border-gray-600"><?php echo $obj->name; ?></td>
                        </tr>
                        <tr>
                            <th class="w-1/3  bg-emerald-300 border border-gray-600 py-2">Dni</th>
                            <td class="w-1/3 text-center py-2 bg-white border border-gray-600"><?php echo $obj->dni; ?></td>
                        </tr>
                        <tr>
                            <th class="w-1/3  bg-emerald-300 border border-gray-600 py-2">Teléfono</th>
                            <td class="w-1/3 text-center py-2 bg-white border border-gray-600"><?php echo $obj->phone; ?></td>
                        </tr>
                        <tr>
                            <th class="w-1/3  bg-emerald-300 border border-gray-600 py-2">Teléfono2</th>
                            <td class="w-1/3 text-center py-2 bg-white border border-gray-600"><?php echo $obj->phone2; ?></td>
                        </tr>
                        <tr>
                            <th class="w-1/3  bg-emerald-300 border border-gray-600 py-2">Correo Electrónico</th>
                            <td class="w-1/3 text-center py-2 bg-white border border-gray-600"><?php echo $obj->mail; ?></td>
                        </tr>
                        <tr>
                            <th class="w-1/3  bg-emerald-300 border border-gray-600 py-2">Dirección</th>
                            <td class="w-1/3 text-center py-2 bg-white border border-gray-600"><?php echo $obj->address; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>





        </div>



    </section>
</body>

</html>