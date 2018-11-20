<?php



class menuitemDAO {

    function define() {
        $posi = ( isset($_POST["posi"]))?$_POST["posi"]:1;
        $lim = $posi * 10;
        $min =($posi>2) ?(($posi -1) *10):1;
        $this->listar($posi,$min, $lim);
    }
    
    function listar($posi, $min, $lim) {
        require_once "./class/conBD.php";
        require_once "./class/falha.php";
        $falha = new falha();
        $conexao = new conBD();
        $conTemp = $conexao->conBD();
//        $comando = "SELECT C.codcardapio AS 'Cardapio', C.datacardapio AS 'Data do Cardápio', PE.* FROM bddelivery.cardapio AS C, (SELECT * FROM produto AS P WHERE P.codproduto =17) AS PE WHERE C.codcardapio = 3 AND C.datacardapio = 2018-01-06 AND C.ceproduto1 = 2 OR C.ceproduto2 = 17;";
        $comando = "SELECT C.codcardapio, C.datacardapio AS 'datacard', PE.codproduto AS 'codigoprod', PE.nomeproduto, PE.descproduto, PE.preco, PE.marmita FROM bddelivery.cardapio AS C left JOIN produto AS PE on C.ceproduto1 = PE.codproduto or C.ceproduto2 = PE.codproduto;";
        $comando_ad = "SELECT * from produto where not marmita = 's' LIMIT $lim;";
        
        $result = mysqli_query($conTemp, $comando) or die($falha->err(2) + "eee");
        $registros = mysqli_num_rows($result);

        if (!$registros) {
            echo '<h2>Nenhum produto encontrado</h2>';
            $falha->err(5);
        } else {
            for ($i = 1; $i <= $registros; $i++) {
                $registro = mysqli_fetch_assoc($result);
                foreach ($registro as $key => $val) {
                    $comando = "\$" . $key . "='" . $val . "';";
                    eval($comando);
                }

                echo $saida = "Protuto ".$nomeproduto;
                
            }
        }

        return ;
    }

}
