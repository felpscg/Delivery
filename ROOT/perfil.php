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
        $obj = new menu();
        $obj->ativoMenu(5);
        
        ?>


        <!--2 O endereço deverá conter os seguintes campos: Rua*, Número*, CEP*, bairro*, cidade*, UF*, complemento.-->
        <div id="f-corpo">
            <div class="corpo">
                <form method="POST" action="class/cons.php">
                    <fieldset class="cad"><legend><h2>teste</h2></legend>
                        <?php
                        $_POST["def"] = 2;
                        require_once './class/cadastrarCliente.php';
                        ?>

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