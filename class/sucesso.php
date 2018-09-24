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
//            1 = Conexao com o BD
//            2 = suco de sintaxe SQL
//            
            case 1:
                $this->efetuarCadastro($classsuc);
                break;
            case 2:
                $this->alterarRegistro($classsuc);
                break;
            case 3:
                $this->deletarRegistro();
                break;
            case 4:
//                Login();
                break;
            default:
                break;
        }
    }

    public function errocon($valerro) {

        $mens = "Ocorreu alguma falha </BR><a href=''>Relatar Problema</a>suco-> $valerro";
        $this->base($mens);
    }

    public function cadrepetido() {
        $mens = "CPF ou E-mail ja cadastrado";
        $this->base($mens);
    }

    public function campoObg() {
        $mens = "Retorne e preencha corretamente os campos obrigatórios";
        $this->base($mens);
    }

    public function base($mens) {
        $this->cabecalho();
        echo
        "<div class='float-cadc'>"
        . "<h1>Seucesso</h1>"
        . "<p>$mens</p>"
        . "<div class='float-c-bord' ></div>"
        . "<img src='../img/falha.png'/>"
        . "<a onClick='history.go(-1)' ><p >Voltar</p></a>"
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
