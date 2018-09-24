<?php
//Incluir a conexão com banco de dados
include_once 'conexao.php';

$valcpf = filter_input(INPUT_POST, 'valcpf', FILTER_SANITIZE_STRING);

//Pesquisar no banco de dados nome do usuario referente a valcpf digitada
$result_user = "SELECT * FROM `cliente` WHERE `cpf` LIKE '%$valcpf%' LIMIT 1";
$resultado_user = mysqli_query($conn, $result_user);

if(($resultado_user) AND ($resultado_user->num_rows != 0 )){
	
		echo "teste";
}else{
	echo "Nenhum usuário encontrado ...";
}
?>