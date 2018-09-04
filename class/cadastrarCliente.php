<?php
session_start();
foreach($_SESSION as $nome_campo => $valor){ 
   $comando = "\$" . $nome_campo . "='" . $valor . "';"; 
   echo $comando."<br>";
   
} 


?>