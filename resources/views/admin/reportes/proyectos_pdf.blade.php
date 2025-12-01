<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Proyectos</title>
    <style>
        body { font-family: 'Arial', sans-serif; font-size: 10px; margin: 20px; }
        h1 { text-align: center; color: #10b981; font-size: 18px; margin-bottom: 10px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #10b981; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #10b981; color: white; padding: 8px; text-align: left; font-size: 9px; }
        td { padding: 6px; border-bottom: 1px solid #e5e7eb; font-size: 9px; }
        tr:nth-child(even) { background-color: #f9fafb; }
        .footer { margin-top: 20px; text-align: center; font-size: 8px; color: #6b7280; }
        .integrantes { font-size: 8px; color: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <h1>REPORTE DE PROYECTOS</h1>
        <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Proyecto</th>
                <th>Equipo</th>
                <th>Evento</th>
                <th>Integrantes</th>
                <th>Calificaciones</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto->id }}</td>
                    <td>{{ $proyecto->nombre }}</td>
                    <td>{{ $proyecto->equipo->nombre ?? 'N/A' }}</td>
                    <td>{{ $proyecto->evento->nombre ?? 'N/A' }}</td>
                    <td class="integrantes">
                        @if($proyecto->equipo)
                            @foreach($proyecto->equipo->participantes as $participante)
                                {{ $participante->user->name }}@if(!$loop->last), @endif
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $proyecto->calificaciones->count() }}</td>
                    <td>{{ $proyecto->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Sistema de Gestión de Proyectos - Total de proyectos: {{ $proyectos->count() }}</p>
    </div>
</body>
</html>
