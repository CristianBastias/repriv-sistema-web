@extends('pdf.layout_encabezado')

@section('content')
<div style="margin-top: 10px;">
    <table width="100%" border="1" style="table-layout: fixed; border-collapse: collapse; font-size: 10px;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th width="25%">Nombre / Razón Social</th>
                <th width="15%">Propietario</th>
                <th width="15%">Email</th>
                <th width="10%">Teléfono</th>
                <th width="20%">Ubicación</th>
                <th width="15%">Condición</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empresas as $empresa)
            <tr>
                <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{ $empresa->nombre_empresa }}</td>
                <td>{{ $empresa->propietario }}</td>
                <td style="word-wrap: break-word;">{{ $empresa->email }}</td>
                <td>{{ $empresa->telefono }}</td>
                <td>{{ $empresa->ubicacion_localidad }}</td>
                <td>{{ $empresa->condicion_actual }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
