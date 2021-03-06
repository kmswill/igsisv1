<?php 
   
   // INSTALAÇÃO DA CLASSE NA PASTA FPDF.
   require('../lib/fpdf/fpdf.php');
   
   //CONEXÃO COM BANCO DE DADOS 
   include("../conectar.php"); 
   

class PDF extends FPDF
{

}




//CONSULTA 
$id_ped=$_GET['id'];

$sql_query_tabelas ="
						SELECT 	pedido_contratacao_pf.Id_PedidoContratacaoPF,
								pedido_contratacao_pf.Objeto,
								pedido_contratacao_pf.LocalEspetaculo,
								pedido_contratacao_pf.Valor,
								pedido_contratacao_pf.ValorPorExtenso,
								pedido_contratacao_pf.FormaPagamento,
								pedido_contratacao_pf.Periodo,
								pedido_contratacao_pf.Duracao,
								pedido_contratacao_pf.CargaHoraria,
								pedido_contratacao_pf.Justificativa,
								pedido_contratacao_pf.Fiscal,
								pedido_contratacao_pf.Suplente,
								pedido_contratacao_pf.ParecerTecnico,
								pedido_contratacao_pf.Observacao,
								setor.Setor,
								categoria_contratacao.CategoriaContratacao,
								verba.*,
								pessoa_fisica.*
						FROM pedido_contratacao_pf
						
						INNER JOIN setor
							ON pedido_contratacao_pf.IdSetor = setor.Id_Setor
						INNER JOIN categoria_contratacao
							ON pedido_contratacao_pf.IdCategoria = categoria_contratacao.Id_CategoriaContratacao
						INNER JOIN verba 
							ON pedido_contratacao_pf.IdVerba = verba.Id_Verba
						INNER JOIN pessoa_fisica
							ON pedido_contratacao_pf.IdPessoaFisica = pessoa_fisica.Id_PessoaFisica
						
						WHERE Id_PedidoContratacaoPF = $id_ped
					";
					

$consulta_tabelas = mysqli_query($conexao,$sql_query_tabelas);
$linha_tabelas = mysqli_fetch_assoc ($consulta_tabelas);


$codPed = $linha_tabelas["Id_PedidoContratacaoPF"];
$objeto = $linha_tabelas["Objeto"];
$local = $linha_tabelas["LocalEspetaculo"];
$valor = $linha_tabelas["Valor"];
$valorExtenso = $linha_tabelas["ValorPorExtenso"];
$formaPagamento = $linha_tabelas["FormaPagamento"];
$periodo = $linha_tabelas["Periodo"];
$duracao = $linha_tabelas["Duracao"];
$cargaHoraria = $linha_tabelas["CargaHoraria"];
$justificativa = $linha_tabelas["Justificativa"];
$fiscal = $linha_tabelas["Fiscal"];
$suplente = $linha_tabelas["Suplente"];
$parecer = $linha_tabelas["ParecerTecnico"];
$observacao = $linha_tabelas["Observacao"];

$nome = $linha_tabelas["Nome"];
$nomeArtistico = $linha_tabelas["NomeArtistico"];
$estadoCivil = $linha_tabelas["EstadoCivil"];
$nacionalidade = $linha_tabelas["Nacionalidade"];
$rg = $linha_tabelas["RG"];
$cpf = $linha_tabelas["CPF"];
$ccm = $linha_tabelas["CCM"];
$omb = $linha_tabelas["OMB"];
$drt = $linha_tabelas["DRT"];
$funcao = $linha_tabelas["Funcao"];
$numero = $linha_tabelas["Numero"];
$complemento = $linha_tabelas["Complemento"];
$cep = $linha_tabelas["CEP"];
$telefone1 = $linha_tabelas["Telefone1"];
$telefone2 = $linha_tabelas["Telefone2"];
$telefone3 = $linha_tabelas["Telefone3"];
$email = $linha_tabelas["Email"];
$inss = $linha_tabelas["InscricaoINSS"];

$ano=date('Y');


// GERANDO O PDF:
$pdf = new PDF('P','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4
$pdf->AliasNbPages();
$pdf->AddPage();

   
$x=20;
$l=7; //DEFINE A ALTURA DA LINHA   
   
   $pdf->SetXY( $x , 40 );// SetXY - DEFINE O X (largura) E O Y (altura) NA PÁGINA

   
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,utf8_decode("Do processo nº:"),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(30,$l,utf8_decode("variavel processo"),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(180,$l,utf8_decode("Lorem ipsum dolor sit amet, eos oblique tractatos ne, oblique qualisque complectitur vis ei, no errem eligendi nec. Te nec cibo ubique, explicari efficiantur ius id. Ei magna ornatus mei, ea eam odio graecis prodesset. Cum labore laboramus sententiae at.
Duo at nemore erroribus, duo graeco feugait minimum cu. Qui fugit partiendo an. Qui et gloriatur interpretaris, esse latine at sit, elitr splendide eu vim. Et solet doming noster est. Pro ne possim appareat concludaturque, ad animal euismod nec."));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(22,$l,'Contratado:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode("$nome".", CPF nº "."$cpf"));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Objeto:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($objeto));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(27,$l,utf8_decode('Data / Período:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(153,$l,utf8_decode($periodo));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(13,$l,utf8_decode('Local:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(167,$l,utf8_decode($local));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(13,$l,utf8_decode('Valor:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(167,$l,utf8_decode("R$ "."$valor"));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(40,$l,utf8_decode('Dotação Orçamentária:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(140,$l,utf8_decode($periodo));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(180,$l,utf8_decode("Lorem ipsum dolor sit amet, eos oblique tractatos ne, oblique qualisque complectitur vis ei, no errem eligendi nec. Te nec cibo ubique, explicari efficiantur ius id. Ei magna ornatus mei, ea eam odio graecis prodesset. Cum labore laboramus sententiae at.
Duo at nemore erroribus, duo graeco feugait minimum cu. Qui fugit partiendo an. Qui et gloriatur interpretaris, esse latine at sit, elitr splendide eu vim. Et solet doming noster est. Pro ne possim appareat concludaturque, ad animal euismod nec."));
   
   
   
$pdf->Output();


?>