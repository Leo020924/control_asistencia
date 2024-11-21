<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Asistencia</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        th {
            background-color: #2575fc;
            color: white;
        }

        .late {
            background-color: #f44336;
            color: white;
        }

        .ontime {
            background-color: #4CAF50;
            color: white;
        }

        .lunch {
            background-color: #f0ad4e;
            color: white;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Estilos para el menú */
        nav {
            background-color: #2575fc;
            padding: 15px;
            color: white;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-around;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 16px;
        }

        nav ul li a:hover {
            background-color: #6a11cb;
            border-radius: 5px;
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

        .sidebar a i {
            margin-right: 8px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>

<body>
    @include('menu') 
    <div class="container" style="margin-left: 270px">
        <div class="header">
            <h1>Reporte de Asistencia - {{ $year }}</h1>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    @for ($i = 1; $i <= 12; $i++) 
                        @for ($j = 1; $j <= Carbon\Carbon::parse("2024-$i-01")->daysInMonth; $j++)
                            <th>{{ $i }}-{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}</th>
                        @endfor
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>

                        @for ($i = 1; $i <= 12; $i++)
                            @for ($j = 1; $j <= Carbon\Carbon::parse("2024-$i-01")->daysInMonth; $j++)
                                @php
                                    $date = Carbon\Carbon::create($year, $i, $j)->toDateString();
                                    $attendance = $attendancesGrouped->get($user->id)?->firstWhere('fecha', $date);
                                    $onTime = null;
                                    if ($attendance) {
                                        $horaEntrada = Carbon\Carbon::parse($attendance->hora_entrada);
                                        $horaLimite = Carbon\Carbon::createFromFormat('H:i', '09:25');
                                        $onTime = $horaEntrada <= $horaLimite;
                                    }
                                @endphp

                                <td class="{{ isset($onTime) ? ($onTime ? '' : 'late') : '' }}">
                                    @if ($attendance)
                                    @else
                                        No registrado
                                    @endif
                                </td>
                            @endfor
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
