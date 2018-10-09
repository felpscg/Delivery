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
        <!---->
        <div id="f-corpo">
            <div class="corpo">
                <fieldset  class="cad"><legend><h2>Cardápio</h2></legend>
                    <?php
                        
                        $_POST["def"] = 2;
                        require_once './class/cardapioDAO.php';

                        ?>
                    
                </fieldset>


            </div>
            <?php
            new footer();
            ?>
        </div>


    </body>
</html>