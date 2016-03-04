<?php

if(isset($_GET['p'])){
	$p = $_GET['p'];	
}else{
	$p = 'inicial';
}




require "../funcoes/funcoesAdministrador.php"; //chamar funcoes do administrador
require "../funcoes/funcoesSiscontrat.php"; //chamar funcoes do administrador

?>
<!--    				<a href="?perfil=administrador&atualizar=agenda" class="btn btn-theme btn-lg btn-block">Atualizar agenda</a> -->
	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li>
								<a href="?perfil=admin&p=visaogeral">Visão Geral</a>
							</li>
   							<li><a href="?perfil=admin&p=reabertura"> Reabrir eventos enviados</a></li>
   							<li><a href="?perfil=admin&p=scripts"> Scripts</a></li>
   							<li><a href="?perfil=admin&p=contratos">Contratos</a></li>
							<li><a href="?secao=perfil">Carregar módulo</a></li>
							<li><a href="?secao=ajuda">Ajuda</a></li>
                            <li><a href="../include/logoff.php">Sair</a></li>
							<!--<li>
								<a href="#">Sub Menu</a>
								<ul class="dl-submenu">
									<li><a href="#">Sub menu</a></li>
									<li><a href="#">Sub menu</a></li>
								</ul>
							</li>-->
						</ul>
					</div><!-- /dl-menuwrapper -->
	</div>	
