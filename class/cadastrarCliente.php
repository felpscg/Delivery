<?php

require_once './conBD.php';

new cadastrarcliente();

class cadastrarcliente {

    public function __construct() {

        $query = "INSERT INTO `bddelivery`.`clientes` 
(`nomecliente`, `rg`, `cpf`, `sexo`, `datanasc`, `telefone`, `telefone2`, `email`, `senha`) 
VALUES ";
        $query .= $this->recebeValVar();
        echo $query;
//            mysqli_query($this->conBD(), $query)   ;
    }

    protected function recebeValVar() {

        foreach ($_POST as $key => $val) {
            $varVal[] = null;
            if ($_POST[$key] != NULL OR $_POST[$key] != "") {
                $comando = "\$" . $key . "='" . $val . "';";
                echo $comando . "<br>";
                
                eval($comando);
            }if($key == "senha"){
                $senha = md5($_POST[$key]);
            }
        }
        $tv=true;
        @$t = array($nomee, $rg, $cpf, $sexo, $dtnasc, $tel, $email, $senha);
        foreach ($t as $key => $value) {
            if($value==="" || $value == null)
            $tv =false;
        }
        $values = "";
        if ($tv === true) {
            $values = "(`$nome`, `$rg`, `$cpf`, `$sexo`, `$dtnasc`, `$tel`, `$tels`, `$email`, `$senha`)";
        } else {
            echo "</BR><H2>Erro ao receber os valores do formulario, retorne e confira os campos</H2></BR>";
        }
        return $values;
    }

}

?>