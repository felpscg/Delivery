<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>CheckBox Selecionados</title>
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    </head>
    <body>
        <?php
        require_once './class/conBD.php';
        $obg = new conBD();
        $contemp = $obg->conBD();

        $cmd = "SELECT * from (SELECT TEMP.codproduto AS CODPRODP, 
			TEMP.nomeproduto AS NOMEPRODP, 
			TEMP.descproduto AS DESCPRODP, 
			TEMP.precoprod AS PRECOPRODP, 
			TEMP.quantidade AS QTDPRODTOTALP
		FROM bddelivery.cardapio AS C, (
			SELECT * FROM produto, cardapio 
			WHERE produto.`codproduto` = cardapio.ceproduto1 and cardapio.datacardapio= (
				SELECT CURRENT_DATE()) ) AS TEMP
	 	GROUP BY TEMP.codproduto) AS P,

(SELECT TEMP.codproduto AS CODPRODS, 
			TEMP.nomeproduto AS NOMEPRODS,
 			TEMP.descproduto AS DESCPRODS, 
 			TEMP.precoprod AS PRECOPRODS, 
 			TEMP.quantidade AS QTDPRODTOTALS
		FROM bddelivery.cardapio AS C, (
			SELECT * FROM produto, cardapio 
			WHERE produto.`codproduto` = cardapio.ceproduto2 and cardapio.datacardapio= (
				SELECT CURRENT_DATE()) ) AS TEMP
	 	GROUP BY TEMP.codproduto) AS S;
";
        $result = mysqli_query($contemp, $cmd) or die("Erro" . mysqli_error($contemp));
        echo mysqli_num_rows($result);
        if (mysqli_num_rows($result) == 1) {
            $registro = mysqli_fetch_assoc($result);
//      Primeiro Item
            foreach ($registro as $key => $val) {

                $comando = "\$" . $key . "='" . $val . "';";
                echo $comando . "<br>";

                eval($comando);
            }
            criaItem(1, $NOMEPRODP, $DESCPRODP, $PRECOPRODP, $CODPRODP, $QTDPRODTOTALP);
            if ($CODPRODP != null || $CODPRODP != '') {
                criaItem(2, $NOMEPRODS, $DESCPRODS, $PRECOPRODS, $CODPRODS, $QTDPRODTOTALS);
            }
        } else {
            echo "Não há cardápio registrado";
        }

        function criaItem($numItem, $NOMEPROD, $DESCPROD = '', $PRECOPROD, $CODPROD, $QTDPRODTOTAL) {
            echo "<div class='produto'>
                <br>
                <label>Nome: $NOMEPROD</label>
                <input type='hidden' name='nomeprod$numItem' value='$NOMEPROD'/>
                <br>
                <label>Descriçao: $DESCPROD</label>
                <br>
                <label>Quantidade: <input style='width:35px; padding: 1px;' type='number' name='qtdprod$numItem' value='1' min='1' max=$QTDPRODTOTAL></label>
                <label>tamanho: </label>
                <label><input name='tamanhoprod$numItem' id='tamanhoprod$numItem' type='range' min='1' value='2' max='3' oninput='sTamanho$numItem();'/>
                               
                </label><br>
                <span id='tamanhoad$numItem'></span> 
                <br>
                Valor: R$: <span id='evalorp$numItem'>$PRECOPROD</span>
                <input type='hidden' name='valorprod$numItem' id='valorprod$numItem'  value='$PRECOPROD' size='3'  /></label>
                <input type='checkbox' name='produto[]' value='$CODPROD' onselect=''/>
                <!--value recebe o códgo do produto-->

            </div>"
                    . ""
                    . "<script defer='defer'>


                        function sTamanho$numItem() {
                            var tamanho = document.getElementById('tamanhoprod$numItem').value;
                            var adt = document.getElementById('tamanhoad$numItem');
                            var preco = document.getElementById('valorprod$numItem').value;
                            var adv = document.getElementById('evalorp$numItem');
                            
                            switch (tamanho) {
                                case '1':
                                    adt.innerHTML = 'Pequeno';
                                    adv.innerHTML=parseFloat(preco)-2;
                                    break;
                                case '2':
                                    adt.innerHTML = 'Médio';
                                    adv.innerHTML=preco;
                                    break;
                                case '3':
                                    adt.innerHTML = 'Grande';
                                    valt = parseFloat(preco)+2;
                                    adv.innerHTML=valt;
                                    break;

                                default:
                                    alert('Erro');
                                    break;
                            }
                        }"
                    . " </script>";
        }
        ?>
        <!--    
        
        SELECT * from (SELECT TEMP.codproduto AS CODPRODP, 
                                TEMP.nomeproduto AS NOMEPRODP, 
                                TEMP.descproduto AS DESCPRODP, 
                                TEMP.precoprod AS PRECOPRODP, 
                                TEMP.quantidade AS QTDPRODTOTALP
                        FROM bddelivery.cardapio AS C, (
                                SELECT * FROM produto, cardapio 
                                WHERE produto.`codproduto` = cardapio.ceproduto1 and cardapio.datacardapio= (
                                        SELECT CURRENT_DATE()) ) AS TEMP
                        GROUP BY TEMP.codproduto) AS P,
        
        (SELECT TEMP.codproduto AS CODPRODS, 
                                TEMP.nomeproduto AS NOMEPRODS,
                                TEMP.descproduto AS DESCPRODS, 
                                TEMP.precoprod AS PRECOPRODS, 
                                TEMP.quantidade AS QTDPRODTOTALS
                        FROM bddelivery.cardapio AS C, (
                                SELECT * FROM produto, cardapio 
                                WHERE produto.`codproduto` = cardapio.ceproduto2 and cardapio.datacardapio= (
                                        SELECT CURRENT_DATE()) ) AS TEMP
                        GROUP BY TEMP.codproduto) AS S;
        
        
        
        
        SELECT TEMP.codproduto AS CODPRODP, 
                                TEMP.nomeproduto AS NOMEPRODP, 
                                TEMP.descproduto AS DESCPRODP, 
                                TEMP.precoprod AS PRECOPRODP, 
                                TEMP.quantidade AS QTDPRODTOTALP
                        FROM bddelivery.cardapio AS C, (
                                SELECT * FROM produto, cardapio 
                                WHERE produto.`codproduto` = cardapio.ceproduto1 and cardapio.datacardapio= (
                                        SELECT CURRENT_DATE()) ) AS TEMP
                        GROUP BY TEMP.codproduto;
        
        SELECT TEMP.codproduto AS CODPRODS, 
                                TEMP.nomeproduto AS NOMEPRODS,
                                TEMP.descproduto AS DESCPRODS, 
                                TEMP.precoprod AS PRECOPRODS, 
                                TEMP.quantidade AS QTDPRODTOTALS
                        FROM bddelivery.cardapio AS C, (
                                SELECT * FROM produto, cardapio 
                                WHERE produto.`codproduto` = cardapio.ceproduto2 and cardapio.datacardapio= (
                                        SELECT CURRENT_DATE()) ) AS TEMP
                        GROUP BY TEMP.codproduto;    
        -->

        <form action="#" method="POST">

            <!--            <div class="produto">
                            <br>
                            <label>Nome: Marmita Especial da Casa</label>
                            <input type="hidden" name="nomeprod1" value="Marmita Especial da Casa"/>
                            <br>
                            <label>Descriçao: arroz, feijao, ...</label>
                            <br>
                            <label>Quantidade: <input style="width:35px; padding: 1px;" type="number" name="qtdprod1" value="1"></label>
                            <label>tamanho: </label>
                            <label><input name="tamanhoprod1" id="tamanhoprod1" type="range" min="1" value="2" max="3" oninput="sTamanho();"/>
                                
            
                               
                                <span id="tamanhoad1"></span>
                            </label>
                            <br>
                            <label>
                                Valor: R$: <span id="evalorp1"></span>
                                <input type="hidden" name="valorprod1" id="valorprod1" value="3.00" size="3" />
                            </label>
                            <input type="checkbox" name="produto[]" value="1" onselect=""/>
                            value recebe o códgo do produto
            
                        </div>-->


