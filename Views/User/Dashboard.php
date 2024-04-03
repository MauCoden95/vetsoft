
        <?php include 'Views/Layout/Menu.php'; ?>
        
        <div class="w-4/5 h-full">
            <div class="w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
                <h1 class="text-4xl">Dashboard</h1>
                <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
            </div>

            <div class="w-11/12 h-52 m-auto py-10  flex items-center justify-between">
                <div class="relative overflow-hidden w-52 h-28 rounded-md bg-emerald-400">
                    <h2 class="text-lg text-center mt-3">Veterinarios</h2>
                    <h2 class="absolute -bottom-2 -left-3 text-7xl text-emerald-800"><i class="fas fa-user-md"></i></h2>
                    <h3 class="absolute bottom-3 right-3 text-5xl"><?php print_r($veterinaries_count->cantidad_de_registros); ?></h3>
                </div>

                <div class="relative overflow-hidden w-52 h-28 rounded-md bg-emerald-400">
                    <h2 class="text-lg text-center mt-3">Pacientes</h2>
                    <h2 class="absolute -bottom-5 text-7xl text-emerald-800"><i class="fas fa-bone"></i></h2>
                    <h3 class="absolute bottom-3 right-3 text-5xl"><?php print_r($patients_count->cantidad_de_registros); ?></h3>
                </div>

                <div class="relative overflow-hidden w-52 h-28 rounded-md bg-emerald-400">
                    <h2 class="text-lg text-center mt-3">Pacientes</h2>
                    <h2 class="absolute -bottom-5 text-7xl text-emerald-800"><i class="fas fa-bone"></i></h2>
                    <h3 class="absolute bottom-3 right-3 text-5xl"><?php print_r($patients_count->cantidad_de_registros); ?></h3>
                </div>

                <div class="relative overflow-hidden w-52 h-28 rounded-md bg-emerald-400">
                    <h2 class="text-lg text-center mt-3">Clientes</h2>
                    <h2 class="absolute -bottom-2 -left-3 text-7xl text-emerald-800"><i class="fas fa-user"></i></h2>
                    <h3 class="absolute bottom-3 right-3 text-5xl"><?php print_r($owners_count->cantidad_de_registros); ?></h3>
                </div>
            </div>
        </div>

    </section>
</body>

</html>