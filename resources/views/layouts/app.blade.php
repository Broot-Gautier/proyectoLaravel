<!DOCTYPE html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style>
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial;
}

.topnav {
  overflow: hidden;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=text]{
  padding: 4px;
  margin-top: 14px;
  font-size: 14px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 4px 10px;
  margin-top: 14px;
  margin-right: 10px;
  background: #E2CAF8;
  font-size: 14px;
  border: none;
  cursor: pointer;
}
.row{margin-top: 2px;}
.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: right;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: right;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
}
</style>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>feibutube</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class=" navbar navbar-light" style="background-color: #e3f2fd;">
            <div class="container">
                <div class="navbar-header">


                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">Inicio</a>
                    <a class="navbar-brand" href="{{ url('/posts') }}">Perfil</a>
                    <a class="navbar-brand" href="{{ url('/suscriptors/news') }}">Explora Personas</a>
                    <a class="navbar-brand" href="{{ url('/suscriptors/suscritos') }}">Suscriptores a tu cuenta!</a>
                    <a class="navbar-brand" href="{{ url('/YoursSuscriptions') }}">Usuarios que sigues!</a>
                    <div class="topnav right">
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Iniciar Sesion</a></li>
                            <li><a href="{{ route('register') }}">Registrate!</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar sesion
                                        </a>


                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    <script>
    function button_click_suscribir(id)
        {
            var url;
            url= '/SuscriptorsController/consulta_seguimiento/'+id;

            // ajax adding data to database
            $.ajax({
                url: url,
                type: "POST",
                //data: $('#form_modificar').serialize(),
                dataType: "JSON",
                success: function (data)
                {
                    if (data.success)
                    {
                            toastr["success"]('Ahora esta siguiendo a este usuario');
                            reload_table();

                    } else
                    {
                        toastr["warning"](data.error);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $('#errors').html(data.error);
                }
            });// END AJAX
            return false;
        }
    </script>
   </body>
</html>
