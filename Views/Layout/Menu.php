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
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="far fa-calendar"></i> Turnos</a>
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
                        <a class="w-full hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://"><i class="far fa-calendar"></i> Turnos</a>
                    </div>
                    <div class="border-b border-gray-300 my-5"></div>
                    <div class="w-full min-h-0">
                        <a class="w-full <?php echo $action == 'settings' ? 'bg-emerald-800' : '' ?> hover:bg-white hover:text-emerald-900 py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/settings"><i class="fas fa-cog"></i> Mi perfil</a>
                        <a class="w-full bg-red-500 hover:bg-red-950 hover:text-white py-1 px-2 my-2 rounded-md text-white text-xl block duration-300" href="http://localhost/VetSoft/User/logout"><i class="fas fa-sign-out-alt mr-1"></i>Cerrar sesión</a>
                    </div>
                <?php endif; ?>
            </div>


        </div>