<?php

/**
 * Description of sucesso:
 * Define o retorno da tela de sucesso e a respectiva mensagem
 *
 * @author Felipe
 */
class sucesso {

//    Função para erros de conexao, erros internos ou externos(Usuário)
//    $classsuc define a seleção do erro e a mensagem
    public function suc($classsuc) {
        switch ($classsuc) {
//            Classificassão dos erros de Conexao
//            
            case 1:
                $this->efetuarCadastro();
                break;
            case 2:
                $this->alterarRegistro();
                break;
            case 3:
                $this->deletarRegistro();
                break;
//            case 4:
//             Login();
//                break;
            default:
                break;
        }
    }

    public function efetuarCadastro() {

        $mens = "Ao efetuar o cadastro</BR>";
        $link = '../login.php';
        $mensLink = 'Login';
        $this->base($mens, $link, $mensLink);
    }

    public function alterarRegistro() {
        $mens = "Registro Alterado";
        $link = '../login.php';
        $mensLink = 'login';
        $this->base($mens, $link, $mensLink);
        session_start();
        session_destroy();
        session_abort();
    }

    public function deletarRegistro() {
        $mens = "Registro Excluido";
        $link = '../index.php';
        $mensLink = 'Página Inicial';
        $this->base($mens, $link, $mensLink);
        session_start();
        session_destroy();
        session_abort();
    }

    private function base($mens, $link = '', $mensLink = 'Proceguir') {
        $this->cabecalho();
        echo
        "<div class='float-cadc'>"
        . "<h1>Sucesso</h1>"
        . "<p>$mens</p>"
        . "<div class='float-c-bord' ></div>"
        . "<img src='../img/sucesso.png'/>"
        . "<a onClick='history.go(-1)' href='$link'><p >$mensLink</p></a>"
        . "</div>'";
        $this->rodape();
    }

    public function cabecalho() {
        echo "<html lang='pt-br'>"
        . "<head>"
        . "<meta charset='UTF-8'>"
        . "<meta name='viewport'>"
        . "<!-- content='width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1.2'-->"
        . "<link rel='shortcut icon' href='../img/icon/icpr.png'>"
        . "<title>Delivery</title>"
        . "<!--CSS-->"
        . "<link rel='stylesheet' type='text/css' href='../css/style.css'>"
        . "<link rel='stylesheet' type='text/css' href='../css/truefalse.css'>"
        . "<!--JS-->"
        . "<script type='text/javascript' src='../js/basic.js' defer='defer'></script>"
        . "<style>"
        . "</style>"
        . "</head>"
        . "<body>";
    }

    public function rodape() {
        echo "</body>
</html>";
        exit(0);
//        Exit necessario, pois a validação continua após identificar o erro
    }

}
