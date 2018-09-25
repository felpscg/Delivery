<?php
session_start();
class menu {

    private $valAtv = array("", "", "", "", "", "", "");
    public $localLogo = "img/icon/icon.png";
    public $localNome = "img/dm.png";
    public $imgFundoPrinc = "img/Mapo-doufu-1680x1050.jpg";
    private $btLog = "";
    public $btCad = "";

    public function getValAtv($pos) {

        return $this->valAtv[$pos];
    }

    public function setValAtv($valAtv, $pos) {

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
    function setImgFundoPrinc($imgFundoPrinc) {
        $this->imgFundoPrinc = $imgFundoPrinc;
    }

        function __construct() {
            $valImg = random_int(1, 4);
       $this->setImgFundoPrinc("img/slide/".$valImg.".png");
    }
    
//            
    private function verSessao() {
        $tempAtv = $this->getValAtv(4);
        $tempAtv2 = $this->getValAtv(1);
        $setAtv2 = $this->getValAtv(2);
//            return header('location:login.php');
        $temp = "<a href='login.php' id='bt-log' class='$tempAtv'>login</a>";
        $crBtCad = "<a href='cad.php'><li class='menu-it $tempAtv2'>Cadastrar</li></a>";
        $crBtPerf = "<a href='perfil.php'><li class='menu-it $temp[1]'>Perfil</li></a>";
        $setAtv2 = $this->getValAtv(2);
        $setBtLogAtv = "<a href='./class/sairsessao.php' id='bt-log' class='$tempAtv'>logout</a>";
        if ((!isset($_SESSION['login']) == true) and ( !isset($_SESSION['senha']) == true)) {
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            $this->setBtCad($crBtCad);
            $this->setBtLog($temp);
            return 1;
        } elseif ((isset($_SESSION['login']) == true) and ( isset($_SESSION['senha']) == true)) {
            $nomeUser = $_SESSION['nome'];

            echo "<div id ='nome-u'>Bem Vindo $nomeUser</div>";

            $this->setBtCad($crBtPerf);
            $this->setBtLog($setBtLogAtv);
            return 0;
        } else {
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
                $this->setValAtv($at, 0);
              session_start();
                
                $this->verSessao();
                break;

            case 1:
                session_start();
                $this->setValAtv($at, 1);
                $temp = $this->getValAtv(1);
                $temp2 = "<a href='cad.php'><li class='menu-it $temp'>Cadastrar</li></a>";
                $this->setBtCad($temp2);
                break;

            
            case 2:
                session_start();
                $this->setValAtv($at, 2);
                $this->verSessao();
                break;

            case 3:
                session_start();
                $this->setValAtv($at, 3);
                $this->verSessao();
                break;

            case 4:
                session_start();
                $this->setValAtv($at, 4);
                
                //logar
                break;
            
            case 5:
                session_start();
                $this->setValAtv($at, 5);
                $ValAtv = $this->getValAtv(5);
                $crBtPerf = "<a href='perfil.php'><li class='menu-it $ValAtv'>Perfil</li></a>";
                $this->setBtCad($crBtPerf);
                break;
            case 6:
                
                break;
            

            /*      case 5:
              $valAtv[3] = "ativo";

              break;
             */
            default:
                echo "<script>alert('Erro ao carregar Menu')</script>";
                break;
        }
        
        
        $temp = array($this->getValAtv(0), $this->getValAtv(1), $this->getValAtv(2), $this->getValAtv(3));
        $temp2 = $this->getBtCad();
        $btLog = $this->getBtLog();
        echo "
        $imgF
            <div id='fundo-ps' class='degradefixo'>
    	<div id='fundo-psf' class='degradem'>
    	<img id='img-d' class='img-d' src='$this->localLogo'/>
    	<img id='img-dm'class='img-dm' src='$this->localNome'/>

        <div id='menu'>
    	$btLog
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
session_abort();
?>