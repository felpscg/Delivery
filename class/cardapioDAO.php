<?php

/**
 * Description of cardapioDAO
 *
 * @author Felipe
 */
$obg = new cardapioDAO();
$obg->define();

class cardapioDAO {

    public function define() {

        @$def = $_POST["def"];
        switch ($def) {
            case 1:
                require_once "./conBD.php";
                $conexao = new conBD();
                $conTemp = $conexao->conBD();
//                inclui registro do cliente
//                echo 1;
//                exit(0);
                $this->incluirCard($conTemp);
                break;

            case 2:
                require_once "./class/conBD.php";
                $conexao = new conBD();
                $conTemp = $conexao->conBD();

//                Utlizado para exibir o perfil
                $this->consultarCard($conTemp);
                break;

            case 3:
                require_once "./conBD.php";
                $conexao = new conBD();
                $conTemp = $conexao->conBD();
                $this->alterarCard($conTemp);
                break;

            case 4:
                require_once "./class/conBD.php";
                $conexao = new conBD();
                $conTemp = $conexao->conBD();

//                Utlizado para exibir o perfil
                $this->consultarProd($conTemp);
                break;

            case "seleciona":
                $this->selecionaAcao($conTemp);
                break;
            default:
                echo "<h1>Erro interno</h1><BR>Não foi possivel encontrar a função";
                break;
        }
    }

    public function incluirCard($conTemp) {
        require_once "./falha.php";
        require_once "./sucesso.php";
        $falha = new falha();
        $suc = new sucesso();
        $datacard = $_POST['datacard'];
        $queryverifica = "SELECT cardapio.codcardapio FROM cardapio WHERE datacardapio = '$datacard';";
        $result = mysqli_query($conTemp, $queryverifica) or die("<h1>Erro interno</h1> <br>" + $falha->err(2));


        if (mysqli_num_rows($result) >= 1) {
            echo "apenas um por dia";
            exit();
        }

//        PRODUTO
        $query = "INSERT INTO `bddelivery`.`cardapio`"
                . " (`produto1`, `produto2`, `datacardapio`, `datacadastro`, `precovenda`) VALUES ";
        $query .= $this->recebeValCard($falha, $datacad);
        echo $query;
//        exit(0);
        mysqli_query($conTemp, $query) or die("<h1>Erro interno</h1> <br>" + mysqli_error($conTemp));
        $err = mysqli_error($conTemp);
        if ($err == null || !$err) {
            $suc->suc(1);
        }
    }

    protected function recebeValCard($falha, $datacard) {
//  função que recebe todos os dados do formulario e valida se os campos obrigatórios foram preenchidos 
        $produtos = '';
        foreach ($_POST as $key => $val) {

            $comando = "\$" . $key . "='" . $val . "';";
            eval($comando);
        }
        $tv = true;

        /* se algum campo estiver nulo ele da erro por isso é necessario ignorar
          com o @ e em seguida verificar cada posição do array
         */

        $datacadastro = date("Y-m-d");

        $t = array($produto, $datacard, $datacadastro, $preco);

        foreach ($t as $key => $value) {
            if ($value === "" || $value == null) {
                $tv = false;
                echo $key;
                echo $value;
            }
        }
        $values = "";
        if ($tv === true) {

            $values = "('$produto', '$produtos', '$datacard', '$datacadastro', '$preco')";
        } else {
            $falha->err(4);
        }
        return $values;
    }

