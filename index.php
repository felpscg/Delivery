<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/icon/icpr.png">
        <title>teste</title>

        <!--CSS-->
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <!--JS-->
        <link type="text/javascript" href="js/basic.js">
        <script type="text/javascript" src=""></script>
        <script type="text/javascript" src="js/basic.js"></script>
        <?php
        require_once './class/menu.php';
        ?>


    </head>

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
            <div class="rodape">
                <div class="textrod">
                    <span>teste</span>
                    <p>₢ - 2018</p>
                </div>
            </div>
        </div>

    </body>
</html>