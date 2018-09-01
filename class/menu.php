<?php

class menu {

    public $localLogo = "img/icon/icon.png";
    public $localNome = "img/dm.png";
    public $imgFundoPrinc = "img/Mapo-doufu-1680x1050.jpg";

    function ativoMenu($valorAtivo) {
        $imgF = "<img class='img-fundo' src='$this->imgFundoPrinc'/>";
        $valAtv = array("", "", "", "");
        if ($valorAtivo != 0)
            $imgF = NULL;
        switch ($valorAtivo) {
            case 0:
                $valAtv[0] = "ativo";


                break;

            case 1:
                $valAtv[1] = "ativo";

                break;

            case 2:
                $valAtv[2] = "ativo";

                break;

            case 3:
                $valAtv[3] = "ativo";

                break;

            case 4:
                $valAtv[3] = "ativo";
                //perfil
                break;

            /*      case 5:
              $valAtv[3] = "ativo";

              break;
             */
            default:
                echo "<h1>Erro ao carregar Menu</h1>";
                break;
        }

        echo "
        $imgF
            <div id='fundo-ps'class='degradefixo'>
    	<div id='fundo-psf'class='degradem'>
    	<img id='img-d' class='img-d' src='$this->localLogo'/>
    	<img id='img-dm'class='img-dm' src='$this->localNome'/>

        <div id='menu'>
    	<a href='' id='bt-log'>login</a>
            <ul>
                <a href='index.php'><li class='menu-it $valAtv[0]'>Inicio</li></a>
                <a href='cad.php'><li class='menu-it $valAtv[1]'>Cadastrar</li></a>
                <a href='menuitem.php'><li class='menu-it $valAtv[2]'>Menu</li></a>
                <a href='sobre.php'><li class='menu-it $valAtv[3]'>Sobre</li></a>
            </ul>

        </div>
    	</div>"
                . "</div>";
        return;
    }

}

?>