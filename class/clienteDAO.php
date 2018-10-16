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
        require_once "./sucesso.php";
        $falha = new falha();
        $suc = new sucesso();
        $CEPS = $_POST['ceps'];
        $this->validaCpfEmail($conTemp);
        $idTempends = "null";



//        ENDEREÇO 1
        $query = "INSERT INTO `bddelivery`.`endereco` "
                . "(`cep`, `rua`, `cidade`, `numrua`, `bairro`, `estado`) VALUES ";


        //        ENDEREÇO 2
        $query2 = "INSERT INTO `bddelivery`.`endereco` "
                . "(`cep`, `rua`, `cidade`, `numrua`, `bairro`, `estado`) VALUES ";


//        
//         
//        }
//        CLIENTE
        $queryCliente = "INSERT INTO `bddelivery`.`cliente` "
                . "(`nomecliente`, `rg`, `cpf`, `sexo`, `dtnasc`, `telefone`, `email`, `senha`,`endereco`,`endereco2`) VALUES ";



        $query .= $this->recebeValEnd($falha);
        if ($CEPS != "" || $CEPS != null) {
            $query2 .= $this->recebeValEnds($falha);
        }
        $queryCliente .= $this->recebeValCli($falha);

        mysqli_query($conTemp, $query) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));

//        mysqli_insert_id ===== Retorna ultimo ID ou valor da PK inserido
        $queryCliente .= mysqli_insert_id($conTemp);
        if ($CEPS != "" || $CEPS != null) {
            mysqli_query($conTemp, $query2) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));
            $idTempends = mysqli_insert_id($conTemp);
        }
        $queryCliente .= ',' . $idTempends;
        $queryCliente .= ")";

        echo $queryCliente;
        mysqli_query($conTemp, $queryCliente) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));
        $err = mysqli_error($conTemp);
        if ($err == null || !$err) {
            $suc->suc(1);
        }
    }

    public function alterarCliente($conTemp) {
        session_start();
        require_once "./falha.php";
        require_once "./sucesso.php";
        $falha = new falha();
        $suc = new sucesso();
        //$this->validaEmail($conTemp);
        $templogin = $_SESSION['login'];
        $tempsenha = $_SESSION['senha'];
        $senhamd5 = md5($tempsenha);
        //$query2 = "INSERT INTO `bddelivery`.`cliente` 
//(`nomecliente`, `rg`, `cpf`, `sexo`, `dtnasc`, `telefone`, `email`, `senha`,`endereco`) VALUES ";
//Recebe funções de validação de CPF e E-mail
//        $query .= $this->recebeValEnd($falha);
        $vetvalores = $this->recebeValCliAlt($falha);
        $vetvaloresEnd = $this->recebeValEndAlt($falha);
        $query = "UPDATE `cliente` SET `nomecliente`='$vetvalores[nome]', `rg`='$vetvalores[rg]',  `sexo`='$vetvalores[sexo]', `dtnasc`='$vetvalores[dtnasc]', `telefone`='$vetvalores[tel]', `email`='$vetvalores[email]' WHERE `email` = '$templogin' OR `cpf` = '$templogin' AND `senha`= '$senhamd5';";
        $recebeEnd = "SELECT `endereco` FROM `cliente` WHERE `email` = '$templogin' OR `cpf` = '$templogin' AND `senha`= '$senhamd5';";
        
        mysqli_query($conTemp, $query) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));
        $codend = mysqli_query($conTemp, $recebeEnd) or die("<h1>Erro interno-ENDERECO</h1> <br>" + $falha->err(2));
        $registro = mysqli_fetch_assoc($codend);
        $pKeyEnd = $registro['endereco'];
        
        $queryEnd = "UPDATE `bddelivery`.`endereco` SET `cep`='$vetvaloresEnd[cep]', `rua`='$vetvaloresEnd[rua]', `cidade`='$vetvaloresEnd[cidade]', `numrua`='$vetvaloresEnd[numero]', `estado`='$vetvaloresEnd[uf]', `bairro`='$vetvaloresEnd[bairro]' WHERE `codend`=$pKeyEnd;";
echo $queryEnd;
        mysqli_query($conTemp, $queryEnd) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));
//        mysqli_query($conTemp, $query) or die("<h1>Erro interno</h1> <br>" + mysqli_error($conTemp));
//        $query2 .= mysqli_insert_id($conTemp) . ")";
//        mysqli_query($conTemp, $query2) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));
        /////
