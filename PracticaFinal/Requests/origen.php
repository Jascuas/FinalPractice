<?php

require_once "../include.php";
$origen = Billetes::buscarOrigen();
$xml = "<origenes>";
for ($i = 0; $i < sizeof($origen); $i++) {
    $xml .= "<origen>" . $origen[$i] . "</origen>";
}
$xml .= "</origenes>";
// Imprescindible para que el navegador trate la respuesta como XML
header('Content-Type: text/xml; charset=utf-8');
// Generar contenidos XML de respuesta
echo $xml;