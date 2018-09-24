<?php

/**
 * @name            : clienteDAO
 * @since           : 07/09/2018
 * @author          : felipecg
 *
 * Descrição: Essa classe permite receber todos os dados do cliente e  efetua todas as operações do CRUD de acordo com
 * o $_post["def"] recebido da página requerida
 *
 */
$obg = new cadastrarcliente();
$obg->define();

class cadastrarcliente {

    public function define() {

//      O $conexaopagsec irá buscar a classe de conexão se for acessada por outra página
//        Ex: index.php -> ./class/cadastrarcliente.php ->conBD.php
//            index.php .= cadastrarcliente.php -> ./class/conBD.php

        @$def = $_POST["def"];
        switch ($def) {
            case 1:
                require_once "./conBD.php";
                $conexao = new conBD();
                $conTemp = $conexao->conBD();
//                inclui registro do cliente
//                echo 1;
//                exit(0);
                $this->incluirCliente($conTemp);
                break;

            case 2:
                require_once "./class/conBD.php";
                $conexao = new conBD();
                $conTemp = $conexao->conBD();

//                Utlizado para exibir o perfil
                $this->consultarCliente($conTemp);
                break;

            case 3:
                require_once "./conBD.php";
                $conexao = new conBD();
                $conTemp = $conexao->conBD();
                $this->alterarCliente($conTemp);
                break;

            case 4:
                require_once "./conBD.php";
                $conexao = new conBD();
                $conTemp = $conexao->conBD();
                $this->excluirCliente($conTemp);
                break;

            default:
                echo "<h1>Erro interno</h1><BR>Não foi possivel encontrar a função";
                break;
        }
    }

