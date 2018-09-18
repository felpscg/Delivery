<?php
/*
 * Descrição: Essa classe permite receber todos os dados do cliente e  efetua todas as operações do CRUD de acordo com
 * o $_post["def"] recebido da página requerida
 *  */
require_once "./conBD.php";

$obg = new cadastrarcliente();
$obg->define();

class cadastrarcliente {

    
    
    public function define() {
        $conexao = new conBD();
        $conTemp = $conexao->conBD();
        $t = $_POST["def"];
        switch ($t) {
            case 1:
//                inclui registro do cliente
//                echo 1;
//                exit(0);
                $this->incluirCliente($conTemp);
                break;
            
            case 2:
//                Utlizado para exibir o perfil
                $this->consultarCliente($conTemp);
                break;
            
            case 3:
                $this->alterarCliente();
                break;
            
            case 4:
                $this->excluirCliente();
                break;

            default:
                echo "não foi possivel encontrar a ação";
                break;
        }
    }
    
    
    
    
    
    
    
    
    
    public function incluirCliente($conTemp) {

        $query = "INSERT INTO `bddelivery`.`endereco` (`cep`, `rua`, `cidade`, `numrua`, `bairro`, `estado`) VALUES ";
        $query2= "INSERT INTO `bddelivery`.`cliente` 
(`nomecliente`, `rg`, `cpf`, `sexo`, `dtnasc`, `telefone`, `email`, `senha`,`endereco`) 
VALUES ";
        $query .= $this->recebeValEnd();
        $query2 .= $this->recebeValCli();
        echo $query;
        mysqli_query($conTemp, $query) or die(mysqli_error($conTemp)) ;
        $query2 .= mysqli_insert_id($conTemp).")";
            mysqli_query($conTemp, $query2) or die(mysqli_error($conTemp)) ;
    }

    protected function recebeValCli() {

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
        @$t = array($nome, $rg, $cpf, $sexo, $dtnasc, $tel, $email, $senha);
        foreach ($t as $key => $value) {
            if($value==="" || $value == null)
            $tv =false;
        }
        $values = "";
        if ($tv === true) {
            $values = "('$nome', '$rg', '$cpf', '$sexo', '$dtnasc', '$tel', '$email', '$senha',";
        } else {
            echo "</BR><H2>Erro ao receber os valores do formulario, retorne e confira os campos</H2></BR>";
        }
        return $values;
    }
    
    
    protected function recebeValEnd() {

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
        $tv=true;//cep, rua, cidade, numrua, bairro, estado
        @$t = array($cep, $rua, $cidade, $numero, $bairro, $uf);
        foreach ($t as $key => $value) {
            if($value==="" || $value == null)
            $tv =false;
        }
        $values = "";
        if ($tv === true) {
            $values = "('$cep', '$rua', '$cidade', '$numero', '$bairro', '$uf')";
        } else {
            echo "</BR><H2>Erro ao receber os valores do formulario, retorne e confira os campos</H2></BR>";
            header("Link: ../cad.php");
        }
        return $values;
    }
    

    public function consultarCliente($conTemp) {
        session_start();
        $login = $_SESSION['login'];
$senha = $_SESSION['senha'];
$templogin = $login;
$tempsenha = md5($senha);
    
        $query = "SELECT * FROM `cliente` WHERE `EMAIL` = '$templogin' OR `CPF` = '$templogin' AND `SENHA`= '$tempsenha'";
        $queryTemp = mysqli_query($conTemp, $query) or die(mysqli_error($conTemp)) ;
        $registro = mysqli_fetch_assoc($conTemp);
        $existe = mysqli_num_rows($dados);
        if(!$existe){
            
        }
        else{ 
            $nome=$registro['nome'];
            $telefone = $registro['telefone'];
           echo " <p>"
            . "$nome"
                   . "$telefone"
                   . "</p>";

   
            
            
            
            
            
            
            
            
        }
        
    }
    
}





