    public function consultarCard($conTemp) {

        require_once "./class/falha.php";
        $falha = new falha();
        $query = "SELECT * from `cardapio` ORDER BY `datacardapio` asc";
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
                $optProd = $this->consultarProdExibAlt($conTemp, $produto1, $produto2='');
                $optProd2 = $this->consultarProdExibAlt($conTemp, $produto1, $produto2);
//                <form method='POST' name='formprod' action='altproduto.php'>
                $conCard = "<fieldset  class='cad'><legend><h2>Cardápio</h2></legend>
                    <form action='./class/cardapioDAO.php' method='POST'>
                        <div class='n-campos'>
                            <ul>
                                <li>Produto:*</li>
                                <li>Produto:</li>
                                <li>Data do Cardápio:</li>
                                <li>Preço da Venda</li>


                            </ul>
                        </div>
                        <div class='campos' style='max-width: 100%;margin-top:2em;'>
                            <ul>
                                <li>
                                    <select name='produto' id='produto'>
                                        <option value=''>Selecione</option>
                                        
                                        $optProd
                                    </select>
                                </li>
                                
                                <li>
                                    <select name='produtos' id='produtos'>
                                        <option value=''>Selecione</option>
                                        
$optProd2

                                    </select>
                                </li>
                                <li><input type='date' name='datacard' value='$datacardapio'/></li>
                                <li><input type='text' name='preco' value='$precovenda'/></li>
                            </ul>
                        </div>
                        <input type='hidden' name='codcardapio' value='$codcardapio'/>
                            
                        <input type='hidden' name='def' value='seleciona'/>
                        <button type='submit' name='alterar' value='true'/>Alterar</button>
                         <button type='submit' name='deletar' value='true'/>Deletar</button>
                    </form>

                
</fieldset>



                               ";
                echo $conCard;
            }
        }
    }

    public function consultarProd($conTemp) {
//        Recebe os valores do login e senha, faz a consulta no bd se ouver algum registro retorna os valores para a pagina 
        require_once "./class/falha.php";
        $falha = new falha();


        $query = "SELECT * from `produto` WHERE marmita='s' ORDER BY `nomeproduto` asc";
        $result = mysqli_query($conTemp, $query) or die($falha->err(2));

        $existe = mysqli_num_rows($result);

        if (!$existe) {
            echo "<option value= ''>Vazio</option>";

            $falha->err(5);
        } else {



            for ($i = 1; $i <= $existe; $i++) {
                $registro = mysqli_fetch_assoc($result);
                foreach ($registro as $key => $val) {

                    $comando = "\$" . $key . "='" . $val . "';";
                    eval($comando);
                }
//                <form method='POST' name='formprod' action='altproduto.php'>
                echo "<option value= '$codproduto'>$nomeproduto</option>";

                //$preco;
            }
        }
    }

    public function consultarProdExibAlt($conTemp, $produto1, $produto2) {
//        Recebe os valores do login e senha, faz a consulta no bd se ouver algum registro retorna os valores para a pagina 
        require_once "./class/falha.php";
        $falha = new falha();


        $query = "SELECT * from `produto` WHERE marmita='s' ORDER BY `nomeproduto` asc";
        $result = mysqli_query($conTemp, $query) or die($falha->err(2));
        $existe = mysqli_num_rows($result);

        if (!$existe) {
            return "<option value= ''>Vazio</option>";

            $falha->err(5);
        } else {
            $valOpt = '';


            for ($i = 1; $i <= $existe; $i++) {
                $registro = mysqli_fetch_assoc($result);
                foreach ($registro as $key => $val) {

                    $comando = "\$" . $key . "='" . $val . "';";
                    eval($comando);
                }
                if ($produto1 == $codproduto || $produto2 == $codproduto) {
                    $valOpt .= "<option value= '$codproduto' selected='true'>$nomeproduto</option>";
                } else {
                    $valOpt .= "<option value= '$codproduto'>$nomeproduto</option>";
                }
//                <form method='POST' name='formprod' action='altproduto.php'>
                //$preco;
            }

            return $valOpt;
        }
    }
    
    public function excluirCard($conTemp) {
        
        require_once "./falha.php";
        require_once "./sucesso.php";
        $falha = new falha();
        $suc = new sucesso();
        $codcardapio = $_POST['codcardapio'];
            $queryDEL = "DELETE FROM `cardapio` WHERE `codcardapio` = '$codcardapio'";

            mysqli_query($conTemp, $queryDEL) or die(mysqli_error($conTemp) + exit(0));
            echo $codcardapio;
            echo $queryDEL;
            $suc->suc(3);
        
    }
    
    
public function selecionaAcao() {
        if(isset($_POST["alterar"])){
            $_REQUEST["cod"] = "ta";
            require_once './selecFuncProd.php';
        }
        if(isset($_POST["deletar"])){
            echo "deletar";
            require_once "./conBD.php";
                $conexao = new conBD();
                $conTemp = $conexao->conBD();
                $this->excluirCard($conTemp);
        }
    }
}
