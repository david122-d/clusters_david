<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Clusters, entradas y amenidades</title>
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
    <h1>Reporte de Clusters ({{$selectedClust}})</h1>
    <table>
    @if($amenities->isEmpty())
        <table>
            <thead>
                <h2>No hay Amenidades en el cluster</h2>
            </thead>
        </table>
    @else
        <h1>Reporte de Amenidades </h1>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($amenities as $ameniti)
                <tr>
                    <td>{{ $ameniti->name }}</td>
                    <td>{{ $ameniti->type }}</td>
                    <td>{{ $ameniti->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
   
    @endif

    <h1>Reporte de Entradas y salidas</h1>
    @if($vehicleEntrances->isEmpty())
    <table>
        <thead>
            <h1>No hay entradas en el cluster</h1>
        </thead>
    </table>
    @else
    <table>
        <thead>
            <<tr>
                <th>Placas</th>
                <th>Hora de entrada</th>
                <th>Hora de salida</th>
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
                    <td>{{ $vehicleEntrance->stand->number ?? 'No asignado' }}</td>
                    <td>{{ $vehicleEntrance->user->name ?? 'No asignado' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
        
    @endif
    

</body>
</html>