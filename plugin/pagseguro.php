<?php

vendaPagSeguroVerifica();

function vendaPagSeguroVerifica() {

//conecta na sessão existente
    require_once '../class/conBD.php';
    $obg = new conBD();
    $contemp = $obg->conBD();
// session_start inicia a sessão
    session_start();
// as variáveis login e senha recebem os dados digitados na página anterior
    $login = $_SESSION['login'];
    $senha = $_SESSION['senha'];
    $templogin = $login;
    $tempsenha = md5($senha);
    $result = mysqli_query($contemp, "SELECT * FROM `cliente` WHERE `email` = '$templogin' OR `cpf` = '$templogin' AND `senha`= '$tempsenha'") or die(mysqli_error($contemp));
    /*  verifica se a variável $result foi executado com sucesso se o contrario ele recarrega a página */
    if (mysqli_num_rows($result) == 1) {
        $registro = mysqli_fetch_assoc($result);
        $_SESSION['nome'] = $registro['nomecliente'];
        $_SESSION['login'] = $templogin;
        $_SESSION['senha'] = $senha;

        vendaPagSeguro();
    } else {
        unset($_SESSION['login']);
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);
        echo"<script>"
        . "alert('Efetue o Login para efetuar a compra');"
        . "history.go(-1);"
        . "</script>";
    }
}

function vendaPagSeguro($nome = '', $cpf = '', $email = '', $telefone = '', $cep = '', $numeroend = '') {
    $token = '71CB1A7838E54539A81E9563D1A262A0';
    $emailPagamento = 'felipefelpgomes42@gmail.com';
    foreach ($_POST as $key => $value) {
        if ($_POST[$key] != NULL OR $_POST[$key] != "") {
            $comando = "\$" . $key . "='" . $value . "';";
            echo $comando . "<br>";
        }
    }
    $limProd = true;
    while ($limProd) {
        $i=1;
        $cmd = "\$produto$i";
        $cmd=eval($cmd);
        if (isset($produto)) {
            $i++;
            $limProd = true;
            $total=i;
        }
        else{
            $limProd=false;
            return;
        }
    }
    $data['token'] = $token;
    $data['email'] = $emailPagamento;
    $data['currency'] = 'BRL';
    
    $data['itemId1'] = '0000001';
    $data['itemQuantity1'] = '2';
    $data['itemDescription1'] = 'teste';
    $data['itemAmount1'] = '3.00';
    
    $data['itemId2'] = '0000002';
    $data['itemQuantity2'] = '3';
    $data['itemDescription2'] = 'teste2';
    $data['itemAmount2'] = '4.00';
    
    $data['itemId3'] = '0000003';
    $data['itemQuantity3'] = '3';
    $data['itemDescription3'] = 'teste3';
    $data['itemAmount3'] = '5.00';
    
    $data['senderName'] = $nome;
    $data['senderCPF'] = $cpf;

    $data['senderAreaCode'] = '14';
    $data['senderPhone'] = '998902807';

    $data['senderEmail'] = $email;
    $data['shippingAddressPostalCode'] = $cep;
    $data['shippingAddressNumber'] = $numeroend;
    $data['shippingType'] = '1';

    $url = 'https://ws.pagseguro.uol.com.br/v2/checkout';
    /*
      curl https://ws.pagseguro.uol.com.br/v2/checkout/ -d\
      "email=suporte@lojamodelo.com.br\
      &token=95112EE828D94278BD394E91C4388F20\
      &currency=BRL\
      &itemId1=0001\
      &itemDescription1=Notebook Prata\
      &itemAmount1=24300.00\
      &itemQuantity1=1\
      &itemWeight1=1000\
      &itemId2=0002\
      &itemDescription2=Notebook Rosa\
      &itemAmount2=25600.00\
      &itemQuantity2=2\
      &itemWeight2=750\
      &reference=REF1234\
      &senderName=Jose Comprador\
      &senderAreaCode=11\
      &senderPhone=56273440\
      &senderEmail=comprador@uol.com.br\
      &shippingType=1\
      &shippingAddressStreet=Av. Brig. Faria Lima\
      &shippingAddressNumber=1384\
      &shippingAddressComplement=5o andar\
      &shippingAddressDistrict=Jardim Paulistano\
      &shippingAddressPostalCode=01452002\
      &shippingAddressCity=Sao Paulo\
      &shippingAddressState=SP\
      &shippingAddressCountry=BRA"
     */


    $data = http_build_query($data);

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    $xml = curl_exec($curl);

    curl_close($curl);

    $xml = simplexml_load_string($xml);

    if ($xml == 'Unauthorized') {
        $return = 'Não Autorizado';
        echo $return;
        exit;
    }


    if (count($xml->error) > 0) {
        $return = 'Dados Inválidos ' . $xml->error->message;
        echo $return;
        exit;
    }
    echo $xml->code;
}

?>