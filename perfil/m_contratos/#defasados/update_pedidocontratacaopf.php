<?php

include 'includes/menu.php';
$conexao = bancoMysqli();
$server = "http://".$_SERVER['SERVER_NAME']."/igsis/";
$http = $server."/pdf/";

$link1=$http."rlt_pedido_contratacao_pf.php";
$link2=$http."rlt_evento_pf.php";

	$id_ped = $_GET['id_ped'];
	$valor = $_POST['Valor']; 
	$forma_pagamento = $_POST['FormaPagamento'];
	$verba = $_POST['Verba'];
	$justificativa = $_POST['Justificativa'];
	$fiscal = $_POST['Fiscal'];
	$suplente  = $_POST['Suplente'];
	$parecer = $_POST['ParecerTecnico'];
	$observacao = $_POST['Observacao'];
	$idUsuario = $_SESSION['idUsuario'];

	$sql_atualiza_pedido = "UPDATE igsis_pedido_contratacao SET
		valor = '$valor',
		formaPagamento = '$forma_pagamento',
		idVerba = '$verba',
		justificativa = '$justificativa',
		observacao = '$observacao',
		parecerArtistico = '$parecer',
		estado = 'Análise do Pedido',
		IdUsuarioContratos = '$idUsuario'
		WHERE idPedidoContratacao = '$id_ped'";
	
	$stmt = mysqli_prepare($conexao,$sql_atualiza_pedido);

 if(mysqli_stmt_execute($stmt))
{
 	echo"<p>&nbsp;</p><h4><center>Pedido de Contratação recebido com sucesso!</h4><br>";
	 
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

}	

?>