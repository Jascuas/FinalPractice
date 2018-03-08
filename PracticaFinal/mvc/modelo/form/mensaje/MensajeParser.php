<?php

class MensajeParser
{
    public static function loadContent($vista)
    {
        $vista = self::_pasoSiguiente($vista);
        return $vista;
    }

    private static function _pasoSiguiente($vista)
    {
        foreach (getTagsVista($vista) as $tag) {
// sustituimos en el formulario los tags por el contenido de los elementos del formulario
            $str = '';
            switch ($tag) {
                case 'mensaje':
                    if (Session::get('ins'))
                        $str = '<blockquote class="blockquote bq-success">
                         <p class="bq-title">Billete guardado.</p>
                        <p>Su clave es: <b>' . Session::get("clave") . ' </b></p>
                        </blockquote>';
                    else
                        $str = '<blockquote class="blockquote bq-warning">
                        <p class="bq-title">No se han podido guardar los datos</p>
                        <p>Lo sentimos, pero no hemos podido guardar los datos.</p>
                        </blockquote>';
                    break;
            }
            $vista = str_replace('{{' . $tag . '}}', $str, $vista);
        }
        return $vista;
    }
}