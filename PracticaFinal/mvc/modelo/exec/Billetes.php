<?php

class Billetes
{

    public static function insertDB($data)
    {
        $database = medoo::getInstance();
        $database->openConnection(MYSQL_CONFIG);
        $datos = $database->insert('billetes', $data);
        $database->closeConnection();
        return $datos;
    }

    public static function duplicateDNI($dni)
    {
        $database = medoo::getInstance();
        $database->openConnection(MYSQL_CONFIG);
        $datos = ($database->count('billetes', ['dni' => $dni]) > 0) ? true : false;
        $database->closeConnection();
        return $datos;
    }

    public static function duplicateKey($key)
    {
        $database = medoo::getInstance();
        $database->openConnection(MYSQL_CONFIG);
        $datos = ($database->count('billetes', ['clave[=]' => $key]) > 0) ? true : false;
        $database->closeConnection();
        return $datos;
    }

    public static function buscarBillete($clave)
    {
        $database = medoo::getInstance();
        $database->openConnection(MYSQL_CONFIG);
        $datos = $database->select('billetes', ["nombre", "apellido1", "apellido2", "dni", "email", "movil", "origen", "destino"], ["clave[=]" => $clave]);
        $database->closeConnection();
        return $datos;
    }
    public static function buscarBilleteC($info)
    {
        $database = medoo::getInstance();
        $database->openConnection(MYSQL_CONFIG);
        $datos = $database->select('billetes', ["nombre", "apellido1", "apellido2", "dni", "email", "movil", "origen", "destino"], ["OR" => [
            "dni[=]" =>$info,
            "email[=]" =>$info
        ]]);
        $database->closeConnection();
        return $datos;
    }
    public static function buscarOrigen()
    {
        $database = medoo::getInstance();
        $database->openConnection(MYSQL_CONFIG);
        $datos = $database->select('ciudades', 'ciudad');
        $database->closeConnection();
        return $datos;
    }

    public static function buscarDestino($origen)
    {
        $database = medoo::getInstance();
        $database->openConnection(MYSQL_CONFIG);
        $datos = $database->select('ciudades', 'ciudad', ["ciudad[!]" => $origen]);
        $database->closeConnection();
        return $datos;
    }

    public static function randomKey($length)
    {
        $key = "";
        $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
        for ($i = 0; $i < $length; $i++)
            $key .= $pattern{rand(0, 35)};
        return $key;
    }
}