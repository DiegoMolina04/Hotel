@php
    
    /*
        Problema encontrado: Cuando deseo emplear directamente la variable, laravel me envia un error, indicandome que la variable no existe, aunque esta fuera enviada al momento de invocar al componente.

        Solución: A través de un condicional, se guarda un valor por defecto en la variable, mientras que los datos enviados son procesados
    */
    if (!isset($itemActive)) {
        $itemActive = '';
    }
    
    //Definicion por default de los active de las opciones del modulo de reservaciones
    $reservations_index = '';
    $reservations_create = '';
    
    //Definicion por default de los active de las opciones del modulo de eventos
    $eventos_create = '';
    
    //Definicion por default de los active de las opciones del modulo de PQRS
    $pqrs_create = '';
    
    //Definicion por default de los active de las opciones del modulo de eventos
    $eventos_index = '';
    
    $pregunta = '';
    $queja = '';
    $reclamo = '';
    $sugerencia = '';
    
    //Segun la informacion enviada, cambiara el estado de una u otra opcion para que esta aparezca como activa
    switch ($itemActive) {
        case 'reservations_index':
            $reservations_index = 'active';
            break;
    
        case 'reservations_create':
            $reservations_create = 'active';
            break;
    
        case 'eventos_create':
            $eventos_create = 'active';
            break;
    
        case 'pqrs_create':
            $pqrs_create = 'active';
            break;
    
        case 'eventos_lista':
            $eventos_index = 'active';
            break;
    }
@endphp

<x-element_menu link="{{ route('gestion-pqrs.index') }}" nombre="Todos los PQRS" activo="{{ $reservations_index }}">
    <path
        d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
    <path
        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
</x-element_menu>

<x-element_menu link="{{ route('gestion-pqrs.index') }}" nombre="Petición" activo="{{ $reservations_index }}">
    <path
        d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
    <path
        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
</x-element_menu>

<x-element_menu link="{{ route('reservations.create') }}" nombre="Quejas" activo="{{ $reservations_create }}">
    <path
        d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
    <path
        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
</x-element_menu>

<x-element_menu link="{{ route('eventos.index') }}" nombre="Reclamos" activo="{{ $eventos_index }}">
    <path
        d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
    <path
        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
</x-element_menu>

<x-element_menu link="{{ route('eventos.create') }}" nombre="Sugerencias" activo="{{ $eventos_create }}">
    <path
        d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
    <path
        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
</x-element_menu>
