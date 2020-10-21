<?php

namespace App\Http\Controllers\catalogo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\catalogo\Practica;
use App\catalogo\Horario;
use App\catalogo\Carrera;
use App\catalogo\HorasClases;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\catalogo\PracticaFormRequest;
use App\Role;
use App\User;
use DB;
use Carbon\Carbon;

class PracticaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {

        if ($request) {

            if (auth()->user()->can('read practicas')) {

                $practicas = Practica::with('carreras')->get();

                // dd($carreras);
                return view('catalogo.practica.index', ["practicas" => $practicas]);
            } else {
                // abort(403);
                return view('home');
            }
        }
    }
    public function create()
    {
        if (auth()->user()->can('create practicas')) {
            $carreras = Carrera::get();
            $horario = Horario::with('materias')->get();

            return view("catalogo.practica.create", ["carreras" => $carreras, "horario" => $horario]);
        } else {
            // abort(403);
            return view('home');
        }
    }
    public function store(PracticaFormRequest $request)
    {
        $practica = new Practica;
        $practica->fecha = $request->get('fecha');
        $practica->asistencia = $request->get('asistencia');

        $practica->id_carreras = $request->get('id_carreras');
        $practica->id_horarios = $request->get('id_horarios');
        $practica->timestamp = Carbon::now();
        $practica->save();
        alert()->success('El registro ha sido agregado correctamente');
        return Redirect::to('catalogo/practica/create');
    }
    public function show($id)
    {
        return view("catalogo.practica.show", ["practica" => Practica::findOrFail($id)]);
    }
    public function edit($id)
    {
        $practica = Practica::findOrFail($id);
        $carrera = Carrera::get();

        $horas_clases = HorasClases::where('id_horario', '=', $practica->id_horarios)->get();

        $horario = Horario::with('materias')->get();

        return view("catalogo.practica.edit", ["practica" => $practica, Practica::findOrFail($id), "carrera" => $carrera, "horario" => $horario, "horas_clases" => $horas_clases]);
    }
    public function update(PracticaFormRequest $request, $id)
    {

        $practica = Practica::findOrFail($id);
        $practica->fecha = $request->get('fecha');
        $practica->asistencia = $request->get('asistencia');
        $practica->id_carreras = $request->get('carrera');
        $practica->id_horarios = $request->get('id_horarios');
        $practica->update();
        alert()->info('El registro ha sido modificado correctamente');
        return redirect('catalogo/practica/' . $id . '/edit');
    }
    public function destroy($id)
    {
        $practica = Practica::findOrFail($id);
        $practica->delete();
        alert()->error('El registro ha sido eliminado correctamente');
        return Redirect::to('catalogo/practica');
    }

    /* public function add_materia(Request $request)
    {
        $carrera = Carrera::findOrFail($request->get('id'));
        $materia = Materia::findOrFail($request->get('materias'));

        $carrera->carreraMaterias()->attach($request->get('materias'));
        $carrera->save();

        return redirect('catalogo/carrera/' . $carrera->id . '/edit');
    }*/
}