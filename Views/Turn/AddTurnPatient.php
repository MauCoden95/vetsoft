<?php
require_once 'Config/Helpers.php';

if (!isLogged($_SESSION['user'])) {
    header('Location: http://localhost/VetSoft/User/index');
} else {
    $userType = $_SESSION['user']->user_type;
}

unset($_SESSION['update_pat']);

$url = explode('/', $_GET['url']);
$controller = $url[0];
$action = $url[1];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Estilos CSS-->
    <link rel="stylesheet" href="../../Assets/css/Styles.css">

    <!--Tailwind CSS-->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>


    <!--SweetAlert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!--Moment JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- jQuery -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

    <!--FullCalendar-->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/locales/es.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                hiddenDays: [0],
                buttonText: {
                    today: 'Hoy'
                },
                validRange: {
                    start: new Date(),
                    end: '2100-01-01'
                },
                dateClick: function(info) {
                    var selectedDate = moment(info.date);
                    var dayOfWeekName = selectedDate.format('dddd');


                    if (dayOfWeekName == 'Sunday') {
                        return false;
                    } else {
                        //Colocar en el input de la fecha, la fecha elegida
                        var inputDate = document.getElementById("date");
                        inputDate.value = info.dateStr;


                        //Colocar en el input del id, el id del paciente
                        var url = window.location.href;
                        var regex = /\/(\d+)$/;
                        var match = url.match(regex);
                        document.getElementById('h4').value = match[1];


                        //Mostrar en la ventana, la fecha elegida
                        var selectedDate = info.dateStr;
                        var formattedDate = formatDate(selectedDate);
                        document.getElementById('selected-date').textContent = formattedDate;

                        //Abrir ventana
                        $("#popup").show();

                    }

                }
            });
            calendar.render();

            function formatDate(dateString) {
                var dateParts = dateString.split("-");
                return dateParts[2] + "-" + dateParts[1] + "-" + dateParts[0];
            }

            $("#close-popup").click(function() {
                $("#popup").hide();
            });





        });
    </script>

    <script src="<?= base_url ?>/Main.js" defer></script>
    <title>Document</title>
</head>

