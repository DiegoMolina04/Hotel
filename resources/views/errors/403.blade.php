@extends('errors::minimal')
@section("titulo", "¡Error 403!")
  
@section("imagen")
        <img src="{{asset('img/errores/error403.jpeg')}}" >
@endsection
@section("texto")
 ¡Ops!, no tienes permiso para acceder a este recurso. 
@endsection
