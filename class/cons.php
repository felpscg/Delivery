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



$templogin = $login;
$tempsenha = md5($senha);
$result = mysqli_query($contemp, "SELECT * FROM `cliente` WHERE `email` = '$templogin' OR `cpf` = '$templogin' AND `senha`= '$tempsenha'") or die(mysqli_error($contemp));
/*  verifica se a variável $result foi executado com sucesso se o contrario ele recarrega a página */
if (mysqli_num_rows($result) == 1) {
    $registro = mysqli_fetch_assoc($result);
    $_SESSION['nome'] = $registro['nomecliente'];
    $_SESSION['login'] = $templogin;
    $_SESSION['senha'] = $senha;
    header('location:../perfil.php');
} else {
    unset($_SESSION['login']);
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    echo"<script>"
    . "alert('Login ou Senha incorretos');"
    . "history.go(-1);"
    . "</script>";
}
?>