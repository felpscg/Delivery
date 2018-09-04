<?php

class menu {
    private $valAtv = array("", "", "", "", "");
    public $localLogo = "img/icon/icon.png";
    public $localNome = "img/dm.png";
    public $imgFundoPrinc = "img/Mapo-doufu-1680x1050.jpg";
    private $btLog = "";
    public $btCad = "";
    public function getValAtv($pos) {
        
        return $this->valAtv[$pos];
    }

    public function setValAtv($valAtv,$pos) {
        
        $this->valAtv[$pos] = $valAtv;
    }
    

        function getBtLog() {
        return $this->btLog;
    }

    function setBtLog($btLog) {
        $this->btLog = $btLog;
    }

    function getBtCad() {
        return $this->btCad;
    }

    function setBtCad($btCad) {
        $this->btCad = $btCad;
    }


//            
    private function verSessao() {

        if ((!isset($_SESSION['login']) == true) and ( !isset($_SESSION['senha']) == true)) {
            unset ($_SESSION['login']);
            unset ($_SESSION['senha']);
            
//            return header('location:login.php');
            $temp = "<a href='login.php' id='bt-log' class='$this->getValAtv(4)'>login</a>";
            $temp2= "<a href='cad.php'><li class='menu-it $temp[1]'>Cadastrar</li></a>";
            $this->setBtCad($temp2);
            $this->setBtLog($temp);
            return 1;
            }
            elseif ( (isset ($_SESSION['login']) == true) and (isset ($_SESSION['senha']) == true)) {
                $temp = $_SESSION['login'];
                echo "<div>Bem Vindo $temp</div>";
                $temp2= "<a href='perfil.php'><li class='menu-it $temp[1]'>Perfil</li></a>";
            $this->setBtCad($temp2);
                $temp = "<a href='./class/sairsessao.php' id='bt-log' class='$valAtv[4]'>logout</a>";
            $this->setBtLog($temp);
            return 0;
            }
            
         else{
             return -1;
         }   
    }

    
            
    function ativoMenu($valorAtivo) {
        $at = "ativo";


        $imgF = "<img class='img-fundo' src='$this->imgFundoPrinc'/>";
        
        if ($valorAtivo != 0)
            $imgF = NULL;
        switch ($valorAtivo) {
            case 0:
                $this->setValAtv($at,0);
//              session_start();
                session_start();
                $this->verSessao();
                break;

            case 1:
                $this->setValAtv($at,1);
                $temp = $this->getValAtv(1);
            $temp2= "<a href='cad.php'><li class='menu-it $temp'>Cadastrar</li></a>";
            $this->setBtCad($temp2);
                break;

            case 2:
                $this->setValAtv($at,2);
                session_start();
                $this->verSessao();
                break;

            case 3:
                $this->setValAtv($at,3);
                session_start();
                $this->verSessao();
                break;

            case 4:
                $this->setValAtv($at,4);
                session_destroy();
                //logar
                break;

            /*      case 5:
              $valAtv[3] = "ativo";

              break;
             */
            default:
                echo "<h1>Erro ao carregar Menu</h1>";
                break;
        }
$temp = array($this->getValAtv(0),$this->getValAtv(1),$this->getValAtv(2),$this->getValAtv(3));
$temp2 = $this->getBtCad();
        echo "
        $imgF
            <div id='fundo-ps'class='degradefixo'>
    	<div id='fundo-psf'class='degradem'>
    	<img id='img-d' class='img-d' src='$this->localLogo'/>
    	<img id='img-dm'class='img-dm' src='$this->localNome'/>

        <div id='menu'>
    	$this->btLog
            <div>$nome</div>
            <ul>
                <a href='index.php'><li class='menu-it $temp[0]'>Inicio</li></a>
                $temp2
                <a href='menuitem.php'><li class='menu-it $temp[2]'>Menu</li></a>
                <a href='sobre.php'><li class='menu-it $temp[3]'>Sobre</li></a>
            </ul>

        </div>
    	</div>"
        . "</div>";
        return;
    }

}

?>