/*

 * 
 * 
 * 
 * 
 * 
 * 
 * <?php

require_once './conBD.php';

$obg=new cadastrarcliente();
$obg->define();
class cadastrarcliente {

    public function define() {
        $conexao = new conBD();
        $conTemp = $conexao->conBD();
        $t = $_POST["def"];
        switch ($t) {
            case 1:
//                inclui registro do cliente
//                echo 1;
//                exit(0);
                $this->incluirCliente($conTemp);
                break;
            
            case 2:
//                Utlizado para exibir o perfil
                $this->consultarCliente();
                break;
            
            case 3:
                $this->alterarCliente();
                break;
            
            case 4:
                $this->excluirCliente();
                break;

            default:
                echo "não foi possivel encontrar a ação";
                break;
        }
    }
    
    
    
    
    
    public function incluirCliente($conTemp) {

        $query = "START TRANSACTION; ";
//        $query .= "SELECT LAST_INSERT_ID() INTO @ID; ";

        $query .= "INSERT INTO endereco (codend, cep, rua, cidade, numrua,bairro,estado) "
                . "VALUES (40,'19901080', 'rua paraafsf', 'adsfg', '2343','ultimoteste','es'); ";

        $query .= "INSERT INTO cliente (nomecliente, rg, cpf, sexo, dtnasc, telefone, telefone2, email, senha, endereco, endereco2) "
                . " VALUES ('tegd65te','dgwd', 'd534fdssd', b'0', '2018-09-14', '3413242', '3334', 'otppqqd', 'asdsw', '15', '15');";

//        $query .= " set LAST_INSERT_ID=@id+1;";
        $query .= " COMMIT;";
        //$query .= $this->recebeValVar();
        echo $query;
        if (!$conTemp) {
      die("Erro de conexão: " . mysqli_connect_error());
}
            mysqli_query($conTemp, $query) or die( mysqli_error($conTemp));
            mysqli_close($conTemp);
            
    }
    
    
    
    
    
    
    
public function excluirCliente() {

        $query = "START TRANSACTION";
        $query .= "SELECT LAST_INSERT_ID() INTO @ID";

        $query .= "INSERT INTO bddelivery.endereco (codend, cep, rua, cidade, numrua,bairro,estado) "
                . "VALUES ((@id),'19901080', 'rua paraafsf', 'adsfg', '2343','ultimoteste','es');";

        $query .= "INSERT INTO `bddelivery`.`cliente` (`nomecliente`, `rg`, `cpf`, `sexo`, `dtnasc`, `telefone`, `telefone2`, `email`, `senha`, `endereco`, `endereco2`) "
                . "VALUES ((@id), 'dasdasgfdd', 'dassadefdsd', b'0', '2018-09-14', '231213242', '3142123334', 'dwfsdasdqed', 'sadqfsddasw', '5', '5');";

        $query .= "set LAST_INSERT_ID=@id+1";
        $query .= "COMMIT";
        $query .= $this->recebeValVar();
        echo $query;
//            mysqli_query($this->conBD(), $query)   ;
    }
    
    
    
    
    
    
    public function consultarCliente() {

        $query = "START TRANSACTION";
        $query .= "SELECT LAST_INSERT_ID() INTO @ID";

        $query .= "INSERT INTO bddelivery.endereco (codend, cep, rua, cidade, numrua,bairro,estado) "
                . "VALUES ((@id),'19901080', 'rua paraafsf', 'adsfg', '2343','ultimoteste','es');";

        $query .= "INSERT INTO `bddelivery`.`cliente` (`nomecliente`, `rg`, `cpf`, `sexo`, `dtnasc`, `telefone`, `telefone2`, `email`, `senha`, `endereco`, `endereco2`) "
                . "VALUES ((@id), 'dasdasgfdd', 'dassadefdsd', b'0', '2018-09-14', '231213242', '3142123334', 'dwfsdasdqed', 'sadqfsddasw', '5', '5');";

        $query .= "set LAST_INSERT_ID=@id+1";
        $query .= "COMMIT";
        $query .= $this->recebeValVar();
        echo $query;
//            mysqli_query($this->conBD(), $query)   ;
    }
    
    
    
    
    
    public function alterarCliente() {

        $query = "START TRANSACTION";
        $query .= "SELECT LAST_INSERT_ID() INTO @ID";

        $query .= "INSERT INTO bddelivery.endereco (codend, cep, rua, cidade, numrua,bairro,estado) "
                . "VALUES ((@id),'19901080', 'rua paraafsf', 'adsfg', '2343','ultimoteste','es');";

        $query .= "INSERT INTO `bddelivery`.`cliente` (`nomecliente`, `rg`, `cpf`, `sexo`, `dtnasc`, `telefone`, `telefone2`, `email`, `senha`, `endereco`, `endereco2`) "
                . "VALUES ((@id), 'dasdasgfdd', 'dassadefdsd', b'0', '2018-09-14', '231213242', '3142123334', 'dwfsdasdqed', 'sadqfsddasw', '5', '5');";

        $query .= "set LAST_INSERT_ID=@id+1";
        $query .= "COMMIT";
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
            }if ($key == "senha") {
                $senha = md5($_POST[$key]);
            }
        }
        $tv = true;
        @$t = array($nomee, $rg, $cpf, $sexo, $dtnasc, $tel, $email, $senha);
        foreach ($t as $key => $value) {
            if ($value === "" || $value == null)
                $tv = false;
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
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * class cadastrarcliente {

    public function __construct() {
$conexao = new conBD();
        $conTemp = $conexao->conBD();
        $query = "INSERT INTO `bddelivery`.`endereco` (`cep`, `rua`, `cidade`, `numrua`, `bairro`, `estado`) VALUES ";
        $query2= "INSERT INTO `bddelivery`.`cliente` 
(`nomecliente`, `rg`, `cpf`, `sexo`, `dtnasc`, `telefone`, `email`, `senha`,`endereco`) 
VALUES ";
        $query .= $this->recebeValEnd();
        $query2 .= $this->recebeValCli();
        echo $query;
        mysqli_query($conTemp, $query) or die(mysqli_error($conTemp)) ;
        $query2 .= mysqli_insert_id($conTemp).")";
            mysqli_query($conTemp, $query2) or die(mysqli_error($conTemp)) ;
    }

    protected function recebeValCli() {

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
        @$t = array($nome, $rg, $cpf, $sexo, $dtnasc, $tel, $email, $senha);
        foreach ($t as $key => $value) {
            if($value==="" || $value == null)
            $tv =false;
        }
        $values = "";
        if ($tv === true) {
            $values = "('$nome', '$rg', '$cpf', '$sexo', '$dtnasc', '$tel', '$email', '$senha',";
        } else {
            echo "</BR><H2>Erro ao receber os valores do formulario, retorne e confira os campos</H2></BR>";
        }
        return $values;
    }
    
    
    protected function recebeValEnd() {

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
        $tv=true;//cep, rua, cidade, numrua, bairro, estado
        @$t = array($cep, $rua, $cidade, $numero, $bairro, $uf);
        foreach ($t as $key => $value) {
            if($value==="" || $value == null)
            $tv =false;
        }
        $values = "";
        if ($tv === true) {
            $values = "('$cep', '$rua', '$cidade', '$numero', '$bairro', '$uf')";
        } else {
            echo "</BR><H2>Erro ao receber os valores do formulario, retorne e confira os campos</H2></BR>";
        }
        return $values;
    }
    

} */










?>