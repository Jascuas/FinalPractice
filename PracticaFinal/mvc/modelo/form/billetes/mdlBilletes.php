<?php

class mdlBilletes extends Singleton
{
    const PAGE = 'billetes';

    public function onGestionPagina()
    {
        if (getGet('pagina') != self::PAGE) return;
        $val = Validacion::getInstance();
// Validamos los elementos que hay en $_POST
        $toValidate = ($_POST);
        $rules = array(
            'nombre' => 'required|alpha_space',
            'apellido1' => 'required|alpha_space',
            'apellido2' => 'required|alpha_space',
            'dni' => 'required|dni',
            'email' => 'required|email',
            'movil' => 'required|number',
            'origen' => 'required',
            'destino' => 'required',
        );
        //Comprobar DNI duplicado
//        $dni = getPost('dni');
//        if (Billetes::duplicateDNI($dni))
//            $val->setExists(true);
        $val->addRules($rules);
        $val->run($toValidate);
        if (!is_null(getPost("Enviar"))) {
            if ($val->isValid()) {
                $clave = Billetes::randomKey(8);
                $existe = true;
                while ($existe) {
                    $existe = Billetes::duplicateKey($clave);
                    if ($existe)
                        $clave = Billetes::randomKey(8);
                }
                $_SESSION['clave'] = $clave;
                $fila = array_merge($val->getOks(), ["clave" => $clave]);
                $datos = Billetes::insertDB($fila);
                if ($datos)
                    $_SESSION['ins'] = true;
                else
                    $_SESSION['ins'] = false;
                redirectTo('index.php?pagina=mensaje');
            }
        }
    }

    public function onCargarVista($path)
    {
        if (getGet('pagina') != self::PAGE) return;
        ob_start();
        include $path;
        $vista = ob_get_contents();
        ob_end_clean();
        echo BilletesParser::loadContent($vista);
    }
}