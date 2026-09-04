@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3>Módulo de Auditoría</h3>
    <hr>
    <div class="alert alert-info">
        Vista de: <strong>{{ Request::is('*/preinscripcion') ? 'Validación de Preinscripciones' : 'Validación de Usuarios Registrados' }}</strong>
    </div>
    </div>
@endsection
