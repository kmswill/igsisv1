<?php 

$con = bancoMysqli();

$_SESSION['idPedido'] = $_GET['id_ped'];
$ano=date('Y');
$id_ped=$_GET['id_ped'];
$pedido = siscontrat($id_ped);
$pj = siscontratDocs($pedido['IdProponente'],2);
$evento = recuperaDados("ig_evento",$pedido['idEvento'],"idEvento");
$executante = siscontratDocs($pedido['IdExecutante'],1);

$ped = recuperaDados("igsis_pedido_contratacao",$id_ped,"idPedidoContratacao");
$res01 = siscontratDocs($ped['idRepresentante01'],3);
$res02 = siscontratDocs($ped['idRepresentante02'],3);

?>

<!-- MENU -->	
<?php include 'includes/menu.php';?>
		
	  
	 <!-- Contact -->
<section id="contact" class="home-section bg-white">
	<div class="container">
		<div class="form-group"><h2>PROPOSTA DE PESSOA JURÍDICA</h2></div>
		<div class="row">
	  		<div class="col-md-offset-1 col-md-10">
            <div class="col-md-offset-2 col-md-8">
            <div class="left">
                <p align="justify"><strong>Código do pedido de contratação:</strong> <?php echo $ano."-".$id_ped; ?></p>
				<p align="justify"><strong>Setor:</strong> <?php echo $pedido['Setor'];?></p>	
				<p align="justify"><strong>Proponente:</strong> <?php echo $pj['Nome'];?></p>
                <p align="justify"><strong>Objeto:</strong> <?php echo $pedido['Objeto'];?></p>
                <p align="justify"><strong>Local:</strong> <?php echo $pedido['Local'];?></p>
                <p align="justify"><strong>Valor:</strong> R$ <?php echo dinheiroParaBr($pedido["ValorGlobal"]);?></p>
                <p align="justify"><strong>Forma de Pagamento:</strong> <?php echo $pedido["FormaPagamento"];?></p>
                <p align="justify"><strong>Data/Período:</strong> <?php echo $pedido['Periodo'];?></p>
                <p align="justify"><strong>Duração:</strong> <?php echo $pedido['Duracao'];?> minutos</p>
                <p align="justify"><strong>Carga Horária:</strong> <?php echo $pedido['CargaHoraria'];?></p>
                <p align="justify"><strong>Justificativa:</strong> <?php echo $pedido['Justificativa']; ?></p>
                <p align="justify"><strong>Fiscal:</strong> <?php echo $pedido['Fiscal'];?></p>
                <p align="justify"><strong>Suplente:</strong> <?php echo $pedido['Suplente'];?></p>
                <p align="justify"><strong>Parecer Técnico:</strong> <?php echo $pedido['ParecerTecnico']; ?></p>
                <p align="justify"><strong>Observação:</strong> <?php echo $pedido['Observacao'];?></p>
                <p align="justify"><strong>Data do Cadastro:</strong> <?php echo exibirDataBr($pedido['DataCadastro']);?></p>
                
			</div>
            </div>
            <div class="form-group">
                <form class="form-horizontal" role="form" action="?perfil=contabilidade&p=rlt_proposta_padrao_pj&id_ped=<?php echo $_SESSION['idPedido']; ?>" method="post">
					<div class="col-md-offset-2 col-md-8">
					 <input type="submit" class="btn btn-theme btn-lg btn-block" value="Gerar Word">
					</div>
                </form>   
				</div>
            </div>
         </div>
         </div>
</section>          
