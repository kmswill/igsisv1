<?php

function eventosDiarios($dia){
	$semana = diaSemanaBase($dia);
	$con = bancoMysqli();
	$sql = "SELECT DISTINCT idEvento FROM ig_ocorrencia WHERE 
		(".
		"(dataInicio = '$dia' AND dataFinal <> '0000-00-00')". //data única 
		" OR (dataInicio = '$dia' AND dataFinal = '$dia') ". //data única 
		" OR (dataInicio <= '$dia' AND dataFinal >= '$dia' AND dataFinal <> '0000-00-00' )".
		") AND publicado = '1' ".
		
		"  ORDER BY dataInicio ASC";
	$query = mysqli_query($con,$sql);
	$i = 0;
	while($evento = mysqli_fetch_array($query)){
		$id = $evento['idEvento'];
		$y = recuperaDados("ig_evento",$evento['idEvento'],"idEvento");
		$sql_o = "SELECT * FROM ig_ocorrencia WHERE idEvento = '$id' AND publicado = '1'";
		$query_o = mysqli_query($con,$sql_o);
		while($o = mysqli_fetch_array($query_o)){
			if($o['dataFinal'] == '0000-00-00' AND $o['dataInicio'] == '$dia'){
				$print =  true;	
			}else{
				if(($o['segunda'] == 1 AND $semana == 'segunda') OR
				($o['terca'] == 1 AND $semana == 'terca') OR
				($o['quarta'] == 1 AND $semana == 'quarta') OR
				($o['quinta'] == 1 AND $semana == 'quinta') OR
				($o['sexta'] == 1 AND $semana == 'sexta') OR
				($o['sabado'] == 1 AND $semana == 'sabado') OR
				($o['domingo'] == 1 AND $semana == 'domingo')){
					$print = true;
				}else{
					$print = false; 
				}
				
			} 
			if($print == true){
				$x[$i]['evento'] = $y['nomeEvento'];
				$x[$i]['instituicao'] = $y['idInstituicao'];
				$x[$i]['hora'] = $o['horaInicio'];
				$i++;
			}
		}
	}
	return $x;
}




	if(isset($_POST['inicio']) AND $_POST['inicio'] != ""){
		if($_POST['final'] == ""){
			$mensagem = "É preciso informar a data final do filtro";	
		}else{
			$inicio = exibirDataMysql($_POST['inicio']);
			$final = exibirDataMysql($_POST['final']);
			if($_POST['inicio'] > $_POST['final']){
				$mensagem = "A data final do filtro deve ser maior que a data inicio";		
			}else{
				$data_inicio = exibirDataMysql($_POST['inicio']);
				$data_final = exibirDataMysql($_POST['final']);
				$mensagem = "Filtro aplicado: eventos entre ".$_POST['inicio']." e ".$_POST['final'];
			}
		
		}
		
		
		
	}else{
		$data_inicio = date('Y-m-d');
		$data_final = date('Y-m-d', strtotime("+30 days",strtotime($data_inicio)));
		$mensagem = "Filtro aplicado: eventos de ".exibirDataBr($data_inicio)." a ".exibirDataBr($data_final);	
	}
	
	if(isset($_POST['local'])){
		$idLocal = $_POST['local'];
		$local = " AND idLocal = '$idLocal' ";	
	}else{
		$local = "";	
	}
	

	
	?>
    <script type="application/javascript">
$(function(){
	$('#instituicao').change(function(){
		if( $(this).val() ) {
			$('#local').hide();
			$('.carregando').show();
			$.getJSON('local.ajax.php?instituicao=',{instituicao: $(this).val(), ajax: 'true'}, function(j){
				var options = '<option value=""></option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].idEspaco + '">' + j[i].espaco + '</option>';
				}	
				$('#local').html(options).show();
				$('.carregando').hide();
			});
		} else {
			$('#local').html('<option value="">-- Escolha uma instituição --</option>');
		}
	});
});
</script>
    	<div class="menu-area">
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?secao=inicio">Início</a></li>
							<li><a href="?secao=perfil">Carregar módulo</a></li>
							<li><a href="?secao=ajuda">Ajuda</a></li>
                            <li><a href="../include/logoff.php">Sair</a></li>
							
						</ul>
					</div><!-- /dl-menuwrapper !-->
		</div>
	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Agenda</h2>
					<h4></h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                 </div>
				  </div>
			  </div>  
            <form method="POST" action="?perfil=agenda" class="form-horizontal" role="form">
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
               			 <label>Data início *</label>
                		<input type="text" name="inicio" class="form-control" id="datepicker01" placeholder="">
               		 </div>
                	<div class=" col-md-6">
                		<label>Data encerramento *</label>
                		<input type="text" name="final" class="form-control" id="datepicker02"  placeholder="">
               		</div>
                </div>
                                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
                		<label>Local / instituição *</label><img src="images/loading.gif" class="loading" style="display:none" />
                		<select class="form-control" name="instituicao" id="instituicao" >
                		<option>Selecione</option>
                		<?php geraOpcao("ig_instituicao","","") ?>
                		</select>
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
               		 	<label>Sala / espaço (antes selecione a instituição)</label>
                		<select class="form-control" name="local" id="local" ></select>
                	</div>
                </div>	
 
                  <div class="form-group">
	            <div class="col-md-offset-2 col-md-8">
                <br />
                	<input type="submit" class="btn btn-theme btn-lg btn-block" value="Filtrar">
                    <br >
					</form>
            	</div>
            </div>
            </form>
			<div class="table-responsive list_info">
                  <table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td width='15%'>Data</td>
							<td>Hora</td>
							<td>Evento</td>
							<td>Local</td>
						</tr>
					</thead>
					<tbody>
                    <?php
		//reloadAgenda();			
		$con = bancoMysqli();
		$sql_busca = "SELECT * FROM igsis_agenda WHERE data >= '$data_inicio' AND data <= '$data_final' $local ORDER BY data, hora";
		$query_busca = mysqli_query($con,$sql_busca);
		$data_antiga = "";
		while($busca = mysqli_fetch_array($query_busca)){
			$evento = recuperaDados("ig_evento",$busca['idEvento'],"idEvento");
			$tipo = recuperaDados("ig_tipo_evento",$evento['ig_tipo_evento_idTipoEvento'],"idTipoEvento");
			$local = recuperaDados("ig_local",$busca['idLocal'],"idLocal");
			$instituicao = recuperaDados("ig_instituicao",$busca['idInstituicao'],"idInstituicao");
?>			
<tr>
<?php if($busca['data'] != $data_antiga){ ?>
<td><strong><?php echo exibirDataBr($busca['data']); ?> - <?php echo diasemana($busca['data']); ?></strong></td>
<?php 
$data_antiga = $busca['data'];
}else{
 ?>
<td></td>
<?php } ?>
<td><?php echo substr($busca['hora'], 0, -3); ?></td>
<?php 
if($busca['idTipo'] == 5){
$cinema = recuperaDados("ig_cinema",$busca['idCinema'],"idCinema");
?>

<td><a href="?perfil=busca&p=detalhe&evento=<?php echo $busca['idEvento']; ?>" target='_blank'><?php echo $cinema['titulo']; ?> (<?php echo $tipo['tipoEvento']; ?> : <?php echo $evento['nomeEvento']; ?>) </a> </td>
<?php }else{ ?>
<td><a href="?perfil=busca&p=detalhe&evento=<?php echo $busca['idEvento']; ?>" target='_blank'><?php echo $evento['nomeEvento']; ?> - <?php echo $tipo['tipoEvento']; ?></a></td>
<?php } ?>


<td><?php echo $local['sala']; ?> - <?php echo $instituicao['sigla']; ?></td>

</tr>
<?php }?>					
					</tbody>
					</table>


				   
			</div>
		</div>
	</section>
