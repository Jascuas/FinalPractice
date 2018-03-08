<!--
~ Copyright (C) Javier 2018
~
~ This program is free software: you can redistribute it and/or modify
~ it under the terms of the GNU General Public License as published by
~ the Free Software Foundation, either version 3 of the License, or
~ (at your option) any later version.
~
~ This program is distributed in the hope that it will be useful,
~ but WITHOUT ANY WARRANTY; without even the implied warranty of
~ MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
~ GNU General Public License for more details.
~
~ You should have received a copy of the GNU General Public License
~ along with this program.  If not, see <http://www.gnu.org/licenses/>.
~
-->
<!--
Autor= Javier Sanchez
Fecha= 01/03/2018
Licencia= gpl30
Version= 1.0
Descripcion= Documento html para la web de billetes, contiene la pagina principal
-->
<?php $val = Validacion::getInstance(); ?>
<html lang="en">

<head>
    <title>Billetes</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/common.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">


</head>

<body onload="peticionOrigen()">
<!--Main Navigation-->
<header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark blue scrolling-navbar">
        <div class="logo-wrapper waves-light">
            <a href="index.php"><img src="img/logo.png" ></a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Compra billetes<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ofertas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Opiniones</a>
                </li>
            </ul>
            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-facebook"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-twitter"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-instagram"></i></a>
                </li>
            </ul>
        </div>
    </nav>

</header>
<!--Main Navigation-->

<main>

    <form method="post" action="index.php?pagina=billetes" onsubmit="return validar()">
        {{errores}}
        <div class="row justify-content-around">
            <table class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <tbody>
                <tr class="form-group">
                    <td>
                        <label class="control-label" for="nombre">Nombre*:</label>
                    </td>
                    <td>
                        <input type="text"
                               class="form-control oblig"
                               id="nombre"
                               name="nombre"
                               maxlength="10"
                               pattern="^[a-zA-Z ]*$"
                               placeholder="Introduce tu nombre"
                               required
                               oninvalid="this.setCustomValidity('Formato invalido, solo letras y espacios en blanco '); this.value=''"
                               oninput="this.setCustomValidity(''); casilla()"
                               value='<?php echo $val->restoreValue('nombre'); ?>'>
                        <br>
                    </td>
                </tr>
                <tr class="form-group">
                    <td>
                        <label class="control-label" for="apellido1">Apellido1*:</label>
                    </td>
                    <td>
                        <input type="text"
                               class="form-control oblig"
                               id="apellido1"
                               name="apellido1"
                               maxlength="10"
                               pattern="^[a-zA-Z ]*$"
                               placeholder="Primer apellido"
                               required
                               oninvalid="this.setCustomValidity('Formato invalido, solo letras y espacios en blanco '); this.value=''"
                               oninput="this.setCustomValidity(''); casilla()"
                               value='<?php echo $val->restoreValue('apellido1'); ?>'>
                        <br>
                    </td>
                </tr>
                <tr class="form-group">
                    <td>
                        <label for="apellido2" class="label-control">Apellido2*:</label>
                    </td>
                    <td>
                        <input type="text"
                               id="apellido2"
                               class="form-control oblig"
                               name="apellido2"
                               maxlength="10"
                               pattern="^[a-z A-Z]*$"
                               placeholder="Segundo apellido"
                               required
                               oninvalid="this.setCustomValidity('Formato invalido, solo letras y espacios en blanco '); this.value=''"
                               oninput="this.setCustomValidity(''); casilla()"
                               value='<?php echo $val->restoreValue('apellido2'); ?>'>
                        <br>
                    </td>
                </tr>
                <tr class="form-group">
                    <td>
                        <label for="dni" class="label-control">DNI*: </label>
                    </td>
                    <td>
                        <input type="text"
                               class="form-control oblig"
                               id="dni" name="dni"
                               placeholder="DNI"
                               required
                               pattern="^[0-9]{8}[A-Z]{1}$"
                               onchange="validarDNI(this.value)"
                               oninvalid="this.setCustomValidity('El formato del dni introducido no es correcto.'); this.value='';"
                               oninput="this.setCustomValidity(''); casilla() "
                               value='<?php echo $val->restoreValue('dni'); ?>'>
                        <br>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <tbody>
                <tr class="form-group">
                    <td>
                        <label for="email" class="label-control">Email*: </label>
                    </td>
                    <td>
                        <input type="email"
                               class="form-control oblig"
                               id="email" name="email"
                               placeholder="Email"
                               required
                               oninvalid="this.setCustomValidity('El formato del email introducido no es correcto.'); this.value='';"
                               oninput="this.setCustomValidity(''); casilla()"
                               value='<?php echo $val->restoreValue('email'); ?>'>
                        <br>
                    </td>
                </tr>
                <tr class="form-group">
                    <td>
                        <label for="movil" class="label-control">Teléfono Móvil*: </label>
                    </td>
                    <td>
                        <input type="tel"
                               class="form-control oblig"
                               id="movil" name="movil"
                               pattern="^[6-7]\d{8}$"
                               placeholder="movil"
                               required
                               oninvalid="this.setCustomValidity('El formato del movil introducido no es correcto.'); this.value='';"
                               oninput="this.setCustomValidity(''); casilla()"
                               value='<?php echo $val->restoreValue('movil'); ?>'>
                        <br>
                    </td>
                </tr>
                <tr class="form-group">
                    <td colspan="2">
                        <select id="origen" class="form-control oblig" onchange="peticionDestino(); casilla()"
                                name="origen"
                                required>
                            <option value='' selected>--Seleccione un origen--</option>
                        </select>
                    </td>
                </tr>
                <tr class="form-group">
                    <td colspan="2">
                        <select id="destino" class="form-control oblig" name="destino" disabled required
                                onchange="casilla()">
                            <option value='' selected>--Seleccione un destino--</option>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="justify-content-center form-check" style="text-align: center">
            <br>
            <input type='submit' class="btn btn-primary" id="envio" value="Enviar" name="Enviar" disabled>
        </div>
    </form>
    <br>
    <br>
    Buscar informacion del billete (clave): <input type="text" id="billete" name="billete">
    <input type='button' class="btn btn-info" id="buscar" value="Buscar" name="buscar"
           onclick="comprobarBillete(1)">
    <br>
    <br>

    Buscar informacion de comprador (DNI, Email): <input type="text" id="comprador" name="comprador">
    <input type='button' class="btn btn-info" id="buscar" value="Buscar" name="buscar"
           onclick="comprobarBillete(2)">
    <br>
    <br>
    <div id="informacion"></div>

