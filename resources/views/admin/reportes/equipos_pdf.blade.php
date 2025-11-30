<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Equipos</title>
    <style>
        body { font-family: 'Arial', sans-serif; font-size: 10px; margin: 20px; }
        h1 { text-align: center; color: #3b82f6; font-size: 18px; margin-bottom: 10px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #3b82f6; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #3b82f6; color: white; padding: 8px; text-align: left; font-size: 9px; }
        td { padding: 6px; border-bottom: 1px solid #e5e7eb; font-size: 9px; }
        tr:nth-child(even) { background-color: #f9fafb; }
        .footer { margin-top: 20px; text-align: center; font-size: 8px; color: #6b7280; }
        .integrantes { font-size: 8px; color: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <h1>REPORTE DE EQUIPOS</h1>
        <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Equipo</th>
                <th>Evento</th>
                <th>Proyecto</th>
                <th>Integrantes</th>
                <th>Fecha Creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipos as $equipo)
                <tr>
                    <td>{{ $equipo->id }}</td>
                    <td>{{ $equipo->nombre }}</td>
                    <td>{{ $equipo->proyecto->evento->nombre ?? 'N/A' }}</td>
                    <td>{{ $equipo->proyecto->nombre ?? 'Sin proyecto' }}</td>
                    <td class="integrantes">
                        @foreach($equipo->participantes as $participante)
                            {{ $participante->user->name }}@if(!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>{{ $equipo->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Sistema de Gestión de Proyectos - Total de equipos: {{ $equipos->count() }}</p>
    </div>
</body>
</html>
