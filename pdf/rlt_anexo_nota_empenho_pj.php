<?php
//require '../include/';
   require_once("../funcoes/funcoesConecta.php");
   require_once("../funcoes/funcoesGerais.php");
   require_once("../funcoes/funcoesSiscontrat.php");
//CONEXÃO COM BANCO DE DADOS 
   $conexao = bancoMysqli();
//CONSULTA  (copia inteira em todos os docs)
$id_ped=$_GET['id'];

$ano=date('Y');

$pedido = siscontrat($id_ped);

$pj = siscontratDocs($pedido['IdProponente'],2);
$ex = siscontratDocs($pedido['IdExecutante'],1);
$rep01 = siscontratDocs($pj['Representante01'],3);
$rep02 = siscontratDocs($pj['Representante02'],3);

$id = $pedido['idEvento'];
$Objeto = $pedido["Objeto"];
$Periodo = $pedido["Periodo"];
$Duracao = $pedido["Duracao"];
$CargaHoraria = $pedido["CargaHoraria"];
$Local = $pedido["Local"];
$ValorGlobal = dinheiroParaBr($pedido["ValorGlobal"]);
$ValorPorExtenso = valorPorExtenso($pedido["ValorGlobal"]);
$FormaPagamento = $pedido["FormaPagamento"];
$Justificativa = $pedido["Justificativa"];
$Fiscal = $pedido["Fiscal"];
$Suplente = $pedido["Suplente"];
$rfFiscal = $pedido["RfFiscal"];
$Suplente = $pedido["Suplente"];
$rfSuplente = $pedido["RfSuplente"];
$setor = $pedido["Setor"];

//PessoaJuridica

$pjRazaoSocial = $pj["Nome"];
$pjNomeArtistico = $pj["NomeArtistico"];
$pjEstadoCivil = $pj["EstadoCivil"];
$pjNacionalidade = $pj["Nacionalidade"];
$pjRG = $pj["RG"];
$pjCPF = $pj["CPF"];
$pjCCM = $pj["CCM"];
$pjOMB = $pj["OMB"];
$pjDRT = $pj["DRT"];
$pjFuncao = $pj["Funcao"];
$pjEndereco = $pj["Endereco"];
$pjTelefones = $pj["Telefones"];
$pjEmail = $pj["Email"];
$pjINSS = $pj["INSS"];
$pjCNPJ = $pj['CNPJ'];

$codPed = "";

// Executante

$exNome = $ex["Nome"];
$exNomeArtistico = $ex["NomeArtistico"];
$exEstadoCivil = $ex["EstadoCivil"];
$exNacionalidade = $ex["Nacionalidade"];
$exRG = $ex["RG"];
$exCPF = $ex["CPF"];
$exCCM = $ex["CCM"];
$exOMB = $ex["OMB"];
$exDRT = $ex["DRT"];
$exFuncao = $ex["Funcao"];
$exEndereco = $ex["Endereco"];
$exTelefones = $ex["Telefones"];
$exEmail = $ex["Email"];
$exINSS = $ex["INSS"];

// Representante01

$rep01Nome = $rep01["Nome"];
$rep01NomeArtistico = $rep01["NomeArtistico"];
$rep01EstadoCivil = $rep01["EstadoCivil"];
$rep01Nacionalidade = $rep01["Nacionalidade"];
$rep01RG = $rep01["RG"];
$rep01CPF = $rep01["CPF"];
$rep01CCM = $rep01["CCM"];
$rep01OMB = $rep01["OMB"];
$rep01DRT = $rep01["DRT"];
$rep01Funcao = $rep01["Funcao"];
$rep01Endereco = $rep01["Endereco"];
$rep01Telefones = $rep01["Telefones"];
$rep01Email = $rep01["Email"];
$rep01INSS = $rep01["INSS"];


// Representante02

