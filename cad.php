<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1.2">
        <link rel="shortcut icon" href="img/icon/icpr.png">
        <title>teste</title>

        <!--CSS-->
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <!--JS-->
        <link type="text/javascript" href="js/basic.js">
        <script type="text/javascript" src="js/basic.js"></script>

        <?php
        require_once './class/menu.php';
        ?>


    </head>

    <body>
        <div style="height: 110px !important;" id="fundo-p">
            <?php
            $obj = new menu();
            $obj->ativoMenu(1);
            ?>
        </div>

        <div id="f-corpo">
            <div class="corpo">
                <form method="POST" enctype="" action="">
                    <fieldset><legend><h2>Cadastro</h2></legend>
                        <p>
                            Nome:
                            <input type="text"/>
                        </p>
                        <p>
                            Nome:
                            <input type="text"/>
                        </p>
                        <p>
                            Nome:
                            <input type="text"/>
                        </p>
                        <p>
                            Nome:
                            <input type="text"/>
                        </p>
                        <p>
                            Nome:
                            <input type="text"/>
                        </p>
                        <p>
                            Nome:
                            <input type="text"/>
                        </p>
                        <p>
                            Nome:
                            <input type="text"/>
                        </p>
                        <p>
                            Nome:
                            <input type="button">
                            
                        </p>
                        <p>
                            Nome:
                            <input type="date"/>
                        </p>
                        <p>
                            Nome:
                            <input type="time"/>
                        </p>
                        <p>
                             
                            <input type="submit" value="Avançar"/>
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