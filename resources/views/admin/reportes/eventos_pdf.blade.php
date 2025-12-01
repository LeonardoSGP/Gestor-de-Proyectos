<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Eventos</title>
    <style>
        body { font-family: 'Arial', sans-serif; font-size: 10px; margin: 20px; }
        h1 { text-align: center; color: #9333ea; font-size: 18px; margin-bottom: 10px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #9333ea; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #9333ea; color: white; padding: 8px; text-align: left; font-size: 9px; }
        td { padding: 6px; border-bottom: 1px solid #e5e7eb; font-size: 9px; }
        tr:nth-child(even) { background-color: #f9fafb; }
        .footer { margin-top: 20px; text-align: center; font-size: 8px; color: #6b7280; }
        .descripcion { font-size: 8px; max-width: 200px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>REPORTE DE EVENTOS</h1>
        <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Proyectos</th>
                <th>Criterios</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventos as $evento)
                <tr>
                    <td>{{ $evento->id }}</td>
                    <td>{{ $evento->nombre }}</td>
                    <td class="descripcion">{{ Str::limit($evento->descripcion, 50) }}</td>
                    <td>{{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y') }}</td>
                    <td>{{ $evento->proyectos->count() }}</td>
                    <td>{{ $evento->criterios->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Sistema de Gestión de Proyectos - Total de eventos: {{ $eventos->count() }}</p>
    </div>
</body>
</html>
