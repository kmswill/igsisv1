<?php 
	session_start();
	   @ini_set('display_errors', '1');
	error_reporting(E_ALL); 	
   
   // INSTALA��O DA CLASSE NA PASTA FPDF.
	require_once("../include/lib/fpdf/fpdf.php");
   require_once("../funcoes/funcoesConecta.php");
   require_once("../funcoes/funcoesGerais.php");
   require_once("../funcoes/funcoesSiscontrat.php");

   //CONEX�O COM BANCO DE DADOS 
   $conexao = bancoMysqli(); 
   



//CONSULTA  (copia inteira em todos os docs)
$id_ped=$_GET['id'];

$ano=date('Y');
$dataAtual = date("d/m/Y");

$pedido = siscontrat($id_ped);
$pessoa = siscontratDocs($pedido['IdProponente'],1);

$setor = $pedido["Setor"];

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
$rfFiscal = $pedido["RfFiscal"];
$Suplente = $pedido["Suplente"];
$rfSuplente = $pedido["RfSuplente"];
$NumeroProcesso = $pedido["NumeroProcesso"];
$notaempenho = $pedido["NotaEmpenho"];
$data_entrega_empenho = exibirDataBr($pedido['EntregaNE']);
$data_emissao_empenho = exibirDataBr($pedido['EmissaoNE']);

$grupo = grupos($id_ped);
$integrantes = $grupo["texto"];

//PessoFisica

$Nome = $pessoa["Nome"];
$NomeArtistico = $pessoa["NomeArtistico"];
$EstadoCivil = $pessoa["EstadoCivil"];
$Nacionalidade = $pessoa["Nacionalidade"];
$DataNascimento = exibirDataBr($pessoa["DataNascimento"]);
$RG = $pessoa["RG"];
$CPF = $pessoa["CPF"];
$CCM = $pessoa["CCM"];
$OMB = $pessoa["OMB"];
$DRT = $pessoa["DRT"];
$cbo = $pessoa["cbo"];
$Funcao = $pessoa["Funcao"];
$Endereco = $pessoa["Endereco"];
$Telefones = $pessoa["Telefones"];
$Email = $pessoa["Email"];
$INSS = $pessoa["INSS"];

$codPed = "";


header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=$NumeroProcesso - Termo de Doa��o de Servi�o.doc");

?>

<html>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<body>
<style type='text/css'>
.style_01 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
</style>

<h2><center>PROCESSO N� <?php echo $NumeroProcesso; ?> <br /></h2>
<h3><center>TERMO DE DOA��O DE SERVI�OS N�________/<?php echo $ano; ?> </center></h3>

<p align='justify'>De acordo com o despacho proferido pelo Senhor Secret�rio Municipal de Cultura em fls. retro do processo administrativo n�. <?php echo $NumeroProesso; ?>,A <b>PREFEITURA DO MUNIC�PIO DE S�O PAULO</b>, por interm�dio de sua <b>SECRETARIA MUNICIPAL DE CULTURA</b>, neste ato representada  por seu titular <b>Sr. NABIL GEORGES BONDUKI</b>,Secret�rio Municipal de Cultura e <b><?php echo $Nome; ?></b>, nome art�stico <?php echo $NomeArtistico; ?>, <?php echo $Nacionalidade; ?>, portador do RG/RNE <?php echo $RG; ?>, inscrito no CPF/MF sob o n�.<?php echo $CPF; ?>, residente e domiciliado no endere�o <?php echo $Endereco; ?>, denominad <b>DOADOR</b>, resolvem, com fundamento no artigo 1� do Decreto n� 40.834/2001, firmar o presente termo de doa��o de servi�os profissionais de natureza art�stica, mediante as seguintes cl�usulas e condi��es: </p>
<br/>

<h3>CL�USULA 1 - OBJETO</h3>

