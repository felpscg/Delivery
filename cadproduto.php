<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport">
		<!-- content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1.2"-->
        <link rel="shortcut icon" href="img/icon/icpr.png">
        <title>teste</title>

        <!--CSS-->
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <!--JS-->
        <!-- <link type="text/javascript" href="js/basic.js"> -->
		<script type="text/javascript" src="js/basic.js" defer="defer"></script>
		<script charset="utf-8" type="text/javascript" src="js/cep.js" defer="defer"></script>

        <?php
        require_once './class/menu.php';
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