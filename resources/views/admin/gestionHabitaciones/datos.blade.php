@extends('layouts.dashboard')

@section('title', 'Interfaz que recibe los datos')

@section('content')

  <div class="container">
    <h1 class="text-center">Interfaz que recibe los datos</h1>

    <form action="{{route('estado',$datos->id)}}" method = 'POST'>
      @csrf
      @method("PUT")

 
    <p>   La habitacion seleccionada fue {{$datos->id}},
      de tipo  {{$datos->tipo}}
       y su estado es <select name= "estado" value= {{$datos->estado}} >  @foreach ($estados as $estado)
        @if($estado->nombre == $datos->estado)
        <option selected value={{$estado->id}}> {{$estado->nombre}} </option>

        @else
        <option value={{$estado->id}}> {{$estado->nombre}}</option>

        @endif
       @endforeach</select>  </p>


    


       <button type="submit" class="btn btn-success">Continuar</button>

    
       </form>
    
  </div>

@endsection

@section('scripts')

@endsection