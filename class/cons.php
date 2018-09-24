<?php

//conecta na sessão existente
require_once './conBD.php';
$obg = new conBD();
$contemp = $obg->conBD();
// session_start inicia a sessão
session_start();
// as variáveis login e senha recebem os dados digitados na página anterior
$login = $_POST['login'];
$senha = $_POST['senha'];


//codifica em base 64 e executa comando sql de busca
$templogin = $login;
$tempsenha = md5($senha);
$result = mysqli_query($contemp, "SELECT * FROM `cliente` WHERE `email` = '$templogin' OR `cpf` = '$templogin' AND `SENHA`= '$tempsenha'") or die(mysqli_error($contemp));
/*  verifica se a variável $result foi executado com sucesso se o contrario ele recarrega a página*/
if ( mysqli_num_rows($result) == 1) {
    $_SESSION['login'] = $templogin;
    $_SESSION['senha'] = $senha;

    header('location:../menuitem.php');
} else {
//    echo $result;
//    exit();
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    echo "email ou senha incorretos";
    // pagina de erro para retornar
    //echo "teste";
}
?>