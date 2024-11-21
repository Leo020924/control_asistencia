<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // Definir la tabla asociada al modelo (si el nombre de la tabla no es plural por defecto)
    protected $table = 'attendances';

    // Definir los atributos que pueden ser asignados masivamente
    protected $fillable = [
        'user_id', 
        'fecha', 
        'hora_entrada', 
        'hora_salida', 
        'hora_inicio_comida', 
        'hora_fin_comida', 
        'on_time',
    ];

    // Relación con el modelo User (Empleado)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
