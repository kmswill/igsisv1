<?php
	
//require '../include/';
   require_once("../funcoes/funcoesConecta.php");
   require_once("../funcoes/funcoesGerais.php");
   require_once("../funcoes/funcoesSiscontrat.php");
   require_once("../funcoes/funcoesComunicacao.php");
   //CONEXÃO COM BANCO DE DADOS 
   $conexao = bancoMysqli();

//recupera a data_inicial e data_final

$dataInicio = exibirDataMysql($_GET['dataInicio']);
$dataFinal = exibirDataMysql($_GET['dataFinal']);


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
<p><?php echo $sql_temp ?></p>
<?php
	$t = "";
	$p = "";
	$sql_consulta = "SELECT * FROM temp_emcartaz ORDER BY idProjeto, idTipo";
	$query_consulta = mysqli_query($conexao,$sql_consulta);
	while($consulta = mysqli_fetch_array($query_consulta)){
	$evento = recuperaDados("ig_evento",$consulta['idEvento'],"idEvento");
	$tipo = recuperaDados("ig_tipo_evento",$consulta['idTipo'],"idTipoEvento");
	$projeto = recuperaDados("ig_projeto_especial",$consulta['idProjeto'],"idProjetoEspecial");
	$servico = geraServico($consulta['idEvento']);
	$faixa = recuperaDados("ig_etaria", $evento['faixaEtaria'],"idIdade");
?>
	<?php if($consulta['idProjeto'] != 1){ 
		if($consulta['idProjeto'] != $p){
	?>
    <h2><?php echo $projeto['projetoEspecial'] ?></h2>
    <?php }
	$p = $projeto['idProjetoEspecial'];
	}?>
	<?php if($consulta['idTipo'] != $t){ ?>
    <h3>
	<br />
	<?php echo $tipo['tipoEvento'] ?>
    <?php 
	$t = $tipo['idTipoEvento'];	
	} ?>
    </h3>
  	<h4><?php echo $evento['nomeEvento'] ?></h4>
	<p>Com: <?php echo nl2br($evento['autor']); ?></p>
	<p>Ficha técnica: <?php echo nl2br($evento['fichaTecnica']); ?></p>
    <p><?php echo $evento['sinopse'] ?></p>
	    <p>Faixa etária: <?php echo $faixa['faixa']; ?></p>
	<?php 
		if($consulta['idTipo'] == 1){
			listaFilmesCom($consulta['idEvento']);	
			
		}
	?>	
	<p><?php
	if($t != 1){
	 echo $servico; 
	}
	 ?></p>

	
	
	
	

<?php 
	}
?>
</body>
</html>
