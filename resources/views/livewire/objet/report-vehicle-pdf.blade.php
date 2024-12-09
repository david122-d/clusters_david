<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Entradas de Vehículos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
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
    <h1>Reporte de Entradas de Vehículos</h1>
    <table>
        <thead>
            <tr>
                <th>Placas</th>
                <th>Hora de entrada</th>
                <th>Hora de salida</th>
                <th>Cluster</th>
                <th>Caseta</th>
                <th>Guardia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicleEntrances as $vehicleEntrance)
                <tr>
                    <td>{{ $vehicleEntrance->plates }}</td>
                    <td>{{ $vehicleEntrance->check_in_time }}</td>
                    <td>{{ $vehicleEntrance->check_out_time }}</td>
                    <td>{{ $vehicleEntrance->cluster->name ?? 'No asignado' }}</td>
                    <td>{{ $vehicleEntrance->stand->number ?? 'No asignado' }}</td>
                    <td>{{ $vehicleEntrance->user->name ?? 'No asignado' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>