<body>
    <section class="relative w-screen h-screen flex">
        <div class="relative w-1/5 h-full bg-emerald-600 px-5 flex">
            <div class="w-full h-5/6 flex flex-col justify-start">
                <i class="fas fa-globe text-5xl text-white my-10"></i>
                <?php if ($userType == 'Administrador') : ?>
                    <div class="w-full min-h-0">
                        <a class="w-full <?php echo $controller == 'User' && $action != 'settings' ? 'bg-emerald-800' : '' ?> hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/dashboard"><i class="fas fa-columns"></i> Dashboard</a>
                        <a class="w-full <?php echo $controller == 'Veterinary' ? 'bg-emerald-800' : '' ?> hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Veterinary/index"><i class="fas fa-user-md"></i> Veterinarios</a>
                        <a class="w-full <?php echo $controller == 'Patient' ? 'bg-emerald-800' : '' ?> hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Patient/index"><i class="fas fa-bone"></i> Pacientes</a>
                        <a class="w-full <?php echo $controller == 'Owner' ? 'bg-emerald-800' : '' ?> hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Owner/index"><i class="fas fa-user"></i> Clientes</a>
                        <a class="w-full <?php echo $controller == 'Turn' ? 'bg-emerald-800' : '' ?> hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Turn/index"><i class="far fa-calendar"></i> Turnos</a>
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="far fa-user"></i> Usuarios</a>
                    </div>
                    <div class="border-b border-gray-300 my-5"></div>
                    <div class="w-full min-h-0">
                        <a class="w-full <?php echo $action == 'settings' ? 'bg-emerald-800' : '' ?> hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/settings"><i class="fas fa-cog"></i> Mi perfil</a>
                        <a class="w-full bg-red-500 hover:bg-red-950 hover:text-white py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/logout"><i class="fas fa-sign-out-alt mr-1"></i>Cerrar sesión</a>
                    </div>
                <?php else : ?>
                    <div class="w-full min-h-0">
                        <a class="w-full <?php echo $controller == 'User' && $action != 'settings' ? 'bg-emerald-800' : '' ?> hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/dashboard"><i class="fas fa-columns"></i> Dashboard</a>
                        <a class="w-full <?php echo $controller == 'Patient' ? 'bg-emerald-800' : '' ?> hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Patient/index"><i class="fas fa-bone"></i> Pacientes</a>
                        <a class="w-full <?php echo $controller == 'Owner' ? 'bg-emerald-800' : '' ?> hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Owner/index"><i class="fas fa-user"></i> Clientes</a>
                        <a class="w-full <?php echo $controller == 'Turn' ? 'bg-emerald-800' : '' ?> hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/Turn/index"><i class="far fa-calendar"></i> Turnos</a>
                    </div>
                    <div class="border-b border-gray-300 my-5"></div>
                    <div class="w-full min-h-0">
                        <a class="w-full <?php echo $action == 'settings' ? 'bg-emerald-800' : '' ?> hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/settings"><i class="fas fa-cog"></i> Mi perfil</a>
                        <a class="w-full bg-red-500 hover:bg-red-950 hover:text-white py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/logout"><i class="fas fa-sign-out-alt mr-1"></i>Cerrar sesión</a>
                    </div>
                <?php endif; ?>
            </div>


        </div>



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
                <form action="http://localhost/VetSoft/Turn/save" method="POST" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-2/6 min-h-0 py-8 rounded-md bg-white z-40">
                    <?php
                    if (isset($_SESSION['save_turn']) && $_SESSION['save_turn'] == true) { ?>
                        <script>
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Exito!!!",
                                html: "<p style='font-size: 18px;'>Se guardó el turno de manera correcta</p>",
                                timer: 5000,
                                showConfirmButton: true,
                                confirmButtonText: "OK",
                            });
                        </script>
                    <?php
                    }
                    unset($_SESSION['save_turn']);
                    ?>
                    <?php
                    if (isset($_SESSION['save_turn_failed'])) { ?>
                        <script>
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: "Error",
                                timer: 3000,
                                text: "<?php echo $_SESSION['save_turn_failed'] ?>"
                            });
                        </script>

                    <?php
                    }
                    unset($_SESSION['save_turn_failed']);
                    ?>
                    <h2 class="text-center mb-6 text-3xl">Agendar turno <i class="far fa-calendar"></i></h2>
                    <div class="w-5/6 min-h-0 m-auto mt-10 mb-3 flex items-center justify-between">
                        <h3 class="flex items-center justify-between text-xl">Paciente: <?php print_r($name->name); ?></h2>
                            <h3 class="text-xl">Fecha: <span id="selected-date"></span></h3>
                    </div>
                    <input id="h4" class="hidden w-3/6 m-auto border-b-2 border-emerald-500 bg-gray-100 py-2 px-5 my-3" type="text" name="patient_id">
                    <input id="date" class="hidden w-3/6 m-auto border-b-2 border-emerald-500 bg-gray-100 py-2 px-5 my-3" type="date" name="day">
                    <div class="w-5/6 min-h-0 m-auto flex items-center justify-center">
                        <h3 class="w-3/6 text-left my-3 text-xl">Elegir horario</h3>
                        <input class="block w-3/6 m-auto border-b-2 border-emerald-500 bg-gray-100 py-2 px-5 my-3" type="time" id="hora" name="hour" min="00:00" max="23:59" step="60">
                    </div>

                    <div class="w-5/6 min-h-0 m-auto flex items-center justify-center">
                        <h3 class="w-3/6 text-left my-3 text-xl">Asunto</h3>
                        <select class="block w-3/6 border-b-2 m-auto border-emerald-500 bg-gray-100 py-2 px-5 my-3" name="appointment">
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
                </form>
            </div>

        </div>

    </section>


</body>

</html>