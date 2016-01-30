<?php 
   
   // INSTALAÇÃO DA CLASSE NA PASTA FPDF.
	require_once("../include/lib/fpdf/fpdf.php");
   require_once("../funcoes/funcoesConecta.php");
   require_once("../funcoes/funcoesGerais.php");
   require_once("../funcoes/funcoesSiscontrat.php");



   //CONEXÃO COM BANCO DE DADOS 
   $conexao = bancoMysqli(); 
   
// logo da instituição 
session_start();


//var_dump($_SESSION);
  
class PDF extends FPDF
{
// Page header
function Header()
{
	$inst = recuperaDados("ig_instituicao",$_SESSION['idInstituicao'],"idInstituicao");
	$logo = "../visual/img/".$inst['logo']; 
    // Logo
    $this->Image($logo,20,20,50);
    // Move to the right
    $this->Cell(80);
    $this->Image('../visual/img/logo_smc.jpg',170,10);
    // Line break
    $this->Ln(20);
}


//INSERIR ARQUIVOS

function ChapterBody($file)
{
    // Read text file
    $txt = file_get_contents($file);
    // Arial 10
    $this->SetFont('Arial','',10);
    // Output justified text
    $this->MultiCell(0,5,$txt);
    // Line break
    $this->Ln();
}

function PrintChapter($file)
{
    $this->ChapterBody($file);
}

}



//CONSULTA 
$id_ped=$_GET['id'];

dataProposta($id_ped);

$ano=date('Y');

$pedido = siscontrat($id_ped);
$pessoa = siscontratDocs($pedido['IdProponente'],1);

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


