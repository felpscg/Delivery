<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Produto de teste</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>

function enviaPagseguro(){
$.post('pagseguro.php','',function(data){
$('#code').val(data);
$('#comprar').submit();
})
}

</script>

</head>

<body>
<div>
<h1>Produto de teste</h1>
<p> 299,00</p>

</div>
<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form action="https://pagseguro.uol.com.br/checkout/v2/cart.html?action=add" method="post" onsubmit="PagSeguroLightbox(this); return false;">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="itemCode" value="34016E4E2D2D16D114599FB2D7D7FDC3" />
<input type="hidden" name="iot" value="button" />
<input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/180x25-comprar-preto.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->

</body>
</html>