<?php 
   
      
   // INSTALAÇÃO DA CLASSE NA PASTA FPDF.
	require_once("../include/lib/fpdf/fpdf.php");
	
   //require '../include/';
   require_once("../funcoes/funcoesConecta.php");
   require_once("../funcoes/funcoesGerais.php");
   require_once("../funcoes/funcoesSiscontrat.php");

   //CONEXÃO COM BANCO DE DADOS 
   $conexao = bancoMysqli();

   
class PDF extends FPDF
{

// Simple table
function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

// Simple table
function Cabecalho($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data

}

// Simple table
function Tabela($header, $data)
{
    //Data
    foreach($data as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data

}



}


//CONSULTA 
$id_ped=$_GET['id'];

$pedido = siscontrat($id_ped);
$Objeto = $pedido["Objeto"];
$ValorGlobal = dinheiroParaBr($pedido["ValorGlobal"]);
$ValorPorExtenso = valorPorExtenso($pedido["ValorGlobal"]);
$Local = $pedido["Local"];

$grupo = grupos($id_ped);
/*
echo "<pre>";
var_dump($grupo);
echo "</pre>";
*/


$pj = siscontratDocs($pedido['IdProponente'],2);
$ex = siscontratDocs($pedido['IdExecutante'],1);
$rep01 = siscontratDocs($pj['Representante01'],3);
$rep02 = siscontratDocs($pj['Representante02'],3);

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
$rep01RG = $rep01["RG"];
$rep01CPF = $rep01["CPF"];


// Representante02
$rep02Nome = $rep02["Nome"];
$rep02RG = $rep02["RG"];
$rep02CPF = $rep02["CPF"];

$setor = $pedido["Setor"];

$ano=date('Y');


// GERANDO O PDF:
$pdf = new PDF('P','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4
$pdf->AliasNbPages();
$pdf->AddPage();

   
$x=20;
$l=6; //DEFINE A ALTURA DA LINHA   
   
   $pdf->SetXY( $x , 15 );// SetXY - DEFINE O X (largura) E O Y (altura) NA PÁGINA

   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 14);
   $pdf->Cell(180,5,utf8_decode("DECLARAÇÃO DE EXCLUSIVIDADE"),0,1,'C');
   
   $pdf->Ln();
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 11);
   $pdf->MultiCell(170,$l,utf8_decode("Nós, abaixo assinados, declaramos, com o fim especial de contratação de Serviços Profissionais de Natureza Artística pela Prefeitura do Município de São Paulo, que somos representados COM EXCLUSIVIDADE pela empresa "."$pjRazaoSocial".", CNPJ nº "."$pjCNPJ". ", com sede em "."$pjEndereco".", representada por "."$rep01Nome". ", RG nº "."$rep01RG".
   " e CPF nº "."$rep01CPF"." e representada por "."$rep02Nome". ", RG nº "."$rep02RG"." e CPF nº "."$rep02CPF". ", para a apresentação "."$Objeto".", mediante cachê de R$ "."$ValorGlobal"." ("."$ValorPorExtenso"." )"." no(s) local(is)"."$Local"."."));
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 11);
   $pdf->MultiCell(170,$l,utf8_decode("A empresa representante fica autorizada a celebrar contrato, inclusive receber o cachê e outorgar quitação."));
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 11);
   $pdf->MultiCell(170,$l,utf8_decode("Estamos cientes de que o pagamento dos valores decorrentes de nossos serviços é de responsabilidade de nossos representante, não nos cabendo pleitear à Prefeitura do Município de São Paulo quaisquer valores eventualmente não repassados."));
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 11);
   $pdf->MultiCell(170,$l,utf8_decode("Declaramos ainda que não somos servidores públicos vinculados ou lotados na Secretaria Municipal de Cultura ou em qualquer órgão do Executivo ou Legislativo do Município de São Paulo e de que não possuímos impedimento legal para a contratação a ser realizada pela Secretaria Municipal de Cultura da Prefeitura do Município de São Paulo."));
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 11);
   $pdf->Cell(128,$l,utf8_decode("São Paulo, _______ / _______ / " .$ano."."),0,1,'L');
      
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   
   // Column headings
   $header = array('NOME COMPLETO', 'RG', 'CPF','ASSINATURA');
   $data = array($grupo);
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','',8);

   $pdf->Cabecalho($header,$data);
   
   
   
	for($i = 0;$i < $grupo['numero']; $i++){
	$data = array(utf8_decode(sobrenome($grupo[$i]['nomeCompleto'])), $grupo[$i]['rg'],$grupo[$i]['cpf'],"");	
    $pdf->SetX($x);
	$pdf->Tabela($header,$data);
	}
	


   
$pdf->Output();


?>