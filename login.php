<html lang="pt-br">
    <?php
    require_once './temp/head.phtml';
    require_once './temp/footer.phtml';

    new head();
    ?>
    </head>

    <body>

        <?php
        $obj = new menu();
        $obj->ativoMenu(4);
        ?>


        <div id="f-corpo" >
            <div class="corpo"style="background-color: transparent !important;">
                <form method="POST" action="class/cons.php">
                    <fieldset class="cad"><legend><h2>Autenticar(LOGIN)</h2></legend>

                        <div class='n-campos'>
                            <ul>
                                <li>E-mail: </li>
                                <li>Senha: </li>
                            </ul>
                        </div>
                        <div class='campos'>
                            <ul>
                                <li><input name="login"type="text"/></li>
                                <li><input name="senha" type="password"/></li>
                                <li><input type="submit" value="Avançar"/></li>
                            </ul>
                        </div>     
                        
                        
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