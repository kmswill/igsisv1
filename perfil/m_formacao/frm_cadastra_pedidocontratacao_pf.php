<?php
/*
$_SESSION['idPedido'] = $_GET['id_ped'];
$id_ped = $_GET['id_ped'];

$server = "http://".$_SERVER['SERVER_NAME']."/igsisbeta/";
$http = $server."/pdf/";
$link1=$http."rlt_pedido_contratacao_pf.php";
$link2=$http."rlt_evento_pf.php";

if(isset($_POST['atualizar'])){ // atualiza o pedido
	$con = bancoMysqli();
	$ped = $_GET['id_ped'];
	//$valor_individual = dinheiroDeBr($_POST['ValorIndividual']);

	$verba = $_POST['Verba'];
	$justificativa = addslashes($_POST['Justificativa']);
	$fiscal = $_POST['Fiscal'];
	$suplente  = $_POST['Suplente'];
	$parecer = addslashes($_POST['ParecerTecnico']);
	$observacao = addslashes($_POST['Observacao']);
	$parcelas = $_POST['parcelas'];

if($_POST['atualizar'] > '1'){

	$sql_atualiza_pedido = "UPDATE igsis_pedido_contratacao SET
		idVerba = '$verba',
		`parcelas` =  '$parcelas',
		justificativa = '$justificativa',
		observacao = '$observacao',
		estado = 'Análise do Pedido',
		parecerArtistico = '$parecer'
		WHERE idPedidoContratacao = '$ped'";
	$query_atualiza_pedido = mysqli_query($con,$sql_atualiza_pedido);
	if($query_atualiza_pedido){
		$recupera = recuperaDados("igsis_pedido_contratacao",$ped,"idPedidoContratacao");
		$idEvento = $recupera['idEvento'];
		$sql_atualiza_evento = "UPDATE ig_evento SET
		idResponsavel = '$fiscal',
		suplente = '$suplente'
		WHERE idEvento = '$idEvento'";
		$query_atualiza_evento = mysqli_query($con,$sql_atualiza_evento);
		if($query_atualiza_evento){
			$mensagem = "Pedido atualizado com sucesso. <br/> <br>
			<h6>Deseja imprimir?</h6><br>
	 <div class='row'>
	<div class='col-md-offset-1 col-md-10'>
	
	<form class='form-horizontal' role='form'>
	
	<div class='form-group'>
    	<div class='col-md-offset-2 col-md-6'>
			<a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Detalhes do Evento</a>
		</div>
    	<div class='col-md-6'>
			<a href='$link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Contratação</a>
		</div>
	</div>
	
	</div></div>		
	 <br /><br /></center>";
	 
		}else{
			$mensagem = "Erro(1) ao atualizar pedido.";	
		}
		
		
	}else{
		$mensagem = "Erro(2) ao atualizar pedido.";
	}

}else{
	$valor = dinheiroDeBr($_POST['Valor']); 
	$forma_pagamento = $_POST['FormaPagamento'];
	$sql_atualiza_pedido = "UPDATE igsis_pedido_contratacao SET
		valor = '$valor',
		formaPagamento = '$forma_pagamento',
		idVerba = '$verba',
		`parcelas` =  '$parcelas',
		justificativa = '$justificativa',
		estado = 'Análise do Pedido',
		observacao = '$observacao',
		parecerArtistico = '$parecer'
		WHERE idPedidoContratacao = '$ped'";
	$query_atualiza_pedido = mysqli_query($con,$sql_atualiza_pedido);
	if($query_atualiza_pedido){
		$recupera = recuperaDados("igsis_pedido_contratacao",$ped,"idPedidoContratacao");
		$idEvento = $recupera['idEvento'];
		$sql_atualiza_evento = "UPDATE ig_evento SET
		idResponsavel = '$fiscal',
		suplente = '$suplente'
		WHERE idEvento = '$idEvento'";
		$query_atualiza_evento = mysqli_query($con,$sql_atualiza_evento);
		if($query_atualiza_evento){
			$mensagem = "Pedido atualizado com sucesso. <br/> <br>
			<h6>Deseja imprimir?</h6><br>
	 <div class='row'>
	<div class='col-md-offset-1 col-md-10'>
	
	<form class='form-horizontal' role='form'>
	
	<div class='form-group'>
    	<div class='col-md-offset-2 col-md-6'>
			<a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Detalhes do Evento</a>
		</div>
    	<div class='col-md-6'>
			<a href='$link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Contratação</a>
		</div>
	</div>
	
	</div></div>		
	 <br /><br /></center>";
		}else{
			$mensagem = "Erro(1) ao atualizar pedido.";	
		}
		
		
	}else{
		$mensagem = "Erro(2) ao atualizar pedido.";
	}
	
}

}
$ano=date('Y');
$id_ped = $_GET['id_ped'];	
$linha_tabelas = siscontrat($id_ped);
$fisico = siscontratDocs($linha_tabelas['IdProponente'],1);		
$evento = recuperaDados("ig_evento",$linha_tabelas['idEvento'],"idEvento");
$pedido = recuperaDados("igsis_pedido_contratacao",$_GET['id_ped'],"idPedidoContratacao");

*/
?>

