<html lang="pt-br">
    <?php
    require_once './temp/head.phtml';
    require_once './temp/footer.phtml';

    new head();
    ?>

    <body>
        <?php
        $obj = new menu();
        $obj->ativoMenu(5);
        ?>

        <style>
            .n-prod{
                max-width: 70%;
            }
        </style>
        <!--produto1*, produto2, data de cadastro*, dia do cardápio (dia/mês/ano), preço de venda-->
        <div id="f-corpo">
            <div class="corpo">
                <fieldset  class="cad"><legend><h2>Cardápio</h2></legend>
                    <form action='./class/cardapioDAO.php' method="POST">
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
                                    <select name="produto" id="produto">
                                        <option value="">Selecione</option>
                                        <?php
                                        $_POST["def"] = 4;
                                        require_once './class/cardapioDAO.php';
                                        ?>
                                    </select>
                                </li>
                                <li>
                                    <select name="produtos" id="produtos">
                                        <option value="">Selecione</option>
                                        <?php
                                        $obg->define();
                                        ?>
                                    </select>
                                </li>
                                <li><input type="date" name="datacard"/></li>
                                <li><input type="text" name="preco"/></li>
                            </ul>
                        </div>
                        <input type="hidden" name="def" value="1"/>
                        <input type="submit" value="Enviar"/>
                    </form>

                </fieldset>


            </div>
            <?php
            new footer();
            ?>
        </div>


    </body>
</html>