<!--
            <div class="produto">
                <br>
                <label>Nome: Marmita Especial da Casa</label>
                <input type="hidden" name="nomeprod2" value="Marmita Especial da Casa"/>
                <br>
                <label>Descriçao: arroz, feijao, ...</label>
                <br>
                <label>Quantidade: <input style="width:35px; padding: 1px;" type="number" name="qtdprod2" value="1"></label>
                <label>tamanho: </label>
                <label><input name="tamanhoprod2" type="range" min="1" value="2" max="3"/>
                </label>
                <br>
                <label>Valor: R$: <span>3.00</span><input type="hidden" name="valorprod2" value="3.00" size="3" /></label>
                <input type="checkbox" name="produto[]" value="2" onselect=""/>
                value recebe o códgo do produto

            </div>-->

            <input type="submit" value="Verificar" id="btnverificar" name="btnverificar">    
        </form>


        <?php
        $totalItens = 0;
        foreach ($_POST as $key => $value) {

            if ($_POST[$key] != NULL OR $_POST[$key] != "") {
                $comando = "\$" . $key . "='" . $value . "';";

//                echo $comando . "<br>";
                eval($comando);
                if ($key == "produto") {
                    $Produto = $_POST["produto"];
                    foreach ($Produto as $key => $value) {
//                        echo $comando = "\$" . $key . "='" . $value . "';";
                        $totalItens = $totalItens + 1;
                    }
                }
            }
        }


        $limProd = true;
        $i = 1;
        while ($totalItens >= $i) {
            $numProd = $Produto[$i - 1];
            $tempqtd = $_POST["qtdprod$i"];
            $tempvalor = $_POST["valorprod$i"];
            $temptamanho = $_POST["tamanhoprod$i"];
            $tempnome = $_POST["nomeprod$i"];
            $cmd = "\$data['itemId$i'] = '$numProd';<br>"
                    . "\$data['itemQuantity$i'] = '$tempqtd';<br>"
                    . "\$data['itemDescription$i'] = '$tempnome . $temptamanho';<br>"
                    . "\$data['itemAmount$i'] = '$tempvalor';<br>";

            echo $cmd;
            $i++;
        }
        ?>

    </body>
</html>