<html lang="pt-br">
     <?php
    require_once './temp/head.phtml';
    require_once './temp/footer.phtml';

    new head();
    ?>
    </head>

    <body>
        
            <?php
            session_start();
            //session_unset($_SESSION["login"]);
            session_destroy();
            
            $obj = new menu();
            $obj->ativoMenu(1);
            //session_start();
            foreach ($_SESSION as $key => $value) {
    echo $_SESSION[$key];
}
            ?>
        


        <div id="f-corpo">
            <div class="corpo">
                <form method="POST" action="class/cadastrarProduto.php">
                    <fieldset class="cad"><legend><h2>Cadastro de Produto</h2></legend>
                        <p>
                            Nome do Produto:*
                            <input name="nomeproduto" type="text"/>
                        </p>
                        <p>
                            Preço:*
                            <input name="precoproduto" type="text"/>
                        </p>
                        <p>
                            Tamanho:
                            <input name="tamanhoproduto" min = "1" max = "3" type="range"/>
                        </p>
                        <p>
                            Marmita:* 
                            <input type="radio" name="tipom" value ="s"/>sim&nbsp;&nbsp;&nbsp;
							<input type="radio" name="tipom" value="n"/>nao
							
                        </p>
                        <p>
                            Descrição do Produto*
                            <textarea name="descricao"></textarea>
                        </p>				
							
						</fieldset>


                        <p>
                             
                            <input type="submit"  value="Avançar"/>
                        </p>
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