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
var peticion_http = null;

function peticionOrigen() {
    peticion_http = new XMLHttpRequest();
    peticion_http.onload = procesaRespuesta1;
    peticion_http.open('GET', "Requests/origen.php", true);
    peticion_http.setRequestHeader("Content-Type",
        "application/x-www-form-urlencoded");
    peticion_http.send();
}

function procesaRespuesta1() {
    var documento_xml = peticion_http.responseXML;
    var origenes = documento_xml.getElementsByTagName("origen");
    var select = document.getElementById("origen");
    select.innerHTML = "<option value='' selected>--Seleccione un destino--</option>";
    var opciones;
    var valor;
    var len = origenes.length;
    for (var i = 0; i < len; i += 1) {
        valor = origenes[i].firstChild.nodeValue;
        opciones = "<option value='" + valor + "'>" + valor + "</option>";
        select.innerHTML += opciones;
    }
}

function peticionDestino() {
    if (document.getElementById("origen").value != "") {
        peticion_http = new XMLHttpRequest();
        peticion_http.onload = procesaRespuesta2;
        peticion_http.open("POST", "Requests/destinos.php", true);
        peticion_http.setRequestHeader("Content-Type",
            "application/x-www-form-urlencoded");
        var query_string = "origen=" + crea_query_string();
        peticion_http.send(query_string);
    } else {
        document.getElementById("destino").value = "";
        document.getElementById("destino").disabled = true;
    }
}

function crea_query_string() {
    var opcion = document.getElementById("origen").value;
    return opcion + "&nocache=" + Math.random();
}

function procesaRespuesta2() {
    var documento_xml = peticion_http.responseXML;
    console.log(peticion_http.response);
    var destinos = documento_xml.getElementsByTagName("destino");
    var select = document.getElementById("destino");
    select.innerHTML = "<option value='' selected>--Seleccione un destino--</option>";
    var opciones;
    var valor;
    var len = destinos.length;
    for (var i = 0; i < len; i += 1) {
        valor = destinos[i].firstChild.nodeValue;
        opciones = "<option value='" + valor + "'>" + valor + "</option>";
        select.innerHTML += opciones;
    }
    select.disabled = false;
}

function comprobarBillete(x) {
    peticion_http = new XMLHttpRequest();
    peticion_http.onload = procesaRespuesta3;
    peticion_http.open('POST', "Requests/compruebaBillete.php", true);
    peticion_http.setRequestHeader("Content-Type",
        "application/x-www-form-urlencoded");
    if(x==1)
        peticion_http.send("billete=" + document.getElementById('billete').value);
    else
        peticion_http.send("comprador=" + document.getElementById('comprador').value);
}

function procesaRespuesta3() {
    var respuesta = peticion_http.responseText;
    var info = document.getElementById("informacion");
    info.innerHTML = respuesta;
}