<?php
switch($p){
case "inicial":	
	
?>
<section id="contact" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                <h2>Administrador do Sistema</h2>
	                <h5>Escolha uma opção</h5>
                </div>
            </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <a href="?perfil=admin&p=visaogeral" class="btn btn-theme btn-lg btn-block">Visao Geral</a>
                <a href="?perfil=admin&p=reabertura" class="btn btn-theme btn-lg btn-block">Reabrir eventos enviados</a>
                <a href="?perfil=admin&p=scripts" class="btn btn-theme btn-lg btn-block">Scripts</a>

	            <!--<a href="?perfil=busca&p=pedidos" class="btn btn-theme btn-lg btn-block">Pedidos de contratação</a>-->

            </div>
          </div>
        </div>
    </div>
</section>    


<?php break; 
case "visaogeral":
?>
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Administração Geral do Sistema</h3>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
           					<h5>Usuários ativos</h5>
			                <div class="form-group">

                            <?php 
							// Defino a hora com a qual vou trabalhar
							$agora = date('Y-m-d H:i:s');
							// Somo 5 minutos (resultado em int)
							//$horaNova = strtotime("$hora + 30 minutes");
							// Formato o resultado
							//$horaNovaFormatada = date("H:i:s",$horaNova);
							// Mostro na tela
							$con = bancoMysqli();
							$sql_user = "SELECT DISTINCT idUsuario, ip, time FROM igsis_time";
							$query_user = mysqli_query($con,$sql_user);
							while($x = mysqli_fetch_array($query_user)){
								 
								$usuario = recuperaDados("ig_usuario",$x['idUsuario'],"idUsuario");
								$hora = strtotime($x['time']);
								$novaHora = strtotime('+30 minute',$hora);
								$agora = strtotime(date('H:m:i'));
								if($novaHora > $agora){				
								?>                            
									<p><?php echo $usuario['nomeCompleto'] ?> pelo IP: <?php echo $x['ip']; ?> às <?php echo $x['time']; ?> </p>
		
								<?php
									}
								}
								
							?>
                            </div>
                            <br />
           					<h5>Usuários ativos no último mês</h5>
			                <div class="form-group">
<?php 
	$trinta_dias = date('Y-m-d H:i:s', strtotime("-30 days"));
	$sql_usuarios = "SELECT DISTINCT ig_usuario_idUsuario FROM ig_log WHERE dataLog > '$trinta_dias'";
	$query_usuarios = mysqli_query($con,$sql_usuarios);
	$num_usuarios = mysqli_num_rows($query_usuarios);

?>                            
<p><b><?php echo $num_usuarios ?></b> usuários logaram no sistema nos últimos 30 dias.</p>
                            
                            </div>
							<br />
           					<h5>IGs</h5>
			                <div class="form-group">

    <?php
	$con = bancoMysqli();
	$sql_eventos = "SELECT * FROM ig_evento WHERE publicado ='1' AND dataEnvio IS NOT NULL";
	$query_eventos = mysqli_query($con,$sql_eventos);
	$num_eventos = mysqli_num_rows($query_eventos);

	$sql_pedidos = "SELECT * FROM igsis_pedido_contratacao WHERE publicado = '1' AND estado IS NOT NULL";
	$query_pedidos = mysqli_query($con,$sql_pedidos);
	$num_pedidos = mysqli_num_rows($query_pedidos);
	?>
	<p>Foram enviados <b><?php echo $num_eventos ?></b> eventos com <b><?php echo $num_pedidos ?></b> pedidos de contratação.</p>

    
                            </div>
                            <br />
           					<h5>IGs</h5>
			                <div class="form-group">
                            
                            
                            </div>

          </div>
        </div>
    
    </div>
</section>  
<?php	
break; // FIM EVENTOS
case "reabertura": // VISUALIZAR REABERTURA DE IGSIS


if(isset($_POST['apagar'])){
	$idEvento = $_POST['apagar'];
	$sql_reabrir = "UPDATE ig_evento SET publicado = '0' WHERE idEvento = '$idEvento'";
	$query_reabrir = mysqli_query($con,$sql_reabrir);
	if($query_reabrir){
		$sql_pedido = "UPDATE igsis_pedido_contratacao SET publicado = '0' WHERE idEvento = '$idEvento'";
		$query_pedido = mysqli_query($con,$sql_pedido);
		if($query_pedido){
			$evento = recuperaDados("ig_evento",$idEvento,"idEvento");
			$mensagem = "Evento ".$evento['nomeEvento']."($idEvento) apagado com sucesso";	
		}
	} 
	
}



if(isset($_POST['reabertura'])){
	$idEvento = $_POST['reabertura'];
	$mensagem = "";
	$sql_reabrir = "UPDATE ig_evento SET dataEnvio = NULL WHERE idEvento = '$idEvento'";
	$query_reabrir = mysqli_query($con,$sql_reabrir);
	if($query_reabrir){
		$evento = recuperaDados("ig_evento",$idEvento,"idEvento");
		$mensagem = $mensagem."O evento ".$evento['nomeEvento']." foi reaberto.<br />";
		$sql_pedido = "UPDATE igsis_pedido_contratacao SET estado = NULL WHERE idEvento = '$idEvento'";
		$query_pedido = mysqli_query($con,$sql_pedido);
		if($query_pedido){
			$mensagem = $mensagem."Os pedidos foram reabertos.<br />";
			$sql_recupera_pedidos_abertos = "SELECT * FROM igsis_pedido_contratacao WHERE publicado = '1' AND idEvento = $idEvento AND estado IS NULL";
			$query_recupera_pedidos_abertos = mysqli_query($con,$sql_recupera_pedidos_abertos);
			$n_recupera = mysqli_num_rows($query_recupera_pedidos_abertos);
			if($n_recupera > 0){
				$mensagem = "O evento ".$evento['nomeEvento']."foi reaberto.";
				$pedido = "";
				while($x = mysqli_fetch_array($query_recupera_pedidos_abertos)){
					$pedidos = $pedidos." ".$x['idPedidoContratacao'].","; 	
				}
				$conteudo_email = "
				Olá,<br />
				Por solicitação, o(s) pedido(s) ".trim(substr($pedidos,0,-1))." foi(foram) reaberto(s) e não aparecerá(ão) em suas listas no Módulo Contratação até que seja(m) reenviado(s).<br /><br />
				Att,<br />
				Equipe IGSIS<br />
				";
				$instituicao = 4;
				$subject = "O evento '".$evento['nomeEvento']."' foi reaberto";
				$email = "sistema.igsis@gmail.com";
				$usuario = "IGSIS";
				
					
				$email_envia = enviarEmailContratos($conteudo_email, $instituicao, $subject, $email, $idEvento);
			}
			if($email_envia){
				$mensagem = $mensagem."<br />Foram enviadas notificações à área de Contratos.";	
			}	
			
		}
	} 
	
}

						if(isset($_GET['order'])){
							switch($_GET['order']){
						
							case "dataEnvio":
								$order = " ORDER BY dataEnvio DESC";
								$mensagem .= "<br /> Ordenados pelas últimas datas de envio.<br />(Reaberturas de IGs geram novas datas de envio mas não Números de Evento.)";	
							break;
						
							case "idEvento":
								$order = " ORDER BY idEvento DESC";	
								$mensagem .= "<br /> Ordenados pelo número de Evento";	
					
							
								
							}	
						}else{
							$order = " ORDER BY idEvento DESC ";	
							$mensagem .= "<br /> Ordenados pelo últimos números de Evento";	

						}


?>
<section id="list_items" class="home-section bg-white">
		 <div class="form-group">
            <div class="col-md-offset-2 col-md-8">		
			<h2>Lista de eventos</h2>
			
  	        </div>
				</div> 
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					
					</div> <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
					</div>
				  </div>
				  
			<div class="table-responsive list_info">
<?php 

						$idInsituicao = $_SESSION['idInstituicao'];
						$sql_lista = "SELECT * FROM ig_evento WHERE publicado = '1' AND dataEnvio IS NOT NULL $order";
						$query_lista = mysqli_query($con,$sql_lista);
						$num = mysqli_num_rows($query_lista);
?>
			<h5><?php echo $num ?> eventos enviados.</h5>
            <p><a href="?perfil=admin&p=reabertura">Ordenar pelos últimos Números de Evento</a> | <a href="?perfil=admin&p=reabertura&order=dataEnvio">Ordenar pelas últimas datas de envio</a></p>
            <table class='table table-condensed'>
					<thead>					
					<tr class='list_menu'> 
							<td>ID</td>
							<td>Evento</td>
  							<td>Tipo</td>
                            <td>Instituição</td>
							<td>Data/Período</td>
                            <td>Pedido</td>
                            <td width="7%"></td>
                            <td width="7%"></td>
                            <td width="7%"></td>
						 </tr>	
					</thead>
					<tbody>
                        <?php 
						

						while($campo = mysqli_fetch_array($query_lista)){
		$protocolo = recuperaDados("ig_protocolo",$campo['idEvento'],"ig_evento_idEvento");
		$chamado = recuperaAlteracoesEvento($campo['idEvento']);
		$instituicao = recuperaDados("ig_instituicao",$campo['idInstituicao'],"idInstituicao");	
			echo "<tr>";
			echo "<td class='list_description'><a href='?perfil=detalhe&evento=".$campo['idEvento']."' target='_blank'>".$campo['idEvento']."</a>
			</td>";
			echo "<td class='list_description'>".$campo['nomeEvento']." ["; 
			if($chamado['numero'] == '0'){
				echo "0";
			}else{
			echo "<a href='?perfil=chamado&p=evento&id=".$campo['idEvento']."' target='_blank'>".$chamado['numero']."</a>";	
			}
				
			echo "]</td>";
			echo "<td class='list_description'>".retornaTipo($campo['ig_tipo_evento_idTipoEvento'])."</td>";
			echo "<td class='list_description'>".$instituicao['instituicao']."</td>";
			echo "<td class='list_description'>".retornaPeriodo($campo['idEvento'])."</td>";
			echo "<td class='list_description'>".substr(retornaPedidos($campo['idEvento']),7)."</td>";
			echo "<td class='list_description'>
			<form method='POST' action='?perfil=admin&p=reabertura'>
			<input type='hidden' name='reabertura' value='".$campo['idEvento']."' >
			<input type ='submit' class='btn btn-theme  btn-block' value='reabrir'></td></form>"	;
			echo "<td class='list_description'>
			<form method='POST' action='?perfil=administrador&p=reabertura'>
			<input type='hidden' name='apagar' value='".$campo['idEvento']."' >
			<input type ='submit' class='btn btn-theme  btn-block' value='Apagar'></td></form>"	;
			echo "<td class='list_description'>
			<form method='POST' action='?perfil=evento&p=basica' target='_blank'>
			<input type='hidden' name='carregar' value='".$campo['idEvento']."' >
			<input type ='submit' class='btn btn-theme  btn-block' value='Carregar'></td></form>"	;
			echo "</tr>";	
						}
?>
                        </tbody>
				</table>
			</div>
		</div>
</section>
<?php 
break;
case "contratos":

if(!isset($_POST['id_ped'])){
?>

	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title"><h2>Digite o Número do Pedido</h2></div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=admin&p=contratos" method="post">
				 <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><br/>
					  <input type="text" class="form-control" id="id_ped" name="id_ped">
					</div>
				  </div>
					
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <input type="submit" value="GRAVAR" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
                  
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

<?php 	
}else{
	$id_ped = $_POST['id_ped'];	
	if(isset($_POST['atualizar'])){
		$processo = $_POST['NumeroProcesso'];
		$nota = $_POST['NumeroNotaEmpenho'];
		$data_emissao = $_POST['DataEmissaoNotaEmpenho'];
		$data_entrega = $_POST['DataEntregaNotaEmpenho'];
		$con = bancoMysqli();
		$sql_atualiza = "UPDATE igsis_pedido_contratacao SET
		NumeroProcesso = '$processo',
		NumeroNotaEmpenho = '$nota',
		DataEmissaoNotaEmpenho = '$data_emissao',
		DataEntregaNotaEmpenho = '$data_entrega'
		WHERE idPedidoContratacao = '$id_ped'";
	$query_atualiza = mysqli_query($con,$sql_atualiza);
		if($query_atualiza){
			gravarLog($sql_atualiza);
			$mensagem = "Pedido atualizado";
			
		}else{
			$mensagem = "Erro ao atualizar";
		}

	echo $mensagem = "Erro(2)";
	}

	
	

$pedido = recuperaDados("igsis_pedido_contratacao",$id_ped,"idPedidoContratacao");
$ped = siscontrat($id_ped);
?>
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title"><h2><?php echo $ped['Objeto']; ?></h2>
                    <h3><?php if(isset($mensagem)){ echo $mensagem;} ?></h3>
                    <h3><?php if(isset($sql_atualizsa)){echo $sql_atualiza;} ?></h3>
                    </div>
                    
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=admin&p=contratos" method="post">
				 <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Código do Pedido de Contratação:</strong><br/>
					  <input type="text" readonly class="form-control" id="IdPedidoContratacaoPJ" name="IdPedidoContratacaoPJ" value="<?php echo $pedido['idPedidoContratacao']; ?>" >
					</div>
				  </div>
				  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Processo SEI:</strong>
					  <input type="text" class="form-control" id="NumeroProcesso" name="NumeroProcesso" placeholder="Número do Processo"  value="<?php echo $pedido['NumeroProcesso']; ?>" /> 
					</div>
				  </div>
				 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Número da Nota de Empenho:</strong>
					  <input type="text" class="form-control" id="NumeroNotaEmpenho" name="NumeroNotaEmpenho" placeholder="Número da Nota de Empenho" value="<?php echo $pedido['NumeroNotaEmpenho']; ?>">
					</div>
				  </div>
                  
                   <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Data de Emissão da Nota de Empenho:</strong>
					  <input type="date" class="form-control" id="DataEmissaoNotaEmpenho" name="DataEmissaoNotaEmpenho" placeholder="Data de Emissao da Nota de Empenho" value="<?php echo $pedido['DataEmissaoNotaEmpenho']; ?>">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Data de Entrega da Nota de Empenho:</strong>
					  <input type="date" class="form-control" id="DataEntregaNotaEmpenho" name="DataEntregaNotaEmpenho" placeholder="Data de Entrega da Nota de Empenho" value="<?php echo $pedido['DataEntregaNotaEmpenho']; ?>">
					</div>
				  </div>
					
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <input type="hidden" name="id_ped" value="<?php echo $id_ped; ?>" /> 
                    <input type="hidden" name="atualizar" value="1" /> 
					 <input type="submit" value="Atualizar" class="btn btn-theme btn-lg btn-block">
				</form>

					</div>

				  </div>
				<a href="?perfil=admin&p=contratos" class="btn btn-theme btn-lg btn-block" >Outro pedido</a>                  
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  



<?php 
}
break;
case "scripts":

if(isset($_GET['atualizar'])){
	if($_GET['atualizar'] == 'agenda'){
		if(reloadAgenda()){
			$texto = "Agenda atualizada.";	
		}	
	}
}

if(isset($_GET['status'])){
	$con = bancoMysqli();
	$sql_pedido = "SELECT * FROM igsis_pedido_contratacao WHERE publicado = '1'";
	$query_pedido = mysqli_query($con,$sql_pedido);
	$texto = "";
	$i = 0;
	

	while($pedido = mysqli_fetch_array($query_pedido)){
		$idPedido = $pedido['idPedidoContratacao'];

		$texto .= $pedido['estado']."<br />";	

		if($pedido['aprovacaoFinanca'] == NULL OR $pedido['aprovacaoFinanca'] == 1 ){
			
		}else{
		if(trim($pedido['NumeroProcesso']) != "" OR $pedido['NumeroProcesso'] != NULL){ // Se há número de processo
			if(trim($pedido['NumeroNotaEmpenho']) != "" OR $pedido['NumeroNotaEmpenho'] != NULL){ // Se há número de Nota de Empenho
				$idStatus = "10";
			$texto .= "O status do pedido $idPedido é 10.<br />";
			}else{
				$idStatus = "4"; //Só tem número de processo	
				$texto .= "O status do pedido $idPedido é 4.<br />";
			}
		}  		
		// switch
		$switchPedido = $pedido['estado'];
		switch($switchPedido){
		
		case "Proposta":
		$idStatus = "5";
		$texto .= "O status do pedido $idPedido é Proposta.<br />";
		break;

		case "Análise do Pedido":
		$idStatus = "3";
		$texto .= "O status do pedido $idPedido é Análise.<br />";
		break;

		case "Pedido":
		$idStatus = "1";
		$texto .= "O status do pedido $idPedido é Pedido.<br />";
		
		break;

		case "Concluído":
		$idStatus = "11";
		$texto .= "O status do pedido $idPedido é Concluído.<br />";
		break;
		}
		
		$sql_atualiza = "UPDATE igsis_pedido_contratacao SET estado = '$idStatus' WHERE idPedidoContratacao = '$idPedido'";
		$query_atualiza = mysqli_query($con, $sql_atualiza);
		if($query_atualiza){
			$texto .= "OK<br />";
			$i++;	
		}else{
			$texto .= "Erro<br />";	
		}
	}
	}
	
	$texto .= "<br /> $i pedidos atualizados.<br />";

}

if(isset($_GET['empenho'])){
	$sql_pedido = "SELECT * FROM igsis_pedido_contratacao WHERE publicado = '1' and valor > 0";
	$query_pedido = mysqli_query($con,$sql_pedido);
	$texto = "";
	while($pedido = mysqli_fetch_array($query_pedido)){
		if($pedido['NumeroNotaEmpenho'] != "" OR $pedido['NumeroNotaEmpenho'] != NULL){
			$con = bancoMysqli();
			$idPedido = $pedido['idPedidoContratacao'];
			$sql_atualiza_status = "UPDATE igsis_pedido_contratacao SET estado = '10' WHERE idPedidoContratacao = '$idPedido'"; 
			$query_atualiza_status = mysqli_query($con,$sql_atualiza_status);
			if($query_atualiza_status){
				$texto .= "Pedido $idPedido atualizado para Entrega N.E.";
			}	
		}
	}
}

if(isset($_GET['inst_agenda'])){
	$con = bancoMysqli();	
	$sql_data = "SELECT * FROM igsis_agenda";
	$query_data = mysqli_query($con,$sql_data);
	$i = 0;
	$num = mysqli_num_rows($query_data);
	while($agenda = mysqli_fetch_array($query_data)){
		
		$id = $agenda['idAgenda'];
		$inst = recuperaDados("ig_local",$agenda['idLocal'],"idLocal");
		$idInst = $inst['idInstituicao'];
		$sql_atualiza = "UPDATE igsis_agenda SET idInstituicao = '$idInst' WHERE idAgenda = '$id'";
		$query_atualiza = mysqli_query($con,$sql_atualiza);
		if($query_atualiza){
			$i++;	
		}
	}
	$mensagem = "Foram atualizados $i de $num registros.";
}


if(isset($_GET['limpar_base'])){
	$con = bancoMysqli();	
	$sql_data = "DELETE FROM ig_evento WHERE ig_tipo_evento_idTipoEvento = '0'";
	$query_data = mysqli_query($con,$sql_data);
	$num = mysqli_affected_rows($query_data);
	if($query_data){
		$mensagem = "Base de eventos limpa. Foram deletados $num registros.";
	}else{
		$mensagem = "Erro ao limpar a base";
	}
}


?>
<section id="contact" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                <h2>Administrador do Sistema</h2>
	                <h5>Scripts - use com moderação</h5>
                    <h5><?php if(isset($mensagem)){ echo $mensagem; } ?></h5>
                    
                </div>
            </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                <a href="?perfil=admin&p=scripts&atualizar=agenda" class="btn btn-theme btn-lg btn-block">Atualizar agenda</a>
                <a href="?perfil=admin&p=scripts&status=1" class="btn btn-theme btn-lg btn-block">Atualizar status</a>
              <a href="?perfil=admin&p=scripts&inst_agenda=1" class="btn btn-theme btn-lg btn-block">Atualizar Instituições/Agenda</a>
               <a href="?perfil=admin&p=scripts&limpar_base=1" class="btn btn-theme btn-lg btn-block">Limpar base de eventos</a>
              <a href="?perfil=admin&p=scripts&empenho=1" class="btn btn-theme btn-lg btn-block">Atualizar status N.E.</a>

	            <!--<a href="?perfil=busca&p=pedidos" class="btn btn-theme btn-lg btn-block">Pedidos de contratação</a>-->

            </div>
          </div>
          <?php if(isset($texto)){ ?>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
            <br /><br />
				<p><?php echo $texto;  ?></p>
            </div>
          </div>
  		<?php } ?>	
        </div>
    </div>
</section>    

<?php } ?>
