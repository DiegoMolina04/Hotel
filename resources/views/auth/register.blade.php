@extends('layouts.auth')

@section('title','Register')

@section('custom_attributes','class=register_body')

@section('content')

    <div class="register_form">
        <div class="row container-fluid">

            <!--Logo Hotel-->
            <div style=" display: flex; align-items:center; justify-content:center;"  class="col-lg-5 d-none d-lg-flex offset-1 align-items-center register_image">
                <img style=" margin: auto 0;" src="{{asset("img/others/logos/negative.png")}}" class="align-middle">
            </div>

            <div class="col-lg-6 col-12 text-center">
                <div class="card col-12 col-md-10">
                    <div class="card-body">

                        <h1 class="card-title">Registro Clientes</h1>

                        <form action="{{route("clientRegister")}}" method="POST" class="row g-3">
                            @csrf
                            
                            <!--Campo Nombre Completo-->
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre Completo:</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
        
                            <!--Menu desplegable pais de origen-->
                            <div class="col-md-6">
                                <label for="id_pais" class="form-label">Pais de origen:</label>

                                <select class='form-control' name='id_pais' id='id_pais' required>
                                    <option value='' style='text-align:center;'>Seleccione</option>

                                    @foreach ($paises as $pais)
                                        <option value="{{$pais->id}}" style='text-align:center;'>{{$pais->nombre}}</option>
                                    @endforeach         
                                </select>

                            </div>
                    
                            <!--Menu desplegable tipo de documento-->
                            <div class="col-md-6">
                                <label for="id_tip_doc" class="form-label">Tipo de Documento:</label>

                                <select class='form-control' name='id_tip_doc' id='id_tip_doc' required>
                                    <option value='' style='text-align:center;'>Seleccione</option>

                                    @foreach ($documentos as $documento)
                                        <option value="{{$documento->id}}" style='text-align:center;'>{{$documento->nombre}}</option>
                                    @endforeach         
                                </select>
                            </div>

                            <!--Campo Numero de Documento-->
                            <div class="col-md-6">
                                <label for="num_doc" class="form-label">Numero de Documento:</label>
                                <input type="text" class="form-control" name="num_doc" required max="50">
                            </div>    
        
                            <!--Menu desplegable sexo/genero-->
                            <div class="col-md-6">
                                <label for="id_genero" class="form-label">Sexo/Genero:</label>

                                <select class='form-control' name='id_genero' id='id_genero' required>
                                    <option value='' style='text-align:center;'>Seleccione</option>

                                    @foreach ($generos as $genero)
                                        <option value="{{$genero->id}}" style='text-align:center;'>{{$genero->nombre}}</option>
                                    @endforeach         
                                </select>
                            </div>

                            <!--Campo Fecha de Nacimiento-->
                            <div class="col-md-6">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" name="fecha_nacimiento" style='text-align:center;' max="2005-06-27" required>
                            </div>   
                            
                            <!--Campo Numero Telefonico-->
                            <div class="col-md-6">
                                <label for="num_telefono" class="form-label">Numero Telefonico:</label>
                                <input type="text" class="form-control" name="num_telefono" required max="15">
                            </div>
        
                            <!--Campo Correo electronico-->
                            <div class='col-md-6'>
                                <label for="email" class="form-label">Correo Electronico:</label>
                                <input type="email" class="form-control" name="email" required max="255">
                            </div>
        
                            <!--Campo Contraseña-->
                            <div class='col-md-6'>
                                <label for="password" class="form-label">Contraseña:</label>
                                <input type="password" class="form-control" name="password" required min="8">
                            </div>
        
                            <!--Campo Confirmar contraseña-->
                            <div class='col-md-6'>
                                <label for="verify_password" class="form-label">Confirmar Contraseña:</label>
                                <input type="password" class="form-control" name="verify_password" required min="8">
                            </div>
        
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary col-md-12">Registrar</button>

                                <a href="{{route("login")}}">¿Ya tienes cuenta?, Inicia Sesion</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection