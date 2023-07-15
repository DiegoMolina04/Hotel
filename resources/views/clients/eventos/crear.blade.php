@extends('layouts.dashboard')

@section('title', 'Nueva reserva')

{{-- Envio del item que debe aparecer como activo en el menu de navegacion --}}
@section('itemActive','eventos_create')

@section('content')
    <h1>Hacer nueva reserva de evento o espacio</h1>
    <div class="card p-2">
        <form action="{{route("eventos.store")}}" method="POST">

            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row p-2">
                <div class="col-8 col-sm-6">
                    <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off" name="spaceOnly">
                    <label class="btn btn-outline-primary" for="btn-check">Reservar solo espacio</label>
                </div >
                
                <div class="row mt-4">
                    <div class="col-12 col-sm-6">
                        <label id="tipoDe">Tipo de evento</label>
                        <select class="form-select" id="EventType" name="TipoEvento" value={{old("TipoEvento")}} required>
                            <option value=""> --- </option>
                            @foreach($event_types as $event)
                                @if ($event->id == 1)
                                    @continue
                                @endif
                                <option value="{{$event->id}}">{{$event->nombre}}</option>
                            @endforeach
                        </select>
                        <select class="form-select" id="SalonType" name="TipoSalon" value="{{old("TipoSalon")}}" hidden>
                            <option value=""> --- </option>
                            @foreach($salon_types as $salon)
                                <option value="{{$salon->id}}">{{$salon->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-sm-3" id="sillas" >
                        <label for="inputSillas">Número sillas/invitados</label>
                        <input class="form-control" type="number" name="invitados" id="inputSillas">
                    </div>
                </div >
                    
            </div class="row">
            <div class="row p-2">
                <div class="col-12 col-sm-6">
                    <label for="ini">Inicio evento</label>
                    <input type="datetime-local" name="fecha_inicio" id="ini" class="form-control" value="{{old('fecha_inicio')}}" min="{{date('Y-m-d\TH:i', strtotime('+1 day'))}}">
                </div >
                
                <div class="col-12 col-sm-6">
                    <label for="fin">Final evento</label>
                    <input type="datetime-local" name="fecha_fin" id="fin" class="form-control" value="{{old('fecha_fin')}}" min="{{date('Y-m-d\TH:i', strtotime('+1 day'))}}">
                </div>
                    
            </div>
            <div id="complementos" hidden>
                <h3>Complementos: </h3>
                @foreach ($complementos as $complemento)
                    <input type="checkbox" name="{{$complemento->id}}" id="{{$complemento->nombre}}" class="form-check-input">
                    <label for="{{$complemento->nombre}}">{{$complemento->nombre}}</label><br>
                @endforeach
            </div>
            <div class="p-2 d-flex justify-content-end">

                <input type="submit" value="Hacer reserva" class="btn btn-success">
            </div>

            <input type="hidden" name="num_rows" value=2>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        /*Logica para cambiar formulario de acuerdo a acción*/
        const eventType = document.getElementById("btn-check");
        const labelInput = document.getElementById("tipoDe");
        const inputSpace = document.getElementById("SalonType");
        const inputEvent = document.getElementById("EventType");
        const complementos = document.getElementById('complementos');

        eventType.addEventListener('change', ()=>{
            if(eventType.checked == false){
                showEspacio();
            }else{
                showEvento();
            }
        });

        function showEspacio(){
            labelInput.innerHTML ="Tipo de evento";
            inputEvent.hidden = false;
            inputEvent.required = true;
            inputSpace.hidden = true;
            inputSpace.required = false;
            complementos.hidden = true;
        }

        function showEvento(){
            labelInput.innerHTML ="Tipo de espacio";
            inputSpace.hidden = false;
            inputSpace.required = true;
            inputEvent.hidden = true;
            inputEvent.required = false;
            complementos.hidden = false;
        }
    </script>
@endsection