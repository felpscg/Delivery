<?php

/**
 * @name            : clienteDAO
 * @since           : 22/11/2018
 * @author          : felipecg
 *
 * Descrição: Essa classe permite receber todos os dados do cliente e  efetua todas as operações do CRUD de acordo com
 * o $_post["def"] recebido da página requerida
 * Atualização da ultima classe DAO
 *
 */
$obg = new clienteDAO();
$obg->define();

class clienteDAO {

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
        require_once "./sucesso.php";
        $falha = new falha();
        $suc = new sucesso();
        $CEPS = $_POST['ceps'];
        $this->validaCpfEmail($conTemp); //
        $idTempends = "null";
        $tempenderecos = '';
        $idenderecop = '';
        $idenderecos = '';

//        ENDEREÇO 1
        $queryEnd = "INSERT INTO `bddelivery`.`endereco` (`cep`, `rua`, `cidade`, `numrua`, `bairro`, `estado`) VALUES ";
        $queryEndS = $queryEnd;
        $queryEnd .= $this->recebeValEnd($falha, 'p');

        if ($CEPS == "" || $CEPS == null) {
            mysqli_query($conTemp, $queryEnd) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));
            $idenderecop = mysqli_insert_id($conTemp);
        }

        if ($CEPS != "" || $CEPS != null) {
            mysqli_query($conTemp, $queryEnd) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));
            $idenderecop = mysqli_insert_id($conTemp);


            $queryEndS .= $this->recebeValEnd($falha, 's');
            mysqli_query($conTemp, $queryEndS) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));
            $idenderecos = mysqli_insert_id($conTemp);
            $tempenderecos = ",`endereco2`";
        }


//        CLIENTE
        $queryCliente = "INSERT INTO `bddelivery`.`cliente` (`nomecliente`, `rg`, `cpf`, `sexo`, `dtnasc`, `telefone`, `email`, `senha`,`endereco` $tempenderecos) VALUES ";
        $queryCliente .= $this->recebeValCli($falha);

//        mysqli_insert_id ===== Retorna ultimo ID ou valor da PK inserido
        $queryCliente .= $idenderecop;
        if ($CEPS != "" || $CEPS != null) {
            $queryCliente .= ',' . $idenderecos;
        }
        
        $queryCliente .= ")";

        echo $queryCliente;
        mysqli_query($conTemp, $queryCliente) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));
        $err = mysqli_error($conTemp);
        if ($err == null || !$err) {
            $suc->suc(1);
        }
    }

    protected function recebeValEnd($falha, $tipo = 'p') {

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
        switch ($tipo) {
            case 'p':
                @$t = array($cep, $rua, $cidade, $numero, $bairro, $uf);
                foreach ($t as $key => $value) {
                    if ($value === "" || $value == null)
                        $tv = false;
                }
                $values = "";
                if ($tv === true) {
                    $values = "('$cep', '$rua', '$cidade', '$numero', '$bairro', '$uf')";
                    return $values;
                } else {
                    $falha->err(4);
                    //sleep(10);
                    //header("Location: ../cad.php");
                }

                break;

            case 's':
                @$t = array($ceps, $ruas, $cidades, $numeros, $bairros, $ufs);
                foreach ($t as $key => $value) {
                    if ($value === "" || $value == null)
                        $tv = false;
                }
                $values = "";
                if ($tv === true) {
                    $values = "('$ceps', '$ruas', '$cidades', '$numeros', '$bairros', '$ufs')";
                    return $values;
                } else {
                    $falha->err(4);
                    //sleep(10);
                    //header("Location: ../cad.php");
                }

                break;

            default:
                echo "Erro Interno<br>"
                . "Problema ao carregar o Endereço";
                break;
        }
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
    
    protected function validaCpfEmail($conTemp) {//CORRETO
        require_once "./falha.php";
        $falha = new falha();
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        if ($cpf || $email) {
            $validacpf = "SELECT cpf FROM `bddelivery`.`cliente` WHERE cpf = ";
            $validacpf .= "'$cpf'";
            $validaemail = "SELECT email FROM `bddelivery`.`cliente` WHERE email = ";
            $validaemail .= "'$email'";
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

}
