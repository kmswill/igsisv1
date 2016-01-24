<?php include 'includes/menu.php';?>

<?php
if(!isset($_POST['pesquisar'])){ ?>



	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Busca por pedido</h2>
                    <p></p>

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            <h5><?php if(isset($mensagem)){ echo $mensagem; } ?>
                      <form method="POST" action="?perfil=contratos&p=frm_busca" class="form-horizontal" role="form">
            		<label>Código</label>
            		<input type="text" name="id" class="form-control" id="palavras" placeholder="Insira o ID" ><br />
            		<label>Objeto/Evento</label>
            		<input type="text" name="evento" class="form-control" id="palavras" placeholder="Insira o objeto" ><br />

     
            			          
    	        <label>Fiscal, suplente ou usuário que cadastrou o evento</label>
					<select class="form-control" name="fiscal" id="inputSubject" >
					<option value="0"></option>	
					<?php echo opcaoUsuario($_SESSION['idInstituicao'],"") ?>
                    </select>
                    <br />
                     <label>Tipo de evento</label>
                    <select class="form-control" name="tipo" id="inputSubject" >
					<option value="0"></option>		                
						<?php echo geraOpcao("ig_tipo_evento","","") ?>
                    </select>	
                    <br />
                    <label>Instituição</label>
                    <select class="form-control" name="instituicao" id="inputSubject" >
                   <option value="0"></option>
						<?php echo geraOpcao("ig_instituicao","","") ?>
                    </select>		
                    <br />
                    <label>Status do pedido</label>
                    <select class="form-control" name="estado" id="inputSubject" >
                   <option value=""></option>

<option value="Pedido">Pedido</option>
<option value="Análise do Pedido">Análise do Pedido</option>
<option value="Proposta">Proposta</option>
<option value="Pedido de Reserva">Pedido de Reserva</option>
<option value="Despacho">Despacho</option>
<option value="Publicação no D.O.">Publicação no D.O.</option>
<option value="Anexo da N.E.">Anexo da N.E.</option>
<option value="Anexo da N.E.">Anexo da N.E.</option>
<option value="Pedido de Pagamento">Pedido de Pagamento</option>
                    </select>	

            	</div>
             </div>
				<br />             
	            <div class="form-group">
		            <div class="col-md-offset-2 col-md-8">
                	<input type="hidden" name="pesquisar" value="1" />
    		        <input type="submit" class="btn btn-theme btn-lg btn-block" value="Pesquisar">
                    </form>
        	    	</div>
        	    </div>

            </div>
	</section>
<?php
}else{
$id = trim($_POST['id']);
$evento = trim($_POST['evento']);
$fiscal = $_POST['fiscal'];
$tipo = $_POST['tipo'];
$instituicao = $_POST['instituicao'];
$estado = $_POST['estado'];

if($id == "" AND $evento == "" AND $fiscal == 0 AND $tipo == 0 AND $instituicao == 0 AND $estado == ""){ 
	$mensagem = "Deu merda";
	$x['num'] = 0;
}else{
	

$con = bancoMysqli();
	$sql_existe = "SELECT idPedidoContratacao,idEvento,estado FROM igsis_pedido_contratacao WHERE idEvento = '$idEvento' AND publicado = '1'";
	$query_existe = mysqli_query($con, $sql_existe);
	$num_registro = mysqli_num_rows($query_existe);
if($id != "" AND $num_registro > 0){ // Foi inserido o número do pedido

		$pedido = recuperaDados("igsis_pedido_contratacao",$id,"idPedidoContratacao");
		$evento = recuperaDados("ig_evento",$pedido['idEvento'],"idEvento"); //$tabela,$idEvento,$campo
		$usuario = recuperaDados("ig_usuario",$evento['idUsuario'],"idUsuario");
		$instituicao = recuperaDados("ig_instituicao",$evento['idInstituicao'],"idInstituicao");
		$local = listaLocais($pedido['idEvento']);
		$periodo = retornaPeriodo($pedido['idEvento']);
		$duracao = retornaDuracao($pedido['idEvento']);
		$pessoa = recuperaPessoa($pedido['idPessoa'],$pedido['tipoPessoa']);
		$fiscal = recuperaUsuario($evento['idResponsavel']);
		$suplente = recuperaUsuario($evento['suplente']);
		$protocolo = ""; //recuperaDados("sis_protocolo",$pedido['idEvento'],"idEvento");
		if($pedido['parcelas'] > 1){
			$valorTotal = somaParcela($pedido['idPedidoContratacao'],$pedido['parcelas']);
			$formaPagamento = txtParcelas($pedido['idPedidoContratacao'],$pedido['parcelas']);	
		}else{
			$valorTotal = $pedido['valor'];
			$formaPagamento = $pedido['formaPagamento'];
		}
	
	$x[0]['id']= $pedido['idPedidoContratacao'];
	$x[0]['objeto'] = retornaTipo($evento['ig_tipo_evento_idTipoEvento'])." - ".$evento['nomeEvento'];
	if($pedido['tipoPessoa'] == 1){
		$pessoa = recuperaDados("sis_pessoa_fisica",$pedido['idPessoa'],"Id_PessoaFisica");
		$x[0]['proponente'] = $pessoa['Nome'];
		$x[0]['tipo'] = "Física";

	}else{
		$pessoa = recuperaDados("sis_pessoa_juridica",$pedido['idPessoa'],"Id_PessoaJuridica");
		$x[0]['proponente'] = $pessoa['RazaoSocial'];
		$x[0]['tipo'] = "Jurídica";

	}
	$x[0]['local'] = substr($local,1);
	$x[0]['instituicao'] = $instituicao['sigla'];
	$x[0]['periodo'] = $periodo;
	$x[0]['status'] = $pedido['estado'];
	$x['num'] = 1;
	
}else{ //Não foi inserido o número do pedido
		$i = 0;
		if($evento != ''){
			$filtro_evento = " AND nomeEvento LIKE '%$evento%' ";
		}else{
			$filtro_evento = "";
			
		}
		if($fiscal != 0){
			$filtro_fiscal = " AND (idResponsavel = '$fiscal' OR suplente = '$fiscal' OR idUsuario = '$fiscal' )";	
		}else{
			$filtro_fiscal = "";	
		}
		
		if($tipo != 0){
			$filtro_tipo = " AND ig_tipo_evento_idTipoEvento = '$tipo' ";	
		}else{
			$filtro_tipo = "";	
		}
		
		if($instituicao != 0){
			$filtro_instituicao = " AND idInstituicao = '$instituicao' ";	
		}else{
			$filtro_instituicao = "";	
		}
		
		if($estado == ""){
			$filtro_status = " AND estado IS NOT NULL ";	
	
		}else{
			$filtro_status = " AND estado = '$estado'  ";	

		}
				
		$sql_evento = "SELECT nomeEvento,idEvento FROM ig_evento WHERE publicado = '1' $filtro_evento $filtro_fiscal $filtro_tipo $filtro_instituicao";
		$query_evento = mysqli_query($con,$sql_evento);

		while($evento = mysqli_fetch_array($query_evento)){
			$idEvento = $evento['idEvento'];	
			$sql_existe = "SELECT idPedidoContratacao,idEvento,estado FROM igsis_pedido_contratacao WHERE idEvento = '$idEvento' AND publicado = '1' $filtro_status ";
			$query_existe = mysqli_query($con, $sql_existe);
			if(mysqli_num_rows($query_existe) > 0)
			{
			$pedido = recuperaDados("igsis_pedido_contratacao",$idEvento,"idEvento");
			$evento = recuperaDados("ig_evento",$pedido['idEvento'],"idEvento"); //$tabela,$idEvento,$campo
			$usuario = recuperaDados("ig_usuario",$evento['idUsuario'],"idUsuario");
			$instituicao = recuperaDados("ig_instituicao",$evento['idInstituicao'],"idInstituicao");
			$local = listaLocais($pedido['idEvento']);
			$periodo = retornaPeriodo($pedido['idEvento']);
			$duracao = retornaDuracao($pedido['idEvento']);
			$pessoa = recuperaPessoa($pedido['idPessoa'],$pedido['tipoPessoa']);
			$fiscal = recuperaUsuario($evento['idResponsavel']);
			$suplente = recuperaUsuario($evento['suplente']);
			$protocolo = ""; //recuperaDados("sis_protocolo",$pedido['idEvento'],"idEvento");
			if($pedido['parcelas'] > 1){
				$valorTotal = somaParcela($pedido['idPedidoContratacao'],$pedido['parcelas']);
				$formaPagamento = txtParcelas($pedido['idPedidoContratacao'],$pedido['parcelas']);	
			}else{
				$valorTotal = $pedido['valor'];
				$formaPagamento = $pedido['formaPagamento'];
			}
		
			$x[$i]['id']= $pedido['idPedidoContratacao'];
			$x[$i]['objeto'] = retornaTipo($evento['ig_tipo_evento_idTipoEvento'])." - ".$evento['nomeEvento'];
			if($pedido['tipoPessoa'] == 1){
				$pessoa = recuperaDados("sis_pessoa_fisica",$pedido['idPessoa'],"Id_PessoaFisica");
				$x[$i]['proponente'] = $pessoa['Nome'];
				$x[$i]['tipo'] = "Física";
			}else{
				$pessoa = recuperaDados("sis_pessoa_juridica",$pedido['idPessoa'],"Id_PessoaJuridica");
				$x[$i]['proponente'] = $pessoa['RazaoSocial'];
				$x[$i]['tipo'] = "Jurídica";

			}
			$x[$i]['local'] = substr($local,1);
			$x[$i]['instituicao'] = $instituicao['sigla'];
			$x[$i]['periodo'] = $periodo;
			$x[$i]['status'] = $pedido['estado'];			
			$i++;
			}
		}
		$x['num'] = $i;
		$mensagem = "Foram encontradas ".$x['num']." pedido(s) de contratação.";
}
 
 }
} 



