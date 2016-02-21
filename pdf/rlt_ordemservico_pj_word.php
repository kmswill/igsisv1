<?php 
	session_start();
	   @ini_set('display_errors', '1');
	error_reporting(E_ALL); 	
   
   // INSTALAÇÃO DA CLASSE NA PASTA FPDF.
	require_once("../include/lib/fpdf/fpdf.php");
   require_once("../funcoes/funcoesConecta.php");
   require_once("../funcoes/funcoesGerais.php");
   require_once("../funcoes/funcoesSiscontrat.php");

   //CONEXÃO COM BANCO DE DADOS 
   $conexao = bancoMysqli(); 
   



//CONSULTA  (copia inteira em todos os docs)
$id_ped=$_GET['id'];

$ano=date('Y');

$dataAtual = date("d/m/Y");

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
$rfFiscal = $pedido["RfFiscal"];
$Suplente = $pedido["Suplente"];
$rfSuplente = $pedido["RfSuplente"];
$NumeroProcesso = $pedido["NumeroProcesso"];
$notaempenho = $pedido["NotaEmpenho"];
$data_entrega_empenho = exibirDataBr($pedido['EntregaNE']);
$data_emissao_empenho = exibirDataBr($pedido['EmissaoNE']);

$grupo = grupos($id_ped);
$integrantes = $grupo["texto"];

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
header("Content-Disposition: attachment;Filename=ordem.doc");

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

<h2><center>ORDEM DE EXECUÇÃO DE SERVIÇO</center></h2>

<p><strong>Ordem n°:</strong>__________ ./2016</p>
<center><h3>AUTORIZAÇÃO</h3></center>

<p><strong>Emanada de :</strong> Divisão ADMINISTRATIVA</p>
<p><strong>Suporte Legal:</strong> Artigo 25, inciso III, da Lei Federal n° 8.666/93 e alterações posteriores e artigo 1° da Lei Municipal n° 13.278/02, nos termos dos artigos 16 e 17 do Decreto n° 44.279/03.</p>
<p><strong>Processo n° <?php echo $NumeroProcesso; ?></strong> <strong>Data:</strong></p>

<center><h3>PRESTADOR E/OU EXECUTOR DO SERVIÇO</h3></center>

<p><strong>Nome:</strong><?php echo $exNome ; ?></p>
<p><strong>RG:</strong> <?php echo $exRG; ?> <strong>CPF:</strong> <?php echo $exCPF; ?> </p>
<p><strong>Endereço:</strong> <?php echo $exEndereco; ?></p>

<center><h3>SERVIÇO</h3></center>
<p>Especificações: Contratação dos serviços profissionais de natureza artística de: <?php echo  $integrantes; ?> para apresentação de <?php echo  $Objeto ?>, no(s) local(is) <?php echo $Local ?> no perído de <?php echo $Periodo; ?> conforme cronograma.		
</p>
<p>Fica prevista a possibilidade de sessões extras do espetáculo, nas mesmas condições aqui propostas, a critério da Curadoria e desde que haja compatibilidade com a programação, relativamente à datas e horários.</p>
<p>Fica designado como fiscal do contrato o(a) Sr(a) <?php echo $Fiscal ?>, RF nº <?php echo $rfFiscal ?> e como suplente, Sr(a) <?php echo $Suplente ?>, RF nº <?php echo $rfSuplente ?>, da Secretaria Municipal de Cultura.</p>

<center><h3>RECURSOS FINANCEIROS</h3></center>

<p><strong>Dotação: Unidade Orçamentária:</strong></p>
<p><strong>Nota de Empenho n°</strong><?php echo $notaempenho; ?> <strong>Emitida em:</strong><?php echo $data_emissao_empenho; ?></p>

<center><h3>PAGAMENTO</h3></center>
<p><?php echo $FormaPagamento; ?></p>

<center><h3>PENALIDADES</h3></center>
<p>- Declaro estar ciente da penalidade de multa de 10% (dez por cento) para casos de infração de cláusula contratual e/ou inexecução parcial do ajuste, e de 30% (trinta por cento)  para casos de inexecução total do ajuste. O valor da multa será calculado sobre o valor do contrato ou sobre o valor integral da venda de todos os ingressos disponíveis.</p>
<p>- Declaro estar ciente que no caso de haver atraso de até 30 minutos será aplicada multa de 5% sobre o valor do contrato ou sobre o valor integral da venda de todos os ingressos disponíveis, por dia de apresentação. Ultrapassado esse tempo, e independentemente da aplicação da penalidade, fica a critério da Diretoria autorizar a realização do evento, visando evitar prejuízos à grade de programação. Não sendo autorizada a realização do evento, será considerada inexecução parcial do ajuste, limitado a dois dias de ocorrência.  Havendo o terceiro atraso na temporada, será considerada inexecução total do contrato e deverá ser rescindido o ajuste, com aplicação da multa por inexecução total de 30% sobre o valor do contrato ou sobre o valor integral da venda de todos os ingressos disponíveis, acumulada com a multa de 20% do valor do contrato por rescisão contratual por culpa do contratado.</p>
<p>- Multa de 10% sobre o valor do contrato ou sobre o valor integral da venda de todos os ingressos disponíveis, em função da falta de regularidade fiscal da contratada, bem como, pela verificação de que possui pendências junto ao Cadastro Informativo Municipal – CADIN Municipal.</p>
<p>- As penalidades previstas serão aplicadas sem prejuízo das demais sanções previstas na legislação que rege a matéria.</p>