</main>
<!--Footer-->
<footer class="page-footer font-small blue pt-4 mt-4">

    <!--Footer Links-->
    <div class="container-fluid text-center text-md-left">
        <div class="row">

            <!--First column-->
            <div class="col-md-6">
                <h5 class="text-uppercase">Datos de contacto de Renfe-Operadora:</h5>
                <p>DIRECCION: Avda. Pío XII, 110. 28036, Madrid.</p>
                <p>    CONTACTO: Para cualquier duda, queja o sugerencia contacte con nosotros a través de nuestro área de Atención al Cliente.</p>
            </div>
            <!--/.First column-->

            <!--Second column-->
            <div class="col-md-6">
                <h5 class="text-uppercase">Informacion</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="#!">Avisos legales</a>
                    </li>
                    <li>
                        <a href="#!">Mapa web</a>
                    </li>
                    <li>
                        <a href="#!">Politica de cookies</a>
                    </li>
                    <li>
                        <a href="#!">Condiciones de compra</a>
                    </li>
                </ul>
            </div>
            <!--/.Second column-->
        </div>
    </div>
    <!--/.Footer Links-->

    <!--Copyright-->
    <div class="footer-copyright py-3 text-center">
        © 2018 Copyright:
        <a href="index.php"> Renfe.com </a>
    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->
<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>

<script src="js/app.js" type="text/javascript"></script>
<script src="js/validacion.js" type="text/javascript"></script>
</body>

</html>