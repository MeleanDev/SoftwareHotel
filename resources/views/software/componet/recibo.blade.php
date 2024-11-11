<!DOCTYPE html>
<html>

<head>
    <title>Recibo de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Recibo de Pago</h1>
    <p><strong>Número de Recibo:</strong> {{ $identificacionRecibo }}</p>
    <p><strong>Fecha:</strong> {{ $fechaRecibo }}</p>
    <p><strong>Sede:</strong> {{ $nombreSede }}</p>

    <h2>Datos del Cliente</h2>
    <p><strong>Nombre:</strong> {{ $nombreCliente }}</p>
    <p><strong>Identificación:</strong> {{ $identificacionCliente }}</p>

    <h2>Detalle del Recibo</h2>
    <table>
        <thead>
            <tr>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Habitacion</th>
                <th>Tipo Habitacion</th>
                <th>Cantidad Dias</th>
                <th>Precio Unitario</th>
                <th>Precio Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>{{ $entrada }}</th>
                <th>{{ $salida }}</th>
                <th>{{ $habitacion }}</th>
                <th>{{ $tipo }}</th>
                <th>{{ $cantidad }}</th>
                <th>{{ $precioUnit }}</th>
                <th>{{ $totalAPagar }}</th>
            </tr>
        </tbody>
    </table>

    <p><strong>Total a Pagar:</strong> {{ $totalAPagar }}</p>

    <p>Firma y Sello</p>
</body>

</html>
