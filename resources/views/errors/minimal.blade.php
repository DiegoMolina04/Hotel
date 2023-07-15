<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield("titulo")</title>

    <!--Importacion manual de la hoja de estilos propia del proyecto-->
    <link rel="stylesheet" href="{{asset("addons/css/app.css")}}">

    <link rel="shortcut icon" href="{{asset('img/others/icon.png')}}" type="image/x-icon">
    <style>

        body{
            background-color: #2499c7;
            height:90vh;
        }
        .container{
            height:100%;
            display:grid;
            place-items:center;  
            text-align:center; 
            
        }
        h1{
            color: #1000C2;
            font-size:6rem;
            padding: 0px;
            text-align:center;
        }
        h3, a{
            color:white;
            font-family: "Fuente-contenido";
            text-align:center;
            font-size:20px;
        }

        a{
            color:white;
            background:#1000C2;
            padding:3px;
            border-radius:5px;
            font-size:25px;
            width:5%;
            margin-top:20px;      
        }
        img{
            width:90%;
            height:100%;
            object-fit:cover;
            
        }
       
    </style>
</head>
<body>
    
    <div class="container"> 
        <div>   
            <h1> @yield("titulo")</h1>
            @yield("imagen")
            <h3> @yield("texto")  </h3>
            <br>
            <a href="{{ route('index')}}">Volver</a>
         </div>
       
    </div>

</body>
</html>
