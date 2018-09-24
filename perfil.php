<html lang="pt-br">
    <?php
    require_once './temp/head.phtml';
    require_once './temp/footer.phtml';

    new head();
    ?>
    <script>
        function altform(valor) {
            var formid = document.getElementById('action-perf');
            var def = document.getElementById('def');
            switch (valor) {
                case 1:
                    def.value = 3;
                    formid.action = "class/clienteDAO.php";
                    break;
                case 2:
                    def.value = 4;
                    formid.action = "class/clienteDAO.php";
                    break;


                default:
                    alert('erro');
                    break;

            }
        }
    </script>
    <body>
        <?php
        $obj = new menu();
        $obj->ativoMenu(5);
        ?>


        <!---->
        <div id="f-corpo">
            <div class="corpo">
                <form id ="action-perf" class="action-perf" method="POST" action="#">
                    <input type="hidden" value="" id="def" name="def"/>
                    <div id="bt-altexc">
                        <input value="Alterar" type="submit" onclick="altform(1);" id="alt" class="alt"/>
                        <input value="Deletar" type="submit" onclick="altform(2);" id="exc" class="exc"/>
                    </div>
                    <div class="cad">
                        <?php
                        session_start();
                        $templogin = $_SESSION['login'];
                        if ($templogin == '' || $templogin == null) {
                            session_abort();
                            echo "Efetue o login";

                            exit(0);
                        }
                        $_POST["def"] = 2;
                        require_once './class/clienteDAO.php';

                        session_abort();
                        ?>

                    </div>
                </form>
            </div>
            <?php
            new footer();
            ?>
        </div>


    </body>
</html>