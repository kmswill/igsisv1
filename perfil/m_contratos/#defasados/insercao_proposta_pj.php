<?php

include 'includes/menu.php';
$conexao = bancoMysqli();
$server = "http://".$_SERVER['SERVER_NAME']."/igsis/";
$http = $server."/pdf/";

$link1=$http."rlt_proposta_padrao_pj.php";
$link2=$http."rlt_proposta_artistico_pj.php";
$link3=$http."rlt_proposta_comunicado_001-15_pj.php";
$link4=$http."rlt_proposta_eventoexterno_pj.php";
$link5=$http."rlt_fac_pj.php";
$link6=$http."rlt_declaracao_exclusividade_1rep_pj.php";
$link7=$http."rlt_declaracao_exclusividade_2rep_pj.php";
$link8=$http."rlt_direitos_conexos.php";
$link9=$http."rlt_declaracao_iss_1rep_pj.php";
$link10=$http."rlt_declaracao_iss_2rep_pj.php";


	$id_ped = $_GET['id_ped'];
	$idUsuario = $_SESSION['idUsuario'];

	$sql_atualiza_pedido = "UPDATE igsis_pedido_contratacao SET
		IdUsuarioContratos = '$idUsuario',
		estado = 'Proposta'
		WHERE idPedidoContratacao = '$id_ped'";
	
	$stmt = mysqli_prepare($conexao,$sql_atualiza_pedido);

 if(mysqli_stmt_execute($stmt))
{
	echo"<p>&nbsp;</p><h4><center>Dados Inseridos com sucesso!</h4><br>";
	 $last_id = mysqli_insert_id($conexao);
	 echo "<br><br><h6>Qual modelo de proposta deseja imprimir?</h6><br>
	 
	 <div class='row'>
	<div class='col-md-offset-1 col-md-10'>
	
	<form class='form-horizontal' role='form'>
	
	<div class='form-group'>
    <div class='col-md-offset-2 col-md-6'>
		<a href='$link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Padrão</a></div>
	<div class='col-md-6'>	
		<a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Artístico</a></div>
	</div>
	
	<div class='form-group'>
    <div class='col-md-offset-2 col-md-6'>
		<a href='$link3?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Comunicado</a></div>
	<div class='col-md-6'> 
		<a href='$link4?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Evento Externo</a></div>
	</div>
	
	<br>
		 
	<div class='form-group'>
	<div class='col-md-offset-2 col-md-6'>
		<a href='$link9?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração ISS<br/>01 Representante</a></div>
	<div class='col-md-6'>
		<a href='$link10?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração ISS<br/>02 Representantes</a></div>
	</div>
		
	<div class='form-group'>
	<div class='col-md-offset-2 col-md-6'>
		<a href='$link6?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração de Exclusividade<br/>01 Representante</a></div>
	<div class='col-md-6'>
		<a href='$link7?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração de Exclusividade<br/>02 Representantes</a></div>
	</div>
	
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-6'> 	 
		<a href='$link8?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Uso de Direitos Conexos</a></div>
	 <div class='col-md-6'>
		<a href='$link5?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>FACC</a></div>
	</div>
	 <br /></div></div>";
};


?>