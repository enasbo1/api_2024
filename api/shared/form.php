<?php
function header_str_min($value, string $arg)
{
    return strlen($value) >= (int) $arg;
}

function header_str_max($value, string $arg)
{
    return strlen($value) <= (int) $arg;
}
function header_str_equa($value, string $arg)
{
    return strlen($value) == (int) $arg;
}
function header_int_inf($value, string $arg)
{
    return (int) $value < (int) $arg;
}

function header_int_sup($value, string $arg)
{
    return (int) $value > (int) $arg;
}
function header_compare($value, string $co, string $arg)
{
    switch ($co) {
        case ":m":
            return header_str_min($value, $arg);
        case ":M":
            return header_str_max($value, $arg);
        case ":>":
            return header_int_sup($value, $arg);
        case ":<":
            return header_int_inf($value, $arg);
        case ":e":
            return header_str_equa($value, $arg);
        default:
            return False;
    }
}

function header_message(string $co, string $arg)
{
    switch ($co) {
        case ":m":
            return ' doit faire au moins ' . $arg . ' caractères';
        case ":M":
            return ' doit faire au maximum ' . $arg . ' caractères';
        case ":<":
            return ' doit être plus petit que ' . $arg;
        case ":>":
            return ' doit être plus grand que ' . $arg;
        case ":e":
            return ' doit faire exatement ' . $arg . ' caractères';
        default:
            return '';
    }
}
function header_dechiffre($value, string $type, string $origin, string $name)
{
    $validate = [
        '!url' => FILTER_VALIDATE_URL,
        '!int' => FILTER_VALIDATE_INT,
        '!email' => FILTER_VALIDATE_EMAIL,
        '!float' => FILTER_VALIDATE_FLOAT
    ];
    $message = [
        '!url' => ' doit être une url valide',
        '!int' => ' doit être un nombre entier',
        '!email' => ' doit être une adresse mail valide',
        '!float' => ' doit être un nombre'
    ];
    $type = explode(' ', $type);
    foreach ($type as $co) {
        if ($co[0] == '!') {
            if (!filter_var($value, $validate[$co])) {
                $msg = '"' . $name . '"' . $message[$co];
                return $msg;
            }
        }
        if ($co[0] == ':') {
            $i = explode(',', $co);
            if (!header_compare($value, $i[0], $i[1])) {
                $msg = '"' . $name . '"' . header_message($i[0], $i[1]);
                return $msg;
            }
        }
    }
}

function header_verification(string $origin, array $form): String|null
{
    foreach ($form as $key => $type) {
        if (empty($_POST[$key]) || !isset($_POST[$key])) {
            if ($type[0] == "r") {
                $msg = 'le champ "' . $key . '" doit être remplit';
                return $msg;
            } else {
                $type = "";
                $_POST[$key] = "";
            }
        }
        header_dechiffre($_POST[$key], $type, $origin, $key);
    }
    return null;
}


function header_save(string $origin, array $form)
{
    header_verification($origin, $form);
    if (!isset($_SESSION['post'])) {
        $_SESSION['post'] = [];
    }
    foreach ($form as $key => $value) {
        $_SESSION['post'][$key] = $_POST[$key];
    }
}