<!-- MENU -->	
<?php include 'includes/menu.php';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<h2>PEDIDO DE CONTRATAÇÃO DE PESSOA FÍSICA</h2>
                    <h4><?php if(isset($mensagem)){ echo $mensagem; } ?></h4>
               </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">
                <form class="form-horizontal" role="form" action="#" method="post">

				
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Código de Dados para Contratação:</strong><br/>
					  <input  name="Id_PedidoContratacaoPF"  type="text" class="form-control" id="Id_PedidoContratacaoPF"  >
					</div>
                  </div>
                    
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <form class="form-horizontal" role="form" action="#" method="post">
					 <input type="submit" class="btn btn-theme btn-med btn-block" value="Abrir dados para contratação">
                     </form>
				  	</div>
				  </div>
                  
				  <div class="form-group">                    
                    <div class=" col-md-offset-2 col-md-6"><strong>Setor:</strong> 
					  <input type="text"  class="form-control" >
                    </div>
                    <div class="col-md-6"><strong>Categoria da Contratação:</strong> 
                    	<input type="text"  class="form-control">
                    </div>
                  </div>
                  
                  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Proponente:</strong><br/>
					  <input type='text'  class='form-control' name='nome' id='nome'>                    	
                    </div>
                  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Objeto:</strong><br/>
					  <input type="text"  name="Objeto" class="form-control">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Local:</strong><br/>
					 <input type='text' readonly name="LocalEspetaculo" class='form-control'>
					</div>
				  </div>
             
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Período:</strong><br/>
					   <input type='text' readonly name="Periodo" class='form-control'>
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Duração: </strong>
					   <input type='text'  name="Duracao" class='form-control'>
					</div>
					<div class="col-md-6"><strong>Carga Horária:</strong><br/>
					   <input type='text' readonly name="CargaHoraria" class='form-control'>
					</div>
				  </div>
                  <form class="form-horizontal" role="form" action="#" method="post">
                                
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Valor:</strong><br/>
					  <input type='text' disabled name="valor_parcela" id='valor' class='form-control' value="<?php //echo dinheiroParaBr($pedido['valor']) ?>" >
					</div>	
				  </div>
				  		
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Forma de Pagamento:</strong><br/>
                      <textarea  disabled name="FormaPagamento" class="form-control" cols="40" rows="5"><?php // echo txtParcelas($_SESSION['idPedido'],$pedido['parcelas']); ?> 
                      </textarea>
					</div>
				  </div>
				
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Verba:</strong><br/>
					   <select class="form-control" name="Verba" id="Verba">
                       <?php geraOpcao("sis_verba",$linha_tabelas['Verba'],"") ?>
                      </select>
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Justificativa:</strong><br/>
                      <textarea name="Justificativa" cols="40" rows="5"></textarea>
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Fiscal:</strong>
                       <select class="form-control" name="Fiscal" id="Fiscal">
							<?php opcaoUsuario($_SESSION['idInstituicao'],$evento['idResponsavel']); ?>
					   </select>
					</div>
					<div class="col-md-6"><strong>Suplente:</strong>
                       <select class="form-control" name="Suplente" id="Fiscal">
							<?php opcaoUsuario($_SESSION['idInstituicao'],$evento['suplente']); ?>
					   </select>
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observação:</strong><br/>
					   <input type='text' name="Observacao" class='form-control'>
					</div>
				  </div>
                  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <input type="hidden" name="atualizar"  />
					 <input type="submit" class="btn btn-theme btn-lg btn-block" value="Gravar">
					</div>
				  </div>
                  
				</form>
                  
	  		</div>
		</div>
			
	 </div>
	</section>  
