<?php 
//conecta na sessão existente
require_once './conBD.php';
$obg =new conBD();
$temp = $obg->conBD();
// session_start inicia a sessão
session_start();
// as variáveis login e senha recebem os dados digitados na página anterior
$login = $_POST['login'];
$senha = $_POST['senha'];


//codifica em base 64 e executa comando sql de busca
$templogin = base64_encode($login);
$tempsenha = md5($senha);
$result = mysqli_query($temp, "SELECT * FROM `CLIENTES` WHERE `APELIDO` = '$templogin' AND `SENHA`= '$tempsenha'");
/* Logo abaixo temos um bloco com if e else, verificando se a variável $result foi 
bem sucedida, ou seja se ela estiver encontrado algum registro idêntico o seu valor
será igual a 1, se não, se não tiver registros seu valor será 0. Dependendo do 
resultado ele redirecionará para a página site.php ou retornara  para a página 
do formulário inicial para que se possa tentar novamente realizar o login */
if(mysqli_num_rows($result) == 1 ){
$_SESSION['login'] = base64_decode($templogin);
$_SESSION['senhamd5'] = $tempsenha;

header('location:../menuitem.php');
}
else{
//    echo $result;
//    exit();
  unset ($_SESSION['login']);
  unset ($_SESSION['senha']);
  header('location:../login.php');
   
  }
?>