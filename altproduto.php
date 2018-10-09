<html lang="pt-br">
    <?php
    require_once './temp/head.phtml';
    require_once './temp/footer.phtml';

    new head();
    ?>
</head>
<!--Cadastro para incluir o produto-->
<body>

    <?php
    require_once "./class/conBD.php";
    $conexao = new conBD();
    $conTemp = $conexao->conBD();
    echo "teste";
    $cod = $_POST['codprod'];
    $query = "SELECT * from `produto` where `codproduto` = $cod";
    echo $cod;
    $queryTemp= mysqli_query($conTemp, $query) or die(mysqli_connect_error());
    $registro = mysqli_fetch_assoc($queryTemp);
    echo "teste";
    $existe = mysqli_num_rows($queryTemp);
    echo "teste";
    if (!$existe) {
        echo 'Nenhum registro encontrado';

        $falha->err(5);
    } else {

//echo "teste";
        foreach ($registro as $key => $val) {
//echo "teste";
            $comando = "\$" . $key . "='" . $val . "';";
            eval($comando);
        }
    }

    echo $corpo = "
            <div id='f-corpo'>
            <div class='corpo'>
                <form method='POST' action='./class/produtoDAO.php'>
                    <input type='hidden' name='def' value='3'/>
                    <input type='hidden' name='codprod' value='$codproduto'/>
                    <fieldset class='cad'><legend><h2>Cadastro</h2></legend>

                    <div class='n-campos'>
                        <ul>
                            <li>Nome do Produto:*</li>
                            <li>Preço:*</li>
                            <li>Tamanho:</li>
                            <li>Marmita:*</li>
                            <li>Descrição do Produto*</li>
                        </ul>
                    </div>
                    <div class='campos'>
                        <ul>
                            <li><input name='nomeprod' maxlength='80' value='$nomeproduto' type='text'/></li>
                            <li><input name='precoprod' type='text' value='$preco'/></li>
                            <li><input name='tamanho' min = '1' max = '3' value='$tamanho' type='range'/></li>
                            <li>
                                <input type='radio' name='marmita' value ='s' checked='true'/>sim&nbsp;&nbsp;&nbsp;
                                <input type='radio' name='marmita' value='n'/>nao
                            </li>
                            <li><textarea name='descricao' maxlength='250'>$descproduto</textarea></li>

                        </ul>	
                    </div>
                    

                            </fieldset>";








    echo "<input type='submit'  value='Avançar'/>

                </fieldset>
            </form>
        </div>
        <div class='rodape'>
            <div class='textrod'>
                <span>teste</span>
                <p>₢ - 2018</p>
            </div>
        </div>
    </div>

</body>
</html>";
    ?>