<p align='justify'>Doa��o de servi�os para realiza��o de <?php echo $Objeto; ?>, no per�odo de <?php echo $Periodo; ?>, no espa�o <?php echo $Local; ?>.</p>

<h3>CL�USULA 2 - OBRIGA��ES DO DOADOR</h3>

<p align='justify'><b>O DOADOR</b> compromete-se a:</p>

<ol>
<li>Executar os servi�os no per�odo e hor�rios constantes na proposta de doa��o, garantindo sua qualidade e adequa��o aos prop�sitos art�sticos do evento.</li>
<li>Fazer men��o dos cr�ditos da Prefeitura da Cidade de S�o Paulo, Secretaria Municipal de Cultural, em toda divulga��o, escrita ou falada, realizada sobre o evento programado.</li>
</ol>

<h3>CL�USULA 3 - DOS DIREITOS E ENCARGOS DA DONAT�RIA</h3>
<p align='justify'><strong>Caber� a <?php echo $grupo; ?>,</strong></p>

<p align='justify'><b>A DONAT�RIA:</b></p>

<ol>
<li>Reserva-se o direito de registrar a imagem do evento, para efeito de documenta��o e publica��o em qualquer m�dia;</li>
<li>Dever� fornecer os equipamentos de sonoriza��o e ilumina��o dispon�veis do local da realiza��o do evento, bem como providenciar a divulga��o de praxe (confec��o de cartaz manual e encaminhamento de release � m�dia impressa e televisiva)</li>
<li>Exercer a coordena��o e comunica��es necess�rias, bem como dirimir d�vidas, para o bom cumprimento das obriga��es descritas neste termo.</li>

</ol>

<h3>CL�USULA 4 - DISPOSI��ES GERAIS</h3>
<p align='justify'><b>O DOADOR</b>, nos termos do artigo 8� do Decreto Municipal n� 40.384/01, declara, sob as penas da lei, que n�o est� em d�bito com a Fazenda Municipal.</p>
<p align='justify'>Nos termos do art. 6 do Decreto n�. 54.873/2014, foi designado como fiscal do contrato o(a) Sr.(a) <?php echo $Fiscal; ?>, RF n�.<?php echo $rfFiscal; ?>, e como suplente o(a) Sr.(a) <?php echo $Suplente; ?>, RF n�<?php echo $rfSuplente; ?>.</p>
<p align='justify'>Fica eleito o foro da Fazenda P�blica da Capital para qualquer procedimento judicial oriundo do presente Termo, com a ren�ncia de qualquer outro, por mais especial ou privilegiado que seja.</p>
<p align='justify'>E, para firmeza e validade de tudo quanto ficou estipulado, lavrou-se o presente Termo de Doa��o, que depois de lido e achado conforme pela Assessoria Jur�dica a Secretaria Municipal de Cultura, foi assinado em 03 (tr�s) vias de igual teor, pelas partes e pelas testemunhas abaixo identificadas.</p>
</p>

<p align='justify'>-.-.-.-.-.-.-.--.-.-.-.-.-.-.-.-.-.-.</p>

<p align='justify'>S�o Paulo, <?php echo $dataAtual; ?></p>

<p>&nbsp;</p>

<p align='justify'>Secretaria Municipal de Cultura / <?php echo $setor; ?><br/>
NABIL GEORGES BONDUKI<br/>
Secret�rio Municipal de Cultura<br/></p>

<br/>

<p align='justify'>DOADORA</p>

<p>&nbsp;</p>

<p align='justify'><?php echo $Nome; ?><br/>
RG/RNE n� <?php echo $RG; ?></br>
CPF n� <?php echo $CPF; ?>
</p>

<p>&nbsp;</p>

<p align='justify'><?php echo $Fiscal; ?><br/>
RF n� <?php echo $rfFiscal; ?>
</p>

<p>&nbsp;</p>

<p align='justify'><?php echo $Suplente; ?><br/>
RF n� <?php echo $rfSuplente; ?>

</body>
</html>
