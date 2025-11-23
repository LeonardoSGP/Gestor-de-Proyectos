<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Constancia</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; text-align: center; padding: 40px; border: 10px double #1a202c; height: 90%; }
        .header { margin-bottom: 30px; }
        .logo { font-size: 30px; font-weight: bold; color: #4a5568; text-transform: uppercase; }
        .title { font-size: 50px; font-weight: bold; color: #2d3748; margin: 20px 0; font-family: 'Georgia', serif; }
        .subtitle { font-size: 20px; color: #718096; margin-bottom: 40px; }
        .recipient { font-size: 28px; font-weight: bold; color: #1a202c; margin: 20px 0; border-bottom: 2px solid #cbd5e0; display: inline-block; padding-bottom: 10px; }
        .event { font-size: 24px; font-weight: bold; color: #2b6cb0; margin-top: 10px; }
        .achievement { font-size: 35px; font-weight: bold; color: #d69e2e; margin: 30px 0; text-transform: uppercase; letter-spacing: 2px; }
        .date { position: absolute; bottom: 60px; left: 0; right: 0; font-size: 14px; color: #718096; }
        .signatures { position: absolute; bottom: 80px; width: 100%; display: table; }
        .sig-block { display: table-cell; width: 50%; vertical-align: bottom; }
        .line { width: 200px; border-top: 1px solid #000; margin: 0 auto 10px auto; }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo">Sistema de Gestión de Proyectos</div>
    </div>

    <div class="title">CONSTANCIA DE LOGRO</div>

    <p class="subtitle">Se otorga el presente reconocimiento al equipo:</p>

    <div class="recipient">{{ $proyecto->equipo->nombre }}</div>

    <p class="subtitle">Y a sus integrantes:<br>
        <small>
            @foreach($proyecto->equipo->participantes as $p)
                {{ $p->user->name }}@if(!$loop->last), @endif
            @endforeach
        </small>
    </p>

    <p class="subtitle">Por haber obtenido el:</p>

    <div class="achievement">{{ $textoLogro }}</div>

    <p class="subtitle">Con el proyecto "<strong>{{ $proyecto->nombre }}</strong>" en el evento:</p>
    
    <div class="event">{{ $proyecto->evento->nombre }}</div>

    <div class="date">
        Expedido el {{ now()->format('d') }} de {{ now()->locale('es')->monthName }} del {{ now()->format('Y') }}
    </div>

    {{-- Firmas --}}
    <div class="signatures">
        <div class="sig-block">
            <div class="line"></div>
            <div>Director del Evento</div>
        </div>
        <div class="sig-block">
            <div class="line"></div>
            <div>Comité Evaluador</div>
        </div>
    </div>

</body>
</html>