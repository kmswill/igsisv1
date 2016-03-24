<?php

include 'includes/menu.php';
$conexao = bancoMysqli();
$server = "http://".$_SERVER['SERVER_NAME']."/igsis/";
$http = $server."/pdf/";

$link1=$http."rlt_pedido_contratacao_pj.php";
$link2=$http."rlt_evento_pj.php";
	
	$con = bancoMysqli();
	$pedido = $_GET['id_ped'];
	$id_ped = $pedido;
	$valor = dinheiroDeBr($_POST['Valor']); 
	$forma_pagamento = addslashes($_POST['FormaPagamento']);
	$verba = $_POST['Verba'];
	$justificativa = addslashes($_POST['Justificativa']);
	$fiscal = $_POST['Fiscal'];
	$suplente  = $_POST['Suplente'];
	$parecer = addslashes($_POST['ParecerTecnico']);
	$observacao = $_POST['Observacao'];
	$idUsuario = $_SESSION['idUsuario'];

	$sql_atualiza_pedido = "UPDATE igsis_pedido_contratacao SET
		valor = '$valor',
		formaPagamento = '$forma_pagamento',
		`parecerArtistico` = '$parecer',
		`justificativa` = '$justificativa', 
		idVerba = '$verba',
		observacao = '$observacao',
		estado = 'Análise do Pedido',
		IdUsuarioContratos = '$idUsuario'
		WHERE idPedidoContratacao = '$pedido'";
	$query_atualiza_pedido = mysqli_query($con,$sql_atualiza_pedido);
	if($query_atualiza_pedido){
		$x = recuperaDados("igsis_pedido_contratacao",$_GET['id_ped'],"idPedidoContratacao");
		$idEvento = $x['idEvento'];
		$sql_atualiza_evento = "UPDATE `ig_evento` SET 
		`idResponsavel` = '$fiscal',
		 `suplente` = '$suplente'

		   WHERE `idEvento` = '$idEvento'
		";
		
		$query_atualiza_evento = mysqli_query($con,$sql_atualiza_evento);
		if($query_atualiza_evento){
			$mensagem = "Pedido atualizado com sucesso!";
		}else{
			$mensagem = "Erro ao atualizar(1). Tente novamente.";	
		}
			
	}else{
			$mensagem = "Erro ao atualizar(2). Tente novamente.";	
	}	


	  echo "<p>&nbsp;</p><h4><center>Pedido alterado com sucesso</h4><br>";
	   echo "<br><br><h6>O que deseja imprimir?</h6><br>
	 <div class='row'>
	<div class='col-md-offset-1 col-md-10'>
	
	<form class='form-horizontal' role='form'>
	
	<div class='form-group'>
    	<div class='col-md-offset-2 col-md-8'>
			<a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Detalhes do Evento</a>
		</div>
	</div>
	
	<br/>
	
	<div class='form-group'>
    	<div class='col-md-offset-2 col-md-8'>
			<a href='$link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Contratação</a>
		</div>
	</div>
	
	</div></div>		
	 <br /></center>";
 

?>