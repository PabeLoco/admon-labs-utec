@extends ('layouts.app')
@section ('h2',"Practicas Libres")
@section ('content')
<script src="{{asset('js/sweetalert/sweetalert.min.js')}}"></script>



<!-- Fin del Titulo -->
<!-- Inicio del main -->

<div class="row my-5">
    @if(empty($idLab) && $rol == 'administrador')
        <h4>No posee un laboratorio asignado</h4>
    @else
        <a href="{{url('catalogo/practica/create/')}}">
            <button class="btn btn-dark ml-auto d-flex align-items-end" id="btnAgregarUser">
                Agregar Nueva Practica &nbsp <span class="material-icons m-0 p-0"> add_circle_outline </span>
            </button>
        </a>
    @endif

    
    <table id="datatable" class="table table-striped table-bordered">
        <thead class="text-light">
            <th>id</th>
            <th>Laboratorio</th>
            <th>dia</th>
            <th>Hora</th>    
            <th>fecha</th>
            <th>Carrera</th>
            <th>Asistencia</th>
            <th colspan="3">Acciones</th>
        </thead>
        <tbody>
            @if(empty($practicas))
                <tr><td colspan="12" class="text-center">No tiene practicas registradas</td></tr>
            @else
                @foreach ($practicas as $obj)
                <tr>
                    <td align="center">{{ $obj->id}}</td>
                    <td>{{$obj->horario->laboratorio->nombre}}</td>
                    <td>{{$obj->horario->dia}}</td>
                    <td>{{$obj->horario->hora->horario}}</td>
                    <td>{{ $obj->fecha}}</td>
                    <td>{{ $obj->carrera->nombre}}</td>
                    <td>{{ $obj->asistencia}}</td>
                    <td align="center">
                        <a href="{{URL::action('catalogo\PracticaController@edit',$obj->id)}}"
                            class="on-default edit-row"><i class="fa fa-pencil fa-lg"></i></a>
                        &nbsp;&nbsp;
                        <a href="" data-target="#modal-delete-{{$obj->id}}" data-toggle="modal"><i
                                class="fa fa-trash fa-lg"></i></a>
                    </td>
                </tr>
                @include('catalogo.practica.modal')
                @endforeach
            @endif



        </tbody>
    </table>
    @include('sweet::alert')
</div>
<!-- fin del main -->



@endsection