<?php

namespace App\catalogo;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    //
    protected $table = 'laboratorio';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'nombre',
        'ubicacion',
        'imagen',
        'user_id',
        'software'
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function horarios()
    {
        return $this->hasMany('App\catalogo\Horario','laboratorio_id');
    }

    public function softwares()
    {
        return $this->belongsToMany('App\catalogo\Software','laboratorio-software', 'id_laboratorios', 'id_software');
    }

}
