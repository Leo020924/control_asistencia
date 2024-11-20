<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Control de Asistencia</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Para gráficos -->

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #2575fc;
            color: white;
            height: 100vh;
            padding-top: 30px;
            position: fixed;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .sidebar a {
            color: white;
            padding: 15px;
            display: block;
            text-decoration: none;
            font-size: 18px;
            border-bottom: 1px solid #f1f1f1;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #6a11cb;
        }

        /* Estilos para la barra de navegación superior */
        .navbar {
            background-color: #2575fc;
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-left: 250px; /* Desplazar el contenido principal para no tapar el sidebar */
        }

        .navbar h1 {
            font-size: 24px;
            margin: 0;
        }

        .navbar .logout-btn {
            background-color: #6a11cb;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        /* Contenido principal */
        .main-content {
            margin-left: 250px; /* Asegurarse de que el contenido no se solape con el sidebar */
            width: 100%;
            padding: 20px;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .welcome-message {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 25px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .stat-card:hover {
            transform: translateY(-10px);
        }

        .stat-card h3 {
            font-size: 22px;
            color: #2575fc;
        }

        .stat-card p {
            font-size: 40px;
            font-weight: bold;
            color: #333;
        }

        .chart-container {
            margin-top: 40px;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .actions {
            margin-top: 30px;
        }

        .actions h2 {
            font-size: 24px;
            font-weight: 500;
            color: #333;
            margin-bottom: 15px;
        }

        .actions ul {
            list-style: none;
            padding: 0;
        }

        .actions ul li {
            margin: 10px 0;
        }

        .actions a {
            background-color: #2575fc;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            display: inline-block;
            text-decoration: none;
            font-weight: bold;
        }

        .actions a:hover {
            background-color: #6a11cb;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Menú</h3>
        <a href="#">Inicio</a>
        <a href="#">Registro de Asistencia</a>
        <a href="#">Ver informes</a>
        <a href="#">Configuración</a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Cerrar sesión
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
    

        <!-- Dashboard content -->
        <div class="dashboard-container">
            <div class="welcome-message">
                Bienvenido, {{ auth()->user()->name }}.
            </div>

            <!-- Estadísticas -->
            <div class="stats-container">
                <!-- Estadística 1: Total de asistencia -->
                <div class="stat-card">
                    <h3>Asistencia Total</h3>
                    <p>350 hrs</p>
                </div>
                
                <!-- Estadística 2: Asistencia este mes -->
                <div class="stat-card">
                    <h3>Asistencia este mes</h3>
                    <p>30 hrs</p>
                </div>

                <!-- Estadística 3: Porcentaje de asistencia -->
                <div class="stat-card">
                    <h3>Asistencia</h3>
                    <p>98%</p>
                </div>
            </div>

            

            <!-- Acciones rápidas -->
            <div class="actions">
                <h2>Acciones rápidas</h2>
                <ul>
                    <li><a href="#">Ver registro de asistencia</a></li>
                    <li><a href="#">Agregar nueva entrada de asistencia</a></li>
                    <li><a href="#">Ver informes</a></li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Gráfico de asistencia mensual usando Chart.js
        var ctx = document.getElementById('attendanceChart').getContext('2d');
        var attendanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Horas de Asistencia',
                    data: [25, 30, 28, 35, 40, 32, 45, 50, 37, 42, 48, 52], // Datos de horas de asistencia por mes
                    borderColor: '#2575fc',
                    backgroundColor: 'rgba(37, 117, 252, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>
</html>
