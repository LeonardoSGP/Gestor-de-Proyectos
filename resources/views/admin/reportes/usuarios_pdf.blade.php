<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Usuarios</title>
    <style>
        body { font-family: 'Arial', sans-serif; font-size: 10px; margin: 20px; }
        h1 { text-align: center; color: #4f46e5; font-size: 18px; margin-bottom: 10px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #4f46e5; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #4f46e5; color: white; padding: 8px; text-align: left; font-size: 9px; }
        td { padding: 6px; border-bottom: 1px solid #e5e7eb; font-size: 9px; }
        tr:nth-child(even) { background-color: #f9fafb; }
        .footer { margin-top: 20px; text-align: center; font-size: 8px; color: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <h1>REPORTE DE USUARIOS</h1>
        <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol(es)</th>
                <th>No. Control</th>
                <th>Carrera</th>
                <th>Fecha Registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->roles->pluck('nombre')->join(', ') }}</td>
                    <td>{{ $usuario->participante->no_control ?? 'N/A' }}</td>
                    <td>{{ $usuario->participante->carrera->nombre ?? 'N/A' }}</td>
                    <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Sistema de Gestión de Proyectos - Total de usuarios: {{ $usuarios->count() }}</p>
    </div>
</body>
</html>
