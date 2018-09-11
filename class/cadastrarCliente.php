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
    
    foreach ($_POST as $key => $val) {
        $varVal[]=null;
    if ($_POST[$key]!=NULL OR $_POST[$key]!="") {
        $comando = "\$" . $key . "='" . $val . "';";
        echo $comando . "<br>";
        eval($comando);
    }
    }
$values="";
    if(@!$t=array($apelido, $nomecliente, $rg, $cpf, $sexo, $datanasc, $tel, $tels, $email, $senha)) {
        $values = "(`$apelido`, `$nomecliente`, `$rg`, `$cpf`, `$sexo`, `$datanasc`, `$tel`, `$tels`, `$email`, `$senha`)";
    } else{
        echo "</BR><H2>Erro ao receber os valores do formulario, retorne e confira os campos</H2></BR>";
    }
    return $values;
    }
        
        }

?>