<html>
    <?php
    require_once './temp/head.phtml';
    require_once './temp/footer.phtml';
    new head();
    require_once './class/menu.php';
    ?>
    <!--
    no checkboxsera enviado primiro o num item e apos o codigo
    -->
    <style>
        #menuprod{
            position: relative;
            width: 100%;
            height: 30px;
            background-color: #500;
        }
        .m-prod{
            position: relative;
            height:auto;
            width: auto;
            margin-top: 2px;
            padding: 1px 0.5em 0.5em 1em;
            display: block;
            float:left;
            font-size: 1.2em;
            color:#ccc;
        }
        /*                .m-prod-atv{
                            margin-top: 0px;
                            height: 15px;
                            border-top: 2px;
                            border-bottom: 2px;
                            border-left: 0px;
                            border-right: 0px;
                            border-style: solid;
                            border-color:#500;
                            border-bottom-color: #fff;
                            background: #fff;
                            color: #400;
                        }*/
        .m-prod:hover{
            margin-top: 0px;
            height: 15px;
            border-top: 2px;
            border-bottom: 2px;
            border-left: 0px;
            border-right: 0px;
            border-style: solid;
            border-color:#500;
            border-bottom-color: #fff;
            background: #fff;
            color: #400;
        }
        .produto{
            position: relative;
            display: block;
        }

    </style>
    <script>



        var itensM = document.getElementById("prod-c");


        function atvMarmita() {
            atvAdicional();
            var menuM = document.getElementById("m-prod-m").style;
            var itensA = document.getElementById("prod-c").style;
            var itensM = document.getElementById("marm-c").style;
//            menuM.margin.top = "0px";
            menuM.height = "15px";
//            menuM.border.top = "2px";
            menuM.border.bottom = "2px";
            menuM.border.left = "0px";
            menuM.border.right = "0px";
            menuM.border.style = "solid";
            menuM.border.color = "#500";
//                    menuM.border.bottom.color= "#fff";
            menuM.background = "#fff";
            menuM.color = "#400";

            itensM.display = "block";
            itensA.display = "none";

            desAdicional();
        }

        function atvAdicional() {
            var menuA = document.getElementById("m-prod-a").style;
            var itensA = document.getElementById("prod-c").style;
            var itensM = document.getElementById("marm-c").style;

//            menuA.margin-top = "0px";
            menuA.height = "15px";
            menuA.border.top = "2px";
            menuA.border.bottom = "2px";
            menuA.border.left = "0px";
            menuA.border.right = "0px";
            menuA.border.style = "solid";
            menuA.border.color = "#500";
//                    menuA.border.bottom.color= "#fff";
            menuA.background = "#fff";
            menuA.color = "#400";
            itensM.display = "none";
            itensA.display = "block";
            desMarmita();
        }



        function desMarmita() {
            var menuM = document.getElementById("m-prod-m").style;

            menuM.border.bottom = "2px";
            menuM.border.left = "0px";
            menuM.border.right = "0px";
            menuM.border.style = "transparent";
            menuM.border.color = "#500";
            menuM.background = "#500";
            menuM.color = "#ccc";


        }

        function desAdicional() {
            var menuA = document.getElementById("m-prod-a").style;

            menuA.border.bottom = "2px";
            menuA.border.left = "0px";
            menuA.border.right = "0px";
            menuA.border.style = "transparent";
            menuA.border.color = "#500";
            menuA.background = "#500";
            menuA.color = "#ccc";

        }
    </script>


    <body onload="atvMarmita();">
        <script defer="defer">
            function enviaPagseguro() {
                $.post('./plugin/pagseguro.php', '', function (data) {

                    $('#code').val(data);
                    $('#comprar').submit();
                })
            }
        </script>


        <div id="fundo-p">
            <?php
            $obj = new menu();
            $obj->ativoMenu(2);
            ?>

            <div style="border: 1px solid #000" id="" >
                teste
                <form id="comprar" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="PagSeguroLightbox(this);
                        return false;">
                    <div style="border: 1px solid #000" class="corpo">
                        <div>
                            <div id="menuprod">
                                <!--menu-produto-marmita-->
                                <div id="m-prod-m" class="m-prod " onclick="atvMarmita();">Marmita</div>
                                <div id="m-prod-a" class="m-prod" onclick="atvAdicional();">Adicionais</div>
                            </div>

                            <div>
                                <div id="marm-c">

                                    <div class="produto">
                                        <br>
                                        <label>Nome: Marmita Especial da Casa</label>
                                        <input type="hidden" name="nomeprod1" value="Marmita Especial da Casa"/>
                                        <br>
                                        <label>Descriçao: arroz, feijao, ...</label>
                                        <br>
                                        <label>Quantidade: <input style="width:35px; padding: 1px;" type="number" name="qtdprod1" value="1"></label>
                                        <label>tamanho: </label>
                                        <label><input name="tamanhoprod1" type="range" min="1" value="2" max="3"/>
                                        </label>
                                        <br>
                                        <label>Valor: R$: <input type="text" name="precoprod1" value="3.00" size="3" disabled="true"/></label>
                                        <input type="checkbox" name="produto" value="1" onselect=""/>
                                                                        <!--value recebe o códgo do produto-->
                                        
                                    </div>
                                </div>

                                <div id="prod-c">
                                    <div class="produto">
                                        Nome: Coca-Cola
                                        Descriçao: 300 ml 
                                        Valor: R$: 3,00
                                        <input type="checkbox" value="3.5"/>
                                    </div>
                                    <div class="produto">
                                        Nome: Salada
                                        Descriçao: Alface, tomate, azeite
                                        Valor: R$: 1,5
                                        <input type="checkbox" value="1,5"/>
                                    </div>


                                </div>

                            </div>

                        </div>

                    </div>
                    
                    <div>

                        <label>Observaçoes:
                            <textarea rows="4" cols="20"></textarea>
                        </label>
                        <!--Quantidade total dos produtos-->
                        <input type="hidden" name="qtdprod" />
                        <label> Valor total: R$: <input type="text" size="3" id="valort" name="valort" value="0,00"/></label>
                        
                        <button onclick="enviaPagseguro()">Comprar</button>
                        <label>Codigo Token<input type="text" name="code" id="code" value="" /></label>
                    </div>
                </form>
                <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
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
