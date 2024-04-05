<?php include 'Views/Layout/Menu.php'; ?>



<div class="w-4/5 h-full overflow-y-scroll">
    <div class="ollin w-full min-h-0 py-10 px-10 flex items-center justify-between shadow-md">
        <h1 class="text-4xl">Turnos</h1>
        <h2 class="text-2xl">Bienvenido, <?php print_r($_SESSION['user']->name) ?></h2>
    </div>

    <div class="relative w-11/12 min-h-0 m-auto my-6">
        <a class="text-xl" href="http://localhost/VetSoft/Patient/index"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>



    <div class="w-11/12 m-auto mt-12 mb-12" id='calendar'></div>

    <div id="popup" class="absolute hidden duration-400 top-0 left-0 container_form w-screen h-screen bg-black bg-opacity-80 flex items-center justify-center">
        <i id="close-popup" class="cursor-pointer absolute top-5 right-5 duration-300 text-white hover:text-gray-400 text-6xl fas fa-times-circle"></i>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-2/6 min-h-0 py-8 rounded-md bg-white z-40">
            <h2 class="text-center mb-6 text-3xl">Agendar turno <i class="far fa-calendar"></i></h2>
            <div class="w-5/6 min-h-0 m-auto mt-10 mb-3 flex items-center justify-between">
                <h3 class="flex items-center justify-between text-xl">Paciente: <?php print_r($name->name); ?></h2>
                <h3 class="text-xl">Fecha: <span id="selected-date"></span></h3>
            </div>
            <input id="h4" class="hidden w-3/6 m-auto border-b-2 border-emerald-500 bg-gray-100 py-2 px-5 my-3" type="text" name="day">
            <input id="date" class="hidden w-3/6 m-auto border-b-2 border-emerald-500 bg-gray-100 py-2 px-5 my-3" type="date" name="day">
            <div class="w-5/6 min-h-0 m-auto flex items-center justify-center">
                <h3 class="w-3/6 text-left my-3 text-xl">Elegir horario</h3>
                <input class="block w-3/6 m-auto border-b-2 border-emerald-500 bg-gray-100 py-2 px-5 my-3" type="time" id="hora" name="hora" min="00:00" max="23:59" step="60">
            </div>

            <div class="w-5/6 min-h-0 m-auto flex items-center justify-center">
                <h3 class="w-3/6 text-left my-3 text-xl">Asunto</h3>
                <select class="block w-3/6 border-b-2 m-auto border-emerald-500 bg-gray-100 py-2 px-5 my-3" id="estudios" name="estudios">
                    <option value="----">----</option>
                    <option value="Chequeo general">Chequeo general</option>
                    <option value="Radiografía">Radiografía</option>
                    <option value="Ecografía">Ecografía</option>
                    <option value="Análisis de sangre">Análisis de sangre</option>
                    <option value="Análisis de orina">Análisis de orina</option>
                    <option value="Endoscopia">Endoscopia</option>
                    <option value="Biopsia">Biopsia</option>
                    <option value="Tomografía computarizada (CT)">Tomografía computarizada (CT)</option>
                    <option value="Resonancia magnética (MRI)">Resonancia magnética (MRI)</option>
                    <option value="Eutanasia">Eutanasia</option>
                </select>
            </div>

            <button class="block w-5/6 m-auto mt-7 py-3 text-xl rounded bg-emerald-500 hover:bg-emerald-800 duration-300">Guardar <i class="fas fa-save"></i></button>
        </div>
    </div>

</div>

</section>


</body>

</html>