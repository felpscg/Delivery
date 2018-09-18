<!------------------------------------>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport">
        <!-- content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1.2"-->
        <link rel="shortcut icon" href="img/icon/icpr.png">
        <title>teste</title>

        <!--CSS-->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/truefalse.css">

        <!--JS-->
        <!-- <link type="text/javascript" href="js/basic.js"> -->
        <script type="text/javascript" src="js/basic.js" defer="defer"></script>
        <script charset="utf-8" type="text/javascript" src="js/cep.js" defer="defer"></script>

        <?php
        require_once './class/menu.php';
        ?>
        <style>
    
            
        </style>
    </head>

    <body>

        <?php
//        session_start();
//        session_destroy();
//        session_abort();
//        $obj = new menu();
//        $obj->ativoMenu(1);
//        session_start();
//        foreach ($_SESSION as $key => $value) {
//            echo $_SESSION[$key];
//        }
        ?>


        <div class="float-cadc">
        <p>Cadastro não efetuado pela ocorrencia de um</p><h1>Erro</h1>
        <div class="float-c-bord" ></div>
        <img src="./img/sucesso.png"/>
        <a onClick="history.go(-1)" ><p >Voltar</p></a>
        </div>
    </body>
</html>