<?php
	
//require '../include/';
   require_once("../funcoes/funcoesConecta.php");
   require_once("../funcoes/funcoesGerais.php");
   require_once("../funcoes/funcoesSiscontrat.php");
   require_once("../funcoes/funcoesComunicacao.php");
   //CONEXÃO COM BANCO DE DADOS 
   $conexao = bancoMysqli();

//recupera a data_inicial e data_final

$dataInicio = $_GET['dataInicio'];
$dataFinal = $_GET['dataFinal'];


//gera a tabela temporária
	$sql_limpa = "TRUNCATE TABLE temp_emcartaz";	
	$query_limpa = mysqli_query($conexao,$sql_limpa);
	if($query_limpa){

$sql_temp = "SELECT DISTINCT idEvento FROM igsis_agenda WHERE data >= '$dataInicio' AND data <= '$dataFinal'"; 
$query_temp = mysqli_query($conexao,$sql_temp);
	while($consulta = mysqli_fetch_array($query_temp)){
		$evento = recuperaDados("ig_evento",$consulta['idEvento'],"idEvento");
		$idEvento = $evento['idEvento'];
		$idTipo = $evento['ig_tipo_evento_idTipoEvento'];
		$idProjeto = $evento['projetoEspecial'];
		$sql_insert = "INSERT INTO `temp_emcartaz` (`idEmcartaz`, `idEvento`, `idTipo`, `idProjeto`) VALUES (NULL, '$idEvento', '$idTipo', '$idProjeto')";
		mysqli_query($conexao,$sql_insert);
	}
}

// gera a consulta

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=revista.doc");
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


<?php
for($j = 0; $j < count($evhoj); $j++){

 ?>
<div class="titulo"> <?php echo $evhoj[$j]['nome']; ?></div>
<p><?php echo substr($evhoj[$j]['sala'], 7); ?><p>
<p><?php echo $evhoj[$j]['valor']; ?></p>
<p><?php echo $evhoj[$j]['horario']; ?></p> 

<?php 
	}
 
?>
</body>
</html>
