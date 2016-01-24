
<?php
include 'includes/menu.php';
$conexao = bancoMysqli();
$_SESSION['idPedido'] = $_GET['id_ped'];
$id_ped = $_GET['id_ped'];
$id = $id_ped;

$server = "http://".$_SERVER['SERVER_NAME']."/igsis/";
$http = $server."/pdf/";
$link0=$http."rlt_pedido_contratacao_pj.php";
$link1=$http."rlt_proposta_padrao_pj.php";
$link2=$http."rlt_proposta_artistico_pj.php";
$link3=$http."rlt_proposta_comunicado_001-15_pj.php";
$link4=$http."rlt_proposta_eventoexterno_pj.php";
$link5=$http."rlt_fac_pj.php";
$link6=$http."rlt_evento_pj.php";
$link7=$http."rlt_direitos_conexos.php";
$link8=$http."rlt_parecer_pj.php";
$link9=$http."rlt_pedido_reserva_padrao_pj.php";
$link10=$http."rlt_pedido_reserva_cooperativa_pj.php";
$link11=$http."rlt_pedido_reserva_fepac_pj.php";
$link12=$http."rlt_pedido_reserva_atividadecultural_pj.php";
$link13=$http."rlt_pedido_reserva_atividadecultural_cooperativa_pj.php";
$link14=$http."rlt_pedido_reserva_vocacional_pj.php";
$link15=$http."rlt_recibo_ne_1rep_pj.php";
$link16=$http."rlt_recibo_ne_2rep_pj.php";
$link17=$http."rlt_declaracao_iss_1rep_pj.php";
$link18=$http."rlt_declaracao_iss_2rep_pj.php";
$link19=$http."rlt_declaracao_exclusividade_1rep_pj.php";
$link20=$http."rlt_declaracao_exclusividade_2rep_pj.php";
$link21=$http."rlt_proposta_reversao_pj.php";




	 $last_id = mysqli_insert_id($conexao);
	 echo "

<section id='list_items' class='home-section bg-white'><h6>Qual modelo de documento deseja imprimir?</h6>
<div class='container'>
<div class='col-md-offset-2 col-md-8'>	
	<div class='table-responsive list_info'>
	
	<table class='table table-condensed'>
	  <thead>					
		<tr class='list_menu'> 
			<td colspan='5'><strong>PEDIDO</strong></td>
		</tr>	
	  </thead>
	  <tbody>
		<tr>
			<td class='list_description'><br/></td>
		</tr>
		<tr>
			<td colspan='3' width='40%'><a href='$link0?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Contratação</a></td>
			<td></td>
			<td></td>
		</tr>
	  </tbody>
	  </table>
	  
	<hr/>	
	
	<table class='table table-condensed'>
	  <thead>					
		<tr class='list_menu'> 
			<td colspan='5'><strong>PROPOSTA</strong></td>
		</tr>	
	  </thead>
	  <tbody>
		<tr>
			<td class='list_description'><br/></td>
		</tr>
		<tr>
			<td><a href='link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Padrão</a></td>
			<td><a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Artístico</a></td>
			<td><a href='$link3?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Comunicado</a></td>
			<td><a href='$link4?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Evento Externo</a></td>
			<td><a href='$link21?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Reversão</a></td>
		</tr>
	  </tbody>
	  </table>
	  
	<br/>
	
	<table class='table table-condensed'>
	  <thead>					
		<tr class='list_menu'> 
			<td colspan='4'><strong>DECLARAÇÃO</strong></td>
		</tr>	
	  </thead>
	  <tbody>
		<tr>
			<td colspan='2' class='list_description'>01 REPRESENTANTE</td>
			<td colspan='2' class='list_description'>02 REPRESENTANTES</td>
		</tr>
		<tr>
			<td><a href='$link17?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>ISS</a></td>
			<td><a href='$link19?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Exclusividade</a></td>
			<td><a href='$link18?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>ISS</a></td>
			<td><a href='$link20?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Exclusividade</a></td>
		</tr>
	  </tbody>
	  </table>
	  
	<hr/>	
	  
	</div>	
		</div>
		</div>
	</section> 		
		
		
<div class='row'>
	<div class='col-md-offset-1 col-md-10'>
	
	<form class='form-horizontal' role='form'>
			
	<div class='form-group'>
     <div class='col-md-offset-2 col-md-8'>Proposta</div>
	</div>
		
		
		
		
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
	 <div class='col-md-offset-2 col-md-8'><h6 align='left'>Proposta</h6></div>
	</div>	 
	 
	 
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-2'> 
		<a href='$link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Padrão</a></div>
	 <div class='col-md-2'>
		<a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'> Artístico</a></div>
	 <div class='col-md-2'> 	 
		<a href='$link3?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'> Comunicado</a></div>
	 <div class='col-md-2'>
		<a href='$link4?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Evento Externo</a></div>
	</div>
	
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-2'> 
		<a href='$link21?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Reversão</a></div>
	</div>	
	 
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-6'> 	 
		<a href='$link3?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Comunicado</a></div>
	 <div class='col-md-6'>
		<a href='$link4?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Evento Externo</a></div>
	</div>
	
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-6'> 	 
		<a href='$link21?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Reversão</a></div>
	</div>	
	 
	 <br/>
	
	<div class='form-group'>
	<div class='col-md-offset-2 col-md-6'>
		<a href='$link17?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração ISS<br/>01 Representante</a></div>
	<div class='col-md-6'>
		<a href='$link18?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração ISS<br/>02 Representantes</a></div>
	</div>
	
	<div class='form-group'>
	<div class='col-md-offset-2 col-md-6'>
		<a href='$link19?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração de Exclusividade<br/>01 Representante</a></div>
	<div class='col-md-6'>
		<a href='$link20?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração de Exclusividade<br/>02 Representantes</a></div>
	</div>
	 
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-6'> 	 
		<a href='$link7?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Uso de Direitos Conexos</a></div>
	 <div class='col-md-6'>
		<a href='$link5?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>FACC</a></div>
	</div>
	
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-6'> 	 
		<a href='$link8?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Parecer da Comissão</a></div>
	</div>
	
	 <br/>
	 
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-6'> 	 
		<a href='$link9?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva Padrão</a></div>
	 <div class='col-md-6'>
		<a href='$link10?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva Cooperativa</a></div>
	</div>
	 
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-6'> 	 
		<a href='$link11?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva FEPAC</a></div>
	 <div class='col-md-6'>
		<a href='$link14?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva Vocacional</a></div>
	</div>
	 
	 <br/>
	 
	<div class='form-group'>
	 <div class='col-md-offset-2 col-md-6'> 	 
		<a href='$link15?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Recibo de Nota de Empenho<br/>01 Representante</a></div>
	 <div class='col-md-6'>
		<a href='$link16?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Recibo de Nota de Empenho<br/>02 Representantes</a></div>
	</div>
   
    </form>
    </div></div>
	 
	 <br /></center>";

?>