    public function incluirCliente($conTemp) {
        require_once "./falha.php";
        $falha = new falha();
        $this->validaCpfEmail($conTemp);
        $query = "INSERT INTO `bddelivery`.`endereco` (`cep`, `rua`, `cidade`, `numrua`, `bairro`, `estado`) VALUES ";
        $query2 = "INSERT INTO `bddelivery`.`cliente` 
(`nomecliente`, `rg`, `cpf`, `sexo`, `dtnasc`, `telefone`, `email`, `senha`,`endereco`) 
VALUES ";

//Recebe funções de validação de CPF e E-mail
        $query .= $this->recebeValEnd($falha);
        $query2 .= $this->recebeValCli($falha);


        sleep(2);
//  Aguardar 2 seg para faser a consulta no BD, e lógo após da consulta verificar os erros
        mysqli_query($conTemp, $query) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));
        //mysqli_query($conTemp, $query) or die("<h1>Erro interno</h1> <br>" + mysqli_error($conTemp));
        $query2 .= mysqli_insert_id($conTemp) . ")";
        mysqli_query($conTemp, $query2) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));
        $err = mysqli_error($conTemp);
        if ($err == null || !$err) {
            echo $query;
        }
    }

    // função para validar CPF e E-MAIL
    protected function validaCpfEmail($conTemp) {
        require_once "./falha.php";
        $falha = new falha();
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        if ($cpf || $email) {
            $validacpf = "SELECT cpf FROM `bddelivery`.`cliente` WHERE cpf = ";
            $validacpf .= "'$cpf'";
            $validaemail = "SELECT email FROM `bddelivery`.`cliente` WHERE email = ";
            $validaemail .= "'$email'";



//      echo $valida;
            $resultemail = mysqli_query($conTemp, $validaemail) or die($falha->err(2));
            $resultcpf = mysqli_query($conTemp, $validacpf) or die($falha->err(2));
            if (mysqli_num_rows($resultcpf) >= 1 || mysqli_num_rows($resultemail) >= 1) {
                echo '<H2>Erro:<H2><H1>CPF ou E-mail ja cadastrado</H1>';
                $falha->err(2);
            } else {
                $resultvalida = array($resultcpf, $resultemail);
                return $resultvalida;
            }
        }
        echo "Preencha o CPF ou o E-mail";
        return;
    }

    protected function recebeValCli($falha) {
//  função que recebe todos os dados do formulario e valida se os campos obrigatórios foram preenchidos 

        foreach ($_POST as $key => $val) {

            if ($_POST[$key] != NULL OR $_POST[$key] != "") {
                $comando = "\$" . $key . "='" . $val . "';";
                echo $comando . "<br>";

                eval($comando);
            }if ($key == "senha") {// codifica a senha e guarda no banco
                $senha = md5($_POST[$key]);
            }
        }


        $tv = true;

        /* se algum campo estiver nulo ele da erro por isso é necessario ignorar
          com o @ e em seguida verificar cada posição do array
         */

        @$t = array($nome, $rg, $cpf, $sexo, $dtnasc, $tel, $email, $senha);

        foreach ($t as $key => $value) {
            if ($value === "" || $value == null)
                $tv = false;
        }

        $values = "";
        if ($tv === true) {
            $values = "('$nome', '$rg', '$cpf', '$sexo', '$dtnasc', '$tel', '$email', '$senha',";
        } else {
            $falha->err(4);

            //sleep(10);
            //header("Location: ../cad.php");
        }
        return $values;
    }

    protected function recebeValEnd($falha) {

        foreach ($_POST as $key => $val) {
            $varVal[] = null;
            if ($_POST[$key] != NULL OR $_POST[$key] != "") {
                $comando = "\$" . $key . "='" . $val . "';";
                eval($comando);
            }if ($key == "senha") {
                $senha = md5($_POST[$key]);
            }
        }

        /* se algum campo estiver nulo ele da erro por isso é necessario ignorar
          com o @ e em seguida verificar cada posição do array
         */
        $tv = true; //cep, rua, cidade, numrua, bairro, estado
        @$t = array($cep, $rua, $cidade, $numero, $bairro, $uf);
        foreach ($t as $key => $value) {
            if ($value === "" || $value == null)
                $tv = false;
        }
        $values = "";
        if ($tv === true) {
            $values = "('$cep', '$rua', '$cidade', '$numero', '$bairro', '$uf')";
        } else {
            $falha->err(4);
            //sleep(10);
            //header("Location: ../cad.php");
        }



        return $values;
    }

    public function consultarCliente($conTemp) {
        require_once "./class/falha.php";
        $falha = new falha();
        $login = $_SESSION['login'];
        $senha = $_SESSION['senha'];
        $templogin = $login;
        $tempsenha = md5($senha);
        $query = "SELECT * FROM `cliente` WHERE `email` = '$templogin' OR `cpf` = '$templogin' AND `SENHA`= '$tempsenha'";
        $queryTemp = mysqli_query($conTemp, $query) or die(mysqli_error($conTemp));
        $registro = mysqli_fetch_assoc($queryTemp);
        $existe = mysqli_num_rows($queryTemp);
        $queryend = "SELECT * FROM `endereco` WHERE `codendereco` = '$endereco'";
        if (!$existe) {
            echo 'não foi encontrado registro';
        } else {

            foreach ($registro as $key => $val) {

                $comando = "\$" . $key . "='" . $val . "';";
                eval($comando);
            }
            $select = array('1' => "", '2' => "");
            if ($sexo == 'm') {
                $select['1'] = "selected";
            } else {
                $select['2'] = "selected";
            }
            echo "<div style='margin-top:-0.7em;' class='n-campos'>
                            <ul>
                                <li>Nome:*</li>
                                <li>CPF:*</li>
                                <li>RG:</li>
                                <li>Sexo:*</li>
                                <li>Data de Nascimento:*</li>
                                <li>Telefone:</li>
                                <li>Celular:*</li>
                                <li>E-mail:</li>
                            </ul>
                        </div>
		<div class='campos'>
                            <ul>
                                <li><input name='nome' placeholder='$nomecliente' value='$nomecliente' type='text'/></li>
                                <li><input name='cpf' value='$cpf' id='cpf' onblur='TestaCPF(this.value);' type='text' disabled/></li>
                                <li><input name='rg' placeholder='$rg' value='$rg' type='text'/></li>
                                <li>
                                    <input type='radio' name='sexo' value ='f' $select[1]/>Feminino&nbsp;&nbsp;&nbsp; 
                                    <input type='radio' name='sexo' value='m' $select[2]/>Masculino
                                </li>
                                <li><input name='dtnasc' value='$dtnasc' type='date'/></li>
                                <li><input  name='tel' placeholder='$telefone' value='$telefone' type='text'/></li>


                                <li><input name='tels' placeholder='$telefone2' value='$telefone2' type='text'/></li>


                                <li><input name='email' placeholder='$email' value='$email' id='email' type='email'></li>
                            </ul>
                        </div>"
            ;
        }
    }

    public function excluirCliente($conTemp) {
        session_start();
        require_once "./falha.php";
        $falha = new falha();
        $login = $_SESSION['login'];
        $senha = $_SESSION['senha'];
        echo $login + $senha;
        $templogin = $login;
        $tempsenha = md5($senha);
        $query = "SELECT `endereco` FROM `cliente` WHERE `email` = '$templogin' OR `cpf` = '$templogin' AND `senha`= '$tempsenha'";
        $queryTemp = mysqli_query($conTemp, $query) or die(mysqli_error($conTemp));
        $registro = mysqli_fetch_assoc($queryTemp);
        $existe = mysqli_num_rows($queryTemp);

        if (!$existe) {
            echo 'não foi encontrado registro';
        } else {

            foreach ($registro as $key => $val) {

                $comando = "\$" . $key . "='" . $val . "';";
                eval($comando);
            }
            $queryend = "DELETE FROM `endereco` WHERE `codend` = '$endereco'";
            echo $endereco;
            $queryDEL = "DELETE FROM `cliente` WHERE `email` = '$templogin' OR `cpf` = '$templogin'";
            mysqli_query($conTemp, $queryDEL) or die(mysqli_error($conTemp) + exit(0));

            echo "sucesso";
            mysqli_query($conTemp, $queryend) or die(mysqli_error($conTemp));
            echo "Registro Excluido";

            session_unset();
            session_destroy();
            session_abort();
        }
    }

}

?>