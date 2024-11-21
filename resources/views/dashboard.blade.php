<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Control de Asistencia</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Para gráficos -->

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            display: flex;
        }

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

        .navbar {
            background-color: #2575fc;
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-left: 250px;
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

        .main-content {
            margin-left: 250px;
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

        .sidebar a i {
            margin-right: 8px;
            font-size: 18px;
            color: #333;
           
        }
    </style>
</head>

<body>

    
    @include('menu') 

    <div class="main-content">

        <div class="dashboard-container">
            <div class="welcome-message">
                Bienvenido, {{ auth()->user()->name }}.
            </div>

            <div class="stats-container">
                <div class="stat-card">
                    <h3> Registro de Asistencia</h3>
                    <h4>Sin Tipo de Horario Asignado</h4>
                </div>

                <div class="stat-card">
                    <h3>Lista de Actividades</h3>

                </div>

                <div class="stat-card">
                    <h3>Noticias</h3>
                    <h4>Sin Noticias</h4>
                </div>
            </div>

        </div>
    </div>

    <script>
        var ctx = document.getElementById('attendanceChart').getContext('2d');
        var attendanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Horas de Asistencia',
                    data: [25, 30, 28, 35, 40, 32, 45, 50, 37, 42, 48,
                    52], 
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
