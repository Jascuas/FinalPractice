/*
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
*/
/*
Autor= Javier Sanchez
Fecha= 01/03/2018
Licencia= gpl30
Version= 1.0
Descripcion= Documento .js para la web de billetes, contiene los scripts de peticiones Ajax
*/

var val = false;

function casilla() {
    var diss = document.getElementById("envio");
    var bolean = true;
    var a = document.getElementsByClassName("oblig");
    len = a.length;
    for (i = 0; i < len; i += 1) {
        if (a[i].value == "") {
            bolean = false;
            break;
        }
    }
    diss.disabled = !(val && bolean);
    return bolean;
}

function validar() {
    var enviar = casilla();
    if (enviar) alert("contactaremos contigo lo antes posible");
    return enviar;
}

function validarDNI(dni) {
    var numero = dni.substr(0, dni.length - 1);
    numero = numero % 23;
    var letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
    letra = letra.substring(numero, numero + 1);
    var aux = dni.substr(dni.length - 1, 1);
    val = letra == aux;
    if (!val) alert("El DNI no es un DNI real.")
}
