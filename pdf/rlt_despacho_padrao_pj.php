<?php

//require '../include/';
   require_once("../funcoes/funcoesConecta.php");
   require_once("../funcoes/funcoesGerais.php");
   require_once("../funcoes/funcoesSiscontrat.php");

//CONEXÃO COM BANCO DE DADOS 
   $conexao = bancoMysqli();

//CONSULTA 
$id_ped=$_GET['id'];
$linha_tabelas = siscontrat($id_ped);
$pj = siscontratDocs($linha_tabelas['IdProponente'],2);

$codPed = $id_ped;
$objeto = $linha_tabelas["Objeto"];
$local = $linha_tabelas["Local"];
$ValorGlobal = $linha_tabelas["ValorGlobal"];
$ValorPorExtenso = valorPorExtenso($linha_tabelas["ValorGlobal"]); 
$periodo = $linha_tabelas["Periodo"];
$duracao = $linha_tabelas["Duracao"];
$dataAtual = date("d/m/Y");
$NumeroProcesso = $linha_tabelas["NumeroProcesso"];
$FormaPagamento = $linha_tabelas["FormaPagamento"];
$assinatura = $linha_tabelas["Assinatura"];
$cargo = $linha_tabelas["Cargo"];
$amparo = $linha_tabelas["AmparoLegal"];
$final = $linha_tabelas["Finalizacao"];
$complementoDotacao = $linha_tabelas["ComplementoDotacao"];

$pjRazaoSocial = $pj["Nome"];
$pjCNPJ = $pj["CNPJ"];

$setor = $linha_tabelas["Setor"];

$ano=date('Y');

 ?>
 
 
<html>
<head> 
<meta http-equiv=\"Content-Type\" content=\"text/html. charset=Windows-1252\">
<style>

.texto{
 	width: 900px;
 	border: solid;
 	padding: 20px;
 	font-size: 12px;
 	font-family: Arial, Helvetica, sans-serif;
	text-align:justify;
}
</style>
<script src="include/dist/ZeroClipboard.min.js"></script>
</head>

 <body>

  
<?php

$sei = 
  "<p><strong>Do processo nº:</strong> "."$NumeroProcesso"."</p>".
  "<p>&nbsp;</p>".
  "<p><strong>INTERESSADO:</strong> "."$pjRazaoSocial"."  </span></p>".
  "<p><strong>ASSUNTO:</strong> "."$objeto"."  </p>".
  "<p>&nbsp;</p>".
  "<p><strong>DESPACHO</strong></p>".
  "<p align='justify'>"."$amparo"."</p>".
  "<p>&nbsp;</p>".
  "<p><strong>Contratado:</strong> "."$pjRazaoSocial".", "."$pjCNPJ"."</p>".
  "<p><strong>Objeto:</strong> "."$objeto"."</p>".
  "<p><strong>Data / Período:</strong> "."$periodo"." - conforme cronograma</p>".
  "<p><strong>Local:</strong> "."$local"."</p>".
  "<p><strong>Valor:</strong> "."R$ $ValorGlobal"."  "."($ValorPorExtenso )"."</p>".
  "<p><strong>Forma de Pagamento:</strong> "."$FormaPagamento"."</p>".
  "<p><strong>Dotação Orçamentária:</strong> "."dotação".", $complementoDotacao"."</p>".
  "<p>&nbsp;</p>".
  "<p align='justify'>"."$final"."</p>".
  "<p>&nbsp;</p>".
  "<p>&nbsp;</p>".
  "<p>&nbsp;</p>".
  "<p align='center'>São Paulo, ".$dataAtual."</p>".
  "<p>&nbsp;</p>"

?>

<div align="center">
 <div id="texto" class="texto"><?php echo $sei; ?></div>
</div> 

 <p>&nbsp;</p>
 
 <div align="center"><button id="botao-copiar" data-clipboard-target="texto"><img src="img/copy-icon.jpg"> CLIQUE AQUI PARA COPIAR O TEXTO</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="http://sei.prefeitura.sp.gov.br" target="_blank">
 <button>CLIQUE AQUI PARA ACESSAR O <img src="img/sei.jpg"></button></a>
</div>
         
<script>
var client = new ZeroClipboard();
client.clip(document.getElementById("botao-copiar"));
client.on("aftercopy", function(){
    alert("Copiado com sucesso!");
});
</script>

  </body>
  </html>