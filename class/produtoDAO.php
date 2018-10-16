<?php

/**
 * @name            : clienteDAO
 * @since           : 07/09/2018
 * @author          : felipecg
 *
 * Descrição: Essa classe permite receber todos os dados do produto e  efetua todas
 *  as operações do CRUD de acordo com o $_post["def"] recebido da página requerida
 *
 */
$obg = new produtoDAO();
$obg->define();

class produtoDAO {

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
                $this->incluirproduto($conTemp);
                break;

            case 2:
                require_once "./class/conBD.php";
                $conexao = new conBD();
                $conTemp = $conexao->conBD();

//                Utlizado para exibir o perfil
                $this->consultarProd($conTemp);
                break;

            case 3:
                require_once "./conBD.php";
                $conexao = new conBD();
                $conTemp = $conexao->conBD();
                $this->alterarProd($conTemp);
                break;

            case 4:

                break;

            case "seleciona":
                $this->selecionaAcao($conTemp);
                break;
            default:
                echo "<h1>Erro interno</h1><BR>Não foi possivel encontrar a função";
                break;
        }
    }

    public function incluirProduto($conTemp) {
        require_once "./falha.php";
        require_once "./sucesso.php";
        $falha = new falha();
        $suc = new sucesso();
        $datacad = date('Y-m-d');
        $queryverifica = "SELECT produto.codproduto FROM produto WHERE datacad = '$datacad';";
        $result = mysqli_query($conTemp, $queryverifica) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));


        /*     if (mysqli_num_rows($result) >= 2) {
          echo "apenas dois por dia";
          exit();
          }
         */
//        PRODUTO
        $query = "INSERT INTO `bddelivery`.`produto`"
                . " (`nomeproduto`, `descproduto`, `preco`, `tamanho`, `datacad`, `marmita`) VALUES ";
        $query .= $this->recebeValProd($falha, $datacad);
//        echo $query;
        mysqli_query($conTemp, $query) or die("<h1>Erro interno</h1> <br>" + mysqli_error($conTemp));
        $err = mysqli_error($conTemp);
        if ($err == null || !$err) {
            $suc->suc(1);
        }
    }

    protected function recebeValProd($falha, $datacad) {
//  função que recebe todos os dados do formulario e valida se os campos obrigatórios foram preenchidos 
        $descricao = '';
        $tamanho = '';
        foreach ($_POST as $key => $val) {

            $comando = "\$" . $key . "='" . $val . "';";
            eval($comando);
        }
        $tv = true;

        /* se algum campo estiver nulo ele da erro por isso é necessario ignorar
          com o @ e em seguida verificar cada posição do array
         */


        @$t = array($nomeprod, $precoprod, $datacad, $marmita);

        foreach ($t as $key => $value) {
            if ($value === "" || $value == null)
                $tv = false;
        }

        $values = "";
        if ($tv === true) {

            $values = "('$nomeprod', '$descricao', '$precoprod', '$tamanho', '$datacad', '$marmita')";
        } else {
            $falha->err(4);
        }
        return $values;
    }

    public function consultarProd($conTemp) {
//        Recebe os valores do login e senha, faz a consulta no bd se ouver algum registro retorna os valores para a pagina 
        require_once "./class/falha.php";
        $falha = new falha();


        $query = "SELECT * from `produto` ORDER BY `nomeproduto` asc";
        $result = mysqli_query($conTemp, $query) or die($falha->err(2));

        $existe = mysqli_num_rows($result);

        if (!$existe) {
            echo 'Nenhum registro encontrado';

            $falha->err(5);
        } else {



            for ($i = 1; $i <= $existe; $i++) {
                $registro = mysqli_fetch_assoc($result);
                foreach ($registro as $key => $val) {

                    $comando = "\$" . $key . "='" . $val . "';";
                    eval($comando);
                }
//                <form method='POST' name='formprod' action='altproduto.php'>
                echo "<form method='POST' name='formprod' action='./class/produtoDAO.php'>
                        <fieldset class='n-prod'>
                            <legend><h2>$nomeproduto</h2></legend>


                            <div class='n-campos'>
                                <ul>
                                    <li>Nome:*</li>
                                    <li>Preço:*</li>
                                    <li>Tamanho:</li>
                                    <li>Marmita:*</li>
                                    <li>Descrição do Produto:*</li>

                                </ul>
                            </div>
                            <div class='campos'>
                                <ul>
                                
<li><input name='nomeprod' maxlength='80' value='$nomeproduto' type='text'/></li>
                            <li><input name='precoprod' value='$preco' type='text'/></li>
                            <li><input name='tamanho' value='$tamanho' min = '1' max = '3' type='range'/></li>
                            <li>
                                <input type='radio' name='marmita' value ='s' checked='true'/>sim&nbsp;&nbsp;&nbsp;
                                <input type='radio' name='marmita' value='n'/>nao
                            </li>
                            <li><textarea name='descricao' maxlength='250'>$descproduto</textarea></li>
                            




                                    <input type='hidden' name='codprod' value='$codproduto'/>
                                    <input type='hidden' name='def' value='seleciona'/>
                                    
                                    <li><button type='submit' name='alterar' value='true'/>Alterar</button></li>
                                    <li><button type='submit' name='deletar' value='true'/>Deletar</button></li>
                                    



                                </ul>
                            </div>
                        </fieldset>
                    </form>";
            }
        }
    }

    public function alterarProd($conTemp) {

        require_once "./falha.php";
        require_once "./sucesso.php";
        $falha = new falha();
        $suc = new sucesso();

        $vetvalores = $this->recebeValProdAlt($falha);
        $query = "UPDATE `bddelivery`.`produto` SET `nomeproduto`='$vetvalores[0]', `descproduto`='$vetvalores[1]', `preco`='$vetvalores[2]', `tamanho`='$vetvalores[3]', `datacad`='$vetvalores[4]', `marmita`='$vetvalores[5]' WHERE `codproduto`=$vetvalores[6];";

        mysqli_query($conTemp, $query) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));

        $err = mysqli_error($conTemp);
        if ($err == null || !$err) {
            $suc->suc(2);
        }
    }

    // função para validar CPF e E-MAIL


    protected function recebeValProdAlt($falha) {
        require_once "./falha.php";
        require_once "./sucesso.php";
        $falha = new falha();
        $suc = new sucesso();
        $codproduto = $_POST['codprod'];


        foreach ($_POST as $key => $val) {

            $comando = "\$" . $key . "='" . $val . "';";
            eval($comando);
        }

        $dataalt = date('Y-m-d');
        $values = array($nomeprod, $descricao, $precoprod, $tamanho, $marmita, $dataalt, $codproduto);

        return $values;
    }

    public function excluirProd($conTemp) {

        require_once "./falha.php";
        require_once "./sucesso.php";
        $falha = new falha();
        $suc = new sucesso();
        $codproduto = $_POST['codprod'];
        $queryDEL = "DELETE FROM `produto` WHERE `codproduto` = '$codproduto'";

        mysqli_query($conTemp, $queryDEL) or die(mysqli_error($conTemp) + exit(0));
        echo $codproduto;
        $suc->suc(3);
    }

    public function selecionaAcao() {
        if (isset($_POST["alterar"])) {
            echo "alterar";
            require_once "./conBD.php";
            $conexao = new conBD();
            $conTemp = $conexao->conBD();
            $this->alterarProd($conTemp);
        }
        if (isset($_POST["deletar"])) {
            echo "deletar";
            require_once "./conBD.php";
            $conexao = new conBD();
            $conTemp = $conexao->conBD();
            $this->excluirProd($conTemp);
        }
    }

}

?>