// GERANDO O PDF:
$pdf = new PDF('P','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4
$pdf->AliasNbPages();
$pdf->AddPage();

   
$x=20;
$l=7; //DEFINE A ALTURA DA LINHA   

	//Executante
   
   $pdf->SetXY( $x , 37 );// SetXY - DEFINE O X (largura) E O Y (altura) NA PÁGINA

   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(10,5,'(A)',0,0,'L');
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(170,5,'CONTRATADO',0,1,'C');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','I', 10);
   $pdf->Cell(10,10,utf8_decode('(Quando se tratar de grupo, o líder do grupo)'),0,0,'L');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(12,$l,'Nome:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(168,$l,utf8_decode($Nome));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,utf8_decode('Nome Artístico:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(152,$l,utf8_decode($NomeArtistico));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(23,$l,utf8_decode('Estado Civil:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(35,$l,utf8_decode($EstadoCivil),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,utf8_decode('Nacionalidade:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(35,$l,utf8_decode($Nacionalidade),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CCM:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($CCM),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(8,$l,utf8_decode('RG:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode($RG),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CPF:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(53,$l,utf8_decode($CPF),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(12,$l,utf8_decode('OMB:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($OMB),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('DRT:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(40,$l,utf8_decode($DRT),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,utf8_decode('C.B.O.:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(30,$l,utf8_decode($cbo),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,utf8_decode('Função:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($Funcao),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(20,$l,utf8_decode('Endereço:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(160,$l,utf8_decode($Endereco));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(17,$l,utf8_decode('Telefone:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(87,$l,utf8_decode($Telefones),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(13,$l,utf8_decode('E-mail:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(53,$l,utf8_decode($Email),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(64,$l,utf8_decode('Inscrição no INSS ou nº PIS / PASEP:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode($INSS),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(36,$l,utf8_decode('Data de Nascimento:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($DataNascimento),0,1,'L');  
   
   $pdf->SetX($x);
   $pdf->Cell(180,5,'','B',1,'C');
   
   $pdf->Ln();
    
   
	// Proposta   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(10,10,'(B)',0,0,'L');
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(160,10,'PROPOSTA',0,0,'C');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(10,10,$ano."-".$id_ped,0,1,'R');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Objeto:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($Objeto));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(27,$l,utf8_decode('Data / Período:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(153,$l,utf8_decode("$Periodo"." - conforme cronograma."));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(82,$l,utf8_decode('Tempo Aproximado de Duração do Espetáculo:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(98,$l,utf8_decode("$Duracao"."utos"));
      
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Local:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($Local));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Valor:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(168,$l,utf8_decode("R$ $ValorGlobal"."  "."($ValorPorExtenso )"));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(40,$l,utf8_decode('Valor da Prestação do Serviço:'),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(140,$l,utf8_decode($FormaPagamento));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(25,$l,'Justificativa:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(155,$l,utf8_decode($Justificativa));


//RODAPÉ PERSONALIZADO
   $pdf->SetXY($x,262);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(100,$l,utf8_decode($Nome),'T',1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(100,$l,"RG ".$RG,0,0,'L');
   

//	QUEBRA DE PÁGINA
$pdf->AddPage('','');

$pdf->SetXY( $x , 33 );// SetXY - DEFINE O X (largura) E O Y (altura) NA PÁGINA

$l=4; //DEFINE A ALTURA DA LINHA  


$pdf->SetX($x);
   $pdf->SetFont('Arial','', 9);
   $pdf->Cell(10,5,'(D)',0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(170,5,utf8_decode('OBSERVAÇÕES E DECLARAÇÕES'),0,1,'C');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 8);
   $pdf->MultiCell(180,$l,utf8_decode("Ciente da obrigatoriedade de fazer menção dos créditos PREFEITURA DA CIDADE DE SÃO PAULO, SECRETARIA MUNICIPAL DE CULTURA, em toda divulgação, escrita ou falada, realizada sobre o espetáculo programado, sob pena de cancelamento sumário do mesmo se não cumpridas estas determinações. 
No caso de reversão de bilheteria, fica sujeito ao atendimento no disposto nas Leis municipais no 10.973/91, regulamentada pelo Decreto Municipal n° 30.730/91; 11.113/91; 11.357/93 e 12.975/2000 e portaria nº 66/SMC/2007; Leis Estaduais nº 7.844/92, regulamentada pelo Decreto Estadual nº 35.606/92; 10.858/2001, alterada pela Lei Estadual 14.729/2012 e Medida Provisória Federal 12.933/2013 e Lei Federal nº 10.741/2003 (Estatuto do Idoso).
Nos casos de lançamento de CD ou outro produto artístico-cultural, assumo inteira responsabilidade fiscal e tributária quanto a sua comercialização, isentando a Municipalidade de quaisquer ônus ou encargos , nos termos da O.I. n o 01/2002 – SMC-G.
No caso de espetáculo musical, declaro assumir quaisquer ônus decorrentes da fiscalização e autuação da Ordem dos Músicos do Brasil - OMB."));

   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 8);
   $pdf->MultiCell(180,$l,utf8_decode("Declaramos que não temos débitos perante as Fazendas Públicas, Federal, Estadual e, em especial perante a Prefeitura do Município de São Paulo.
Declaramos que assumimos inteira responsabilidade, conforme o caso:
-	pelo recolhimento de direitos autorais perante à SBAT;
-	pela adoção de providências junto à OMB; 
-	pela adoção das providências administrativas para liberação da autorização do ECAD, sendo que eventuais pagamentos serão efetuados pela SMC.
Declaramos que estamos  cientes da penalidade de multa de 10% (dez por cento) para casos de infração de cláusula contratual e/ou inexecução parcial do ajuste, e de 30%  (trinta por cento)  para casos de inexecução total do ajuste. O valor da multa será calculado sobre o valor do contrato ou sobre o valor integral da venda de todos os ingressos disponíveis.
Declaramos que estamos  cientes de que haverá multa de 10% sobre o valor do contrato ou sobre o valor integral da venda de todos os ingressos disponíveis por atraso de até 30 minutos no evento.  Ultrapassado esse tempo, e independentemente da aplicação da penalidade, fica a critério da Diretoria autorizar a realização do evento, visando evitar prejuízos à grade de programação.  Não sendo autorizada a realização do evento, será considerada inexecução total do contrato, com aplicação da multa prevista por inexecução total.
Declaramos que estamos  cientes de que haverá multa de 10% sobre o valor do contrato ou sobre o valor integral da venda de todos os ingressos disponíveis, em função da falta de regularidade fiscal da contratada, bem como, pela verificação de que a contratada possui pendências junto ao Cadastro Informativo Municipal-CADIN Municipal.
As penalidades serão aplicadas sem prejuízo das demais sanções previstas na legislação que rege a matéria.
Declaramos que estamos cientes de que do valor do serviço serão descontados os impostos cabíveis.
Declaramos que estamos cientes de que é vedada a colocação de anúncios (lambe-lambe e similares) com base na legislação municipal existente que disciplina a matéria.
Declaramos que no caso de apresentação de espetáculo (s) de dança, estamos cientes de que é de nossa responsabilidade providenciar operador (es) de som e luz.
Todas as informações precedentes são formadas sob as penas da Lei.
"));


   $pdf->Ln();
   $pdf->Ln();


   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(180,$l,"Data: _________ / _________ / "."$ano".".",0,0,'L');
   
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   
   
//RODAPÉ PERSONALIZADO
   $pdf->SetXY($x,262);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(100,$l,utf8_decode($Nome),'T',1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(100,$l,"RG ".$RG,0,0,'L');
   
   
   
//	QUEBRA DE PÁGINA
$pdf->AddPage('','');

$pdf->SetXY( $x , 37 );// SetXY - DEFINE O X (largura) E O Y (altura) NA PÁGINA

$l=5; //DEFINE A ALTURA DA LINHA 

   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(170,5,utf8_decode('CRONOGRAMA'),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 12);
   $pdf->MultiCell(170,$l,utf8_decode($Objeto));
   
   $pdf->Ln();	 

	$ocor = listaOcorrenciasContrato($id);

	for($i = 0; $i < $ocor['numero']; $i++){
	
	$tipo = $ocor[$i]['tipo'];
	$dia = $ocor[$i]['data'];
	$hour = $ocor[$i]['hora'];
	$lugar = $ocor[$i]['espaco'];

  
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(12,$l,utf8_decode('Tipo:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(158,$l,utf8_decode($tipo));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(22,$l,utf8_decode('Data/Perído:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(148,$l,utf8_decode($dia));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,utf8_decode('Horário:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(155,$l,utf8_decode($hour));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(12,$l,utf8_decode('Local:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(158,$l,utf8_decode($lugar));
   
   $pdf->Ln(); 
	}

//RODAPÉ PERSONALIZADO
   $pdf->SetXY($x,262);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(100,$l,utf8_decode($Nome),'T',1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(100,$l,"RG ".$RG,0,0,'L');
   

//for($i=1;$i<=20;$i++)
   // $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();


?>