<?php

class Validacion extends Singleton
{
    private $_rules = array();
    private $_errors = array(); // ejemplo: _errors['nombre'] = array('value' => 'Pedro','rule' => 'required')
    private $_oks = array();
    private $_exists;

    public function addRules($rules)
    {
        $this->_rules = $rules;
    }

    public function run($toValidate)
    {
        foreach ($toValidate as $field => $value) {
// si el nombre del campo no esta en $this->_rules es que no hay que validarlo
            if (!array_key_exists($field, $this->_rules)) continue;
// creamos un array con la cadena $this->_rules[$field] usando como separador de elementos |
            $rules = explode('|', $this->_rules[$field]);
// Si el campo es requerido en $rules hay un elemento cuyo contenido es 'required'
            if (in_array('required', $rules)) {
// el método validate_required verifica si el campo tiene contenido, es decir, ha sido rellenado
// si no es así, añade el campo al _errors
                $this->_validate_required($field, $value);
// si el campo no se ha rellenado no sigue relizando el control de entrada
// por ello verifica que si existe un elemento con el 'rule'='required'
// getArray() esta definida en common.php
                if (getArray($this->getErrorsByField($field), 'rule') == 'required')
                    continue;
            }
            foreach ($rules as $rule) {
                if ($rule == 'required') continue;
                $method = '_validate_' . $rule;
// verifica si el método de validación existe en esta clase (constante __CLASS__)
                if (!method_exists(__CLASS__, $method)) continue;
// ejecuta el método de validación (por ejemplo, validate_alpha_space)
                $this->$method($field, $value);
            }
            if (empty($this->getErrorsByField($field)))
                $this->_setError($field, $value, 'ok');
        }
    }

    public function isValid()
    {
        if (count($this->_oks) == count($this->_errors))
            return true;
        return false;
    }

    public function getStrRule($rule)
    {
        switch ($rule) {
// solo hay una posible coincidencia, pero ya añadiremeos más
            case 'alpha_space':
                return 'Solo puede contener letras (a-z) y espacios en blanco';
            case 'duplicated':
                return 'Dni duplicado';
            case 'number':
                return 'Solo numeros';
        }
        return '';
    }

// Este método sirve tambien para los elementos <textarea>
    public function restoreValue($name)
    {
        if (array_key_exists($name, $this->_errors)) {
            $value = $this->_errors[$name]['value'];
            return $value;
        }
        return '';
    }

    public function restoreRadios($name, $value, $default = false)
    {
        if (array_key_exists($name, $this->_errors)) {
            if ($this->_errors[$name]['value'] == $value)
                return 'checked';
// si el nombre del campo no está en _radios, es que es la primera vez que se visualiza el formulario
// y es cuando podemos poner valores por defecto.
        } elseif ($default)
            return 'checked';
        return '';
    }

    public function getOks()
    {
        return $this->_oks;
    }

    public function restoreSelects($name, $value, $default = false)
    {
        if (array_key_exists($name, $this->_errors)) {
            if ($this->_errors[$name]['value'] == $value)
                return 'selected';
// si el nombre del campo no está en _errors, es que es la primera vez que se visualiza el formulario
// y es cuando podemos poner valores por defecto.
        } elseif ($default)
            return 'selected';
        return '';
    }

    public function restoreList($name, $value, $default = false)
    {
//si _errors está vacío, es la primera vez que se visuliza el formulario
        if (array_key_exists($name, $this->_errors)) {
            if ($this->_errors[$name]['value'] == $value)
                return 'selected';
// si el nombre del campo no está en _radios, es que es la primera vez que se visualiza el formulario
// y es cuando podemos poner valores por defecto.
        } elseif ($valor = getCookie($name))
            if ($valor == $value)
                return 'selected';
            else if (!$valor) {
                if ($default)
                    return 'selected';
            }
        return '';
    }

    public function restoreCheckboxes($name, $value, $default = false)
    {
        if (array_key_exists($name, $this->_errors)) {
            if ($this->_errors[$name]['value'] == $value)
                return 'checked';
// si el nombre del campo no está en _errors, es que es la primera vez que se visualiza el formulario
// y es cuando podemos poner valores por defecto.
        } elseif ($default)
            return 'checked';
        return '';
    }

// método que devuelve el elemento del array _errors de un campo (si existe)
    public function getErrorsByField($field)
    {
        return getArray($this->_errors, $field, array());
    }

    public function getErrors()
    {
        return $this->_errors;
    }

    private function _setError($field, $value, $rule)
    {
        $this->_errors[$field] = array(
            'value' => $value,
            'rule' => $rule
        );
        if ($rule == 'ok') {
            $this->_oks[$field] = $value;
        }
    }

    private function _validate_alpha_space($field, $value)
    {
//        if (!preg_match('/^[a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ\s]+$/i', $value))
//            $this->_setError($field, $value, 'alpha_space');
        if (!preg_match('/^[0-9a-zA-Z ]+$/', $value))
            $this->_setError($field, $value, 'alpha_space');
    }

    private function _validate_number($field, $value)
    {

        if (!preg_match('/^[6-7]\d{8}$/', $value))
            $this->_setError($field, $value, 'number');
    }

// método que añade una elemento al array _errors cuando un campo obligatorio no se ha completado
    private function _validate_required($field, $value)
    {
        if (strlen($value) == 0)
            $this->_setError($field, $value, 'required');
    }

    private function _validate_dni($field, $value)
    {
        if (!preg_match('/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i', $value))
            $this->_setError($field, $value, 'dni');
    }

    private function _validate_email($field, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
            $this->_setError($field, $value, 'email');
    }

    public function setExists($dup)
    {
        $this->_exists = $dup;
    }

    private function _validate_duplicate($field, $value)
    {
        if ($this->_exists)
            $this->_setError($field, $value, 'duplicate');
    }

}