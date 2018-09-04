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
        <?php
        session_start();
        if ((!isset($_SESSION['login']) == true) and ( !isset($_SESSION['senha']) == true)) {
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            return header('location:login.php');
        }
        $logado = $_SESSION['login'];
        ?>

    </head>

    <body>
        <div id="fundo-p">
            <?php
  echo" Bem vindo $logado";
  ?>
            <?php
            $obj = new menu();
            $obj->ativoMenu(2);
            ?>
           
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
