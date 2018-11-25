<html>
    <?php
    require_once './temp/head.phtml';
    require_once './temp/footer.phtml';

    new head();
    $Prod = array(0 => "Produto tal", 1 => "Item 1", 2 => "Item 2", 3 => "Item 3",4 =>null);
    ?>

    <body>
        <div id="fundo-p">

            <?php
            $obj = new menu();
            $obj->ativoMenu(0);
            ?>
            <div id="bloco-e">
                <div class="b-p b-c"><!--primeiro bloco e assim sucessivamente -->
                    <?php
                    
                    echo "$Prod[0]";
                    
                    ?>
                </div>

                <div class="b-s b-c">
                    Itens:
                    <ul>


                        <?php
                        echo "<li>"
                        . $Prod[1]
                        . "</li>"
                        . "<li>"
                        . $Prod[2]
                        . "</li>"
                        . "<li>"
                        . $Prod[3]
                        . "</li>";
                        ?>

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
			<br><br><br>
			
				<div id="t">
				<center>
				<img src="img/text3809.png" style="positon:relative; width:900px;" />
				</center>
				</div>


            </div>
            <?php
            new footer();
            ?>
        </div>

    </body>
</html>