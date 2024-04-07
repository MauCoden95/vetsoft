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
                    var clickedDate = info.date;
                    var formattedDate = clickedDate.getFullYear() + '-' +
                        ('0' + (clickedDate.getMonth() + 1)).slice(-2) + '-' +
                        ('0' + clickedDate.getDate()).slice(-2);

                    getTurnsByDay(formattedDate);
                    $("#popup").show();

                }
            });
            calendar.render();

            $("#close-popup").click(function() {
                $("#popup").hide();
            });

            function getTurnsByDay(date) {
                $.ajax({
                    url: 'http://localhost/VetSoft/Turn/getDateByDay/' + date,
                    type: 'GET',
                    success: function(response) {
                        localStorage.removeItem('turns');
                        var object = JSON.parse(response);
                        var objectJSON = JSON.stringify(object);
                        localStorage.setItem('turns', objectJSON);
                        showTurnsTable();
                    },
                    error: function(xhr, status, error) {}
                });
            }

            function showTurnsTable() {
                $(document).ready(function() {
                    var storedTurns = localStorage.getItem('turns');



                    if (storedTurns) {
                        var turns = JSON.parse(storedTurns);
                        console.log(turns.length);

                        if (turns.length === 0) {
                            $("#turns_table").html("<tr><td class='text-center text-xl'>No hay turnos registrados</td></tr>");
                        } else {
                            function createTableRow(turn) {
                                var dateFormat = moment(turn.fecha).format('DD-MM-YYYY');
                                var hourSplit = turn.hora.split('');
                                hourSplit.splice(hourSplit.length - 3, 3);
                                hourFormat = hourSplit.join('');
                                var row = "<tr>";
                                row += "<td class='w-1/5 border border-black text-center py-1'>" + turn.nombre_paciente + "</td>";
                                row += "<td class='w-1/5 border border-black text-center py-1'>" + dateFormat + "</td>";
                                row += "<td class='w-1/5 border border-black text-center py-1'>" + hourFormat + "</td>";
                                row += "<td class='w-1/5 border border-black text-center py-1'>" + turn.cita + "</td>";
                                row += "<td class='w-1/6 border border-black text-center py-1'>" + "<button><i class='mr-5 fas fa-edit text-2xl text-blue-500 hover:text-blue-800'></i></button>" + "<button><i class='fas fa-trash text-2xl text-red-500 hover:text-red-800'></i></button>" + "</td>";
                                row += "</tr>";
                                return row;
                            }
                            var table = $("#turns_table");
                            table.empty();

                            var headerRow = "<tr>";
                            headerRow += '<th class="w-1/5 bg-emerald-500 border border-black py-1">Paciente</th>';
                            headerRow += '<th class="w-1/5 bg-emerald-500 border border-black py-1">Fecha</th>';;
                            headerRow += '<th class="w-1/5 bg-emerald-500 border border-black py-1">Hora</th>';
                            headerRow += '<th class="w-1/5 bg-emerald-500 border border-black py-1">Motivo</th>';
                            headerRow += '<th class="w-1/6 bg-emerald-500 border border-black py-1">Acciones</th>';
                            headerRow += "</tr>";

                            table.append(headerRow);


                            turns.forEach(function(turn) {
                                table.append(createTableRow(turn));
                            });
                        }



                    }
                });

            }
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





            <div class="w-11/12 m-auto mt-12 mb-12" id='calendar'></div>

            <div id="popup" class="absolute hidden duration-400 top-0 left-0 container_form w-screen h-screen bg-black bg-opacity-80 flex items-center justify-center">
                <i id="close-popup" class="cursor-pointer absolute top-5 right-5 duration-300 text-white hover:text-gray-400 text-6xl fas fa-times-circle"></i>

                <div class="overflow-scroll	absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-5/6 h-[500px] bg-white rounded-md z-40">
                    <h2 class="text-center text-3xl my-14">Los turnos de hoy</h2>
                    <table class="w-5/6 m-auto mt-8" id="turns_table">
                        <h2 id="empty"></h2>
                    </table>
                </div>
            </div>

        </div>

    </section>


</body>

</html>