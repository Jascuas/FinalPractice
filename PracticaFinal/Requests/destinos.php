<?php
require_once "../include.php";
$origen = $_POST["origen"];
$destinos = Billetes::buscarDestino($origen);
$xml = "<destinos>";
for ($i = 0; $i < sizeof($destinos); $i++) {
    $xml .= "<destino>" . $destinos[$i] . "</destino>";
}
$xml .= "</destinos>";
header('Content-Type: text/xml; charset=utf-8');
echo $xml;