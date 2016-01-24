
<?php
include 'includes/menu.php';
$conexao = bancoMysqli();
$server = "http://".$_SERVER['SERVER_NAME']."/igsis/";
$http = $server."/pdf/";
$link0=$http."rlt_pedido_contratacao_pf.php";
$link1=$http."rlt_proposta_padrao_pf.php";
$link2=$http."rlt_proposta_artistico_pf.php";
$link3=$http."rlt_proposta_eventoexterno_pf.php";
$link4=$http."rlt_proposta_oficina_pf.php";
$link5=$http."rlt_fac_pf.php";
$link6=$http."rlt_evento_pf.php";
$link7=$http."rlt_pedido_reserva_padrao_pf.php";
$link8=$http."rlt_pedido_reserva_fepac_pf.php";
$link9=$http."rlt_pedido_reserva_cooperativa_pf.php";
$link10=$http."rlt_pedido_reserva_vocacional_pf.php";
$link11=$http."rlt_recibo_ne_pf.php";
$link12=$http."rlt_declaracao_naoservidor_pf.php";
$link13=$http."rlt_declaracao_iss_pf.php";
$link14=$http."rlt_parecer_pf.php";

$processo=$_POST['NumeroProcesso'];
$numeroNE=$_POST['NumeroNotaEmpenho'];
$emissaoNE= $_POST['DataEmissaoNotaEmpenho'];
$entregaNE= $_POST['DataEntregaNotaEmpenho'];
$assinatura = $_POST['Id_Assinatura'];
$idUsuario = $_SESSION['idUsuario'];
$id_ped=$_GET['id_ped'];

$update = "UPDATE igsis_pedido_contratacao 
			SET
			NumeroProcesso = '$processo',
			NumeroNotaEmpenho = '$numeroNE',
			DataEmissaoNotaEmpenho = '$emissaoNE',
			DataEntregaNotaEmpenho = '$entregaNE',
			idAssinatura = '$assinatura'
			WHERE IdPedidoContratacao = '$id_ped' ";

$stmt = mysqli_prepare($conexao,$update);

 if(mysqli_stmt_execute($stmt))
{
 	echo"<p>&nbsp;</p><h4><center>Dados Inseridos com sucesso!</h4><br>";
	 $last_id = mysqli_insert_id($conexao);
	 echo "<br><br><h6>Qual modelo de documento deseja imprimir?</h6><br>
	<div class='row'>
	<div class='col-md-offset-1 col-md-10'>
	
	<form class='form-horizontal' role='form'>
	
	<div class='form-group'>
     <div class='col-md-offset-2 col-md-6'>
		<a href='$link6?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Detalhes do Evento</a></div>
     <div class='col-md-6'>
		<a href='$link0?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Contratação</a></div>
	</div>
	
	<br/> 
	 
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-6'> 
		<a href='$link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Padrão</a></div>
	 <div class='col-md-6'>
	 <a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Artístico</a></div>
	</div>
	 
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-6'> 	 
		<a href='$link3?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Evento Externo</a></div>
	 <div class='col-md-6'>
		<a href='$link4?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Oficina</a></div>
	</div>
	 
	<br/> 
	
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-6'>
		<a href='$link12?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração Não Servidor</a></div>	
	<div class='col-md-6'>	 
		<a href='$link13?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração ISS</a></div>
	</div>
	 
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-6'> 
		<a href='$link5?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>FACC</a></div>
	 <div class='col-md-6'>
		<a href='$link14?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Parecer da Comissão</a></div>
	</div>
	
	<br/> 
	
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-6'> 
		<a href='$link7?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva Padrão</a></div>
	 <div class='col-md-6'>
		<a href='$link8?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva FEPAC</a></div>
	</div>
	 
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-6'> 
		<a href='$link9?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva Cooperativas</a></div>
	 <div class='col-md-6'>
		<a href='$link10?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva Vocacional</a></div>
	</div>
	 
	<br/>  
	 
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-8'> 
		<a href='$link11?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Recibo de Entrega de Nota de Empenho</a></div>
	</div>
   
    </form>
    </div></div>
	 <br /></center>";

}
?>


