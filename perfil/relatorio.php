<?php
require_once("../funcoes/funcoesVerifica.php");
require_once("../funcoes/funcoesSiscontrat.php");
if(isset($_GET['idEvento'])){
	$evento = verificaCampos($_GET['idEvento']);
	$ocorrencia = verificaOcorrencias($_GET['idEvento']);	
}

?>

	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Relatórios do Sistema</h2>
                     <h3>Eventos e pedidos de contratação</h3>
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

<?php 

function geraTimestamp($data) {
$partes = explode('-', $data);
return mktime(0, 0, 0, $partes[1], $partes[2], $partes[1]);
}
	$i = 0;
	while($data = mysqli_fetch_array($query_eventos)){
		$prazo = prazoContratosDias($data['idEvento']);
		if($prazo == TRUE){
			$i++;	
		}
		
		 
	}

?>

	<p>Sendo o prazo de 45 dias antes da execução do evento a data máxima para o envio de pedidos de contratação, foram enviados <?php echo $i++ ?> dentro do prazo.</p>
    	




					</div>
				  </div>
			  </div>
			  
		</div>
	</section>