$rep02Nome = $rep02["Nome"];
$rep02NomeArtistico = $rep02["NomeArtistico"];
$rep02EstadoCivil = $rep02["EstadoCivil"];
$rep02Nacionalidade = $rep02["Nacionalidade"];
$rep02RG = $rep02["RG"];
$rep02CPF = $rep02["CPF"];
$rep02CCM = $rep02["CCM"];
$rep02OMB = $rep02["OMB"];
$rep02DRT = $rep02["DRT"];
$rep02Funcao = $rep02["Funcao"];
$rep02Endereco = $rep02["Endereco"];
$rep02Telefones = $rep02["Telefones"];
$rep02Email = $rep02["Email"];
$rep02INSS = $rep02["INSS"];

   
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=pedido_reserva.doc");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";

echo "<p><b>CONTRATANTE:</b> "."$setor"."</p>";
echo "<p><b>CONTRATADO(S):</b> Contratação de <b>"."$exNome"."</b>, CPF "."$exCPF"." e os demais integrantes do "."$Objeto".", por intermédio da(o) "."$pjRazaoSocial".", inscrita no CNPJ sob o Nº. "."$pjCNPJ".", representada legalmente pelo próprio contratado.</p>";
echo "<p><b>EVENTO/SERV:</b> Apresentação do "."$Objeto".", conforme segue:<br>
"."$Local"." 
TEMPO APROX. "."$Duracao"." cada apresentação</p>";
echo "<p><b>VALOR TOTAL DA CONTRATAÇÃO:</b> "."R$ $ValorGlobal"."  "."($ValorPorExtenso)"."<br> Quaisquer despesas aqui não ressalvadas, bem como direitos autorais, serão de responsabilidade do(a) contratado(a).<br></p>";
echo "<b>CONDIÇÕES DE PAGAMENTO: </b>"."$FormaPagamento"."<br>";
echo "<b>FISCALIZAÇÃO DO CONTRATO NA SMC: </b>Servidor "."$Fiscal"." - RF "."$rfFiscal"." como fiscal do contrato e Sr(a)" ."$Suplente"." - RF "."$rfSuplente"." como substitut(o)a.<br> <b> De acordo com a Portaria nº 5/2012 de SF, haverá compensação financeira, se houver atraso no pagamento do valor devido, por culpa exclusiva do Contratante, dependendo de requerimento a ser formalizado pelo Contratado.</b> <br>";
echo "<b>PENALIDADES: </b> O contratado incorrerá em multa de:<br>
5% (cinco por cento) para casos de infração de cláusula contratual como desobedecer às determinações da fiscalização ou desrespeitar munícipes ou funcionários municipais.
10% (dez por cento) para casos de inexecução parcial.
20% (vinte por cento) para casos de inexecução total.
Multa de 3% (três por cento) a cada 30 (trinta) minutos de atraso sobre o valor do ajuste, até o máximo de 9% (nove por cento), quando o contrato, a critério da administração, será considerado totalmente inexecutado e ao contratado será aplicada a multa prevista para a inexecução total.
O valor da multa será calculado sobre o valor da proposta, do contrato ou nota de empenho, quando esta o substituir. 
A multa será descontada do pagamento devido ou será inscrita como dívida ativa, sujeita à cobrança executiva;
Suspensão temporária de contratar e licitar com a municipalidade;
Os trabalhos deverão ser iniciados pontualmente no horário e data previamente estabelecidos, sob pena de inadimplemento parcial do contrato.
";
echo "<p><b>RESCISÃO CONTRATUAL: </b> Dar-se-á caso ocorra quaisquer dos atos cabíveis descritos na legislação vigente.
* Contratação, por inexigibilidade da licitação, com fundamento no artigo 25, Inciso III, da Lei Federal nº. 8.666/93, e alterações posteriores, e artigo 1º da Lei Municipal nº. 13.278/02, nos termos dos artigos 16 e 17 do Decreto Municipal nº. 44.279/03.</p>
<b> ** OBS.: ESTE EMPENHO SUBSTITUI O CONTRATO, CONFORME ARTIGO 62 DA LEI FEDERAL Nº. 8.666/93.</b>
</p>";
echo "</body>";
echo "</html>";
?>