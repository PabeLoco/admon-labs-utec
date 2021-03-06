<?php

namespace App\catalogo;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
 	protected $table = 'horario';

    protected $primaryKey = 'id';

    public $timestamps = false;


  protected $fillable = [
        'dia',
        'hora_id',
        'materia_id',
        'ciclo_id',
        'laboratorio_id',
        'alerta_seminarios',
        'clave',
        'timestamp',
        'estado'
    ];

    protected $guarded = [];

     /* public function laboratorios()
    {
        ////Pendiente hacer Inversa de Relaciones
        return $this->belongsTo('App\catalogo\Laboratorio', 'horario', 'id');
    }*/

     public function laboratorio()
    {
        return $this->belongsTo('App\catalogo\Laboratorio');
    }

    public function materia()
    {
        return $this->belongsTo('App\catalogo\Materia');
    }

    public function hora()
    {
        return $this->belongsTo('App\catalogo\Hora');
    }

    public function ciclo()
    {
        return $this->belongsTo('App\catalogo\Ciclo');
    }

    public function practicas()
    {
        return $this->hasMany('App\catalogo\Practica', 'horario_id');
    }

  /*
    public function horario()
    {
        return $this->hasMany('App\catalogo\Practica', 'id_horarios');
    }
    public function materias()
    {
        return $this->belongsTo('App\catalogo\Materia', 'id_materia');
    }

    public function horas()
    {
        return $this->hasMany('App\catalogo\HorasClases', 'horario');
    } */

}
