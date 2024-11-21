<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function showReport()
{
    $year = Carbon::now()->year;
    $users = User::all();

    // Obtener todas las asistencias de este año
    $attendances = Attendance::whereYear('fecha', $year)->get();

    // Agrupar las asistencias por usuario y fecha
    $attendancesGrouped = $attendances->groupBy(function($attendance) {
        return $attendance->user_id;
    });

    return view('reporte_asistencia', compact('users', 'attendancesGrouped', 'year'));
}



    
}
