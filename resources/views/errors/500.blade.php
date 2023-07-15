@extends('errors::minimal')
@section("titulo", "¡Error 500!")
  
@section("imagen")
        <img src="{{asset('img/errores/error500.png')}}" >
@endsection
@section("texto")
 Lo sentimos, ha ocurrido un error interno del servidor. <br>
 Intenta refrescar la página o sientete libre de contactarnos.
@endsection
