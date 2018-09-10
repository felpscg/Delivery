<?php

require_once './conBD.php';

new cadastrarcliente();

class cadastrarcliente {

    public function __construct() {
        $values = $this->recebeValVar();
        $query = "INSERT INTO `bddelivery`.`clientes` 
(`apelido`, `nomecliente`, `rg`, `cpf`, `sexo`, `datanasc`, `telefone`, `telefone2`, `email`, `senha`) 
VALUES $values
";
        echo $query;
//            mysqli_query($this->conBD(), $query)   ;
    }

    protected function recebeValVar() {
        $values = "(`apelido`, `nomecliente`, `rg`, `cpf`, `sexo`, `datanasc`, `telefone`, `telefone2`, `email`, `senha`)";
        foreach ($_POST as $key => $val) {
            $varVal[] = null;
            if ($_POST[$key] != NULL OR $_POST[$key] != "") {
                $comando = "\$" . $key . "='" . $val . "';";
                if (strcmp($key, "nomecliente")) {
                    
                    $values = str_replace($key, md5($val), $values);
                }
                echo $comando . "<br>";
                $values = str_replace($key, $val, $values);
            }
        }

        return $values;
    }

}

?>