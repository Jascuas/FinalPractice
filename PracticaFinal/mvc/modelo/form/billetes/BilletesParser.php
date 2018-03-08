<?php

class BilletesParser
{
    public static function loadContent($vista)
    {
        $vista = self::pasoSiguiente($vista);
        return $vista;
    }

    public static function pasoSiguiente($vista)
    {
        $val = Validacion::getInstance();
        $required_fields = '';
        $warning_fields = '';
        $duplicate_fields = '';
        foreach ($val->getErrors() as $field => $error) {
            $value = $error['value'];
            $rule = $error['rule'];
            switch ($rule) {
                case 'ok':
                    $vista = str_replace('{{class-' . $field . '}}', '', $vista);
                    break;
                case 'required':
                    $required_fields .= "<strong>$field</strong>, ";
                    $vista = str_replace('{{class-' . $field . '}}', 'has-error', $vista);
                    break;
                case 'alpha_space|number|email|dni':
                    $warning_fields .= "<strong>$field</strong>, ";
                    $vista = str_replace('{{class-' . $field . '}}', 'has-warning', $vista);
                    $vista = str_replace('{{war-' . $field . '}}', $val->getStrRule($rule), $vista);
                    break;
                case 'duplicate':
                    $duplicate_fields .= "<strong>$field</strong>, ";
                    $vista = str_replace('{{class-' . $field . '}}', 'has-duplicate', $vista);
                    $vista = str_replace('{{war-' . $field . '}}', $val->getStrRule($rule), $vista);
                    break;
            }
        }
        foreach (getTagsVista($vista) as $tag) {
            $str = '';
            switch ($tag) {
                case "errores":
                    if (strlen($required_fields) > 0) {
                        $required_fields = substr($required_fields, 0, -2);
                        $str .= "<p class='has-error'> El/Los campo(s) $required_fields son obligatorios</p>";
                    }
                    if (strlen($warning_fields) > 0) {
                        $warning_fields = substr($warning_fields, 0, -2);
                        $str .= "<p class='has-warning'> El/Los campo(s) $warning_fields tienen errores de formato.</p>";
                    }
                    if (strlen($duplicate_fields) > 0) {
                        $duplicate_fields = substr($duplicate_fields, 0, -2);
                        $str .= "<p class='has-duplicate'> El $duplicate_fields es duplicado.</p>";
                    }
                    break;
            }
            $vista = str_replace('{{' . $tag . '}}', $str, $vista);
        }
        return $vista;
    }
}