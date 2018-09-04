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
            $obj->ativoMenu(2);
            ?>
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
