<?php

/**
 * @name            : inserircliente
 * @since           : 07/09/2018
 * @author          : felipecg
 */
require_once './clienteDAO.php';
$val_campos = array();

foreach ($_POST as $key => $value) {
    $val_campos[$key] = $value;
}

$vartemp = new clienteDAO();
$vartemp->inserirCliente($val_campos);

session_start();

foreach ($_POST as $key => $value) {
    $_SESSION[$key] = $value;
}
session_unset();
session_destroy();

return;
//fim classe inserircliente
