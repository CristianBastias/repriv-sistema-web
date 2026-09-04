<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha Técnica - {{ $empresa->nombre_empresa }}</title>
    <style>
        /* Márgenes APA 7ma Edición: 2.54 cm (1 pulgada) en todos los lados */
        @page {
            margin-top: 1.00cm;
            margin-bottom: 2.54cm;
            margin-left: 2.54cm;
            margin-right: 2.54cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif; /* APA 7 recomienda tipografías formales */
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
            margin: 0;
            padding: 0;
        }

        /* Ajuste de contenedor interno para evitar desbordes */
        .content {
            width: 100%;
        }

        .title {
            text-align: center;
            font-size: 15pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 15px;
            margin-bottom: 25px;
            text-decoration: underline;
        }

        /* Secciones de datos */
        .section-title {
            font-weight: bold;
            font-size: 12pt;
            margin-top: 15px;
            margin-bottom: 8px;
            border-bottom: 1px solid #000;
            text-transform: uppercase;
        }

        .data-row {
            margin-bottom: 6px;
        }

        .label {
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Cuadro de Estado Administrativo */
        .status-box {
            border: 1px solid #000;
            padding: 12px;
            text-align: center;
            font-weight: bold;
            font-size: 12pt;
            margin-top: 25px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="content">

        <!-- Incluir Encabezado Institucional -->
        @include('pdf.pdf_membrete', ['position' => 'header'])

        <!-- Título del Documento -->
        <div class="title">Ficha Técnica</div>

        <!-- Datos Identificatorios -->
        <div class="section-title">Datos Identificatorios</div>
        <div class="data-row"><span class="label">Razón Social:</span> {{ $empresa->nombre_empresa }}</div>
        <div class="data-row"><span class="label">CUIT:</span> {{ $empresa->cuit ?? '---' }}</div>
        <div class="data-row"><span class="label">Propietario:</span> {{ $empresa->propietario ?? '---' }}</div>

        <!-- Información de Contacto -->
        <div class="section-title">Información de Contacto</div>
        <div class="data-row"><span class="label">Localidad:</span> {{ $empresa->ubicacion_localidad }}</div>
        <div class="data-row"><span class="label">Teléfono:</span> {{ $empresa->telefono ?? '---' }}</div>
        <div class="data-row"><span class="label">Email:</span> {{ $empresa->email }}</div>

        <!-- Estado Administrativo -->
        <div class="status-box">
            ESTADO ADMINISTRATIVO ACTUAL: <u>{{ mb_strtoupper($empresa->condicion_actual) }}</u>
        </div>

        <!-- Incluir Cierre, Texto Legal y Firma Institucional -->
        @include('pdf.pdf_membrete', ['position' => 'footer'])

    </div>
</body>
</html>