<center><h3>CANCELAMENTO</h3></center>

<p>ESTA O.E.S. PODERÁ SER CANCELADA NO INTERESSE DA ADMINISTRAÇÃO, DEVIDAMENTE JUSTIFICADA OU EM VIRTUDE DA INEXECUÇÃO TOTAL OU PARCIAL DO SERVIÇO SEM PREJUÍZO DE MULTA.</p>
   
<center><h3>FORO</h3></center>

<p>FICA ELEITO O FORO DESTA COMARCA PARA TODO E QUALQUER PROCEDIMENTO JUDICIAL ORIUNDO DESTA ORDEM DE EXECUÇÃO DE SERVIÇOS.</p>
   
<center><h3>OBSERVAÇÕES</h3></center>
<p>-Compete à contratada a realização do espetáculo, e a fazer constar o crédito - PMSP/SECRETARIA MUNICIPAL DE CULTURA - CENTRO CULTURAL SÃO PAULO, em toda divulgação escrita ou falada, realizada sobre o espetáculo programado.</p>
<p>-	A  empresa contratada fica sujeita ao atendimento do disposto nas Leis Municipais nºs 10.973/91, regulamentada pelo DM 30.730/91; 11.113/91; 11.357/93; 12.975/2000 e Portaria 66/SMC/2007: Leis Estaduais nº 7.844/92 regulamentada pelo Decreto Estadual nº 35.606/92; 10.858/2001, alterada pela Lei Estadual 14.729/2012; Medida Provisória Federal 12.933/2013 e Lei Federal 10.741/2003 (estatuto do idoso).</p>
<p>-	A contratada é responsável por qualquer prejuízo ou dano causado ao patrimônio municipal ou a bens de terceiros que estejam sob a guarda do Centro Cultural São Paulo.</p>
<p>-	Quaisquer outras despesas não ressalvadas aqui serão de responsabilidade da contratada, que se compromete a adotar as providências necessárias junto à SBAT.</p>
<p>-	As providências administrativas para liberação da autorização do ECAD serão de responsabilidade da contratada, sendo que eventuais pagamentos serão efetuados pela SMC.</p>
<p>-	A Municipalidade não é responsável por qualquer material ou equipamento que não lhe pertença utilizado no espetáculo, devendo esse material ser retirado no seu término.</p>
<p>-	A renda integral apurada na bilheteria, com ingressos vendidos ao preço único de R$ 20,00 (vinte reais), será revertida à contratada, por intermédio da Empresa Brasileira de Comercialização de Ingressos Ltda, que também confeccionará os ingressos, já deduzidos os impostos e taxas pertinentes, podendo ter preços reduzidos em face de promoções realizadas pela produção do evento.</p>
<p>-	Compete, ainda, à Municipalidade, o fornecimento da sonorização necessária à realização dos espetáculos e os equipamentos de iluminação disponíveis na Sala Jardel Filho, assim como providências quanto à divulgação de praxe (confecção de cartaz a ser afixado na Rua Interna do Centro Cultural São Paulo e encaminhamento de release à mídia impressa e televisiva).</p>
<p>-	Serão reservados ingressos aos funcionários da PMSP até 10% (dez por cento) da lotação da sala.</p>
<p>-	A contratada se compromete a realizar o espetáculo para um número mínimo de 10 (dez) pagantes.</p>
<br />
<p>ACEITO AS CONDIÇÕES DESTA O.E.S. PARA TODOS OS EFEITOS DE DIREITO</p>
<br />
<p>Local e data:</p>
<br /><br />



<p>-----------------------------------------------------<br />
<strong><?php echo $exNome; ?><br />
CPF: <?php echo  $exCPF ?><strong>

<p>Com competência delegada pela Portaria nº. 19/2006- SMC/G, determino a execução do serviço na forma desta O.E.S.</p>
<p> Local e data</p>   
   

 
 
 
 
 ------------------------------------------------------------<br />
 
 DIRETOR
 

</body>
</html>
