<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            text-align: center;
            padding: 0;
            margin: 0;
            font-family: sans-serif;
            height: 100%;
            background-image: url("{{ public_path('images/fondo.png') }}");
            background-size: cover;
            background-position: center;
        }
        .header {
            width: 100%;
            text-align: center;
        }
        .header img {
            width: 100px; /* Ajusta según tus necesidades */
            display: inline-block;
        }
        .header div {
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            margin: 0 25px;
        }
        .header div label {
            color: #004aad;
            font-size: 30px;
            display: block;
            margin: 5px 0;
            font-weight: bold;
        }

        .header div span {
            font-size: 30px;
            letter-spacing: 10px;
            color: #737373;
        }
        .content, .content-image {
            display: table;
            width: 100%;
        }
        .content label {
            color: #004aad;
            font-weight: bold;
            display: table-cell;
            width: 50%; /* Ajusta la proporción de ancho */
            vertical-align: middle; /* Alineación vertical */
            padding: 5px;
            text-align: left;
        }
        .content label span {
            color: #0dcaf0;
        }
        .footer {
            width: 100%;
            padding: 0;
        }
        .footer p {
            margin-top: 30px;
            font-size: 14px;
            text-align: center;
            color: #004aad;
            font-weight: bold;
            width: 100%;
        }
        .title {
            font-size: 20px;
            color: #247ca7;
            margin: 20px 0;
        }
        .content-image img {
            width: 100px;
            display: table-cell;
            vertical-align: middle; /* Alineación vertical */
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.jpeg') }}" alt="Logo Izquierdo">
        <div>
            <label>MARÍTIMA DEL CARIBE S.A.S.</label>
            <label>NIT 900.061.576-6</label>
            <span>Operador portuario</span>
        </div>
        <img src="{{ public_path('images/logo2.png') }}" alt="Logo Derecho">
    </div>
    <h1 class="title">{{ $title }} </h1>

    <div class="content">
        <label for="">N°: <span>{{ $dataPDF['id_boleta_servicio'] }}</span></label>
        <label for="">MOTONAVE: <span>{{ $dataPDF['motonave'] }}</span></label>
    </div>
    <div class="content">
        <label for="">DESTINO: <span>{{ $dataPDF['destino'] }}</span></label>
        <label for="">AGENCIA: <span>{{ $dataPDF['agencia'] }}</span></label>
    </div>
    <div class="content">
        <label for="">FECHA INICIO: <span>{{ $dataPDF['fecha_salida'] }} {{ $dataPDF['hora_salida'] }}</span></label>
        <label for="">EMBARCACIÓN: <span>{{ $dataPDF['lancha'] }}</span></label>
    </div>
    <div class="content">
        <label for="">FECHA FIN: <span>{{ $dataPDF['fecha_regreso'] }} {{ $dataPDF['hora_regreso'] }}</span></label>
        <label for="">PILOTO PRÁCTICO: <span>{{ $dataPDF['piloto'] }}</span></label>
    </div>
    <div class="content">
        <label for="">TIPO DE SERVICIO: <span>{{ $dataPDF['servicio'] }}</span></label>
    </div>
    <div class="content">
        <label for="">OBSERVACIÓN: <span>{{ $dataPDF['observaciones'] }}</span></label>
    </div>
    <div class="footer">
        <p>
            Troncal del Caribe, Carretera 90 N° KM 9 - 350 Sector Bomba Zuca, Santa Marta D.T.C.H., Colombia.
            <br>
            Página web: www.maritimadc.com - Email: facturacion@maritimadc.com
        </p>
        <div class="content-image">
            <img src="{{ public_path('images/logo-basc-transp-color.png') }}" alt="">
            <img src="{{ public_path('images/vigilado-supertransporte_orig.png') }}" alt="">
            <img src="{{ public_path('images/logo-iso-45001_1.png') }}" alt="">
            <img src="{{ public_path('images/logo-iso-9001_1.png') }}" alt="">
            <img src="{{ public_path('images/logo-iso-14001_1.png') }}" alt="">
        </div>
    </div>
</body>
</html>