?>
<br />
<br />
	<section id="list_items">
		<div class="container">
			 <h3>Resultado da busca</3>
             <h5>Foram encontrados <?php echo $x['num']; ?> pedidos de contratação.</h5>
             <h5><a href="?perfil=contratos&p=frm_busca">Fazer outra busca</a></h5>
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Codigo do Pedido</td>
							<td>Proponente</td>
							<td>Tipo</td>
							<td>Objeto</td>
							<td width="20%">Local</td>
                            <td>Instituição</td>
							<td>Periodo</td>
							<td>Status</td>
						</tr>
					</thead>
					<tbody>
<?php

$data=date('Y');
for($h = 0; $h < $x['num']; $h++)
 {
	echo "<tr><td class='lista'> <a href='?perfil=contratos&p=frm_edita_propostapj&id_ped=".$x[$h]['id']."'>".$x[$h]['id']."</a></td>";
	echo '<td class="list_description">'.$x[$h]['proponente'].					'</td> ';
	echo '<td class="list_description">'.$x[$h]['tipo'].					'</td> ';
	echo '<td class="list_description">'.$x[$h]['objeto'].						'</td> ';
	echo '<td class="list_description">'.$x[$h]['local'].				'</td> ';
	echo '<td class="list_description">'.$x[$h]['instituicao'].				'</td> ';
	echo '<td class="list_description">'.$x[$h]['periodo'].						'</td> ';
	echo '<td class="list_description">'.$x[$h]['status'].						'</td> </tr>';
	}
?>
	
					
					</tbody>
				</table>
			</div>
		</div>
	</section>



<?php if(isset($resultado)){var_dump($resultado);}?>