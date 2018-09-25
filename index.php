<html>
    <?php
    require_once './temp/head.phtml';
    require_once './temp/footer.phtml';

    new head();
    ?>

    <body>
        <div id="fundo-p">
            
            <?php
            $obj = new menu();
            $obj->ativoMenu(0);
            ?>
            <div id="bloco-e">
                <div class="b-p b-c"><!--primeiro bloco e assim sucessivamente -->
                    Especial da Semana
                </div>

                <div class="b-s b-c">
                    Itens:
                    <ul>

                        <li>
                            Lagarto
                        </li>

                        <li>
                            Omelete
                        </li>
                    </ul>
                </div>

                <div class="b-t b-c">
                    <img id="prom" src="img/lagarto.png"/>
                    <p style="margin-top: -3px">
                        Imagem meramente ilustrativa
                        <img  class="info" src="img/info56.png"/>
                    </p>
                </div>
            </div>
        </div>
        <div id="f-corpo">
            <div class="corpo">

            </div>
            <?php
            new footer();
            ?>
        </div>

    </body>
</html>