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
    session_start();
    //session_unset($_SESSION["login"]);
    session_destroy();

    $obj = new menu();
    $obj->ativoMenu(0);
    //session_start();
    foreach ($_SESSION as $key => $value) {
        echo $_SESSION[$key];
    }
    ?>



    <div id="f-corpo">
        <div class="corpo">
            <form method="POST" action="class/produtoDAO.php">
                <input type="hidden" name="def" value="1"/>
                <fieldset class="cad"><legend><h2>Cadastro</h2></legend>

                    <div class="n-campos">
                        <ul>
                            <li>Nome do Produto:*</li>
                            <li>Preço:*</li>
                            <li>Tamanho:</li>
                            <li>Marmita:*</li>
                            <li>Descrição do Produto*</li>
                        </ul>
                    </div>
                    <div class="campos">
                        <ul>
                            <li><input name="nomeprod" maxlength="80" type="text"/></li>
                            <li><input name="precoprod" type="text"/></li>
                            <li><input name="tamanho" min = "1" max = "3" type="range"/></li>
                            <li>
                                <input type="radio" name="marmita" value ="s" checked="true"/>sim&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="marmita" value="n"/>nao
                            </li>
                            <li><textarea name="descricao" maxlength="250"></textarea></li>

                        </ul>	
                    </div>
                    

                            </fieldset>


                            

                                <input type="submit"  value="Avançar"/>
                           
                            </fieldset>
                            </form>
                    </div>
                    <div class="rodape">
                        <div class="textrod">
                            <span>teste</span>
                            <p>₢ - 2018</p>
                        </div>
                    </div>
                    </div>

                    </body>
                    </html>