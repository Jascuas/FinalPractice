<?php
/**
 * Created by PhpStorm.
 * User: Daw2
 * Date: 27/02/2018
 * Time: 12:06
 */
require_once "../include.php";
if (isset($_POST['billete'])){
    $clave = getPost('billete');
    $datos = Billetes::buscarBillete($clave);
}
else{
    $info = getPost('comprador');
    $datos = Billetes::buscarBilleteC($info);
}

if (count($datos) > 0) {
    $str = "<table border='1' class='table table-sm'><thead><tr>";
// Recorremos los campos de la primera fila de datos devueltos (en este caso una única fila)
// para averiguar los nombres de los campos

    foreach ($datos[0] as $field => $value) {
        $str .= "<th>$field</th>";
    }
    $str .= "</tr></thead>";
// Recorremos las filas de datos devueltos (en este caso única fila luego no haría falta un bucle)

    foreach ($datos as $producto) {
        $str .= "<tr>";
        foreach ($producto as $value)
            $str .= "<td>" . $value . "</td>";
        $str .= "</tr>";
    }
    $str .= "</table>";
} else
    $str = '<p> <b>No se han encontrado resultados...</b></p>';
echo $str;

