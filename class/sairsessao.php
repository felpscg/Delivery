<?php
new sairsessao();
class sairsessao {
    public function __construct() {
        session_start();
            session_unset($_SESSION["login"]);
            session_unset($_SESSION["senha"]);
            session_destroy();
            session_abort();
            header('location:../index.php');
    }
}
