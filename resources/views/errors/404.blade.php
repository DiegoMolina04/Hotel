@extends('errors::minimal')
@section("titulo", "¡Error 404!")
  
@section("imagen")
        <img src="{{asset('img/errores/error404.png')}}" >
@endsection
@section("texto")
 Lo sentimos, No podemos encontrar la página que buscas. <br> No te preocupes, Regresemos al inicio. 
 @endsection