/////VERIFICAR SE LOGIN INCORRETO
        /*

         * verificar se uma linha foi alterada, se não exibir login incorreto, faça logout a conta e faça login novamente
         *          */


        $err = mysqli_error($conTemp);
        if ($err == null || !$err) {
            $suc->suc(2);
            session_destroy();
            session_abort();
        }
        session_abort();
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

    protected function validaEmail($conTemp) {
        require_once "./falha.php";
        $falha = new falha();
        $email = $_POST['email'];
        if ($email) {
            $validaemail = "SELECT email FROM `bddelivery`.`cliente` WHERE email = ";
            $validaemail .= "'$email'";
            $resultemail = mysqli_query($conTemp, $validaemail) or die($falha->err(2));
            if (mysqli_num_rows($resultemail) >= 1) {
                echo '<H2>Erro:<H2><H1>E-mail ja cadastrado</H1>';
                $falha->err(2);
            } else {
                $resultvalida = $resultemail;
                return $resultvalida;
            }
        }
        echo "Preencha o CPF ou o E-mail";
        return;
    }

    protected function recebeValCliAlt($falha) {
//  função que recebe todos os dados do formulario e valida se os campos obrigatórios foram preenchidos
//        Função para retornar de acordo com o update

        foreach ($_POST as $key => $val) {

            if ($_POST[$key] != NULL OR $_POST[$key] != "") {
                $comando = "\$" . $key . "='" . $val . "';";
                echo $comando . "<br>";

                eval($comando);
            }
            if ($key == "senha") {// codifica a senha e guarda no banco
                $senha = md5($_POST[$key]);
            }
        }


        $tv = true;

        /* se algum campo estiver nulo ele da erro por isso é necessario ignorar
          com o @ e em seguida verificar cada posição do array
         */

        @$t = array($nome, $rg, $sexo, $dtnasc, $tel, $email);

        foreach ($t as $key => $value) {
            if ($value === "" || $value == null)
                $tv = false;
        }

        $values = "";
        if ($tv === true) {
            $values = array("nome" => $nome, "rg" => $rg, "sexo" => $sexo, "dtnasc" => $dtnasc, "tel" => $tel, "email" => $email);
        } else {
            $falha->err(4);

            //sleep(10);
            //header("Location: ../cad.php");
        }
        return $values;
    }

    protected function recebeValEndAlt($falha) {
//  função que recebe todos os dados do formulario e valida se os campos do end 1 foram preenchido para alterar
//        Função para retornar de acordo com o update

        foreach ($_POST as $key => $val) {

            if ($_POST[$key] != NULL OR $_POST[$key] != "") {
                $comando = "\$" . $key . "='" . $val . "';";
                echo $comando . "<br>";

                eval($comando);
            }
            if ($key == "senha") {// codifica a senha e guarda no banco
                $senha = md5($_POST[$key]);
            }
        }


        $tv = true;

        /* se algum campo estiver nulo ele da erro por isso é necessario ignorar
          com o @ e em seguida verificar cada posição do array
         */

        @$t = array($cep, $rua, $cidade, $numero, $bairro, $uf);
        $comp = "''";
        foreach ($t as $key => $value) {
            if ($value === "" || $value == null)
                $tv = false;
        }

        $values = "";
        if ($tv === true) {
            $values = array("cep" => $cep, "rua" => $rua, "cidade" => $cidade, "numero" => $numero, "comp" => $comp, "bairro" => $bairro, "uf" => $uf);
        } else {
            $falha->err(4);
        }
        return $values;
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

//    ENDEREÇO OBRIGATÓRIO
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

//    ENDEREÇO OPCIONAL


    protected function recebeValEndS($falha) {

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
        @$t = array($ceps, $ruas, $cidades, $numeros, $bairros, $ufs);
        foreach ($t as $key => $value) {
            if ($value == "" || $value == null)
                $tv = false;
        }
        $values = "";
        if ($tv === true) {
            $values = "('$ceps', '$ruas', '$cidades', '$numeros', '$bairros', '$ufs')";
        } else {
            echo "Endereço opcional";
            $falha->err(4);
            //sleep(10);
            //header("Location: ../cad.php");
        }

        return $values;
    }

    public function consultarCliente($conTemp) {
//        Recebe os valores do login e senha, faz a consulta no bd se ouver algum registro retorna os valores para a pagina 
        require_once "./class/falha.php";
        $falha = new falha();

        $login = $_SESSION['login'];
        $senha = $_SESSION['senha'];
        $templogin = $login;
        $tempsenha = md5($senha);
        $query = "SELECT * FROM `cliente` WHERE `email` = '$templogin' OR `cpf` = '$templogin' AND `senha`= '$tempsenha'";
        $queryTemp = mysqli_query($conTemp, $query) or die($falha->err(2));
        $registro = mysqli_fetch_assoc($queryTemp);
        $existe = mysqli_num_rows($queryTemp);

        if (!$existe) {
            echo 'Registro inesistente';
            $falha->err(5);
        } else {

            foreach ($registro as $key => $val) {

                $comando = "\$" . $key . "='" . $val . "';";
                eval($comando);
            }
//            $endereco;
//            $queryend = "SELECT * FROM `endereco` WHERE `codendereco` = '$endereco'";
//            $queryTemp = mysqli_query($conTemp, $query) or die(mysqli_error($conTemp));
//        $registro = mysqli_fetch_assoc($queryTemp);
//        $existe = mysqli_num_rows($queryTemp);

            $ends = $this->encontraEnds($conTemp, $falha, $endereco, $endereco2);

            $end1 = $ends[0];
            $end2 = $ends[1];
            foreach ($end1 as $key => $value) {
                $comando = "\$" . $key . "='" . $value . "';";
                eval($comando);
            }
            foreach ($end2 as $key => $value) {
                $comando = "\$" . $key . "s='" . $value . "';";
                eval($comando);
            }


            $select = array('1' => "", '2' => "");
            if ($sexo == 'm') {
                $select['1'] = "true";
            } else {
                $select['2'] = "true";
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
                                    <input type='radio' name='sexo' value ='f' checked='$select[1]'/>Feminino&nbsp;&nbsp;&nbsp; 
                                    <input type='radio' name='sexo' value='m' checked='$select[2]'/>Masculino
                                </li>
                                <li><input name='dtnasc' value='$dtnasc' type='date'/></li>
                                <li><input  name='tel' placeholder='$telefone' value='$telefone' type='text'/></li>


                                <li><input name='tels' placeholder='$telefone2' value='$telefone2' type='text'/></li>


                                <li><input name='email' placeholder='$email' value='$email' id='email' type='email'></li>
                            </ul>
                        </div>"
            . "<h4>Endereço: *</h4>
                            <div class='n-campos'>
                                <ul>
                                    <li>CEP:*</li>
                                    <li>Rua:*</li>
                                    <li>Número:*</li>
                                    <li>Complemento:</li>
                                    <li>Bairro (Jd):*</li>
                                    <li>Cidade:*</li>
                                    <li>UF:*</li>
                                </ul>
                            </div>
                            <div class='campos'>
                                <ul>
                                    <li><input  placeholder='00000-000' name='cep' value='$cep' onblur='pesquisacep(this.value);' type='text'/></li>
                                    <li><input maxlength='100' size='65' name='rua' id='rua' value='$rua' type='text'/></li>
                                    <li><input  maxlength='5' size='6' name='numero' id='numero' value='$numrua' type='number'/></li>
                                    <li><input  maxlength='5' size='6' name='comp'  id='comp' value='$comp' type='number'/></li>
                                    <li>
                                        <input maxlength='100' size='65' name='bairro'  id='bairro' value='$bairro' type='text'/>
                                    </li>
                                    <li><input maxlength='30' size='40' name='cidade'  id='cidade' value='$cidade'type='text'></li>
                                    <li><select name='uf' id='uf'>
                                            <option value='' disabled='true'>Selecione</option>
                                            <option value='AC'>AC</option>
                                            <option value='AL'>AL</option>
                                            <option value='AM'>AM</option>
                                            <option value='AP'>AP</option>
                                            <option value='BA'>BA</option>
                                            <option value='CE'>CE</option>
                                            <option value='DF'>DF</option>
                                            <option value='ES'>ES</option>
                                            <option value='GO'>GO</option>
                                            <option value='MA'>MA</option>
                                            <option value='MG'>MG</option>
                                            <option value='MS'>MS</option>
                                            <option value='MT'>MT</option>
                                            <option value='PA'>PA</option>
                                            <option value='PB'>PB</option>
                                            <option value='PE'>PE</option>
                                            <option value='PI'>PI</option>
                                            <option value='PR'>PR</option>
                                            <option value='RJ'>RJ</option>
                                            <option value='RN'>RN</option>
                                            <option value='RS'>RS</option>
                                            <option value='RO'>RO</option>
                                            <option value='RR'>RR</option>
                                            <option value='SC'>SC</option>
                                            <option value='SE'>SE</option>
                                            <option value='SP'>SP</option>
                                            <option value='TO'>TO</option>
                                        </select></li>

                                </ul>
                            </div>


                            <p style='display:none;'>
                                <input name='ibge' type='text' id='ibge' size='8' />
                            </p>


                        <h4>Endereço:(Opcional)</h4>

                            <div class='n-campos'>

                                <ul>
                                    <li>CEP:*</li>
                                    <li>Rua:*</li>
                                    <li>Número:*</li>
                                    <li>Complemento:</li>
                                    <li>Bairro (Jd):*</li>
                                    <li>Cidade:*</li>
                                    <li>UF:*</li>

                                </ul>
                            </div>
                            <div class='campos'>
                                <ul>
                                    <li><input  placeholder='00000-000' name='ceps' value='$ceps' onblur='pesquisaceps(this.value);' type='text'/></li>
                                    <li><input maxlength='100' size='65' name='ruas' id='ruas' value='$ruas' type='text'/></li>
                                    <li><input  maxlength='5' size='6' name='numeros' id='numeros' value='$numruas' type='number'/></li>
                                    <li><input  maxlength='5' size='6' name='comps'  id='comps' value='$comps' type='number'/></li>
                                    <li><input maxlength='100' size='65' name='bairros'  id='bairros' value='$bairros' type='text'/></li>
                                    <li><input maxlength='30' size='40' name='cidades'  id='cidades' value='$cidades'type='text'></li>
                                    <li><select name='ufs' id='ufs'>
                                            <option value=''>Selecione</option>
                                            <option value='AC'>AC</option>
                                            <option value='AL'>AL</option>
                                            <option value='AM'>AM</option>
                                            <option value='AP'>AP</option>
                                            <option value='BA'>BA</option>
                                            <option value='CE'>CE</option>
                                            <option value='DF'>DF</option>
                                            <option value='ES'>ES</option>
                                            <option value='GO'>GO</option>
                                            <option value='MA'>MA</option>
                                            <option value='MG'>MG</option>
                                            <option value='MS'>MS</option>
                                            <option value='MT'>MT</option>
                                            <option value='PA'>PA</option>
                                            <option value='PB'>PB</option>
                                            <option value='PE'>PE</option>
                                            <option value='PI'>PI</option>
                                            <option value='PR'>PR</option>
                                            <option value='RJ'>RJ</option>
                                            <option value='RN'>RN</option>
                                            <option value='RS'>RS</option>
                                            <option value='RO'>RO</option>
                                            <option value='RR'>RR</option>
                                            <option value='SC'>SC</option>
                                            <option value='SE'>SE</option>
                                            <option value='SP'>SP</option>
                                            <option value='TO'>TO</option>
                                        </select></li>

                                </ul>
                            </div>
                        ";
        }
    }

//    Função para encontrar os endereços do cliente
    public function encontraEnds($conTemp, $falha, $end1 = "", $end2 = "") {
        $ends = array();
        if ($end1 == "" && $end2 == "") {
            exit(0);
        }
        if ($end1 != "") {
            $endereco = $end1;
            $queryend = "SELECT * FROM `endereco` WHERE `codend` = '$endereco'";
            $queryTemp = mysqli_query($conTemp, $queryend) or die($falha->err(2));
            $result = mysqli_fetch_assoc($queryTemp);
            $existe = mysqli_num_rows($queryTemp);
            if (!existe) {
                exit(0);
            } else {
                $ends[] = $result;
            }
        }
        if ($end2 != "") {
            $endereco2 = $end2;
            $queryend2 = "SELECT * FROM `endereco` WHERE `codend` = '$endereco2'";
            $queryTemp = mysqli_query($conTemp, $queryend2) or die($falha->err(2));
            $result2 = mysqli_fetch_assoc($queryTemp);
            $existe2 = mysqli_num_rows($queryTemp);

            if (!$existe2) {
                exit(0);
            } else {
                $ends[] = $result2;
            }
        }
        return $ends;
    }

    public function excluirCliente($conTemp) {
        session_start();
        require_once "./sairsessao.php";
        
        require_once "./falha.php";
        require_once "./sucesso.php";
        $falha = new falha();
        $suc = new sucesso();
        $login = $_SESSION['login'];
        $senha = $_SESSION['senha'];

        $templogin = $login;
        $tempsenha = md5($senha);
        $query = "SELECT `endereco` FROM `cliente` WHERE `email` = '$templogin' OR `cpf` = '$templogin' AND `senha`= '$tempsenha'";
        $queryTemp = mysqli_query($conTemp, $query) or die(mysqli_error($conTemp));
        $registro = mysqli_fetch_assoc($queryTemp);
        $existe = mysqli_num_rows($queryTemp);
        if (!$existe) {
            $falha->err(5);
        } else {

            foreach ($registro as $key => $val) {
                $comando = "\$" . $key . "='" . $val . "';";
                eval($comando);
            }
            $queryend = "DELETE FROM `endereco` WHERE `codend` = '$endereco'";
            $queryDEL = "DELETE FROM `cliente` WHERE `email` = '$templogin' OR `cpf` = '$templogin'";

            mysqli_query($conTemp, $queryDEL) or die(mysqli_error($conTemp) + exit(0));
            mysqli_query($conTemp, $queryend) or die(mysqli_error($conTemp));
            if ($endereco2 != null || $endereco2 != "") {
                $queryend2 = "DELETE FROM `endereco` WHERE `codend` = '$endereco2'";
                mysqli_query($conTemp, $queryend2) or die(mysqli_error($conTemp) + exit(0));
            }
            $suc->suc(3);
            new sairsessao();
        }
    }

}

?>