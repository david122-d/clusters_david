<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Amenidades</title>
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
    <h1>Reporte de Estado de amenidades ({{$nombre}})</h1>
    <table>
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
</body>
</html>