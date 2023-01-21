<!DOCTYPE html>
<html>
<head>
    <title>emails</title>
</head>
<body>
    <h1>Reporte de usuarios registrados por país</h1>
    <p>Hola Admin</p>
    <p>Este es el reporte de los usuarios registrados por país:</p>
    
        <table>
            <thead>
                <tr>
                    <th>País</th>
                    <th># Usuarios</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($report as $reportCountry)
                    <tr>
                        <td>{{ $reportCountry->country }}</td>
                        <td>{{ $reportCountry->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <p>Gracias</p>
</body>
</html>